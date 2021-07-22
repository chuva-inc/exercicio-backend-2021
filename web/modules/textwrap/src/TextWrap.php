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
    $size_text = mb_strlen($text, "utf-8"); 

    while ($step < $size_text) {  
      // Se encontrar um espaço em branco ou estiver na ultima palavra
      if (($text[$step] === " ") or ($step === $size_text-1)) {
        $end = $step;
        
        // se estiver na ultima letra da ultima palavra
        if ($step === $size_text-1) {
          $end ++;
        }

        $text_result[] = substr($text, $start, $end-$start);
        $start = $step + 1;
      } 
      $step ++;
    }

    return $text_result;
  }

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    // Apague o código abaixo e escreva sua própria implementação,
    // nós colocamos esse mock para poder rodar a análise de cobertura dos
    // testes unitários.
    
    // se a string estiver vazia
    if (strlen($text) == 0) {return [""];}

    $text = explode(" ", $this->in_strip($this->strip($text)));
    $result = [];
    $position = 0;
    $size_text = count($text); 

    while ($position < $size_text) {
      $word = $text[$position];
      $length_words =  mb_strlen($word, "utf-8"); 

      // se o tamanho da palavra selecionada for menor que length
      if ($length_words <= $length) {
        $words = $position + 1;
        $step = $position + 1;

        // se o tamanho das palavras selecionadas para a linha mais o tamanho
        // da nova palavra for menor que length
        while (($step < $size_text) and ($length_words +  mb_strlen($text[$step], "utf-8")  < $length)){
          $length_words += mb_strlen($text[$step], "utf-8")  + 1; // mais 1 representa espaço vazio entra as palavras
          $words += 1;
          $step += 1;
        }
      
        // junta as palavras colocando " " entre elas e adiciona no result
        $text_string = implode(" ", array_slice($text, $position, $words-$position));
        $result[] = $text_string;
        $position = $words - 1;

      } else {

        // corta a palavra em duas partes
        $cut = substr($word, 0, $length);
        $rest = substr($word, $length);
        
        // salva a primeira parte em result e coloca o resto onde a palavra inteira ficava
        $text[$position] = $rest;
        $result[] = $cut;
        $position --;
      }
      $position ++;
    }
    return $result;
  }
}
