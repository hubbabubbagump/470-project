<?php
    function addItem ($collection, $title, $sellerID, $faculty, $courseNum, $desc, $price) {

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
            'seller' => $sellerID,
            'price' => $price
        ]);
        echo "[" . $collection->getCollectionName() . "] Inserted new sales item with id: " . $result->getInsertedId() . "\n"; 
    }

    function getItemsByCourseNum($collection, $courseNum) {
        // Not sure why this query returns 0
        //$cursor = $collection->find(['courseNum' => $courseNum]);
        $cursor = $collection->find();
        $items = $cursor->toArray();

        return $items;
    }
?>