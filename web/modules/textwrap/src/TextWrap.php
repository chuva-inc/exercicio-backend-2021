<?php

namespace Drupal\textwrap;

/**
 * Implemente sua resolução nessa classe.
 *
 * Implementada com sucesso :D
 */
class TextWrap implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    
    if ($length == 0) { return [""]; }

    $parts = slash($text);

    if (!isset($parts)) { return [""]; }

    // A resolução vai aqui abaixo :)
    $parts = setNewPartsLength($parts, $length);

    return $parts;
  }

  public function slash(string $text) {
    // verifica se o texto informado está vazio
    if (mb_strlen($text, "utf-8") == 0) { return null; }
    // correção de espaços duplicados/repetidos
    $text = replaceWhiteSpaces($text);
    // retorna as palavras da string text ordenadas por indices
    // em um array.
    return explode(" ", $text);
  }

  // remove espaços duplicados ou repetidos entre as palavras.
  public function replaceWhiteSpaces($str) {
      // verifica e corrige através de uma expressão regex os espaços 
      // repetidos da string e a retorna.
      return ($str) ? trim(preg_replace('/\s+/', ' ',$str)) : $str;
  }


/* 
 * setNewPartsLength
 * 
 * ordena os índices do array colocando o máximo
 * de palavras por linha, considerando a quantidade de 
 * caracteres máxima espeficada na variável length
 * 
*/
  public function setNewPartsLength(array $parts, int $length) {
    // determina a codifição dos caracteres para a função
    // mb_strlen, para evitar erros.
    $encoding = "utf-8";
    // variável temporária para armazenar as novas strings.
    $tempString = "";
    // novo array de strings
    $newParts = [];
    $newPartsIndex = 0;
    $counter = 0;
    // variável usada na condição envolvendo quebra de palavras
    // maiores que a variável length
    $startIndex = 0;    

    for ($i = 0; $i < count($parts) + 1; $i++):

        // Pega os restos da variável tempString, na última iteração
        // e adiciona ao último índice do array newParts
        if (!isset($parts[$i]) && mb_strlen($tempString) > 0) {
            $newParts[$newPartsIndex] = $tempString;
            break;
        }

        // condição para trabalhar com índices de tamanho inferior a length
        if(mb_strlen($parts[$i], $encoding) < $length || mb_strlen($tempString, $encoding) > 0) {
            

            if (mb_strlen($tempString, $encoding) == 0) {
                $tempString = $parts[$i];
            }
            elseif (mb_strlen(($tempString . " " . $parts[$i]), $encoding) <= $length) {
                $tempString .= " " . $parts[$i];
            }
            elseif (mb_strlen($tempString, $encoding) == $length || mb_strlen(($tempString . " " . $parts[$i]), $encoding) > $length) {
                $newParts[$newPartsIndex] = $tempString;
                $newPartsIndex++;
                $tempString = "";
                $i--;
            }
        }   
        // condição para trabalhar com índices de tamanho idêntico a length
        elseif (mb_strlen($parts[$i], $encoding) == $length) {
            $newParts[$newPartsIndex] = $parts[$i];
            $newPartsIndex++;
        }
        // condição para trabalhar valores maiores que length
        else {   
            $tempString = substr($parts[$i], $startIndex, $length);
            $startIndex += $length;

            if (mb_strlen($tempString, $encoding) == $length) {
                $newParts[$newPartsIndex] = $tempString;
                $newPartsIndex++;
                $tempString = "";
                $i--;
            }
            elseif (mb_strlen($tempString, $encoding) < $length) {
                $startIndex = 0;
            }
        }
    endfor;

    return $newParts;
  }
}
