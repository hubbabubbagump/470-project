<?php
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
?>