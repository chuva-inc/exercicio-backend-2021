<?php

namespace Drupal\textwrap;

class TextWrap implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    if(empty($text) || $length <= 0){
      return [""];
    }

    $result = array();
    $currentWord = "";
    $currentLine = "";
    // Percorre a String $text
    for($pos = 0; $pos < mb_strlen($text); $pos++){
      // Pega o caractere atual
      $char = mb_substr($text, $pos, 1);

      // Um espaço vazio indica o fim de uma palavra e o começo da próxima
      if($char === ' '){
        /** 
         * Verifica se cabe mais uma palavra na linha
         * se não couber insere a linha no array e coloca a palavra na próxima linha
         */
        if(mb_strlen($currentWord)+1 + mb_strlen($currentLine) > $length) {
          array_push($result, $currentLine);
          $currentLine = "";
        }

        /**
         * Adiciona-se um espaço vazio entre as palavras, 
         * exceto se for a primeira da linha 
         * ou se existir mais de um espaço vazio seguido no texto original.
         */
        if (
          mb_strlen($currentLine) !== 0 && 
          mb_strlen($currentWord) !== 0
        ) {
          $currentWord = ' ' . $currentWord;
        }

        // Adiciona a palavra na linha e coloca $currentWord como vazio 
        $currentLine .= $currentWord;
        $currentWord = "";
      } else {
        $currentWord .= $char;
      }
    }

    // Adiciona as linhas finais a $result

    /**
     * Se a última palavra não couber na linha, então $currentLine será inserido
     * primeiro e $currentWord virá depois, em uma linha separas
     */ 
    if(mb_strlen($currentWord)+1 + mb_strlen($currentLine) > $length) {
      array_push($result, $currentLine);
      array_push($result, $currentWord);
    } else {
      $currentLine .= $currentWord;
      array_push($result, $currentLine);
    }

    return $result;
  }
}
