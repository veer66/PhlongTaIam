<?php
namespace Veer66\PhlongTaIam;

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
