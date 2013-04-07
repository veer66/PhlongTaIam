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
		$ranges = $this->builder->buildFromDag([[0,5,DICT]], 5);
		$this->assertEquals([[0,5,DICT]], $ranges);
	}	
	
	public function testTwoWords() 
	{
		$ranges = $this->builder->buildFromDag([[0,3,DICT], [3,10,DICT]], 10);
		$this->assertEquals([[0,3,DICT], [3,10,DICT]], $ranges);
	}	
	
	public function testSimpleAmbiguity() 
	{
		$ranges = $this->builder->buildFromDag([[0,3,DICT], [0,5,DICT], [3,10,DICT]], 10);
		$this->assertEquals([[0,3,DICT], [3,10,DICT]], $ranges);
	}
	
	public function testWithoutKnownWord() 
	{
		$ranges = $this->builder->buildFromDag([], 10);
		$this->assertEquals([[0,10, UNK]], $ranges);
		$this->assertNotNull($ranges[0][0]);
	}	

	public function testUnknownOnTheRightest() 
	{
		$ranges = $this->builder->buildFromDag([[0,7,DICT]], 10);
		$this->assertEquals([[0,7, DICT], [7,10, UNK]], $ranges);
		$this->assertNotNull($ranges[0][0]);
	}	

	public function testUnknownOnTheLeftest() 
	{
		$ranges = $this->builder->buildFromDag([[7,10, DICT]], 10);
		$this->assertEquals([[0,7, UNK], [7,10, DICT]], $ranges);
	}	

	public function testKnownIsland() 
	{
		$ranges = $this->builder->buildFromDag([[3,5,DICT]], 10);
		$this->assertEquals([[0,3, UNK], [3,5, DICT], [5,10, UNK]], $ranges);
	}	

	
}
?>
