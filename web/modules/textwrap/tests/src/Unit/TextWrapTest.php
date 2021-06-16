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
    $this->advancedString = "Convolução";
    $this->advancedString2 = "se vi mais constit fo por a"; 
    
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
   * Testa a quebra de linha para palavras que excedem o length.
   */
  public function testForLongWords(){
    $ret = $this->resolucao->wrap($this->advancedString, 1);
    $this->assertEquals("C", $ret[0]);
    $this->assertEquals("o", $ret[1]);
    $this->assertEquals("n", $ret[2]);
    $this->assertEquals("v", $ret[3]);
    $this->assertEquals("o", $ret[4]);
    $this->assertEquals("l", $ret[5]);
    $this->assertEquals("u", $ret[6]);
    $this->assertEquals("ç", $ret[7]);
    $this->assertEquals("ã", $ret[8]);
    $this->assertEquals("o", $ret[9]);
    $this->assertCount(10, $ret);
  }
  /**
   * Testa a quebra de linha para palavras que excedem o length.
   */

  public function testForSmallLength() {
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

  public function testForSmallLength2(){
    $ret = $this->resolucao->wrap($this->advancedString2, 5);
    $this->assertEquals("se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("const", $ret[2]);
    $this->assertEquals("it fo", $ret[3]);
    $this->assertEquals("por a", $ret[4]);
    $this->assertCount(5, $ret);
  }

  
  // "se vi mais constit fo por a"
  // "Se vi mais longe foi por estar de pé sobre ombros de gigantes"
  // Convolução
}
