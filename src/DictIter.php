<?php

namespace PhlongTaIam;

define("ACTIVE", 1);
define("ACTIVE_BOUNDARY", 2);
define("INVALID", 3);


class DictIter
{
	public function __construct($dict) {
		$this->dict = $dict;
		$this->e = $this->dict->getDictSize();
		$this->s = 0;
		$this->state = ACTIVE;
		$this->offset = 0;
	}
	
	public function walk($ch) {
		if($this->state != INVALID) {
			$first = $this->dict->findFirstIndexOfNeedle($ch, $this->offset, $this->s, $this->e);
			// echo "FIRST = $first offset=".$this->offset." s=".$this->s." e=".$this->e."\n";
			if($first === null) {
				$this->state = INVALID;
			} else {
				$this->s = $first;
				$last = $this->dict->findLastIndexOfNeedle($ch, $this->offset, $this->s, $this->e);
				$this->e = $last + 1;
				$len = $this->dict->getStringLength($first);
				$this->offset++;
				if($this->offset == $len) 
					$this->state =  ACTIVE_BOUNDARY;
				else
					$this->state =  ACTIVE;		
			}
		}
		return $this->state;
	}
}
