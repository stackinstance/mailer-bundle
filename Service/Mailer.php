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
     * @param string               $subject
     * @param string               $body
     * @param array|string         $to
     * @param array|string         $from
     * @param array|AttachmentInterface|null    $attachments
     * @return int
     */
    public function send($subject, $body, $to, $from, $attachments = null)
    {
        $this->message->setSubject($subject);
        $this->message->setFrom($from);
        $this->message->setTo($to);
        $this->message->setBody($body, self::BODY_TYPE);

        $this->processAttachments($attachments);

        return $this->mailer->send($this->message);

    }

    /**
     * @param AttachmentInterface|array $attachments
     */
    protected function processAttachments($attachments)
    {
        if (is_array($attachments) === true) {
            /** @var Attachment $attachment */
            foreach ($attachments as $attachment) {
                if ($attachment instanceof AttachmentInterface) {
                    $this->attach($attachment);
                }
            }
        } else {
            if ($attachments instanceof AttachmentInterface) {
                $this->attach($attachments);
            }
        }
    }

    /**
     * @param AttachmentInterface $attachment
     * @return $this
     */
    public function attach(AttachmentInterface $attachment)
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
