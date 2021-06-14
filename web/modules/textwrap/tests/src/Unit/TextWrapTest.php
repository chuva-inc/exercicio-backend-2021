<?php

namespace Drupal\textwrap\Tests;

use Drupal\textwrap\TextWrap;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Drupal\textwrap\TextWrap.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase {

  /**
   * Test Setup.
   */
  public function setUp(): void  {
    $this->resolucao = new TextWrap();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
  }

  /**
   * Checa o retorno para strings vazias.
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->wrap("", 2021);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   */
  public function testForSmallWords() {
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
  public function testForSmallWords2() {
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
   * Testa a quebra de palavras médias e grandes.
   */
  public function testForWordBreak() {
    $ret = $this->resolucao->wrap($this->baseString, 6);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi", $ret[3]);
    $this->assertEquals("por", $ret[4]);
    $this->assertEquals("estar", $ret[5]);
    $this->assertEquals("de pé", $ret[6]);
    $this->assertEquals("sobre", $ret[7]);
    $this->assertEquals("ombros", $ret[8]);
    $this->assertEquals("de", $ret[9]);
    $this->assertEquals("gigant", $ret[10]);
    $this->assertEquals("es", $ret[11]);
    $this->assertCount(12, $ret);
  }

  /**
   * Testa a quebra de palavras médias e grandes.
   */
  public function testForWordBreak2() {
    $ret = $this->resolucao->wrap($this->baseString, 4);
    $this->assertEquals("Se", $ret[0]);
    $this->assertEquals("vi", $ret[1]);
    $this->assertEquals("mais", $ret[2]);
    $this->assertEquals("long", $ret[3]);
    $this->assertEquals("e", $ret[4]);
    $this->assertEquals("foi", $ret[5]);
    $this->assertEquals("por", $ret[6]);
    $this->assertEquals("esta", $ret[7]);
    $this->assertEquals("r de", $ret[8]);
    $this->assertEquals("pé", $ret[9]);
    $this->assertEquals("sobr", $ret[10]);
    $this->assertEquals("e", $ret[11]);
    $this->assertEquals("ombr", $ret[12]);
    $this->assertEquals("os", $ret[13]);
    $this->assertEquals("de", $ret[14]);
    $this->assertEquals("giga", $ret[15]);
    $this->assertEquals("ntes", $ret[16]);
    $this->assertCount(17, $ret);
  }

  /**
   * Testa a quebra de frases em trechos mais longos.
   */
  public function testForPhrase() {
    $ret = $this->resolucao->wrap($this->baseString, 20);
    $this->assertEquals("Se vi mais longe foi", $ret[0]);
    $this->assertEquals("por estar de pé", $ret[1]);
    $this->assertEquals("sobre ombros de", $ret[2]);
    $this->assertEquals("gigantes", $ret[3]);
    $this->assertCount(4, $ret);
  }

  /**
   * Testa a quebra de frases em trechos mais longos.
   */
  public function testForPhrase2() {
    $ret = $this->resolucao->wrap($this->baseString, 30);
    $this->assertEquals("Se vi mais longe foi por estar", $ret[0]);
    $this->assertEquals("de pé sobre ombros de gigantes", $ret[1]);
    $this->assertCount(2, $ret);
  }

  /**
   * Testa a quebra de frases em trechos mais longos.
   */
  public function testForPhrase3() {
    $ret = $this->resolucao->wrap($this->baseString, 45);
    $this->assertEquals("Se vi mais longe foi por estar de pé sobre", $ret[0]);
    $this->assertEquals("ombros de gigantes", $ret[1]);
    $this->assertCount(2, $ret);
  }

}
