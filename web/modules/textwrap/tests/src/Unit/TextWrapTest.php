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
   * Checa retorno quando tamanho da linha é igual a 0
   */
  public function testForZeroLength() {
    $ret = $this->resolucao->wrap($this->baseString, 0);
    $this->assertEquals("", $ret[0]);
    $this->assertCount(1, $ret);
  }

  /**
   * Checa retorno quando tamanho da linha é um número negativo
   */
  public function testForNegativeLength() {
    $ret = $this->resolucao->wrap($this->baseString, -2);
    $this->assertEquals("", $ret[0]);
    $this->assertCount(1, $ret);
  }
  
  /**
   * Testa a retirada de espaços em brando desenecessários.
   */
  public function testForBlankSpaces() {
    $ret = $this->resolucao->wrap("  Não somos   apenas o  que podemos ser  ", 40);
    $this->assertEquals("Não somos apenas o que podemos ser", $ret[0]);
    $this->assertCount(1, $ret);
  }

  /**
   * Testa a retirada de espaços em brando desenecessários quando
   * a frase é quebrada em linhas
   */
  public function testForBlankSpacesAndSmallWords() {
    $ret = $this->resolucao->wrap("  Não somos   apenas o  que podemos ser  ", 10);
    $this->assertEquals("Não somos", $ret[0]); 
    $this->assertEquals("apenas o", $ret[1]);
    $this->assertEquals("que", $ret[2]);
    $this->assertEquals("podemos", $ret[3]);
    $this->assertEquals("ser", $ret[4]);
    $this->assertCount(5, $ret);
  }

  /**
   * Checa o retorno para strings que contém apenas espaços em branco.
   */
  public function testForBlankStrings() {
    $ret = $this->resolucao->wrap("    ", 1000);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }

  /**
   * Testa a quebra de uma palavra quando ela excede o tamanho da linha
   */
  public function testForSmallLength() {
    $ret = $this->resolucao->wrap("Dinossauro", 4);
    $this->assertEquals("Dino", $ret[0]);
    $this->assertEquals("ssau", $ret[1]);
    $this->assertEquals("ro", $ret[2]);
    $this->assertCount(3, $ret);
  }
}
