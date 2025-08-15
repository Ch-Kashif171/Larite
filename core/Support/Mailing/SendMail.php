<?php

namespace Core\Support\Mailing;
use Core\Mailer\PHPMailer;
use Core\Mailer\Exception;

class SendMail
{
    public $to;
    public $to_name;
    public $subject;
    public $from;
    public $from_name;
    public $attachment;
    public $attachment_name;
    public $load_view;

    /**
     * @param $view
     * @param $data
     */
    public function __construct($view,$data)
    {
        $this->load_view = view($view, $data,true);
    }

    /**
     * @param $to
     * @param string $to_name
     * @return $this
     */
    public function to($to, string $to_name = ''): static
    {
        $this->to = $to;
        $this->to_name = $to_name;
        return $this;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function subject($subject): static
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param $from
     * @param string $from_name
     * @return $this
     */
    public function from($from, string $from_name = ''): static
    {
        $this->from = $from;
        $this->from_name = $from_name;
        return $this;
    }

    /**
     * @param $attachment
     * @param string $attachment_name
     * @return $this
     */
    public function attachment($attachment, string $attachment_name = ''): static
    {
        $this->attachment = $attachment;
        $this->attachment_name = $attachment_name;
        return $this;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function sendMail(): bool
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = config('mail.host');
            $mail->SMTPAuth = true;
            $mail->Username = config('mail.username');
            $mail->Password = config('mail.password');
            $mail->SMTPSecure = config('mail.encryption');
            $mail->Port = config('mail.port');

            //Recipients
            $mail->setFrom(config('mail.from.address'), config('mail.from.name'));
            $mail->addAddress($this->to, 'Larite');

            if (! is_null($this->attachment)){
                $mail->addAttachment($this->attachment,$this->attachment_name);
            }

            //Content
            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body    = $this->load_view;

            $sent = $mail->send();

            return $sent ?? false;

        } catch (Exception $e) {
            throw $e;
        }

    }

}