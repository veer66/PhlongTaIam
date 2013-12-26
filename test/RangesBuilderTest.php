<?php
require_once "./src/const.php";
require_once "./src/RangesBuilder.php";
use PhlongTaIam\RangesBuilder as Builder;

class RangesBuilderTest extends PHPUnit_Framework_TestCase 
{
	public function setUp() {
		$this->builder = new Builder();
	}
	
	public function testOneWord() 
	{
		$ranges = $this->builder->buildFromDag(array(array(0,5,DICT)), 5);
		$this->assertEquals(array(array(0,5,DICT)), $ranges);
	}	
	
	public function testTwoWords() 
	{
		$ranges = $this->builder->buildFromDag(
      array(array(0,3,DICT), array(3,10,DICT)), 10);
		$this->assertEquals(array(array(0,3,DICT), array(3,10,DICT)), $ranges);
	}	
	
	public function testSimpleAmbiguity() 
	{
		$ranges = $this->builder->buildFromDag(array(array(0,3,DICT), array(0,5,DICT), array(3,10,DICT)), 10);
		$this->assertEquals(array(array(0,3,DICT), array(3,10,DICT)), $ranges);
	}
	
	public function testWithoutKnownWord() 
	{
		$ranges = $this->builder->buildFromDag(array(), 10);
		$this->assertEquals(array(array(0,10, UNK)), $ranges);
    $r0 = $ranges[0];
    $r0_0 = $r0[0];
		$this->assertNotNull($r0_0);
	}	

	public function testUnknownOnTheRightest() 
	{
		$ranges = $this->builder->buildFromDag(array(array(0,7,DICT)), 10);
		$this->assertEquals(array(array(0,7, DICT), array(7,10, UNK)), $ranges);
    $r0 = $ranges[0];
    $r0_0 = $r0[0];
		$this->assertNotNull($r0_0);
	}	

	public function testUnknownOnTheLeftest() 
	{
		$ranges = $this->builder->buildFromDag(array(array(7,10, DICT)), 10);
		$this->assertEquals(array(array(0,7, UNK), array(7,10, DICT)), $ranges);
	}	

	public function testKnownIsland() 
	{
		$ranges = $this->builder->buildFromDag(array(array(3,5,DICT)), 10);
		$this->assertEquals(array(array(0,3, UNK), array(3,5, DICT), array(5,10, UNK)), $ranges);
	}	
}
?>
