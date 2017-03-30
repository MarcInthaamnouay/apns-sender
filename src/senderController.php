<?php 

namespace Vendor\Push\Sender;

include 'senderAbstract.php';

Class Sender{
    
    public function __construct(){}

    /**
     *  Send Push 
     *  @param []byte $payload
     */
    public function sendPush($payload){
        $this->sender = new \Vendor\Push\SenderAbstract\ApnsAbstract();
        $isInit = $this->sender->createGateway();

        if (!$isInit)
            throw new \Exception("can not connect to gateway");
        
        $this->sender->writeSocket($payload);
    }
}