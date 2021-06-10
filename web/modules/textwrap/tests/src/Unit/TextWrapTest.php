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
    $this->otherString = "A vida é bela";
    $this->accentString = "Não Não amém açaí";
    $this->baseStringSpace = "Se  vi      mais longe   foi por   estar de pé    sobre  ombros de            gigantes";
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
   * Testa a quebra de linha para 1 caracter por linha.
   */
  public function testForOneCaracter() {
    $ret = $this->resolucao->wrap($this->otherString, 1);
    $this->assertEquals("A", $ret[0]);
    $this->assertEquals("v", $ret[1]);
    $this->assertEquals("i", $ret[2]);
    $this->assertEquals("d", $ret[3]);
    $this->assertEquals("a", $ret[4]);
    $this->assertEquals("é", $ret[5]);
    $this->assertEquals("b", $ret[6]);
    $this->assertEquals("e", $ret[7]);
    $this->assertEquals("l", $ret[8]);
    $this->assertEquals("a", $ret[9]);
    $this->assertCount(10, $ret);
  }

  /**
   * Testa a quebra de linha em palavras com caracteres multibytes (acentos, cedilha, entre outros)
   */
  public function testForAccent(){
    $ret = $this->resolucao->wrap($this->accentString, 3);
    $this->assertEquals("Não", $ret[0]);
    $this->assertEquals("Não", $ret[1]);
    $this->assertEquals("amé", $ret[2]);
    $this->assertEquals("m",   $ret[3]);
    $this->assertEquals("aça", $ret[4]);
    $this->assertEquals("í",   $ret[5]);
    $this->assertCount(6, $ret);

  }

  /**
  * Testa a quebra de linha quando existe mais de um espaço em branco entre as palavras.
  */
  public function testForSpace() {
    $ret = $this->resolucao->wrap($this->baseStringSpace, 8);
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

  public function testForBiggerThanPhrase() {
    $ret = $this->resolucao->wrap($this->baseString, 100);
    $this->assertEquals("Se vi mais longe foi por estar de pé sobre ombros de gigantes", $ret[0]);
    $this->assertCount(1, $ret);
  }

}
