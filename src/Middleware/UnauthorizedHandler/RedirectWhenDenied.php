<?php

namespace App\Middleware\UnauthorizedHandler;

use Cake\Http\Response;
use Authorization\Exception\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Authorization\Middleware\UnauthorizedHandler\CakeRedirectHandler;
use Cake\Routing\Router;

class RedirectWhenDenied extends CakeRedirectHandler
{

    /**
     * {@inheritDoc}
     *
     * Return a response with a location header set if an exception matches.
     */
    public function handle(
        Exception $exception,
        ServerRequestInterface $request,
        array $options = []
    ): ResponseInterface {
        $options += $this->defaultOptions;

        if (!$this->checkException($exception, $options['exceptions'])) {
            throw $exception;
        }

        /**
         * @var \Cake\Http\ServerRequest $request
         */

        if ($request->getAttribute('identity') === null) {
            // stop appending ?redirect=/controller/action
            $options['queryParam'] = null;

            // if not logged in redirect to /users/login
            $url = $this->getUrl($request, $options);

            $flashMessage = "You need to be logged in to access that location";
        } else {
            $url = $request->referer(false) ?? Router::url($options['noRefererRedirect']);

            $flashMessage = "You don't have access to {$request->getPath()}";
        }

        $request->getFlash()->error($flashMessage);

        return (new Response())
            ->withStatus($options['statusCode'])
            ->withHeader('Location', $url);
    }

    /**
     * @inheritDoc
     */
    protected function getUrl(ServerRequestInterface $request, array $options): string
    {
        $url = $options['url'];

        if ($options['queryParam'] !== null) {
            $uri = $request->getUri();
            $redirect = $uri->getPath();
            if ($uri->getQuery()) {
                $redirect .= '?' . $uri->getQuery();
            }

            $url['?'][$options['queryParam']] = $redirect;

            $url['?']['seen'] = 1;
        }

        return Router::url($url);
    }
}
