<?php
/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send\Elements;


/**
 * Class QuickReplyElement
 */
class QuickReplyElement
{
    /** @var string */
    private $title;

    /** @var string */
    private $payload;

    /** @var string */
    private $contentType;


    /**
     * QuickReplyElement constructor
     */
    public function __construct()
    {
        $this->setContentType('text');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }


    /**
     * Get QuickReply array
     *
     * @return array
     */
    public function getQuickReply()
    {
        $quickReply = [
            'content_type' => $this->getContentType(),
            'title'        => $this->getTitle(),
            'payload'      => $this->getPayload(),
        ];

        return $quickReply;
    }
}
