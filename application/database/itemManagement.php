<?php
    function addItem ($collection, $title, $sellerID, $faculty, $courseNum, $desc) {
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $id = uniqid();
        $result = $collection->insertOne([
            'title' => $title,
            'faculty' => $faculty,
            'courseNum' => $courseNum,
            'desc' => $desc,
            'datePosted' => $timestamp,
            '_id' => $id,
            'seller' => $sellerID
        ]);
        echo "[" . $collection->getCollectionName() . "] Inserted new sales item with id: " . $result->getInsertedId() . "\n"; 
    }

    function getItemsByCourseNum($collection, $courseNum) {
        $cursor = $collection->find(['courseNum' => $courseNum]);
        $items = $cursor->toArray();

        return $items;
    }
?>