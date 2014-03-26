<?php
namespace PhlongTaIam;
class Dict 
{
	public $dict;

	function __construct() {
		$this->dict = array();
	}

	function isEmptyWord($w) {
		return mb_strlen($w, "UTF-8") > 0;
	}

	function loadDict($dictPath) {
		$this->dict = explode("\n", file_get_contents($dictPath));
		$this->dict = array_filter($this->dict, array($this, "isEmptyWord"));
	}
	
	function dictSeek($l, $r, $ch, $strOffset, $pos) {
		$ans = null;
		while ($l <= $r) {
			$m = floor(($l + $r) / 2);
			$dict_item = $this->dict[$m];
			$len = mb_strlen($dict_item, "UTF-8");
			if ($len <= $strOffset) {
				$l = $m + 1;
			} else {
				$ch_ = mb_substr($dict_item, $strOffset, 1, "UTF-8");
				if ($ch_ < $ch) {
					$l = $m + 1;
				} else if ($ch_ > $ch) {
					$r = $m - 1;
				} else {
					$ans = $m;
					if ($pos == "LEFT") {
						$r = $m - 1;
					} else {
						$l = $m + 1;
					}
				}
			}
		}
		return $ans;
	}
	
	function isFinal($acceptor) 
	{
		$w = $this->dict[$acceptor->l];
		$len = mb_strlen($w, "UTF-8");
		return $len == $acceptor->strOffset;
	}

	function transit($acceptor, $ch) {
		$l = $this->dictSeek($acceptor->l, 
							 $acceptor->r, 
                             $ch, 
							 $acceptor->strOffset, 
							 "LEFT");
		if (!is_null($l)) {
			$r = $this->dictSeek($l,
								 $acceptor->r, 
								 $ch,
								 $acceptor->strOffset,
								 "RIGHT");
			$acceptor->l = $l;
			$acceptor->r = $r;
			$acceptor->strOffset++;
			$acceptor->isFinal = $this->isFinal($acceptor);
		} else {
			$acceptor->isError = true;
		}
		return $acceptor;
	}  

	function createAcceptor() {
		return new DictAcceptor($this);
	}

}

class DictAcceptor
{
	public $l, $r, $strOffset, $isFinal, $isError, $tag, $w, $type, $mw, $unk;
	function __construct($dict) {
		$this->dict = $dict;
		$this->l = 0;
		$this->r = sizeof($this->dict->dict) - 1;
		$this->strOffset = 0;
		$this->isFinal = false;
		$this->isError = false;
		$this->tag = "DICT";
		$this->type = "DICT";
		$this->w = 1;
		$this->mw = 0;
		$this->unk = 0;
	}

	function transit($ch) {
		return $this->dict->transit($this, $ch);
	}
}
?>
