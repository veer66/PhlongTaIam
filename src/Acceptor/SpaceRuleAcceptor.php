<?php
namespace Veer66\PhlongTaIam\Acceptor;

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
