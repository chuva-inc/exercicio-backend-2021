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
      if(count($words) > 0)
      {
        $usableWords = [];
        //Inicia a verificação de palavras maiores que a largura da frase
        foreach($words as $word)
        {
          if(strlen($word) <= $length)
          {
            array_push($usableWords, $word);
          }
          else
          {
            //Caso a palavra seja maior que a largura, é dividida
            $dividedWord = str_split($word, $length);
            foreach($dividedWord as $div)
            {
              array_push($usableWords, $div);
            }
          }
        }
        if(count($usableWords) > 0)
        {
          $wordIndex = 0;
          while($wordIndex < count($usableWords))
          {
            $phrase = "";
            do
            {
              $phrase .= (strlen($phrase) > 0 ? " " : "") . $usableWords[$wordIndex++];
            }
            while(array_key_exists($wordIndex, $usableWords) && (strlen($phrase) + strlen($usableWords[$wordIndex]) + 1 <= $length));
            if(!empty($phrase) && strlen($phrase) > 0)
            {
              array_push($ret, $phrase);
            }
          }
        }
      }
    }
    return $ret;
  }

}
