<?php

declare(strict_types=1);

namespace App\Policy;

use App\AllowPhpDebug;
use Authorization\IdentityInterface;
use CakeDC\Auth\Policy\PolicyInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * AllowPhpDebug policy
 */
class AllowDebugKitPolicy  implements PolicyInterface
{
    public function canAccess(?IdentityInterface $identity, ServerRequestInterface $request): bool
    {
        /**
         * @var ServerRequest $request
         */
        if ($request->getParam('plugin') === 'DebugKit') {
            return true;
        }
        return false;
    }
}
