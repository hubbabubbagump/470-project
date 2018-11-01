<?php
    
    include_once __DIR__ . "../utilities.php";

    function sendMessage ($collection, $senderID, $recipientID, $message): string {

        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $id = uniqid();
        $result = $collection->insertOne([
            'senderID' => $senderID,
            'recipientID' => $recipientID,
            'message' => $message,
            'dateSent' => $timestamp,
        ]);
        //Should echo
        echo "[" . $collection->getCollectionName() . "] Sent new message from: {" . $senderID . "} to: {" . $recipientID . "}\n"; 

        return $id;
    }

    function retrieveMessage($collection, $recipientID) {
        $cursor = $collection->find(['recipientID' => $recipientID]);
        foreach ($cursor as $doc) {
            var_dump($doc);
        }
    }
?>