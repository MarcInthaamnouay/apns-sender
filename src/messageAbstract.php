<?php

namespace Vendor\Push\Message;

Class Payload{

    // Constant 
    const RETRY_COUNTER = 3;
    const COMMAND = 1;
    const VALIDITY = 86400 * 7; // Push valid 'til 7 days
    const TOKEN = "<your device token>";

    protected $title;
    protected $body;

    /**
     *  Construct 
     */
    public function __construct($title = "hello", $body = "hey pretty asian girl"){
        $this->title = $title;
        $this->body = $body;
    }

    /**
     *  Make Message
     *  @return []byte 
     */
    public function makeMessage(){
        $payload = $this->createJSONPayload();
        $binary = $this->convertToBinary($payload);

        return $binary;
    }

    /**
     *  Create JSON Payload 
     *  @private 
     *  @return string json
     */
    private function createJSONPayload(){
        $payload = new \StdClass();
        $payload->aps =  array(
            "alert" => array(
                "title" => $this->title,
                "body" => $this->body
            ),
            "url-args" => array()
        );

        return json_encode($payload);
    }

    /**
     *  Convert To Binary 
     *          Convert the payload to binary 
     *  @public 
     *  @params string $payload 
     *  @return []byte $binaryPayload 
     */
    private function convertToBinary($payload){
        if (!strlen($payload))
            throw new \Exception("payload is empty");

        $token = pack('H*', str_replace(' ', '', self::TOKEN));
        $binM = chr(0).chr(0).chr(32).$token.chr(0).chr(strlen($payload)).$payload;

        return $binM;
    }
}