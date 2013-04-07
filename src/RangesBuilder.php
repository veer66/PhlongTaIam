<?php
namespace PhlongTaIam;
require_once "const.php";

define("POINTER", 0);
define("WEIGHT", 1);

class RangesBuilder 
{
	private function buildEIndex($dag) {
		$eIndex = [];
		foreach($dag as $range) {
			if(!array_key_exists($range[E], $eIndex))
				$eIndex[$range[E]] = [];
			$eIndex[$range[E]][] = $range[S];
		}
		return $eIndex;
	}
	
	private function buildPath($len, $eIndex) {
		$path = array_fill(0, $len + 1, null);
		$path[0] = [0, 0];
		for($i = 1; $i <= $len; $i++) {
			if(array_key_exists($i, $eIndex)) {	
				foreach($eIndex[$i] as $s) {
					if($path[$s] !== null) {
						$info = [$s, $path[$s][WEIGHT] + 1];
						if($path[$i] === null || $info[WEIGHT] < $path[$i][WEIGHT])
							$path[$i] = $info;						
					}
				}
			}
		}
		return $path;
	}
	
	private function pathToRanges($path, $len) {
		$ranges = [];
		$i = $len;
		while($i > 0) {
			$info = $path[$i];
			$s = $info[POINTER];
			$ranges[] = [$s, $i];
			$i = $s;
		}		
		return array_reverse($ranges);
	}
	
	public function buildFromDag($dag, $len) {
		$eIndex = $this->buildEIndex($dag);
		$path = $this->buildPath($len, $eIndex);
		return $this->pathToRanges($path, $len);
	}
}
?>