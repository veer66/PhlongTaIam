<?php
/**
 * Created by PhpStorm.
 * User: Gordon Anderson
 * Date: 14/3/2561
 * Time: 2:33 น.
 */

namespace Veer66\PhlongTaIam\Tests;
use PHPUnit\Framework\TestCase;
use Veer66\PhlongTaIam\Service\ThaiWordSplitter;

class ThaiWordSplitterTest extends TestCase
{
    public function test_thai_phrase(){
        $splitter = new ThaiWordSplitter();

        // from https://th.wikisource.org/wiki/%E0%B8%AB%E0%B8%99%E0%B9%89%E0%B8%B2%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%81
        $thai = "จะให้พระยาน้อยยกเข้ามาประชิดเชิงกำแพงเมืองแล้วจึงจะแต่งทัพออกสู้รบนั้น เราไม่เห็นด้วย ชอบแต่ศึกมากศึกใหญ่เหลือกำลังจะต้านทาน"
            ."จึงตั้งมั่นรักษาเมือง อันศึกพอประมาณจะสู้รบ ก็ชอบตัดกำลังศึกเสียแต่กลางทาง";
        $words = $splitter->extractWords($thai);
        error_log(print_r($words, 1));

        // check number of words
        $this->assertEquals(61, sizeof($words));

        // check that they are all <= 6 letters
        foreach($words as $word) {
            $this->assertTrue(mb_strlen($word) <= 6);
        }
    }

    public function test_mixed_phrase(){
        $splitter = new ThaiWordSplitter();

        // from https://th.wikisource.org/wiki/%E0%B8%AB%E0%B8%99%E0%B9%89%E0%B8%B2%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%81
        $thai = "จะให้พระยาน้อยยกเข้ามาประชิดเชิงกำแพงเมืองแล้วจึงจะแ This is an English phrase ต่งทัพออกสู้รบนั้น เราไม่เห็นด้วย ชอบแต่ศึกมากศึกใหญ่เหลือกำลังจะต้านทาน"
            ."จึงตั้งมั่นรักษาเมือง อันศึกพอประมาณจะสู้รบ ก็ชอบตัดกำลังศึกเสียแต่กลางทาง";
        $words = $splitter->extractWords($thai);
        error_log(print_r($words, 1));

        // check number of words
        $this->assertEquals(75, sizeof($words));

        // check that they are all <= 6 letters
        foreach($words as $word) {
            $this->assertTrue(mb_strlen($word) <= 7);
        }
    }

    public function test_english_phrase(){
        $splitter = new ThaiWordSplitter();

        // from https://th.wikisource.org/wiki/%E0%B8%AB%E0%B8%99%E0%B9%89%E0%B8%B2%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%81
        $thai = "This is an English phrase";
        $words = $splitter->extractWords($thai);
        error_log(print_r($words, 1));

        // check number of words
        $this->assertEquals(9, sizeof($words));

        // check that they are all <= 6 letters
        foreach($words as $word) {
            $this->assertTrue(mb_strlen($word) <= 7);
        }
    }
}
