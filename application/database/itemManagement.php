<?php
    
    include_once __DIR__ . "../utilities.php";

    function insertItem ($collection, $title, $sellerID, string $faculty, string $courseNum, string $desc, $price): string {

        $date = new DateTime();
        $timestamp = $date->getTimestamp() * 1000;
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

    function getItemsByQuery($collection, $filter) {
        if(empty($filter)) {
            $cursor = $collection->find();
        } else {
            $cursor = $collection->find($filter);
        }
        $items = $cursor->toArray();
        $result = BSONtoJSON($items);

        return $result;
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

    function getItemsByIndex($collection, $query) {
        $scoreThreshold = 1;

        $results = array();
        $cursor = $collection->find(
            [
                '$text' => [
                    '$search' => $query
                ]
            ],
            [
                'projection' => [
                    'score' => ['$meta' => 'textScore'],
                    'title' => 1,
                    'desc' => 1,
                    'faculty' => 1,
                    'courseNum' => 1
                ],
                'sort' => [
                    'score' => ['$meta' => 'textScore']
                    ]
            ]
        );

        foreach ($cursor as $item) {
            if ($item->score >= $scoreThreshold) {
                array_push($results, $item);
            }
         };

        return json_encode($results);
    }
?>