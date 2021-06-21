<?php

namespace Drupal\textwrap;

class TextWrap implements TextWrapInterface
{

  public function wrap(string $text, int $length): array
  {

    $text = trim($text);
    $explodedText = explode(' ', $text); // use explode to split one string into another given the reference
    $explodedIndex = 0;
    $ret = [];
    $retIndex = 0;

    // check if the length or the given string are empty
    if ($length <= 0 || mb_strlen($text, 'utf8') == 0) { 
      $ret[0] = '';
      return $ret;
    }

    for ($i = 0; $i < count($explodedText); $i++) {

      // 1st: the size of the sting is >= than the max of characters so just put it in the one to return
      if (mb_strlen($explodedText[$explodedIndex], 'utf8') >= $length) {
        if (empty($ret[$retIndex])) {
          $ret[$retIndex] = $explodedText[$explodedIndex];
          $retIndex++;
          $explodedIndex++;
        } else {
          $retIndex++;
          $ret[$retIndex] = $explodedText[$explodedIndex];
          $explodedIndex++;
        }
      }

      // if not
      else if ($explodedIndex == 0 || empty($ret[$retIndex])) { // you don't need to evaluate in the 1st position
        $ret[$retIndex] = $explodedText[$explodedIndex];
        $explodedIndex++;
      }
      // if you can still put in the given position, do it + one space
      else if (mb_strlen($ret[$retIndex], 'utf8') + mb_strlen($explodedText[$explodedIndex], 'utf8') + 1 <= $length) {
        $ret[$retIndex] = "$ret[$retIndex] $explodedText[$explodedIndex]";
        $explodedIndex++;
      } else { // but if you can't just go to the next one
        $retIndex++;
        $ret[$retIndex] = $explodedText[$explodedIndex];
        $explodedIndex++;
      }
    }

    return $ret;
  }
}
