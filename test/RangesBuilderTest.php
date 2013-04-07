<?php
require_once "./src/RangesBuilder.php";
use PhlongTaIam\RangesBuilder as Builder;

class RangesBuilderTest extends PHPUnit_Framework_TestCase 
{
	public function setUp() {
		$this->builder = new Builder();
	}
	
	public function testOneWord() 
	{
		$ranges = $this->builder->buildFromDag([[0,5]], 5);
		$this->assertEquals([[0,5]], $ranges);
	}	
	
	public function testTwoWords() 
	{
		$ranges = $this->builder->buildFromDag([[0,3], [3,10]], 10);
		$this->assertEquals([[0,3], [3,10]], $ranges);
	}	
	
	public function testSimpleAmbiguity() 
	{
		$ranges = $this->builder->buildFromDag([[0,3], [0,5], [3,10]], 10);
		$this->assertEquals([[0,3], [3,10]], $ranges);
	}
	
	public function testWithoutKnownWord() 
	{
		$ranges = $this->builder->buildFromDag([], 10);
		$this->assertEquals([[0,10]], $ranges);
		$this->assertNotNull($ranges[0][0]);
	}	

	public function testUnknownOnTheRightest() 
	{
		$ranges = $this->builder->buildFromDag([[0,7]], 10);
		$this->assertEquals([[0,7], [7,10]], $ranges);
		$this->assertNotNull($ranges[0][0]);
	}	

	public function testUnknownOnTheLeftest() 
	{
		$ranges = $this->builder->buildFromDag([[7,10]], 10);
		$this->assertEquals([[0,7], [7,10]], $ranges);
	}	

	public function testKnownIsland() 
	{
		$ranges = $this->builder->buildFromDag([[3,5]], 10);
		$this->assertEquals([[0,3], [3,5], [5,10]], $ranges);
	}	

	
}
?>
