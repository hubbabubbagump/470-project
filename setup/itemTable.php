<?php

    include_once __DIR__ . "/../application/database/itemManagement.php";
    include_once __DIR__ . "/../application/database/settings.php";

    $mongo = new MongoDB\Client(getDBAddr());

    try {
        $local = $mongo->local;
    }
    catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo $e;
    }

    // Create collection for items that people are selling
    $local->createCollection("saleItems");
    $saleItems = $local->saleItems;
    echo "[" . $local->getDatabaseName() . "] Created new collection: " . $saleItems->getCollectionName() . "\n";
    $saleItems->createIndex(['title' => 'text', 'desc' => 'text', 'faculty' => 'text', 'courseNum' => 'text']);

    // Add some test data
    for ($i = 0; $i < 15; $i++) {
        insertItem($saleItems, "Example Textbook " . $i, "user@user.com" . $i, "John Doe", "CMPT", "470", "Slightly used textbook in good condition", 1, [49.270, -122.91]);
    }
?>