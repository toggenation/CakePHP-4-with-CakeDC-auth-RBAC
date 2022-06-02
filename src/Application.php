<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App;

use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Http\ServerRequest;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Core\ContainerInterface;
use Cake\ORM\Locator\TableLocator;
use CakeDC\Auth\Policy\RbacPolicy;
use Cake\Datasource\FactoryLocator;
use Authorization\Policy\MapResolver;
use Authorization\Policy\OrmResolver;
use Authorization\AuthorizationService;
// In src/Application.php add the following imports
use CakeDC\Auth\Policy\SuperuserPolicy;
use CakeDC\Auth\Policy\CollectionPolicy;
use Authentication\AuthenticationService;
use Authorization\Policy\ResolverCollection;
use Cake\Routing\Middleware\AssetMiddleware;
use Psr\Http\Message\ServerRequestInterface;

use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Authorization\Exception\ForbiddenException;
use Authorization\AuthorizationServiceInterface;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Authentication\AuthenticationServiceInterface;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Authorization\Middleware\AuthorizationMiddleware;
use Authentication\Middleware\AuthenticationMiddleware;
use Authorization\AuthorizationServiceProviderInterface;
use App\Middleware\UnauthorizedHandler\RedirectWhenDenied;
use App\Policy\AllowDebugKitPolicy;
use Authentication\AuthenticationServiceProviderInterface;
use Authorization\Middleware\RequestAuthorizationMiddleware;
use Authorization\Middleware\UnauthorizedHandler\ExceptionHandler;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication implements
    AuthenticationServiceProviderInterface,
    AuthorizationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        } else {
            FactoryLocator::add(
                'Table',
                (new TableLocator())->allowFallbackClass(false)
            );
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }

        // Load more plugins here
        $this->addPlugin('Authorization');
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance. For that when
            // creating the middleware instance specify the cache config name by
            // using it's second constructor argument:
            // `new RoutingMiddleware($this, '_cake_routes_')`
            ->add(new RoutingMiddleware($this))

            ->add(new AuthenticationMiddleware($this))

            ->add(new AuthorizationMiddleware($this, [
                'unauthorizedHandler' => [
                    'className' => RedirectWhenDenied::class,
                    'exceptions' => [
                        ForbiddenException::class
                        // MissingIdentityException::class,
                    ],
                    'url' => [
                        'controller' => 'Users',
                        'action' => 'login',
                    ],
                    'queryParam' => 'redirect',
                    'statusCode' => 302,
                ]
            ]))

            ->add(new RequestAuthorizationMiddleware())

            // Parse various types of encoded request bodies so that they are
            // available as array through $request->getData()
            // https://book.cakephp.org/4/en/controllers/middleware.html#body-parser-middleware
            ->add(new BodyParserMiddleware())

            // Cross Site Request Forgery (CSRF) Protection Middleware
            // https://book.cakephp.org/4/en/controllers/middleware.html#cross-site-request-forgery-csrf-middleware
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
            ]));

        return $middlewareQueue;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/4/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
    }

    /**
     * Bootstrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void
    {
        $this->addOptionalPlugin('Cake/Repl');
        $this->addOptionalPlugin('Bake');

        $this->addPlugin('Migrations');

        // Load more plugins here
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $fields = [
            'username' => 'username',
            'password' => 'password',
        ];

        $authenticationService = new AuthenticationService([
            'unauthenticatedRedirect' => Router::url('/users/login'),
            'queryParam' => 'redirect',
        ]);

        // Load identifiers, ensure we check email and password fields
        $authenticationService->loadIdentifier('Authentication.Password', [
            'fields' => $fields
        ]);

        // Load the authenticators, you want session first
        $authenticationService->loadAuthenticator('Authentication.Session', [
            'skipTwoFactorVerify' => true
        ]);
        // Configure form data check to pick email and password
        $authenticationService->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
            'loginUrl' => Router::url('/users/login'),
        ]);

        return $authenticationService;
    }

    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        $map = new MapResolver();

        $map->map(
            ServerRequest::class,
            new CollectionPolicy([
                AllowDebugKitPolicy::class,
                SuperuserPolicy::class, // if super user access everything
                RbacPolicy::class
            ])
        );

        $orm = new OrmResolver();

        $resolver = new ResolverCollection([
            $map,
            $orm
        ]);

        return new AuthorizationService($resolver);
    }
}
