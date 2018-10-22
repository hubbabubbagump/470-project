<?php
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
?>