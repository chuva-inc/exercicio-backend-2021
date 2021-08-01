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
    return [""];
  }

}
