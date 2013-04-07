<?php
require_once "./src/const.php";
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
		$this->assertEquals([[0,1, DICT]], $dag);
	}
	
	public function testTwoWord() 
	{
		$dag = $this->builder->build("ขก", 2);
		$this->assertEquals([[0,1, DICT], [1,2,  DICT]], $dag);
	}

	public function testWithAmbiguity() 
	{
		$dag = $this->builder->build("ขจก", 3);
		$this->assertEquals([[0,1, DICT], [0,2,  DICT], [1,3, DICT], [2,3, DICT]], $dag);
	}	
	
	public function testEnglish() 
	{
		$dag = $this->builder->build("ขก pls", 6);
		$this->assertEquals([[0,1, DICT], [1,2, DICT], [2,3,SPACE], [3,6, LATIN]], $dag);
	}	
	
}
?>
