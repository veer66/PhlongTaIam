PhlongTaIam
===========

PHP Thai word breaker

Requirement
-----------
* PHP 5.3+

Usage
-----
```php
use Veer66\PhlongTaIam\Service\ThaiWordSplitter;
$splitter = new ThaiWordSplitter();
$thai = "จะให้พระยาน้อยยกเข้ามาประชิดเชิงกำแพงเมืองแล้วจึงจะแต่งทัพออกสู้รบนั้น";
$words = $splitter->extractWords($thai);
```
Word list
---------
Word lists were taken from [LibThai](http://linux.thai.net/projects/libthai)

Demo
----
http://vi.8fold.in/s/demo.php

# Testing
```bash
phpdbg -qrr vendor/bin/phpunit  tests
```
