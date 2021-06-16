<?php

namespace Drupal\textwrap;

class TextWrap implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    #Divide a string em array usando espaço como parâmetro Ex:papagaio teste -> [papagaio, teste]
    $ArrayDePalavras = explode(" ", $text);
    $frasesPorLinha = [];
    $frasesPorLinhaIndex = 0;

    foreach ($ArrayDePalavras as $palavra) {
      #Checa se o tamanho da palavra é maior que o tamanho permitido na linha
      if ( mb_strlen($palavra) > $length ) {
          #Divide a palavra em um array de pedaços da palavra de acordo com o limite da linha Ex:limite = 3, [pap,aga,io]
          $palavraQuebrada = mb_str_split($palavra, $length, $encoding = 'utf8');

          foreach ($palavraQuebrada as $pedaçoPalavra) {
              #Testa se a variável frasesPorLinha ja foi populada, se sim, atribui o valor, se não ele atribui uma string vazia
              $fraseFormadaAteOMomento = isset($frasesPorLinha[$frasesPorLinhaIndex]) ? $frasesPorLinha[$frasesPorLinhaIndex] : "";
              $fraseASerFormada = trim($fraseFormadaAteOMomento . " " . $pedaçoPalavra);
              #Muda de prosição e reseta a $fraseFormadaAteOMomento caso a fraseASerFormada seja maior que o limite da linha
              if ( mb_strlen($fraseASerFormada) > $length ) {
                  $frasesPorLinhaIndex++;
                  $fraseFormadaAteOMomento = "";
              }
              #Adiciona na posição $frasesPorLinhaIndex
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
   
    
