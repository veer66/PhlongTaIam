<?php
namespace Veer66\PhlongTaIam\Rules;

use Veer66\PhlongTaIam\Acceptor\WordRuleAcceptor;

class WordRule
{
    function createAcceptor($tag)
    {
        if (array_key_exists("WORD_RULE", $tag)) {
            return null;
        }
        return new WordRuleAcceptor();
    }
}
