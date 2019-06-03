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
 * Class AttachmentInterface
 * @package StackInstance\MailerBundle\Service
 * @author Ray Kootstra <info@raymondkootstra.nl>
 */
interface AttachmentInterface
{

    /**
     * @param string      $file
     * @param string|null $filename
     * @param string|null $mimeType
     * @return $this
     */
    public function attach(string $file, string $filename = null, string $mimeType = null);

    /**
     * @return string
     */
    public function getFile();

    /**
     * @return string
     */
    public function getFilename();

    /**
     * @return string
     */
    public function getMimeType();

}