<?php
namespace ChatApp;


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $users = array();

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $json_msg = json_decode($msg, true);
        $users[] = ["username"=>$json_msg["user"], "language"=>$json_msg["lang"]];
        var_dump($users);
        foreach ($this->clients as $client) {
            if ($from !== $client) {
               $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
    
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}