<?php
namespace Drupal\textwrap\Tests;
use Drupal\textwrap\TextWrap;
use PHPUnit\Framework\TestCase;

class TextWrapTest extends TestCase{

  public function setUp(): void  {
    $this->resolucao = new TextWrap();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
  }

  public function testForEmptyStrings() {
    $ret = $this->resolucao->wrap("", 2021);
    $this->assertEmpty($ret[0]);
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

  public function testForSmallWords3() {
    $ret = $this->resolucao->wrap($this->baseString, 10);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar", $ret[2]);
    $this->assertEquals("de pé", $ret[3]);
    $this->assertEquals("sobre", $ret[4]);
    $this->assertEquals("ombros de", $ret[5]);
    $this->assertEquals("gigantes", $ret[6]);
    $this->assertCount(7, $ret);
  }

  public function testForSmallWords4() {
    $ret = $this->resolucao->wrap($this->baseString, 5);
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
    $this->assertEquals("gigantes", $ret[10]);
    $this->assertCount(11, $ret);
  }

}


