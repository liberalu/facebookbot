<?php

namespace FacebookBot;

use FacebookBot\Send\InterfaceMessage;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class FacebookBot
 *
 * @package FacebookBot
 */
class FacebookBot
{

    /** @var string $token fb bot token */
    private $token;

    /** @var string */
    private $fbApiUrl = 'https://graph.facebook.com/v2.6/me';

    /** @var Client */
    private $client;

    /**
     * FacebookBot constructor
     *
     * @param string $token fb bot token
     */
    public function __construct($token)
    {
        $this->token  = $token;
        $this->client = new Client();
    }


    /**
     * Check if fb bot token is valid
     *
     * @return bool
     */
    public function isTokenValid()
    {
        $tokenValidation = false;
        $request = new Request('POST', $this->fbApiUrl.'/subscribed_apps?access_token='.$this->token);

        try {
            $response = $this->client->send($request);
            $result = \json_decode($response->getBody()->getContents(), true);
            if (isset($result['success']) && (int) $result['success'] === 1) {
                $tokenValidation = true;
            }
        } catch (\Exception $err) {
            //
        }

        return $tokenValidation;
    }


    /**
     * Send message to Facebook
     *
     * @param InterfaceMessage $message message object
     *
     * @return bool
     */
    public function sendMessage(InterfaceMessage $message)
    {
        $message->validate();
        $request = new Request(
            'POST',
            $this->fbApiUrl.'/messages?access_token='.$this->token,
            [
                'Content-Type' => 'application/json',
            ],
            \json_encode($message->getMessage())
        );

        $response = $this->client->send($request);

        return $response->getStatusCode() === 200;
    }


    /**
     * Set client
     *
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }



}
