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
  private function string_split(string $str):array{
    if (!empty($str)) {
        $newArray = array();
        $size = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $size; $i += $l) {
            $newArray[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $newArray;
    }
  }
  private function IdentifierBigWords(array $words,int $length):array{
    
  }
  public function wrap(string $text, int $length): array {
      //Aqui verifico se o texto passado está vazio
      if(!empty($text)){
          $array=[];
      }
  }

}
