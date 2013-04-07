<?php
namespace PhlongTaIam;
require_once "const.php";

define("POINTER", 0);
define("WEIGHT", 1);
define("UNK", 2);

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
	
	private function buildSIndex($dag) {
		$eIndex = [];
		foreach($dag as $range) {
			if(!array_key_exists($range[S], $eIndex))
				$eIndex[$range[S]] = [];
			$eIndex[$range[S]][] = $range[E];
		}
		return $eIndex;
	}
	
	
	private function comparePathInfo($info0, $info1) {
		return $info0[UNK] < $info1 && $info0[WEIGHT] < $info1[WEIGHT];
	}
	
	private function buildPath($len, $sIndex, $eIndex) {
		$path = array_fill(0, $len + 1, null);
		$path[0] = [0, 0, 0];
		$left_boundary = 0;
		for($i = 1; $i <= $len; $i++) {
			if(array_key_exists($i, $eIndex)) {	
				foreach($eIndex[$i] as $s) {
					if($path[$s] !== null) {
						$info = [$s, $path[$s][WEIGHT] + 1, $path[$s][UNK]];
						if($path[$i] === null || $this->comparePathInfo($info,$path[$i])) {
							$path[$i] = $info;						
						}
					}
				}
				if($path[$i] !== null) {
					$left_boundary = $i;
				}				
			}
			if($path[$i] === null && array_key_exists($i, $sIndex)) {
				$info = [$left_boundary, $path[$left_boundary][WEIGHT] + 1, $path[$left_boundary][UNK] + 1];
				$path[$i] = $info;												
			}							
		}	
						
		if($path[$len] === null) {
			$path[$len] = [$left_boundary, $path[$left_boundary][WEIGHT] + 1, $path[$left_boundary][UNK] + 1];
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
		$sIndex = $this->buildSIndex($dag);		
		$path = $this->buildPath($len, $sIndex, $eIndex);
		return $this->pathToRanges($path, $len);
	}
}
?>