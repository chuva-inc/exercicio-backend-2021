<?php

namespace Drupal\textwrap;

class TextWrap implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    //Caso seja passado um texto vazio ou um número menor ou igual a zero
    //retorna-se uma string vazia
    if(empty($text) || $length <= 0){
      return [""];
    }

    $result = array();

    $lastPos = mb_strlen($text)-1;
    $currentWord = "";
    $currentLine = "";
    // Percorre a String $text
    for($pos = 0; $pos <= $lastPos; $pos++){
      // Pega o caracter atual
      $char = mb_substr($text, $pos, 1);

      // Caso o caractere atual seja um espaço vazio, indica o fim de uma palavra
      // e o começo da próxima
      if($char === ' '){
        // Se a última palavra couber na linha ela é inserida, 
        // caso não, a linha escrita até então é inserida no array $result
        // e a palvra é colocada na próxima linha
        if(mb_strlen($currentWord) + mb_strlen($currentLine) >= $length) {
          array_push($result, $currentLine);
          $currentLine = $currentWord;
        }  else if (mb_strlen($currentLine) === 0) {
          // Na primeira palavra de cada linha não é colocado um espaço em branco antes
          $currentLine .= $currentWord; 
        } else {
          $currentLine .= " " . $currentWord; 
        }
        $currentWord = "";
      } else if($pos === $lastPos) {
        $currentWord .= $char;
        // Se a última palavra do texto não couber na linha atual
        // a palavra é inserida na próxima posição do array.
        if(mb_strlen($currentWord) + mb_strlen($currentLine) >= $length) {
          array_push($result, $currentLine);
          array_push($result, $currentWord);
        } else {
          $currentLine .= $currentWord;
          array_push($result, $currentLine);
        }
      } else {
        // O atual caractere será inserido na palavra atual, 
        // caso não seja um espaço em branco.
        $currentWord .= $char;
      }
    }

    return $result;
  }
}
