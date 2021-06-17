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
    $this->stringSpace = "     ";
    $this->stringTeste = "Oioi eueu eeee";
    // $this->baseString = "pé 34567";
  }

  /**
   * Checa o retorno para strings vazias.
   */

  public function testForEmptyLength() {
    $ret = $this->resolucao->wrap($this->baseString, 0);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }
  // public function testForNegativeLength() {
  //   $ret = $this->resolucao->wrap($this->baseString, -1);
  //   $this->assertEmpty($ret[0]);
  //   $this->assertCount(1, $ret);
  // }
  // public function testForSpaceBeginning(){
  //   $ret = $this->resolucao->wrap($this->stringSpace, 10);
  //   echo $ret[0];
  //   $this->assertEmpty($ret[0]);
  //   $this->assertCount(1, $ret);
     
  // }
 
  // Testa a quebra de linha para palavras curtas.
   
  // public function testForSmallWords() {
  //   $ret = $this->resolucao->wrap($this->baseString, 8);
  //   $this->assertEquals("Se vi", $ret[0]);
  //   $this->assertEquals("mais", $ret[1]);
  //   $this->assertEquals("longe", $ret[2]);
  //   $this->assertEquals("foi por", $ret[3]);
  //   $this->assertEquals("estar de", $ret[4]);
  //   $this->assertEquals("pé sobre", $ret[5]);
  //   $this->assertEquals("ombros", $ret[6]);
  //   $this->assertEquals("de", $ret[7]);
  //   $this->assertEquals("gigantes", $ret[8]);
  //   $this->assertCount(9, $ret);
    
  // }

  //  // Testa a quebra de linha para palavras curtas.
  
  // public function testForSmallWords2() {
  //   $ret = $this->resolucao->wrap($this->baseString, 12);
  //   $this->assertEquals("Se vi mais", $ret[0]);
  //   $this->assertEquals("longe foi", $ret[1]);
  //   $this->assertEquals("por estar de", $ret[2]);
  //   $this->assertEquals("pé sobre", $ret[3]);
  //   $this->assertEquals("ombros de", $ret[4]);
  //   $this->assertEquals("gigantes", $ret[5]);
  //   $this->assertCount(6, $ret);
  
  // }

  public function testForEqualLength() {
    $ret = $this->resolucao->wrap($this->stringTeste, 3);
    $this->assertEquals("Oioi", $ret[0]);
    $this->assertEquals("eueu", $ret[1]);
    $this->assertEquals("eeee", $ret[2]);
    $this->assertCount(3, $ret);
    
    // echo "passei no teste de maior ou igual"; 
  }


}
