<?php

namespace FineDiffTests\Usage;

use PHPUnit\Framework\TestCase;

abstract class Base extends TestCase
{
    protected function getFile($file)
    {
        $txt = file_get_contents(__DIR__.'/Resources/'.$file.'.txt');
        $txt = explode('==========', $txt);

        $from    = trim($txt[0]);
        $to = trim($txt[1]);
        $opcodes = trim($txt[2]);
        $html    = trim($txt[3]);

        return array($from, $to, $opcodes, $html);
    }
}