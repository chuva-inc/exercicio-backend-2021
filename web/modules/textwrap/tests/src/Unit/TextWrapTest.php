<?php

namespace Drupal\textwrap\Tests;

use Drupal\textwrap\TextWrap;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Drupal\textwrap\TextWrap.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase
{

    /**
     * Test Setup.
     */
    public function setUp(): void
    {
        $this->resolucao = new TextWrap();
        $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    }

    /**
     * Checa o retorno para strings vazias.
     */
    public function whenInputStringIsEmptyThenReturnArrayWithEmptyString()
    {
        $ret = $this->resolucao->wrap("", 2021);
        $this->assertEmpty($ret[0]);
        $this->assertCount(1, $ret);
    }

    public function whenInputLengthIsZeroThenReturnArrayWithEmptyString()
    {
        $ret = $this->resolucao->wrap($this->baseString, 0);
        $this->assertEmpty($ret[0]);
        $this->assertCount(1, $ret);
    }

    public function whenInputLengthIsNegativeThenReturnArrayWithEmptyString() {
        $ret = $this->resolucao->wrap($this->baseString, -1);
        $this->assertEmpty($ret[0]);
        $this->assertCount(1, $ret);
    }

    /**
     * Testa a quebra de linha para palavras curtas.
     */
    public function whenWordsInStringFitsLengthInputThenReturnArrayWithWrapedLines()
    {
        $ret = $this->resolucao->wrap($this->baseString, 8);
        $this->assertEquals("Se vi", $ret[0]);
        $this->assertEquals("mais", $ret[1]);
        $this->assertEquals("longe", $ret[2]);
        $this->assertEquals("foi por", $ret[3]);
        $this->assertEquals("estar de", $ret[4]);
        $this->assertEquals("pé sobre", $ret[5]);
        $this->assertEquals("ombros", $ret[6]);
        $this->assertEquals("de", $ret[7]);
        $this->assertEquals("gigantes", $ret[8]);
        $this->assertCount(9, $ret);
    }

    /**
     * Testa a quebra de linha para palavras curtas.
     */
    public function whenWordsInStringFitsLengthInputThenReturnArrayWithWrapedLines2()
    {
        $ret = $this->resolucao->wrap($this->baseString, 12);
        $this->assertEquals("Se vi mais", $ret[0]);
        $this->assertEquals("longe foi", $ret[1]);
        $this->assertEquals("por estar de", $ret[2]);
        $this->assertEquals("pé sobre", $ret[3]);
        $this->assertEquals("ombros de", $ret[4]);
        $this->assertEquals("gigantes", $ret[5]);
        $this->assertCount(6, $ret);
    }

    /**
     * Testa a quebra de linha para palavras curtas.
     */
    public function whenWordsInStringAreBiggerThanLengthInputThenReturnArrayWithWrapedWords()
    {
        $ret = $this->resolucao->wrap($this->baseString, 7);
        $this->assertEquals("Se vi", $ret[0]);
        $this->assertEquals("mais", $ret[1]);
        $this->assertEquals("longe", $ret[2]);
        $this->assertEquals("foi por", $ret[3]);
        $this->assertEquals("estar", $ret[4]);
        $this->assertEquals("de pé", $ret[5]);
        $this->assertEquals("sobre", $ret[6]);
        $this->assertEquals("ombros", $ret[7]);
        $this->assertEquals("de giga", $ret[8]);
        $this->assertEquals("ntes", $ret[9]);
        $this->assertCount(10, $ret);
    }

}
