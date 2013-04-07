<?php
require_once "./src/Dict.php";
require_once "./src/WordDagBuilder.php";
use PhlongTaIam\Dict;
use PhlongTaIam\WordDagBuilder as Builder;

class WordDagBuilderTest extends PHPUnit_Framework_TestCase 
{
	public function setUp() {
		$this->dict = new Dict("./data/test_dict.txt");
		$this->builder = new Builder($this->dict);
	}
	
	public function testOneWord() 
	{
		$dag = $this->builder->build("ก", 1);
		$this->assertEquals([[0,1]], $dag);
	}
	
	public function testTwoWord() 
	{
		$dag = $this->builder->build("ขก", 2);
		$this->assertEquals([[0,1], [1,2]], $dag);
	}

	public function testWithAmbiguity() 
	{
		$dag = $this->builder->build("ขจก", 3);
		$this->assertEquals([[0,1], [0,2], [1,3], [2,3]], $dag);
	}	
}
?>
