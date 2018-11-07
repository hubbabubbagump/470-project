<?php
    
    include_once __DIR__ . "../utilities.php";

    function insertItem ($collection, $title, $sellerEmail, string $sellerName, string $faculty, string $courseNum, string $desc, $price): string {

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
            'sellerEmail' => $sellerEmail,
            'sellerName' => $sellerName,
            'price' => $price
        ]);
        // echo "[" . $collection->getCollectionName() . "] Inserted new sales item with id: " . $result->getInsertedId() . "\n"; 

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
        $item = $collection->findOne(['_id' => $id]);
        $result = json_encode($item);
        
        return $result;
    }

    function getItemsByIndex($collection, $query, $page) {
        $scoreThreshold = 1.2;
        $itemsPerPage = 10;
        $itemMin = ($page - 1) * $itemsPerPage;
        $itemMax = ($page * $itemsPerPage) - 1;
        $moreItems = true;

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
                    'courseNum' => 1,
                    'price' => 1,
                    '_id' => 1
                ],
                'sort' => [
                    'score' => ['$meta' => 'textScore']
                    ]
            ]
        );

        $cursor = $cursor->toArray();
        foreach ($cursor as $item) {
            if ($item->score >= $scoreThreshold) {
                array_push($results, $item);
            }

         };

         $trueResults = array();
         $length = count($results);
         $i = 0;
         foreach ($results as $item) {
            if ( $i >= $itemMin && $i <= $itemMax) {
                array_push($trueResults, $item);
            }

            if ($i >= $length - 1) {
                $moreItems = false;
                break;
            }

            $i += 1;
         }

        return json_encode(array('results' => $results, 'moreItems' => $moreItems));
    }

    function getNewestItems($collection, $page) {
        $itemsPerPage = 10;
        $itemMin = ($page - 1) * $itemsPerPage;
        $itemMax = ($page * $itemsPerPage) - 1;
        $moreItems = true;

        $results = array();
        $cursor = $collection->find(
            [],
            [
                'projection' => [
                    'score' => ['$meta' => 'textScore'],
                    'title' => 1,
                    'desc' => 1,
                    'faculty' => 1,
                    'courseNum' => 1,
                    'price' => 1,
                    '_id' => 1
                ],
                'sort' => [
                    'datePosted' => -1    
                ]
            ]
        );

        $cursor = $cursor->toArray();
        $length = count($cursor);
        $i = 0;
        foreach ($cursor as $item) {
            if ($i >= $itemMin && $i <= $itemMax) {
                array_push($results, $item);
            }
            else if ($i > $itemMax) {
                break;
            }

            if ($i >= $length - 1) {
                $moreItems = false;
                break;
            }

            $i += 1;
         };

         return json_encode(array('results' => $results, 'moreItems' => $moreItems));
    }
?>