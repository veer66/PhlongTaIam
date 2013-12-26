<?php
namespace PhlongTaIam;

require_once "const.php";

class JsonBuilder 
{
	public function __construct() {
		$this->type_map = array("ERR", "DICT", "UNK", "SPACE", "LATIN");
	}
	
	public function build($string, $ranges) {
		$mod_ranges = array();
		foreach($ranges as $range) {
			$mod_ranges[] = array("s" => $range[S],
							 "e" => $range[E],
							 "type" => $this->type_map[$range[LINK_TYPE]]);
		}
		$o = array("string" => $string,
			         "ranges" => $mod_ranges);
		return json_encode($o);
	}
}
?>
