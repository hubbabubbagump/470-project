<?php
    include_once __DIR__ . "/database.php";

    foreach(glob(__DIR__ . "/*.php") as $file) {
        if (strpos($file, "database.php") !== false) {
            continue;
        }

        include_once $file;
    }
?>