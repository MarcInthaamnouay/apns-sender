<?php 

namespace Vendor\Push\Pushcontroller;

include 'messageAbstract.php';
include 'senderController.php';

Class PushController{
    
    // Create a new message 
    private $message;
    private $sender;

    public function __construct(){
        $this->message = new \Vendor\Push\Message\Payload();
        $this->sender = new \Vendor\Push\Sender\Sender();
    }

    public function sendPush(){
        // Create a payload 
        $payload = $this->message->makeMessage();
        
        // Send the APNS 
        $this->sender->sendPush($payload);
    }
}
