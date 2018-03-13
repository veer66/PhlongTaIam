<?php
namespace Veer66\PhlongTaIam;

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
