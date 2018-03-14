<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 14/3/2561
 * Time: 2:57 น.
 */
namespace Veer66\PhlongTaIam\Service;

use Veer66\PhlongTaIam\WordBreaker;

class ThaiWordSplitter
{
    private $thaiDictPath = null;

    /** @var null|WordBreaker */
    private $wordBreaker = null;

    public function __construct($thaiDictPath=null)
    {
        if (empty($thaiDictPath)) {
            $this->thaiDictPath = dirname(__FILE__) . '/../../data/tdict-std.txt';
        } else {
            $this->thaiDictPath = $thaiDictPath;
        }

        $this->wordBreaker = new WordBreaker($this->thaiDictPath);
    }


    public function extractWords($thaiText)
    {
        $words = $this->wordBreaker->breakIntoWords($thaiText);
        return $words;
    }


}