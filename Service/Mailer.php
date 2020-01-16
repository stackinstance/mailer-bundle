<?php

/*
 * This file is part of the Mailer bundle from Stack Instance.
 *
 * (c) 2019 Ray Kootstra
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StackInstance\MailerBundle\Service;

use \Swift_Mailer;
use \Swift_Message;
use \Swift_Attachment;

/**
 * Mailer service to send email via Swift Mailer in an easy way
 *
 * Class Mailer
 *
 * @package StackInstance\MailerBundle\Service
 * @author Ray Kootstra <info@raymondkootstra.nl>
 */
class Mailer implements MailerInterface
{
    /**
     * @var Swift_Mailer
     */
    protected $mailer;

    /**
     * @var Swift_Message
     */
    protected $message;

    /**
     * @param Swift_Mailer $mailer
     */
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @inheritdoc
     */
    public function send(
        string $subject,
        string $body,
        $to,
        $from,
        $cc = null,
        $bcc = null,
        $attachments = null,
        $returnPath = null
    ) {

        $this->message = new \Swift_Message($subject);

        if ($returnPath !== null) {
            $this->message->setReturnPath($returnPath);
        }

        if (is_array($from)) {
            foreach($from as $address => $name) {
                $this->message->addReplyTo($address, $name);
            }
        } else {
            $this->message->addReplyTo($from);
        }
        
        $this->message->setFrom($from);

        $this->message->setSubject($subject);
        $this->message->setTo($to);

        $this->message->setBody($body, MailerInterface::BODY_TYPE_HTML);
        $this->message->addPart($this->htmlToText($body), MailerInterface::BODY_TYPE_PLAIN);

        if ($cc !== null) {
            $this->message->setCc($cc);
        }

        if ($bcc !== null) {
            $this->message->setBcc($bcc);
        }

        $this->processAttachments($attachments);

        $send = $this->mailer->send($this->message);
        $this->reset();

        return $send;
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

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function attach(AttachmentInterface $attachment)
    {
        $mailAttachment = Swift_Attachment::fromPath($attachment->getFile());

        if ($attachment->getFilename() !== null) {
            $mailAttachment->setFilename($attachment->getFilename());
        }

        if ($attachment->getMimeType() !== null) {
            $mailAttachment->setContentType($attachment->getMimeType());
        }

        $this->message->attach($mailAttachment);

        return $this;
    }

    /**
     * @param string $text
     *
     * @return string
     */
    protected function htmlToText(string $text = "")
    {
        preg_match("/<body[^>]*>(.*?)<\/body>/is", $text, $match);
        if (isset($match[1])) {
            $match = $match[1];
        } else {
            $match = $text;
        }
        $text = strip_tags(str_replace("</p>", "\n", $match));
        $text = str_replace("&nbsp;", " ", $text);

        return trim(html_entity_decode($text, ENT_QUOTES | ENT_HTML5));
    }

    /**
     * Resets the mailer after sending an email
     */
    protected function reset()
    {
        $this->message = null;
    }
}
