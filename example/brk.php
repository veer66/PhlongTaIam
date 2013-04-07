<?php
require_once "../src/WordBreaker.php";

use PhlongTaIam\WordBreaker as WordBreaker;
$wordBreaker = new WordBreaker("../data/tdict-std.txt");
print_r($wordBreaker->breakIntoWords("ฉันกินข้าวชิมิ"));

?>