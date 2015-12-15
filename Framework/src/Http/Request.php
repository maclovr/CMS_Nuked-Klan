<?php

/*
 * This file is part of the Nuked-Klan package.
 *
 * (c) Nuked-Klan <xxx@nuked-klan.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NukedKlan\Framework\Http;

use Symfony\Component\HttpFoundation\Request as BaseRequest;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Session;

class Request extends BaseRequest
{
    public static function createFromGlobals()
    {
        $request = parent::createFromGlobals();
        $storage = new NativeSessionStorage();
        $session = new Session($storage);

        $request->setSession($session);

        return $request;
    } 
} 
