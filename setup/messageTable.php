<?php

    include_once __DIR__ . "/../application/database/messageManagement.php";
    include_once __DIR__ . "/../application/database/settings.php";

    $mongo = new MongoDB\Client(getDBAddr());

    try {
        $local = $mongo->local;
    }
    catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo $e;
    }

    //Collection for messages sent between users
    $local->createCollection("messages");
    $messages = $local->messages;
    echo "[" . $local->getDatabaseName() . "] Created new collection: " . $saleItems->getCollectionName() . "\n";

    //Sample message
    sendMessage($messages, "StudentA", "StudentB", "[Generic Greeting]");
    sendMessage($messages, "StudentA", "StudentB", "[Generic Follow-up]");
    sendMessage($messages, "StudentA", "StudentB", "[Agitated Follow-up]");

    //Get messages sent to Student B
    retrieveMessage($messages, "StudentB");
?>