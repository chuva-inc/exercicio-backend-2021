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

  // Testa a quebra de linha para um limite de 5 caracteres
  public function testForSmallWords3() {
    $ret = $this->resolucao->wrap($this->baseString, 5);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi", $ret[3]);
    $this->assertEquals("por", $ret[4]);
    $this->assertEquals("estar", $ret[5]);
    $this->assertEquals("de pé", $ret[6]);
    $this->assertEquals("sobre", $ret[7]);
    $this->assertEquals("ombro", $ret[8]);
    $this->assertEquals("s de", $ret[9]);
    $this->assertEquals("gigan", $ret[10]);
    $this->assertEquals("tes", $ret[11]);
    $this->assertCount(12, $ret);
  }

  // Testa a quebra de linha para um limite de 3 caracteres
  public function testForSmallWords4() {
    $ret = $this->resolucao->wrap($this->baseString, 3);
    $this->assertEquals("Se", $ret[0]);
    $this->assertEquals("vi", $ret[1]);
    $this->assertEquals("mai", $ret[2]);
    $this->assertEquals("s", $ret[3]);
    $this->assertEquals("lon", $ret[4]);
    $this->assertEquals("ge", $ret[5]);
    $this->assertEquals("foi", $ret[6]);
    $this->assertEquals("por", $ret[7]);
    $this->assertEquals("est", $ret[8]);
    $this->assertEquals("ar", $ret[9]);
    $this->assertEquals("de", $ret[10]);
    $this->assertEquals("pé", $ret[11]);
    $this->assertEquals("sob", $ret[12]);
    $this->assertEquals("re", $ret[13]);
    $this->assertEquals("omb", $ret[14]);
    $this->assertEquals("ros", $ret[15]);
    $this->assertEquals("de", $ret[16]);
    $this->assertEquals("gig", $ret[17]);
    $this->assertEquals("ant", $ret[18]);
    $this->assertEquals("es", $ret[19]);
    $this->assertCount(20, $ret);
  }

}
