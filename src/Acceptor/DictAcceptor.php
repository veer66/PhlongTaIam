<?php
namespace Veer66\PhlongTaIam\Acceptor;

class DictAcceptor
{
    public $l, $r, $strOffset, $isFinal, $isError, $tag, $w, $type, $mw, $unk;

    function __construct($dict)
    {
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

    function transit($ch)
    {
        return $this->dict->transit($this, $ch);
    }
}
