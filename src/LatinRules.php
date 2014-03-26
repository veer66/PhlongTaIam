<?php
namespace PhlongTaIam;

class WordRuleAcceptor
{
	public $strOffset, $isFinal, $isError, $tag, $w, $type, $mw, $unk;

    function __construct() 
    {
		$this->strOffset = 0;
		$this->isFinal = false;
		$this->isError = false;
		$this->tag = "WORD_RULE";
		$this->type = "WORD_RULE";
		$this->w = 1;
		$this->mw = 0;
		$this->unk = 0;
	}

    function transit($ch) 
    {
        if (($ch >= "a" && $ch <= "z") || ($ch >= "A" && $ch <= "z")) {
            $this->isFinal = true;
            $this->strOffset++;
        } else {
            $this->isError = true;
        }
        return $this;
    }
}

class WordRule 
{
    function createAcceptor($tag) {
        if (array_key_exists("WORD_RULE", $tag))
            return null;
        return new WordRuleAcceptor();
    }
}

class SpaceRuleAcceptor
{
	public $strOffset, $isFinal, $isError, $tag, $w, $type, $mw, $unk;

    function __construct() 
    {
		$this->strOffset = 0;
		$this->isFinal = false;
		$this->isError = false;
		$this->tag = "SPACE_RULE";
		$this->type = "SPACE_RULE";
		$this->w = 1;
		$this->mw = 0;
		$this->unk = 0;
	}

    function transit($ch) 
    {
        if ($ch == " " || $ch == "\t" || $ch == "\r" || $ch == "\n") {
            $this->isFinal = true;
            $this->strOffset++;
        } else {
            $this->isError = true;
        }
        return $this;
    }
}

class SpaceRule 
{
    function createAcceptor($tag) {
        if (array_key_exists("SPACE_RULE", $tag))
            return null;
        return new SpaceRuleAcceptor();
    }
}


class SingleSymbolAcceptor
{
	public $strOffset, $isFinal, $isError, $tag, $w, $type, $mw, $unk;

    function __construct() 
    {
		$this->strOffset = 0;
		$this->isFinal = false;
		$this->isError = false;
		$this->tag = "SINSYM";
		$this->type = "SINSYM";
		$this->w = 1;
		$this->mw = 0;
		$this->unk = 0;
	}

    function transit($ch) 
    {
        if ($this->strOffset == 0 && mb_strpos("()/-", $ch, 0, "UTF-8") >= 0) {
            $this->isFinal = true;
            $this->strOffset++;
        } else {
            $this->isError = true;
        }
        return $this;
    }
}

class SingleSymbolRule 
{
    function createAcceptor($tag) {
        return new SingleSymbolAcceptor();
    }
}
