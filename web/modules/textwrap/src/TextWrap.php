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
    //Aqui verifico se o texto passado e vazio
    if(!empty($text)){
      // Definindo o array que ira ser retornado
      $array = [];
      //Definindo um array aonde ficará as palavras
      $words = [];
      /**
       * Dou um explode na variavel $text passando um delimitador aspas duplas com espaço pois, palavras são separadas umas das outras por espaços
       * depois disso percorro o array retornado
       */
      foreach(explode(" ",$text) as $word){
        //Verifico o Tamanho da palavra
        $size_word = mb_strlen($word,'UTF-8');
        /**
         * Depois verifico se a palavra e maior que o limite passado na função
         * E aqui que irei quebrar palavras maiores que o limite $length
         */
        if($size_word>$length){    
          $split_word = preg_split('~~u', $word, -1, PREG_SPLIT_NO_EMPTY);
                
          $chunks = array_chunk($split_word, $length);
          foreach ($chunks as $i => $chunk) {
              $chunks[$i] = join('', (array) $chunk);
          }
          foreach($chunks as $chunk){
              $words[] = $chunk;
          }
        }else{
            $words[] = $word;
        }
      }
      //Definindo variavel onde ficará as "palavras" atuais
      $wordsNow = "";
      /**
       * Definindo variavel onde ficará todas as linhas
       * O final de cada linha e marcado com um caracter "&"
       */
      $lines = "";

      foreach($words as $word){
        //Verifico se $wordsNow está vazio
        if(!empty($wordsNow)){
          //Verificando o tamanho da $word variavel concatenada com "espaço" e $wordsNow variavel
          $size_word = mb_strlen($wordsNow." ".$word,"UTF-8");
          /**
           * Verificando se $size_word e maior que $length(Limite de caracteres por linha)
           * Isso para saber quando e necessario adicionar a palavra
           * em uma nova linha
           */
          if($size_word<=$length){
            //Adicionando a palavra na linha
            $lines .= " ".$word;
            //Adicionando a palavra onde fica a string de palavras
            $wordsNow .= " ".$word;
          }else{
            //Adicionando um delimitador "&" que diz o fim de cada linha
            $lines .= "&".$word;
            //Redefinindo o $wordsNow variavel para a palavra atual que não coube na linha anterior
            $wordsNow = $word;
          }
        }else{
          // Tanto $lines e $wordsNow irão iniciar com o valor da palavra atual
          $lines = $word;
          $wordsNow = $word;
        }
      }
      // Retorna o valor final removendo os delimitadores "&" de $lines
      return explode("&",$lines);
    }
    //Retorna um array com indice 0 nulo caso não seja informado nenhum texto
    return [""];
  }

}
