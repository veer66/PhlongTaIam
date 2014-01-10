<?php

    require '../vendor/autoload.php';
    require_once "Dict.php";
    require_once "WordDagBuilder.php";
    require_once "RangesBuilder.php";
    require_once "JsonBuilder.php";


    $path = "../data/tdict-std.txt";

    $client_sub= new Predis\Client(array('read_write_timeout' => 0));
    $client_pub = new Predis\Client(array('read_write_timeout' => 0));
    $client_store = new Predis\Client(array('read_write_timeout' => 0));
    $pubsub = $client_sub->pubSubLoop();
    $pubsub->subscribe('thbrk');

    $dict = new PhlongTaIam\Dict($path);
    $dagBuilder = new PhlongTaIam\WordDagBuilder($dict);
    $rangesBuilder = new PhlongTaIam\RangesBuilder();
    $jsonBuilder = new PhlongTaIam\JsonBuilder();


    foreach ($pubsub as $message) {
        print "Waiting for messages ...\n";
        switch ($message->kind) {
            case 'message':
                if ($message->channel == 'thbrk') {
                    print "breaking ...\n";
                    $req = json_decode($message->payload, true);
                    $string = $req["string"];
                    $len = mb_strlen($string, "UTF-8");
                    $dag = $dagBuilder->build($string, $len);
                    $ranges = $rangesBuilder->buildFromDag($dag, $len);
                    $segment_result = $jsonBuilder->build($string, $ranges);
                    $client_store->set("thbrk:".$req["id"], json_encode($segment_result));
                    $client_pub->publish("thbrkresult", $req["id"]);
                    print "Done\n";
                    break;
                }
        }
    }
?>
