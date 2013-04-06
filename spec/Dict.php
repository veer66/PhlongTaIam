<?php

namespace spec;

use PHPSpec2\ObjectBehavior;

class Dict extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Dict');
    }

		function let() {
			$this->beConstructedWith("./data/test_dict.txt");
		}

		function it_should_give_first_index_of_string_list_by_needle() 
		{
			$this->findFirstIndexOfNeedle("b")->shouldReturn(2);
		}
		
		function it_should_give_last_index_of_string_list_by_needle() 
		{
			$this->findLastIndexOfNeedle("b")->shouldReturn(4);
		}
		
}
