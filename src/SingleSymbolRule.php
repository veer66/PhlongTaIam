<?php
namespace Veer66\PhlongTaIam;

class SingleSymbolRule
{
    function createAcceptor($tag)
    {
        return new SingleSymbolAcceptor();
    }
}
