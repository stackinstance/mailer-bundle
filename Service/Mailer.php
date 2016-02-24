<?php

namespace StackInstance\MailerBundle\Service;

/**
 * Class Mailer
 * @package StackInstance\MailerBundle\Service
 */
class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param $subject
     * @param $body
     * @param $to
     * @param $from
     * @return $this
     */
    public function send($subject, $body, $to, $from)
    {
        $message = \Swift_Message::newInstance();
        $message->setSubject($subject);
        $message->setFrom($from);
        $message->setTo($to);
        $message->setBody($body, 'text/html');

        $this->mailer->send($message);

        return $this;
    }

}