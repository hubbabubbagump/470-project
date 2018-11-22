<?php

    include_once __DIR__ . "/../application/database/itemManagement.php";
    include_once __DIR__ . "/../application/database/settings.php";

    $mongo = new MongoDB\Client(getDBAddr());

    try {
        $local = $mongo->local;
    }
    catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo $e;
    }

    // Create collection for items that people are selling
    $local->createCollection("saleItems");
    $saleItems = $local->saleItems;
    echo "[" . $local->getDatabaseName() . "] Created new collection: " . $saleItems->getCollectionName() . "\n";
    $saleItems->createIndex(['title' => 'text', 'desc' => 'text', 'faculty' => 'text', 'courseNum' => 'text']);

    $defaultBooks = array("https://res.cloudinary.com/dkgnnu4oh/image/upload/v1542266367/images/book1.jpg", "https://res.cloudinary.com/dkgnnu4oh/image/upload/v1542266386/images/book2.png");
    $defaultLoc = [49.270, -122.91];

    // Test  data
    insertItem($saleItems, "Modern Quantam Mechanics", "admin@admin.ca", "Admin User", "PHYS", "231", "Written by J.J. Sakurai. A textbook in fairly  good condition.", 120, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Strutcture and Interpretation of Computer Programs", "admin@admin.ca", "Admin User", "CMPT", "160", "An old textbook written in 1979.", 45, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Introduction to Economic Analysis", "admin@admin.ca", "Admin User", "ECON", "100", "Written by Preston McAfee in 2005. I spilt coffee on it.", 20, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Basic Algebra", "admin@admin.ca", "Admin User", "MATH", "120", "First year math textbook by Anthony Knapp", 150, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "A First Course in Probability", "admin@admin.ca", "Admin User", "STAT", "270", "A really bad  textbook  on statistics", 50, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "How to Design Programs", "admin@admin.ca", "Admin User", "CMPT", "", "A nice read for  anyone in computer science", 100, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Probability and Random Processes", "admin@admin.ca", "Admin User", "MACM", "300", "The textbook was cut in two because i hated the course", 1, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Think Java", "admin@admin.ca", "Admin User", "CMPT", "250", "A textbook explaning java basics", 35, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Introduction to Sociology", "admin@admin.ca", "Admin User", "SA", "150", "Textbook in mint condition", 150, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Learn Python the Hard Way", "admin@admin.ca", "Admin User", "CMPT", "120", "Python textbook by Zed Shaw", 60, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Introductory Statistics", "admin@admin.ca", "Admin User", "STAT", "100", "I dropped this textbook in the toilet.", 5, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "iClicker", "admin@admin.ca", "Admin User", "", "", "The most advanced iClicker you'll ever see!", 1000, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Math in Society", "admin@admin.ca", "Admin User", "MATH", "450", "Textbook on the sociological effects of math", 90, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Discrete mathematics", "admin@admin.ca", "Admin User", "MACM", "200", "The required txtbook for the course", 97, $defaultLoc, $defaultBooks);
    insertItem($saleItems, "Neural Networks and Deep Learning", "admin@admin.ca", "Admin User", "CMPT", "310", "A free online textbook that teaches you about neural  nets. It was written  by Michael Nielson, and is a brilliant addition to your book collection!", 320, $defaultLoc, $defaultBooks);
?>