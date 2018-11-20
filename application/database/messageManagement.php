<?php
    
    include_once __DIR__ . "../utilities.php";

    function sendMessage ($collection, $senderEmail, $recipientEmail, $message): string {

        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $id = uniqid();
        $result = $collection->insertOne([
            'senderEmail' => $senderEmail,
            'recipientEmail' => $recipientEmail,
            'message' => $message,
            'dateSent' => $timestamp,
        ]);
        
        echo "[" . $collection->getCollectionName() . "] Sent new message from: {" . $senderEmail . "} to: {" . $recipientEmail . "}\n"; 

        return $id;
    }

    function retrieveMessage($collection, $senderEmail, $recipientEmail) {
        $cursor = $collection->find(array(
            '$or' => array(
                array(
                    '$and' => array(
                        array(
                            'senderEmail' => $senderEmail
                        ),
                        array(
                            'recipientEmail' => $recipientEmail
                        )
                    )
                ),
                array(
                    '$and' => array(
                        array(
                            'senderEmail' => $recipientEmail
                        ),
                        array(
                            'recipientEmail' => $senderEmail
                        )
                    )
                ),
            )
        ));

        $conversation = array();

        $cursor = $cursor->toArray();

        foreach ($cursor as $message) {
            array_push($conversation, $message);
        }

        return json_encode(array('conversation' => $conversation));

        //echo json_encode(iterator_to_array($cursor, false));
        /*foreach ($cursor as $doc) {
            var_dump($doc);
        }*/
    }

    function getParticipants($collection, $senderEmail) {
        $query1 = array('senderEmail' => $senderEmail);
        //$query2 = array('recipientEmail' => $senderEmail);
        //Didn't find a way to combine two queries, so I made another

        $projection1 = array('projection' => array('recipientEmail' => true));
        //$projection2 = array('projection' => array('senderEmail' => true));

        $cursor1 = $collection->find($query1, $projection1);
        /*foreach ($cursor1 as $doc1) {
            print_r($doc1);
        }*/

        /*$cursor2 = $collection->find($query2, $projection2);
        foreach ($cursor2 as $doc2) {
            print_r($doc2);
        }*/

        $participants = array();
        $cursor1 = $cursor1->toArray();

        foreach ($cursor1 as $contact) {
            array_push($participants, $contact);
        };

        return json_encode(array('participants' => $participants));

        /*$cursor2 = $cursor2->toArray();

        $length1 = count($cursor1);
        $length2 = count($cursor2);

        $i1 = 0;
        $i2 = 0;

        foreach ($cursor1 as $contact) {
            if ($i1 < length1) {
                array_push($participants, $contact);
                $i1 += 1;
            }
        };

        foreach ($cursor2 as $contact) {
            if ($i2 < length2) {
                array_push($participants, $contact);
                $i2 += 1;
            }
        };*/
    }
?>