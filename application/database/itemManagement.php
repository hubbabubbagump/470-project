<?php
    
    require_once DATABASE . "utilities.php";

    function insertItem ($collection, $title, $sellerID, $faculty, $courseNum, $desc, $price): string {

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

        return $id;
    }

    function getItemsByCourseNum($collection, $courseNum) {
        $cursor = $collection->find(['courseNum' => $courseNum]);
        $items = $cursor->toArray();

        return $items;
    }

    function getItemById($collection, $id) {
        $cursor = $collection->find(['_id' => $id]);
        $item = $cursor->toArray();
        // get BSON object by item[0]
        // convert to json string using BSONtoJSON
        // convert json string to array using json_decode
        $result = json_decode(BSONtoJSON($item[0]), true);
        
        return $result;


    }
?>