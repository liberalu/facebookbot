<?php

namespace FacebookBot\Send;


/**
 * Class AbstractMessage
 *
 * @package FacebookBot\Send
 */
abstract class AbstractMessage
{

    /** @var  int */
    private $recipientId;

    /**
     * Set recipient id
     *
     * @param int $recipientId recipient id
     */
    public function setRecipientId($recipientId)
    {
        $this->recipientId = $recipientId;
    }


    /**
     * Get recipient id
     *
     * @return int
     */
    public function getRecipientId()
    {
        return $this->recipientId;
    }


    /**
     * Create response to Facebook content
     *
     * @param array $message
     *
     * @return array
     */
    protected function responseContent(array $message)
    {
        $content = [
            'recipient' => [
                'id' => $this->getRecipientId(),
            ],
            'message' => $message,
        ];

        return $content;
    }

}
