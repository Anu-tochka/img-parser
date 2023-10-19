<?php

namespace App\Tests;

use App\Entity\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testLongURL(): void
    {
        $p = new Parser();
        $p->url = "https://doka.guide/recipes/snow/";
		$result = $p->clearingURL();

        $this->assertEquals("https://doka.guide", $result);
    }
    public function testQuestionMarkURL(): void
    {
        $p = new Parser();
        $p->url = "https://code.visualstudio.com/docs/?dv=win";
		$result = $p->clearingURL();

        $this->assertEquals("https://code.visualstudio.com", $result);
    }
}
