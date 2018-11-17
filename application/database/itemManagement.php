<?php
    
    include_once __DIR__ . "../utilities.php";

    function insertItem ($collection, $title, $sellerEmail, string $sellerName, string $faculty, string $courseNum, string $desc, $price, $location, $images): string {

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
            'price' => $price,
            'location' => $location,
            'images' => $images
        ]);
        // echo "[" . $collection->getCollectionName() . "] Inserted new sales item with id: " . $result->getInsertedId() . "\n"; 

        return $id;
    }

    function getItemById($collection, $id) {
        $item = $collection->findOne(['_id' => $id]);
        $result = json_encode($item);
        
        return $result;
    }

    function getItemsByIndex($collection, $query, $page) {
        $scoreThreshold = 1.1;
        $itemsPerPage = 10;
        $itemMin = ($page - 1) * $itemsPerPage;
        $itemMax = ($page * $itemsPerPage) - 1;
        $moreItems = true;

        $isLoggedIn = false;
        if (isset($_SESSION['user_id'])) {
            $isLoggedIn = true;
        }

        $showEmail = ($isLoggedIn) ? 1 : 0;

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
                    '_id' => 1,
                    'sellerEmail' => 1,
                    'location' => 1
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

        return json_encode(array('results' => $results, 'moreItems' => $moreItems, 'isAuthenticated' => $isLoggedIn));
    }

    function getNewestItems($collection, $page) {
        $itemsPerPage = 10;
        $itemMin = ($page - 1) * $itemsPerPage;
        $itemMax = ($page * $itemsPerPage) - 1;
        $moreItems = true;

        $isLoggedIn = false;
        if (isset($_SESSION['user_id'])) {
            $isLoggedIn = true;
        }

        $showEmail = ($isLoggedIn) ? 1 : 0;

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
                    '_id' => 1,
                    'sellerEmail' => 1,
                    'location' => 1
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

         return json_encode(array('results' => $results, 'moreItems' => $moreItems, 'isAuthenticated' => $isLoggedIn));
    }

    function getItemsBySellerEmail($collection, $sellerEmail)
    {
        if (empty($sellerEmail))
        {
            echo "empty seller";
            return array();
        }

        $cursor = $collection->find(['sellerEmail'=> $sellerEmail]);

        return json_encode($cursor);
    }

    // returns true if deleted successfully, false if failed
    function removeItemById($collection, $itemId)
    {
        if (empty($itemId))
        {
            return false;
        }

        $deleted = $collection->deleteOne(['_id' => $itemId]);

        if ($deleted == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
?>