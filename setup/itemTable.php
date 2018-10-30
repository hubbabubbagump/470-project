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

    // Add some test data
    for ($i = 0; $i < 5; $i++) {
        addItem($saleItems, "Example Textbook " . $i, "exampleID" . $i, "CMPT", 470, "Slightly used textbook in good condition");
    }
?>