<?php

namespace FacebookBot;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

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


}
