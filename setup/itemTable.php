<?php

    include_once __DIR__ . "/../database/itemManagement.php";

    $mongo = new MongoDB\Client("mongodb://localhost:27017");

    try {
        $local = $mongo->local;
    }
    catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo $e;
    }

    //Create collection for items that people are selling
    $local->createCollection("saleItems");
    $saleItems = $local->saleItems;
    echo "[" . $local->getDatabaseName() . "] Created new collection: " . $saleItems->getCollectionName() . "\n";
    addItem($saleItems, "An example textbook", "5345ds3iaf", "CMPT", 470, "Slightly used textbook in good condition");
?>