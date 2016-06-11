<?php

namespace FacebookBot;


/**
 * Class RequestMessage
 *
 * @package FacebookBot
 */
class RequestMessage
{

    private $textMessage = '';
    private $senderId    = null;
    private $timestamp   = null;
    private $type        = null;
    private $payload     = null;
    private $attachment  = null;
    private $seq         = null;


    /**
     * @param string $textMessage
     */
    public function setTextMessage($textMessage)
    {
        $this->textMessage = $textMessage;
    }


    /**
     * @return string
     */
    public function getTextMessage()
    {
        return $this->textMessage;
    }


    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


    /**
     * @return null | string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @param int $senderId
     */
    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }


    /**
     * @return null | int
     */
    public function getSenderId()
    {
        return $this->senderId;
    }


    /**
     * @param string $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }


    /**
     * @return null | string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }


    /**
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }


    /**
     * @return null | string
     */
    public function getPayload()
    {
        return $this->payload;
    }


    /**
     * @param string $attachment
     */
    public function setAtthement($attachment)
    {
        $this->attachment = $attachment;
    }


    /**
     * @return null | string
     */
    public function getAttachment()
    {
        return $this->attachment;
    }


    /**
     * @param int $seq
     */
    public function setSeq($seq)
    {
        $this->seq = $seq;
    }


    /**
     * @return int
     */
    public function getSeq()
    {
        return $this->seq;
    }

}
