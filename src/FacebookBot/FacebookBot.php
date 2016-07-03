<?php

namespace FacebookBot;

use FacebookBot\Send\InterfaceMessage;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

/**
 * Class FacebookBot
 *
 * @package FacebookBot
 */
class FacebookBot
{

    /** @var string $token fb bot token */
    private $token;

    private $fbApiUrl = 'https://graph.facebook.com/v2.6/me';


    /**
     * FacebookBot constructor
     *
     * @param string $token fb bot token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }


    /**
     * Check if fb bot token is valid
     *
     * @return bool
     */
    public function isTokenValid()
    {
        $tokenValidation = false;
        $request = new Psr7\Request('POST', $this->fbApiUrl.'/subscribed_apps?access_token='.$this->token);
        $client  = new Client();

        try {
            $response = $client->send($request);
            $result = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
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
        $request = new Psr7\Request(
            'POST',
            $this->fbApiUrl.'/messages?access_token='.$this->token,
            [
                'Content-Type' => 'application/json',
            ],
            \GuzzleHttp\json_encode($message->getMessage())
        );

        $client  = new Client();
        $response = $client->send($request);

        return $response->getStatusCode() === 200;
    }

}
