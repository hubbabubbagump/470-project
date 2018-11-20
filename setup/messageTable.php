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
    echo "[" . $local->getDatabaseName() . "] Created new collection: " . $messages->getCollectionName() . "\n";

    //Sample message
    sendMessage($messages, "StudentA@mail.com", "StudentB@mail.com", "[Generic Greeting]");
    sendMessage($messages, "StudentB@mail.com", "StudentA@mail.com", "[Generic Response]");
    sendMessage($messages, "StudentA@mail.com", "StudentB@mail.com", "[Generic Discussion]");
    sendMessage($messages, "StudentA@mail.com", "StudentC@mail.com", "[Generic Greeting]");
    sendMessage($messages, "StudentA@mail.com", "StudentD@mail.com", "[Generic Greeting]");
    sendMessage($messages, "StudentE@mail.com", "StudentA@mail.com", "[Generic Response]");

    //Get messages sent to Student B
    retrieveMessage($messages, "StudentB@mail.com", "StudentA@mail.com");

    getParticipants($messages, "StudentA@mail.com");
?>