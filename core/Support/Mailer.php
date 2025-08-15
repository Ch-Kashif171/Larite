<?php

namespace Core\Support;

use Closure;
use Core\Mailer\Exception;
use Core\Support\Mailing\SendMail;

class Mailer
{
    /**
     * @param $view
     * @param $data
     * @param Closure $closure
     * @return bool
     * @throws Exception
     */
    public static function send($view, $data, Closure $closure): bool
    {
        $mail = new SendMail (
            $view,
            $data
        );
         $closure (
             $mail
         );

        return $mail->sendMail();
    }

}