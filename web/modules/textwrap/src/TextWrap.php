<?php

namespace Drupal\textwrap;

class TextWrap implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    $ArrayDePalavras = explode(" ", $text);
    $frasesPorLinha = [];
    $frasesPorLinhaIndex = 0;

    foreach ($ArrayDePalavras as $palavra) {
      if ( mb_strlen($palavra) > $length ) {
          $palavraQuebrada = mb_str_split($palavra, $length, $encoding = 'utf8');

          foreach ($palavraQuebrada as $pedaçoPalavra) {
              $fraseFormadaAteOMomento = isset($frasesPorLinha[$frasesPorLinhaIndex]) ? $frasesPorLinha[$frasesPorLinhaIndex] : "";
              $fraseASerFormada = trim($fraseFormadaAteOMomento . " " . $pedaçoPalavra);

              if ( mb_strlen($fraseASerFormada) > $length ) {
                  $frasesPorLinhaIndex++;
                  $fraseFormadaAteOMomento = "";
              }

              $frasesPorLinha[$frasesPorLinhaIndex] = trim($fraseFormadaAteOMomento . " " . $pedaçoPalavra);

            
          }
      } else {
          $fraseFormadaAteOMomento = isset($frasesPorLinha[$frasesPorLinhaIndex]) ? $frasesPorLinha[$frasesPorLinhaIndex] : "";
          $fraseASerFormada = trim($fraseFormadaAteOMomento . " " . $palavra);

          if ( mb_strlen($fraseASerFormada) > $length ) {
              $frasesPorLinhaIndex++;
              $fraseFormadaAteOMomento = "";
          }

          $frasesPorLinha[$frasesPorLinhaIndex] = trim($fraseFormadaAteOMomento . " " . $palavra);
      }
  }

  return $frasesPorLinha;
}
}
   
    
