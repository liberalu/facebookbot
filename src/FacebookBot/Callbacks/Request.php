<?php

namespace FacebookBot\Callbacks;

/**
 * Class Request
 *
 * @package FacebookBot
 */
class Request
{

    /** @var array */
    private $content = [];

    /** @var string */
    private $apiSecret;

    /** @var \FacebookBot\RequestMessage */
    private $message;


    const PAYLOAD    = 'payload';
    const TEXT       = 'text';
    const ATTACHMENT = 'attachment';
    const DELIVERY   = 'delivery';

    /**
     * InputMessage constructor.
     *
     * @param array  $content   message content
     * @param string $apiSecret fb api secret
     */
    public function __construct(array $content, $apiSecret)
    {
        $this->content   = $content;
        $this->apiSecret = $apiSecret;
        $this->message   = new Message();
        $this->parseMessage($content);
    }


    /**
     * Check if message from Facebook is valid
     *
     * @param string $xHubSignatureHeader X-Hub-Signature header value
     *
     * @return bool
     */
    public function isMessageValid($xHubSignatureHeader)
    {
        $data    = explode('=', $xHubSignatureHeader);
        $isValid = array_key_exists('1', $data)
            && hash_hmac($data[0], \json_encode($this->content), $this->apiSecret) === $data[1];

        return $isValid;
    }


    /**
     * Get incoming message object
     *
     * @return \FacebookBot\Callbacks\Message
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * Parse incoming message
     *
     * @param $content
     */
    private function parseMessage($content)
    {

        if (!empty($content['entry'][0]['messaging'][0])) {
            $this->parseHeader($content['entry'][0]);
            $this->parseMessageContent($content['entry'][0]['messaging'][0]);
        }
    }


    /**
     * Parse incoming message content
     *
     * @param array $content
     */
    private function parseMessageContent(array $content)
    {
        if (!empty($content['message']['attachments'])) {
            $this->parseAttachmentMessage($content);
        } elseif (!empty($content['message']['text'])) {
            $this->parseTextMessage($content);
        } elseif (!empty($content['postback']['payload'])) {
            $this->parsePayloadMessage($content);
        } elseif (!empty($content['delivery'])) {
            $this->parseDeliveryMessage($content);
        } else {
            throw new \RuntimeException('Callback message type doesn\'t exist');
        }
    }


    /**
     * Parse incoming message header
     *
     * @param array $content
     */
    private function parseHeader(array $content)
    {
        $this->message->setSenderId($content['messaging'][0]['sender']['id']);
        $this->message->setTimestamp($content['time']);
        $this->message->setRecipientId($content['messaging'][0]['recipient']['id']);
        $this->message->setPageId($content['id']);
    }


    /**
     * Parse attachment message content
     *
     * @param array $content
     */
    private function parseAttachmentMessage(array $content)
    {
        $this->message->setType(self::ATTACHMENT);
        $this->message->setAttachment($content['message']['attachments'][0]['payload']['url']);
        $this->message->setSeq($content['message']['seq']);
    }


    /**
     * Parse payload message content
     *
     * @param array $content
     */
    private function parsePayloadMessage(array $content)
    {
        $this->message->setPayload($content['postback']['payload']);
        $this->message->setType(self::PAYLOAD);
    }


    /**
     * Parse text message content
     *
     * @param $content
     */
    private function parseTextMessage(array $content)
    {
        $this->message->setTextMessage($content['message']['text']);
        $this->message->setSeq($content['message']['seq']);
        $this->message->setType(self::TEXT);
    }


    /**
     * Parse delivery message text
     *
     * @param $content
     */
    private function parseDeliveryMessage(array $content)
    {
        $this->message->setType(self::DELIVERY);
        $this->message->setSeq($content['delivery']['seq']);
    }

}
