<?php

namespace Drupal\textwrap;

/**
 * Implemente sua resolução nessa classe.
 *
 * Depois disso:
 * - [ ] Crie um PR no github com seu código
 * - [ ] Veja o resultado da correção automática do seu código
 * - [ ] Commit até os testes passarem
 * - [ ] Passou tudo, melhore a cobertura dos testes
 * - [ ] Ficou satisfeito, envie seu exercício para a gente! <3
 *
 * Boa sorte :D
 */
class TextWrap implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    
    if(empty($text) || $length == 0){
      return [""];
    }

    $resultArray = array();

    $key = 0;

    $buildingArray = explode(" ", trim($text));

    mb_internal_encoding('UTF-8');

    foreach($buildingArray as $word){
      $this->process_word($word, $resultArray, $key, $length);
     }
    return $resultArray;
  }

  private function process_word($word, &$resultArray, $key, $length){
    if(empty($resultArray[$key]) && mb_strlen($word) < $length){
      $resultArray[$key] = $word;
    } elseif(mb_strlen($resultArray[$key]) + mb_strlen($word) < $length) {
      $resultArray[$key] .= ' ' . $word;
    } elseif(mb_strlen($word) <= $length) {
      $resultArray[++$key] = $word;
    } else{
      $this->wrap_word($word, $resultArray, $key, $length);
    }
  }

  private function wrap_word($word, &$resultArray, $key, $length) {
    $lengthLeftInArray = $length - mb_strlen($resultArray[$key] . ' ');
    if($lengthLeftInArray < $length){
      $charsLeft = mb_substr($word, $lengthLeftInArray);
      $subword = mb_substr($word, 0, $lengthLeftInArray);
      $resultArray[$key] .= ' ' . $subword;
    } else{
      $charsLeft = $word;
    }
    do{
      if(mb_strlen($charsLeft) < $length){
        $resultArray[++$key] = $charsLeft;
        unset($charsLeft);
        continue;
      }
        $subword = mb_substr($charsLeft, 0, $length);
        $charsLeft = mb_substr($charsLeft, $length);
        $resultArray[++$key] = $subword;
    }while(!empty($charsLeft));
  }

}



