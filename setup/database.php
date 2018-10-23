<?php
    require_once __DIR__ . '/../application/vendor/autoload.php';
    include_once __DIR__ . "/../application/database/settings.php";

    //https://www.mongodb.com/download-center?jmp=docs#production
    //https://docs.mongodb.com/php-library/v1.2/reference/class/MongoDBClient/
    $mongo = new MongoDB\Client(getDBAddr());
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
?>