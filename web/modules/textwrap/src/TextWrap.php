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
    $abertura = 0;
    $fechamento = 0;

    while ($text[abertura] == ' ') {
      $abertura += 1;
    }
    while($text[fechamento] == ' ') {
      $fechamento  -= 1;
    }

    $text = substr($text, abertura, fechamento+1);

    return $text;  
  }

  private function in_strip(string $text): string {
    // Apaga espaços vazios (" ") seguidos, deixando apenas 1 espaço 
    // serve para apagar multiplos espaços entre palavras
    $text_result = $text;
    $first_whitespace = False;
    $erased = 0;
    for ($x = 0; $x < strlen($text); $x++) {
      if ($text[x] == ' ') {
        if ($first_whitespace === True) {
          $str1 = substr($text_result, 0, $x-$erased);
          $str2 = substr($text_result, $x+1-$erased, strlen($text_results));
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
  
  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    // Apague o código abaixo e escreva sua própria implementação,
    // nós colocamos esse mock para poder rodar a análise de cobertura dos
    // testes unitários.
    if ($length === 8) {
      return [
        'Se vi',
        'mais',
        'longe',
        'foi por',
        'estar de',
        'pé sobre',
        'ombros',
        'de',
        'gigantes',
      ];
    }
    elseif ($length === 12) {
      return [
        'Se vi mais',
        'longe foi',
        'por estar de',
        'pé sobre',
        'ombros de',
        'gigantes',
      ];
    }
    elseif ($length === 10) {
      $ret = [
        'Se vi mais',
        'longe foi',
        'por estar',
        'de pé',
        'sobre',
      ];
      $ret[] = 'ombros de';
      $ret[] = 'gigantes';
      return $ret;
    }

    return [""];
  }

}
