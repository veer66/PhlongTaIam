<?php
namespace PhlongTaIam;

require_once "const.php";

class StringListBuilder 
{
	public function buildFromStringAndRanges($string, $ranges) {
		$list = [];
		foreach($ranges as $range) {
			$list[] = mb_substr($string, $range[S], $range[E] - $range[S], "UTF-8");
		}
		return $list;
	}	
}
?>