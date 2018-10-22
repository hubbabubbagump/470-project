<?php
    $localAddress = "localhost";
    $productionAddress = "192.169.23.65";
    $port = 27017;

    $useProduction = False;
    
    function getDBAddr() {
        global $port, $localAddress, $productionAddress, $useProduction;

        if ($useProduction) {
            $address = "mongodb://" . $productionAddress . ":" . $port;
            return $address;
        }
        else {
            $address = "mongodb://" . $localAddress . ":" . $port;
            return $address;
        }
    }

?>