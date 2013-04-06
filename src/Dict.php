<?php

define("FIRST", 1);
define("LAST", 2);

class Dict
{
	
	public function __construct($dictPath) 
	{
		$this->loadDict($dictPath);
	}
	
	private function loadDict($dictPath) 
	{
		$this->strList = explode("\n", file_get_contents($dictPath));
	}
	
	public function findFirstIndexOfNeedle($prefix, $offset = null, $s = null, $e = null) 
	{
		return $this->findIndexOfNeedle(FIRST, $prefix, $offset, $s, $e);
	}

	public function findLastIndexOfNeedle($prefix, $offset = null, $s = null, $e = null) 
	{
		return $this->findIndexOfNeedle(LAST, $prefix, $offset, $s, $e);
	}
	
	public function findIndexOfNeedle($posType, $prefix, $offset = null, $s = null, $e = null) 
	{
		if($offset == null) $offset = 0;
		if($s == null) $s = 0;
		if($e == null) $e = count($this->strList);
		$l = $s;
		$r = $e - 1;
		$ans = null;		
		
		while($l < $r) {			
			$m = floor(($l + $r) / 2);
			if($prefix[0] > $this->strList[$m][$offset]) {
				$l = $m + 1;
			} else if($prefix[0] < $this->strList[$m][$offset]) {
				$r = $m - 1;
			} else {
				$ans = $m;
				if($posType == FIRST) 
					$r = $m - 1;
				else
					$l = $m + 1;
			}
		}
		return $ans == null ? null : intval($ans);
	}
}

?>
