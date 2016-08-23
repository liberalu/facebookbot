<?php

namespace FacebookBot\Settings\Elements;

/**
 * Class ActionElement
 */
class ActionElement
{

    /** @var string */
    private $type;

    /** @var string */
    private $title;

    /** @var string */
    private $url;

    /** @var string */
    private $payload;

    const TYPE_WEB_URL  = 'web_url';
    const TYPE_POSTBACK = 'postback';


    /**
     * Set type
     *
     * @param string $type
     *
     * @throws \InvalidArgumentException type doesn't exist
     */
    public function setType($type)
    {
        if ($type !== self::TYPE_POSTBACK && $type !== self::TYPE_WEB_URL) {
            throw new \InvalidArgumentException('Action type does not exist');
        }

        $this->type = $type;
    }


    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     * Set payload
     *
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }


    /**
     * Get payload
     *
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }


    /**
     * Get action
     *
     * @return array
     */
    public function getAction()
    {
        $return = [
            'type'  => $this->getType(),
            'title' => $this->getTitle(),
        ];

        if ($this->getType() === self::TYPE_WEB_URL) {
            $return['url'] = $this->getUrl();
        } elseif ($this->getType() === self::TYPE_POSTBACK) {
            $return['payload'] = $this->getPayload();
        }

        return $return;
    }

}
