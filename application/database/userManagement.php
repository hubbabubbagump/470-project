<?php
    function insertUser ($collection, string $name, string $email, string $password, $isAdmin):bool {

        $userExists = $collection->findOne(['email' => $email]);

        //If user with email already exists, error
        if (!empty($userExists)) {
            return False;
        }

        $pw = password_hash($password, PASSWORD_DEFAULT);

        $id = uniqid();
        $result = $collection->insertOne([
            'name' => $name,
            'email' => $email,
            'password' => $pw,
            '_id' => $id,
            'isAdmin' => $isAdmin
        ]);

        return True;
    }

    function verifyUser($collection, string $email, string $password):bool {
        $user = $collection->findOne(['email' => $email]);

        //If user with email doesn't exist, error
        if (empty($user)) {
            return False;
        }

        if (password_verify($password, $user->password)) {
            return True;
        }

        return False;
    }

    function getUserName($collection, string $email):string {
        $user = $collection->findOne(['email' => $email]);
        if (empty($user)) {
            return "";
        }
        return $user->name;
    }
?>