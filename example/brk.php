<!DOCTYPE html>
<html>
<body>
<ul>
<?php
require_once "../src/WordBreaker.php";

use PhlongTaIam\WordBreaker as WordBreaker;
$wordBreaker = new WordBreaker("../data/tdict-std.txt");
foreach($wordBreaker->breakIntoWords("ฉัน eat ข้าวชิมิ") as $w) {
	print "<li>$w</li>\n";
}
?>
</ul>
</body>
</html>