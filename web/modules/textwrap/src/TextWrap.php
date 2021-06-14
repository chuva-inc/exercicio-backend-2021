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

    // Qubrando frase em array de palavras e declarando variaveis
    $words = explode(" ", $text);
    $temp = "";
    $result = array();
    $total = count($words);

    //Quebrando palavras com mais caracteres que $length
    for ($i=0; $i < $total ; $i++) {
        if (mb_strlen($words[$i],'utf8') > $length) {
            $wrap_word = str_split($words[$i], $length);
            array_splice($words, $i, 1, $wrap_word);
            $total = count($words);
        }
    }

    //Concatenando $words e gerando $Result
    foreach ($words as $word) {
        if (mb_strlen($temp.$word, 'utf8') <= $length) {
          $temp .= $word . " ";
        }else{
            array_push($result, $temp);
            $temp = $word." ";
        }
    }
    array_push($result, $temp);
    return $result;
  }

}
