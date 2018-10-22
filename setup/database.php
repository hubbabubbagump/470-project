<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    function printCollection ($collection) {
        $cursor = $collection->find();
        foreach ( $cursor as $id => $value ) {
            echo "$id: ";
            print_r(json_encode(json_decode(BSONtoJSON($value)), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
        }
    }

    function BSONtoJSON ($bson) {
        return MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($bson));
    }

    function insertUser ($collection, $name, $email, $password, $isAdmin) {
        $id = uniqid();
        $result = $collection->insertOne([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            '_id' => $id,
            'isAdmin' => $isAdmin
        ]);
        echo "[" . $collection->getCollectionName() . "] Inserted new user with id: " . $result->getInsertedId() . "\n"; 
    }

    function addAdminUser ($collection) {
        insertUser($collection, 'Admin', 'admin@admin.ca', 'password', True);
    }

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

    //https://www.mongodb.com/download-center?jmp=docs#production
    //https://docs.mongodb.com/php-library/v1.2/reference/class/MongoDBClient/
    $mongo = new MongoDB\Client("mongodb://localhost:27017");
    echo "Connected to MongoDB Client on port 27017\n";

    try {
        $local = $mongo->local;
        echo "Local database selected\n";
    }
    catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo $e;
    }
    
    //Delete database collection for fresh startup
    $mongo->dropDatabase("local");

    //Create collection for users
    $local->createCollection("users");
    $users = $local->users;
    echo "[" . $local->getDatabaseName() . "] Created new collection: " . $users->getCollectionName() . "\n";
    addAdminUser($users);

    //Create collection for items that people are selling
    $local->createCollection("saleItems");
    $saleItems = $local->saleItems;
    echo "[" . $local->getDatabaseName() . "] Created new collection: " . $saleItems->getCollectionName() . "\n";
    addItem($saleItems, "An example textbook", "5345ds3iaf", "CMPT", 470, "Slightly used textbook in good condition");
?>