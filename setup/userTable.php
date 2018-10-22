<?php

    include_once __DIR__ . "/../database/userManagement.php";

    function addAdminUser ($collection) {
        insertUser($collection, 'Admin', 'admin@admin.ca', 'password', True);
    }

    $mongo = new MongoDB\Client("mongodb://localhost:27017");

    try {
        $local = $mongo->local;
    }
    catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo $e;
    }

    //Create collection for users
    $local->createCollection("users");
    $users = $local->users;
    echo "[" . $local->getDatabaseName() . "] Created new collection: " . $users->getCollectionName() . "\n";
    addAdminUser($users);
?>