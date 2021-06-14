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

    $ret = [];
    //Verifica se o texto está vazio e se a largura da frase é positiva
    if(!empty($text) && mb_strlen($text) > 0 && $length > 0)
    {
      $words = explode(" ", $text);
      //Verifica se há palavras para serem adicionadas
      if(count($words) > 0)
      {
        $usableWords = [];
        //Inicia a verificação de palavras maiores que a largura da frase
        foreach($words as $word)
        {
          if(mb_strlen($word) <= $length)
          {
            array_push($usableWords, $word);
          }
          else
          {
            //Caso a palavra seja maior que a largura, é dividida
            $dividedWord = mb_str_split($word, $length);
            foreach($dividedWord as $div)
            {
              array_push($usableWords, $div);
            }
          }
        }
        if(count($usableWords) > 0)
        {
          $wordIndex = 0;
          //Verifica se ainda há palavras para serem adicionadas, e se a palavra seguinte existe
          while($wordIndex < count($usableWords) && array_key_exists($wordIndex, $usableWords))
          {
            $phrase = "";
            do
            {
              //Adiciona a palavra à frase, e não for a primeira palavra, adiciona espaço anterior
              $phrase .= (mb_strlen($phrase) > 0 ? " " : "") . $usableWords[$wordIndex++];
            }
            //Verifica se a próxima palavra existe e se há espaço para ela na frase
            while(array_key_exists($wordIndex, $usableWords) && ((mb_strlen($phrase) + mb_strlen($usableWords[$wordIndex]) + 1) <= $length));
            //Se a frase existir e não estiver vazia, é adicionada ao retorno
            if(!empty($phrase) && mb_strlen($phrase) > 0)
            {
              array_push($ret, $phrase);
            }
          }
        }
      }
    }
    else
    {
      //Se o texto for vazio, garante o retorno de array vazio
      $ret = [null];
    }
    //Retorna o array populado pelas frases definidas
    return $ret;
  }

}
