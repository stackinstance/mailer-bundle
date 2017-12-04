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
 * Attachment to add to the Mailer service
 *
 * Class Attachment
 * @package StackInstance\MailerBundle\Service
 * @author Ray Kootstra <r.kootstra@stackinstance.com>
 */
class Attachment implements AttachmentInterface
{

    /**
     * @var string $file
     */
    protected $file;

    /**
     * @var string $filename
     */
    protected $filename;

    /**
     * @var string $mimeType
     */
    protected $mimeType;

    /**
     * @inheritdoc
     */
    public function attach($file, $filename = null, $mimeType = null)
    {
        $this->file = $file;

        if ($filename !== null) {
            $this->filename = $filename;
        }

        if ($mimeType !== null) {
            $this->mimeType = $mimeType;
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @inheritdoc
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @inheritdoc
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

}
