#Facebook Messenger Bot library for PHP

PHP client for Facebook Messenger Bot API.

You can read more [official documentation](https://developers.facebook.com/docs/messenger-platform) about API.

##Install 

composer require "liberalu/facebookbot" "dev-master"

##Example

### Answer to message

```
<?php

use FacebookBot\FacebookBot;
use FacebookBot\Webhook\Request;
use FacebookBot\Send\TextMessage;

$secretKey = 'YOUR_SECRET_KEY';
$apiSecret = 'YOUR_API_SECRET';
$data      = json_decode(file_get_contents("php://input"), true);
$request   = new Request($data, $apiSecret);

if ($request->getMessage()->getType() === Request::TEXT 
    && substr($request->getMessage()->getTextMessage(), 0, 4) === 'echo'
) {
    $fbBot = new FacebookBot($secretKey);
    $sendMessage = new TextMessage();
    $sendMessage->setText($request->getMessage()->getTextMessage());
    $sendMessage->setRecipientId($request->getMessage()->getSenderId());
    $fbBot->sendMessage($sendMessage);
}
```
