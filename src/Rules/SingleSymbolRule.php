<?php
namespace Veer66\PhlongTaIam\Rules;

use Veer66\PhlongTaIam\Acceptor\SingleSymbolAcceptor;


class SingleSymbolRule
{
    function createAcceptor($tag)
    {
        return new SingleSymbolAcceptor();
    }
}
