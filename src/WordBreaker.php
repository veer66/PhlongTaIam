<?php
namespace PhlongTaIam;

require_once "Dict.php";
require_once "WordDagBuilder.php";
require_once "RangesBuilder.php";
require_once "StringListBuilder.php";

class WordBreaker
{
	public function __construct($path) {
		$this->dict = new Dict($path);
		$this->dagBuilder = new WordDagBuilder($this->dict);
		$this->rangesBuilder = new RangesBuilder();
		$this->stringListBuilder = new StringListBuilder();
	}
	
	public function breakIntoWords($string) {
		$len = mb_strlen($string, "UTF-8");
		$dag = $this->dagBuilder->build($string, $len);
		$ranges = $this->rangesBuilder->buildFromDag($dag, $len);
		return $this->stringListBuilder->buildFromStringAndRanges($string, $ranges);
	}
}
?>