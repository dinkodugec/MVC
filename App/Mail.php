<?php

namespace App;

use App\Config;
use Mailgun\Mailgun;

/**
 * Mail
 */
class Mail
{

    /**
     * Send a message
     *
     * @param string $to Recipient
     * @param string $subject Subject
     * @param string $text Text-only content of the message
     * @param string $html HTML content of the message
     *
     * @return mixed
     */
    public static function send($to, $subject, $text, $html)
    {
        $mg = Mailgun::create(Config::MAILGUN_API_KEY); // For US servers
        //$mg = Mailgun::create(Config::MAILGUN_API_KEY, 'https://api.eu.mailgun.net');  For EU servers
         // look at https://github.com/mailgun/mailgun-php for API of mailgun
        $mg->messages()->send(Config::MAILGUN_DOMAIN, [
            'from'    => 'sender@example.com',
            'to'      => $to,
            'subject' => $subject,
            'text'    => $text,
            'html'    => $html
        ]);
    }
}