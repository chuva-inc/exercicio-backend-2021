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

  public function wrap(string $text, int $length): array {

    $text = trim($text);
    $explodedText = explode(' ', $text); // use explode to split one string into another given the reference (?)
    $explodedIndex = 0;
    $ret = [];
    $retIndex = 0;

    // check if the length or the given string are empty
    if($length <= 0 || mb_strlen($text, 'utf8') == 0){ // mb_strlen because strlen doesn't work with ~acento gráfico~
      $ret[0] = '';
      return $ret;
    }

    // now let's walk, man
    for ($i = 0; $i < count($explodedText); $i++){

      // 1st: the size of the sting is >= than the max of characters so just put it in the one to return
      if(mb_strlen($explodedText[$explodedIndex], 'utf8') >= $length){
        if (empty($ret[$retIndex])){
          $ret[$retIndex] = $explodedText[$explodedIndex];
          $retIndex++;
          $explodedIndex++;
        }
        else{
          $retIndex++;
          $ret[$retIndex] = $explodedText[$explodedIndex];
          $explodedIndex++;
        }
      }

      // but when it isn't? let's see
      else{
        if($explodedIndex == 0){ // you don't need to evaluate in the 1st position
          $ret[$retIndex] = $explodedText[$explodedIndex];
          $explodedIndex++;
        }
        else{
          if(empty($ret[$retIndex])){ // if it's empty you also just put it in the other array
            $ret[$retIndex] = $explodedText[$explodedIndex];
            $explodedIndex++;
          }
          else{ // if you can still put in the given position, do it + one space
            if(mb_strlen($ret[$retIndex], 'utf8') + mb_strlen($explodedText[$explodedIndex], 'utf8') + 1 <= $length){
              $ret[$retIndex] = "$ret[$retIndex] $explodedText[$explodedIndex]";
              $explodedIndex++;
            }
            else{ // but if you can't just go to the next one
              $retIndex++;
              $ret[$retIndex] = $explodedText[$explodedIndex];
              $explodedIndex++;
            }
          }
        }
      }
    }

    // echo "to na classe "; 
    return $ret;

  }
}