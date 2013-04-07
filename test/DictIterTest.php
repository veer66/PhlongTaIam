<?php
require_once "./src/Dict.php";
include "./src/DictIter.php";
use PhlongTaIam\Dict;
use PhlongTaIam\DictIter;
use PhlongTaIam\ACTIVE_BOUNDARY;
use PhlongTaIam\INVALID;
use PhlongTaIam\ACTIVE;

class DictIterTest extends PHPUnit_Framework_TestCase 
{
	public function setUp() {
		$this->dict = new Dict("./data/test_dict.txt");
		$this->dictIter = new DictIter($this->dict);
	}	
	
	public function testWalkSimple() {
		$this->assertEquals(ACTIVE_BOUNDARY, $this->dictIter->walk("ข"));
	}	

	public function testWalkSimpleFirstEntry() {
		$this->assertEquals(ACTIVE_BOUNDARY, $this->dictIter->walk("ก"));
	}	
	
	public function testWalkNotFound() {
		$this->assertEquals(INVALID, $this->dictIter->walk("ฉ"));
		$this->assertEquals(INVALID, $this->dictIter->walk("ข"));		
	}
	
	public function test2ndWalkNotFound() {
		$this->assertEquals(ACTIVE_BOUNDARY, $this->dictIter->walk("ข"));
		$this->assertEquals(INVALID, $this->dictIter->walk("ข"));
	}

	public function testActiveToActiveBoundaryWalk() {
		$this->assertEquals(ACTIVE, $this->dictIter->walk("ม"));
		$this->assertEquals(ACTIVE_BOUNDARY, $this->dictIter->walk("จ"));
	}	
}
?>
