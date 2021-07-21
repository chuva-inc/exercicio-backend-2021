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
    
    $resultArray = array();

    $buildingArray = explode(" ", trim($text));

    if(empty($buildingArray)){
      return "";
    }

    $key = 0;

    mb_internal_encoding('UTF-8');

    foreach($buildingArray as $word){
      if(empty($resultArray[$key])){
        $resultArray[$key] = $word;
      } elseif(mb_strlen($resultArray[$key]) + mb_strlen($word) < $length) {
        $resultArray[$key] .= ' ' . $word;
      } elseif(mb_strlen($word) < $length) {
        $resultArray[++$key] = $word;
      } else{
        $subword = $word;
        do{
          if(mb_strlen($subword) < $length){
            $resultArray = $subword;
            unset($leftChars);
            continue;
          }
          $leftChars = substr($subword, $length);
          $subword = substr($subword, 0, $length);
          $resultArray[++$key] = $subword;
        }while(!empty($leftChars));
      }
     }

    return $resultArray;
  }

}
