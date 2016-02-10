<?php namespace SimpleSoftwareIO\SMS\Drivers;
/**
 * Simple-SMS
 * Simple-SMS is a package made for Laravel to send/receive (polling/pushing) text messages.
 *
 * @link http://www.simplesoftware.io
 * @author SimpleSoftware support@simplesoftware.io
 *
 */
use SimpleSoftwareIO\SMS\IncomingMessage;
use SimpleSoftwareIO\SMS\OutgoingMessage;
use GuzzleHttp\Client;
class Msg91SMS extends AbstractSMS implements DriverInterface
{
    /**
     * The Guzzle HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * The API's URL.
     *
     * @var string
     */
    protected $apiBase = 'http://api.msg91.com/api/sendhttp.php';
    /**
     * Constructs the MozeoSMS Instance.
     *
     * @param Client $client The guzzle client
     */
    public function __construct(Client $client, $authKey , $route, $senderId )
    {
        $this->client  = $client;
        $this->authKey = $authKey;
        $this->route   = $route;
        $this->senderId = $senderId;
    }
    /**
     * Sends a SMS message.
     *
     * @param OutgoingMessage $message The SMS message instance.
     * @return void
     */
    public function send(OutgoingMessage $message)
    {
        $composeMessage = $message->composeMessage();
        
        $from = $message->getFrom();
        
        //Convert to callfire format.
        $numbers = implode(",", $message->getTo());
        
        $data = [
             'authkey' => $this->authKey,
             'mobiles' => $numbers,
             'message' => $composeMessage,
             'sender' => $this->senderId,
             'route' => $this->route,
        ];

        $this->buildBody($data);
        
        return $this->postRequest();

    }
    /**
     * Creates many IncomingMessage objects and sets all of the properties.
     *
     * @throws \RuntimeException
     */
    protected function processReceive($rawMessage)
    {
        throw new \RuntimeException('Msg91 does not support Inbound API Calls.');
    }
    /**
     * Checks the server for messages and returns their results.
     *
     * @throws \RuntimeException
     */
    public function checkMessages(Array $options = array())
    {
        throw new \RuntimeException('Msg91 does not support Inbound API Calls.');
    }
    /**
     * Gets a single message by it's ID.
     *
     * @throws \RuntimeException
     */
    public function getMessage($messageId)
    {
        throw new \RuntimeException('Msg91 does not support Inbound API Calls.');
    }
    /**
     * Receives an incoming message via REST call.
     *
     * @param $raw
     * @return IncomingMessage|void
     * @throws \RuntimeException
     */
    public function receive($raw)
    {
        throw new \RuntimeException('Msg91 does not support Inbound API Calls.');
    }
}
