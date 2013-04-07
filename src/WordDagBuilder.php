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
	
	public function build($string, $len) 
	{
		$dag = [];
		for($i = 0; $i < $len; $i++) {
			$iter = new DictIter($this->dict);
			for($j = $i; $j < $len; $j++) {
				$ch = mb_substr($string, $j, 1, "UTF-8");
				
				$status = $iter->walk($ch);				
				// echo "CH = $ch\tstatus=$status\n";
				if($status == INVALID) {
					break;
				} else if($status == ACTIVE_BOUNDARY) {
					$dag[] = [$i, $j+1];
				}
				
			}
		}
		// print_r($dag);
		return $dag;
	}
}
?>