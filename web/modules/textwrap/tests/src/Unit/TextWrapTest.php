<?php

namespace Drupal\textwrap\Tests;

use Drupal\textwrap\TextWrap;
use PHPUnit\Framework\TestCase;

class TextWrapTest extends TestCase {

  public function setUp(): void  {
    $this->resolucao = new TextWrap();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    $this->stringSpace = "    Se vi mais    ";
  }

  public function testForEmptyLength() {
    $ret = $this->resolucao->wrap($this->baseString, 0);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }

  public function testForEmptyStrings() {
    $ret = $this->resolucao->wrap("", 2021);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }

  public function testForNegativeLength() {
    $ret = $this->resolucao->wrap($this->baseString, -1);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }
  public function testForSpaceStartEnd(){
    $ret = $this->resolucao->wrap($this->stringSpace, 10);
    $this->assertEquals($ret[0], "Se vi mais");
    $this->assertCount(1, $ret);
  }

  public function testForOnlyOneWord(){
    $ret = $this->resolucao->wrap("gigantes", 10);
    $this->assertEquals("gigantes", $ret[0]);
    $this->assertCount(1, $ret);
    $ret = $this->resolucao->wrap("gigantes", 3);
    $this->assertEquals("gigantes", $ret[0]);
    $this->assertCount(1, $ret);
  }
   
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


}
