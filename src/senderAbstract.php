<?php 

namespace Vendor\Push\SenderAbstract;

Class ApnsAbstract{

    // gateway url 
    const GATEWAY_URL = 'ssl://gateway.push.apple.com:2195';
    const RETRY_COUNTER = 2;

    // Protected fields
    protected $ctx;
    protected $cert;
    private $passphrase;

    /**
     *  Constructor 
     */
    public function __construct($certName = "cert", $passphrase = "Marc0510"){
       $this->cert = "./cert/".$certName.".pem";
       $this->passphrase = $passphrase;
       $this->socket = false;
    }

    /**
     *  Create Gateway 
     *      Create the gateway 
     */
    public function createGateway(){
        if (!$this->cert)
            throw new \Exception("cert has not been loaded");

        $this->ctx = stream_context_create(array('ssl' => array(
                'local_cert' => $this->cert,
                'passphrase' => $this->passphrase
        )));

        $try = 0;
        
        // Looping and hoping it's going to connect
        while(!$this->socket && $try < self::RETRY_COUNTER){
            $this->socket = stream_socket_client(
                self::GATEWAY_URL,
                $error,
                $errorStr,
                20,
                STREAM_CLIENT_CONNECT,
                $this->ctx
            );

            if (!$this->socket)
                $try++;
        }

        if (!$this->socket)
            throw new \Exception("unable to connect to gateway ".$error." ".$errorStr);

        return true;
    }

    /**
     *  Connect Gateway 
     *          Connect to the gateway 
     *  @param $payload []byte
     *  @public 
     */
    public function writeSocket($payload){
        $try = 0;
        // Creating the socket 
        while($try < self::RETRY_COUNTER){
            $res = (int) fwrite($this->socket, $payload);

            if ($res != 0){
                throw new \Exception("error code : ".$res);
            }
            
            $try++;
        }
        usleep(10000);
    }
}
