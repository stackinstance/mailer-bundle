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
 * Interface MailerInterface
 *
 * @package StackInstance\MailerBundle\Service
 */
interface MailerInterface
{
    const BODY_TYPE_HTML = 'text/html';
    const BODY_TYPE_PLAIN = 'text/plain';

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer);

    /**
     * @param string $subject
     * @param string $body
     * @param array|string $to
     * @param array|string $from
     * @param array|string $cc
     * @param array|string $bcc
     * @param AttachmentInterface|AttachmentInterface[] $attachments
     *
     * @return int
     */
    public function send($subject, $body, $to, $from, $cc = null, $bcc = null, $attachments = null);

    /**
     * @param AttachmentInterface $attachment
     * @return $this
     */
    public function attach(AttachmentInterface $attachment);
}
