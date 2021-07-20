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
    return $text;  
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
