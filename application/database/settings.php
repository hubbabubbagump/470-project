<?php
    function getDBAddr() {
        $localAddress = "localhost";
        $productionAddress = "192.169.23.65";
        $internalMongo = "10.142.0.3";
        $port = 27017;

        //$useProduction = true;
        $useProduction = false;

        if ($useProduction) {
            $address = "mongodb://" . $internalMongo . ":" . $port;
            return $address;
        }
        else {
            $address = "mongodb://" . $localAddress . ":" . $port;
            return $address;
        }
    }

?>
