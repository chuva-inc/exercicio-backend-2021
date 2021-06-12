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
    $chars = 0;
    while($chars < strlen($text))
    {
      $phrase = "";
      while(strlen($phrase) < $length)
      {
        //Verifica espaço no começo do trecho
        if(!empty($text[$chars]) && $text[$chars] === " " && strlen($phrase) == 0)
        {
          $chars++;
        }
        //Separa nova palavra para adicionar
        $word = explode(" ", substr($text, $chars, $length))[0];
        //Verifica se a palavra cabe na frase
        if(strlen($phrase) + strlen($word) <= $length)
        {
          $phrase .= $word;
          $chars += strlen($word);
        }
        else
        {
          $chars++;
        }
        //Verifica espaço vazio no fim da string
        if(!empty($text[$chars]) && $text[$chars] === " ")
        {
          $nextWord = explode(" ", substr($text, ($chars+1), $length))[0];
          //Adiciona espaço se tiver mais uma palavra por vir no trecho
          if(strlen($phrase) + strlen($nextWord) <= $length)
          {
            $phrase .= $text[$chars];
          }
          $chars++;
        }
      }
      $ret[] = $phrase;
    }
    return $ret;
  }

}
