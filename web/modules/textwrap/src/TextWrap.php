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
  
  private function strip(string $text): string {
    // Apaga espaços vazios (" ") no começo e no fim da string text
    $open = 0;
    $close = strlen($text)-1;

    while ($text[$open] == ' ') {
      $open += 1;
    }
    while($text[$close] == ' ') {
      $close  -= 1;
    }

    $text = substr($text, $open, $close+1);

    return $text;  
  }

  private function in_strip(string $text): string {
    // Apaga espaços vazios (" ") seguidos, deixando apenas 1 espaço 
    // serve para apagar multiplos espaços entre palavras
    $text_result = $text;
    $first_whitespace = False;
    $erased = 0;
    for ($x = 0; $x < strlen($text); $x++) {
      if ($text[$x] == ' ') {
        if ($first_whitespace === True) {
          $str1 = substr($text_result, 0, $x-$erased);
          $str2 = substr($text_result, $x+1-$erased, strlen($text_result));
          $text_result = $str1.$str2;
          $erased ++;
        } else {
          $first_whitespace = True;
        }
      } else {
        $first_whitespace = False;
      }
    }
    return $text_result;  
  }
  
  private function split(string $text): array {
    // Função para dividir string em array de acordo com espaços em branco
    // exemplo "sobre o ombro de gigantess" ficaria 
    // ["sobre", "o", "ombro", "de", "gigantes"]

    $text_result = [];
    $step = 0;
    $start = 0;
    $len_text = mb_strlen($text, "utf-8"); 

    while ($step < $len_text) {  
      // Se encontrar um espaço em branco ou estiver na ultima palavra
      if (($text[$step] === " ") or ($step === $len_text-1)) {
        $end = $step;
        
        // se estiver na ultima letra da ultima palavra
        if ($step === $len_text-1) {
          $end ++;
        }

        $text_result[] = substr($text, $start, $end-$start);
        $start = $step + 1;
      } 
      $step ++;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    // Apague o código abaixo e escreva sua própria implementação,
    // nós colocamos esse mock para poder rodar a análise de cobertura dos
    // testes unitários.
    return [];
}
