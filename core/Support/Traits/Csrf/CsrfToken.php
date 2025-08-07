<?php

namespace Core\Support\Traits\Csrf;

use Core\Exception\Handlers\CsrfException;
use Core\Support\Session;

trait CsrfToken
{
    /**
     * @return void
     * @throws CsrfException
     */
    public static function checkCsrf()
    {
        $sessionToken = Session::get('csrf_token');

        // 1. Token from POST
        $postToken = $_POST['csrf_token'] ?? null;

        // 2. Token from headers (manual extraction for full compatibility)
        $headerToken = null;
        foreach ($_SERVER as $key => $value) {
            if (strtolower($key) === 'http_x_csrf_token') {
                $headerToken = $value;
                break;
            }
        }

        // Prefer POST token if available
        $token = $postToken ?? $headerToken;

        if ($token && $sessionToken) {
            if (!static::verify($sessionToken, $token)) {
                throw new CsrfException("CSRF token mismatch");
            }
        } else {
            throw new CsrfException("CSRF token missing or invalid");
        }
    }

    /**
     * @param $token
     * @param $requestedToken
     * @return bool
     */
    public static function verify($token, $requestedToken): bool
    {
        return $token === $requestedToken;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function token(): mixed
    {
        if (Session::has('csrf_token')) {
            $token = Session::get('csrf_token');
        } else{
            $token = bin2hex(random_bytes(32));
            Session::put('csrf_token', $token);
        }
        return $token;
    }

    /**
     * @return void
     * @throws \Exception
     */
    private static function rotateToken()
    {
        $expireAfter = 10;
        if(Session::has('last_action')){
            $secondsInactive = time() - Session::get('last_action');
            $expireAfterSeconds = $expireAfter * 60;
            if($secondsInactive >= $expireAfterSeconds){
                Session::forget('csrf_token');
            }
        }
        Session::put('last_action',time());
        Session::put('csrf_token', bin2hex(random_bytes(32)));
    }

}
