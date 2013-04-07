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
		$this->assertEquals(["กกต", "ขจ"], $this->wordBreaker->breakIntoWords("กกตขจ"));	
	}
	
}
?>