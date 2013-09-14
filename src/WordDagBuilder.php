<?php
namespace PhlongTaIam;

require_once "const.php";
require_once "DictIter.php";
	
class WordDagBuilder
{
	public function __construct($dict) 
	{
		$this->dict = $dict;		
	}
	
	public static function cmp($a, $b) {
		$r = 0;
		if($a[0] == $b[0]) {
			if($a[1] == $b[1]) {
				$r = ($a[2] < $b[2]) ? -1 : 1;
			} else {
				$r = ($a[1] < $b[1]) ? -1 : 1;
			}
		} else {
			$r = ($a[0] < $b[0]) ? -1 : 1;
		}
		return $r;
	}
	
	public function build($string, $len)  {
		$dag = [];	
		$this->buildByDict($dag, $string, $len);
		$this->buildByLatinRule($dag, $string, $len);
		uasort($dag, 'PhlongTaIam\WordDagBuilder::cmp');
		return $dag;
	}

	private function charAt($string, $i) {
		return mb_substr($string, $i, 1, "UTF-8");
	}

	private function buildByLatinRule(&$dag, $string, $len) {
		mb_internal_encoding("UTF-8");
		mb_regex_encoding("UTF-8");
		
		$next_latin = 0;
		for($i = 0; $i < $len; $i++) {
			$space_e = null;
			$latin_e = null;
			$space_break = false;
			$latin_break = false;
			for($j = $i; $j < $len; $j++) {
				if($space_break && $latin_break)
					break;			
				$ch = $this->charAt($string, $j);
				if(!$space_break) {
					if($ch === " ") {
						$space_e = $j + 1;
					} else {
						$space_break = true;
					} 
				}
				if(!$latin_break && $j >= $next_latin) {
					if(mb_ereg_match("[A-Za-z\d]", $ch)) {				
						$latin_e = $j + 1;
					} else {
						$latin_break = true;
					}
				}
			}
									
			if($space_e !== null) {
				$dag[] = [$i, $space_e, SPACE];
			}
			if($latin_e !== null) {
				$dag[] = [$i, $latin_e, LATIN];
				$next_latin = $latin_e;
			} 
		}
	}
	
	private function buildByDict(&$dag, $string, $len) 
	{	
		for($i = 0; $i < $len; $i++) {
			$iter = new DictIter($this->dict);
			for($j = $i; $j < $len; $j++) {
				$ch = $this->charAt($string, $j);
				
				$status = $iter->walk($ch);				

				if($status == INVALID) {
					break;
				} else if($status == ACTIVE_BOUNDARY) {
					$dag[] = [$i, $j+1, DICT];
				}
				
			}
		}	
	}
}
?>