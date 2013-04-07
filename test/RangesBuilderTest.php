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
	
}
?>
