<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use PhpAmqpLib\Connection\AMQPStreamConnection;
    use PhpAmqpLib\Message\AMQPMessage;
    
     
    $connection = new AMQPConnection('localhost', 15672, 'test', 'test');
    $channel = $connection->channel();
     
    $channel->queue_declare('email_queue', false, false, false, false);
     
    $data = json_encode($_POST);
     
    $msg = new AMQPMessage($data, array('delivery_mode' => 2));
    $channel->basic_publish($msg, '', 'email_queue');
     
    header('Location: form.php?sent=true');
