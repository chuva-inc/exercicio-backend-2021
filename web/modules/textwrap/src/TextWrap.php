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
*/
  public function setNewPartsLength(array $parts, int $length) {
    // definindo a codificação de caracteres a ser usada na função
    // mb_strlen
    $encoding = "utf-8";
    // variável temporária para armazenar as novas strings.
    $tempString = "";
    // novo array de strings
    $newParts = [];
    $newPartsIndex = 0;

    // variável usada na condição envolvendo quebra de palavras
    // maiores que a variável length
    $startIndex = 0;    

    for ($i = 0; $i < count($parts); $i++):

        if(mb_strlen($parts[$i], $encoding) < $length || mb_strlen($tempString, $encoding) > 0)  {
            // atribui um valor a variável tempstring, se ela estiver nula.
            if (mb_strlen($tempString, $encoding) == 0) {
                $tempString = $parts[$i];
            }
            // verifica se é possível concartenar mais um valor à variável tempString
            // sem que ela estoure o limite de caracteres
            elseif (mb_strlen(($tempString . " " . $parts[$i]), $encoding) <= $length) {
                $tempString .= " " . $parts[$i];
            }
            // verifica se o valor de tempString estourará o limite de caracteres ou já
            // possui um valor idêntico ao definido em length
            elseif (mb_strlen(($tempString . " " . $parts[$i]), $encoding) > $length || mb_strlen($tempString, $encoding) == $length) {
                $newParts[$newPartsIndex] = $tempString;
                $newPartsIndex++;
                $tempString = "";
                $i--;
            }
        }
        // palavras de tamanho igual ao de length
        elseif (mb_strlen($parts[$i], $encoding) == $length) {
            $newParts[$newPartsIndex] = $parts[$i];
            $newPartsIndex++;
        }
        // palavras maiores que length
        else {

            if (mb_strlen($tempString, $encoding) == 0) {
                $tempString = substr($parts[$i], $startIndex, $length);
                $startIndex += $length; 

                if ($tempString == null) { $startIndex = 0; }
                else { 
                    $i--; 
                }
            }
            // verifica se a substring já tem um valor para ser incrementado ao array
            elseif (mb_strlen($tempString, $encoding) == $length) {
                $newParts[$newPartsIndex] = $tempString;
                $tempString = "";
            }

        }    
    endfor;

    return $newParts;
  }

}
