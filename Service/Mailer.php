<?php

/*
 * This file is part of the Mailer bundle from Stack Instance.
 *
 * (c) 2016 Ray Kootstra
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StackInstance\MailerBundle\Service;

/**
 * Mailer service to send email via Swift Mailer in an easy way
 *
 * Class Mailer
 * @package StackInstance\MailerBundle\Service
 * @author Ray Kootstra <r.kootstra@stackinstance.com>
 */
class Mailer
{
    const BODY_TYPE = 'text/html';

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var \Swift_Message
     */
    protected $message;

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->message = \Swift_Message::newInstance();
    }

    /**
     * @param string    $subject
     * @param string    $body
     * @param array     $to
     * @param array     $from
     * @param array     $attachments
     * @return $this
     */
    public function send($subject, $body, array $to, array $from, array $attachments)
    {
        $this->message->setSubject($subject);
        $this->message->setFrom($from);
        $this->message->setTo($to);
        $this->message->setBody($body, self::BODY_TYPE);

        /** @var Attachment $attachment */
        foreach($attachments as $attachment) {
            if ($attachment instanceof Attachment) {
                $this->attach($attachment);
            }
        }

        $this->mailer->send($this->message);

        return $this;
    }

    /**
     * @param Attachment $attachment
     * @return $this
     */
    public function attach(Attachment $attachment)
    {
        $mailAttachment = \Swift_Attachment::fromPath($attachment->getFile());

        if ($attachment->getFilename() !== null) {
            $mailAttachment->setFilename($attachment->getFilename());
        }

        if ($attachment->getMimeType() !== null) {
            $mailAttachment->setContentType($attachment->getMimeType());
        }

        $this->message->attach($mailAttachment);
        return $this;
    }

}