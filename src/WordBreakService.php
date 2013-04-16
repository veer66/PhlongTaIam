<?php
namespace PhlongTaIam;
require_once "Dict.php";
require_once "WordDagBuilder.php";
require_once "RangesBuilder.php";
require_once "JsonBuilder.php";

header('Content-type: application/json');

$path = "../data/tdict-std.txt";

$string = $_REQUEST['string'];
$dict = new Dict($path);
$dagBuilder = new WordDagBuilder($dict);
$rangesBuilder = new RangesBuilder();
$jsonBuilder = new JsonBuilder();
$len = mb_strlen($string, "UTF-8");
$dag = $dagBuilder->build($string, $len);
$ranges = $rangesBuilder->buildFromDag($dag, $len);
echo $jsonBuilder->build($string, $ranges);

?>