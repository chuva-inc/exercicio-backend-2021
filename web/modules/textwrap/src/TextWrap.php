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
    /*
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
    */
    $ret = [];
    //Verifica se o texto está vazio e se a largura da frase é positiva
    if(!empty($text) && $length > 0)
    {
      $words = explode(" ", $text);
      //Verifica se há palavras para serem adicionadas
      if(count($words) === 0)
      {
        for($x = 0; $x < count($words); $x++)
        {
          $phrase = "";
          //Verifica se a frase está completa
          while(strlen($phrase) + strlen($words[$x]) < $length)
          {
            if(strlen($phrase) > 0)
            {
              if(strlen($phrase) + strlen() + 1 <= $length)
              {
                $phrase .= ` ${$words[$x]}`;
              }
            }
            else
            {
              if(strlen($phrase) + strlen($words[$x]) <= $length)
              {
                $phrase .= ` ${$words[$x]}`;
              }
            }
          }
          $ret[] = $phrase;
        }
      }
    }


    return $ret;
  }

}
