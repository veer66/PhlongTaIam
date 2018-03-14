<?php
namespace Veer66\PhlongTaIam\Acceptor;

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
