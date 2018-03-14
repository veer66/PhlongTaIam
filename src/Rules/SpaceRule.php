<?php
namespace Veer66\PhlongTaIam\Rules;
use Veer66\PhlongTaIam\Acceptor\SpaceRuleAcceptor;

class SpaceRule
{
    function createAcceptor($tag)
    {
        if (array_key_exists("SPACE_RULE", $tag)) {
            return null;
        }
        return new SpaceRuleAcceptor();
    }
}
