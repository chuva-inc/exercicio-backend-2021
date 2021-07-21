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
    
    if(empty($text)){
      return [""];
    }

    $resultArray = array();

    $buildingArray = explode(" ", trim($text));

    $key = 0;

    mb_internal_encoding('UTF-8');

    foreach($buildingArray as $word){
      if(empty($resultArray[$key])){
        $resultArray[$key] = $word;
      } elseif(mb_strlen($resultArray[$key]) + mb_strlen($word) < $length) {
        $resultArray[$key] .= ' ' . $word;
      } elseif(mb_strlen($word) <= $length) {
        $resultArray[++$key] = $word;
      } else{
        $charsLeft = $word;
        do{
          var_dump(mb_strlen($charsLeft) . " + " . $length);
          if(mb_strlen($charsLeft) < $length){
            $resultArray = $charsLeft;
            unset($charsLeft);
            continue;
          }
          $charsLeft = substr($charsLeft, $length);
          $subword = substr($charsLeft, 0, $length);
          if(empty($subword)){
            var_dump( "charsleft" . $charsLeft, "subword" . $subword, $resultArray);
          }
          $resultArray[++$key] = $subword;
        }while(!empty($charsLeft));
      }
     }
    
    return $resultArray;
  }

}
