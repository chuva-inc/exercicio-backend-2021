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
    $text .= ' '; // faz colocar a última palavra do texto em $currentLine
    $currentWord = "";
    $currentLine = "";
    // Percorre a String $text
    for($pos = 0; $pos < mb_strlen($text); $pos++){
      // Pega o caractere atual
      $char = mb_substr($text, $pos, 1);

      // Acompanha o crescimento da linha até atingir o tamanho máximo
      if(mb_strlen($currentWord) + mb_strlen($currentLine) === $length) {
        // Se a linha não estiver vazia ela é adicinada a $result
        if(!empty($currentLine)){
          array_push($result, $currentLine);
          $currentLine = "";
        } else {
          /** 
           * Se estiver vazia, indica que $currenteWord já atingiu o
           * tamanho máximo da linha, e por isso a palavra será cortada 
           * em pedaços e adicionada a mais de uma linha
           */ 
          array_push($result, $currentWord);
          $currentWord = "";
        }
      }

      // Um espaço vazio indica o fim de uma palavra e o começo da próxima
      if($char === ' '){
        /**
         * Adiciona-se um espaço vazio antes de cada palavra, 
         * exceto se for a primeira da linha 
         * ou se $currentWord estiver vazio
         */
        if (
          !empty($currentLine) && 
          !empty($currentWord)
        ) {
          $currentLine .= ' ';
        }

        // Insere a palavra na linha e coloca $currentWord como vazio 
        $currentLine .= $currentWord;
        $currentWord = "";
      } else {
        $currentWord .= $char;
      }
    }

    // Insere mais uma linha a $result se ele estiver vazio
    // ou se a última palavra do texto não coube na última linha até então.
    if(empty($result) || !empty($currentLine)){
      array_push($result, $currentLine);
    }

    return $result;
  }
}
