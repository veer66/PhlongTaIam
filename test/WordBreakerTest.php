<?php
require_once "./src/WordBreaker.php";

use PhlongTaIam\WordBreaker as WordBreaker;

class WordBreakerTest extends PHPUnit_Framework_TestCase
{
	public function setUp() {
		$this->wordBreaker = new WordBreaker("./data/test_dict.txt");
	}

	public function testSimple() 
	{
		$this->assertEquals(array("กกต", "ขจ"), $this->wordBreaker->breakIntoWords("กกตขจ"));	
	}
	
	public function testUnk() 
	{
		$this->assertEquals(array("กกต", "ศรรม", "ขจ"), $this->wordBreaker->breakIntoWords("กกตศรรมขจ"));	
	}
	
}
?>
