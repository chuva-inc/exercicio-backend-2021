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
    // Apague o código abaixo e escreva sua própria implementação,
    // nós colocamos esse mock para poder rodar a análise de cobertura dos
    // testes unitários.


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
    }

    // echo "to na classe "; 
    return $ret;

  }
}