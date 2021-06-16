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
    $fraseArray = explode(" ", $text);
    $limite = $length;
    $frasesPorLinha = [];
    $frasesPorLinhaIndex = 0;

    foreach ($fraseArray as $palavra) {
      if ( mb_strlen($palavra) > $limite ) {
          $palavraQuebrada = mb_str_split($palavra, $limite);

          foreach ($palavraQuebrada as $pedaçoPalavra) {
              $fraseFormadaAteOMomento = isset($frasesPorLinha[$frasesPorLinhaIndex]) ? $frasesPorLinha[$frasesPorLinhaIndex] : "";
              $fraseASerFormada = trim($fraseFormadaAteOMomento . " " . $pedaçoPalavra);

              if ( mb_strlen($fraseASerFormada) > $limite ) {
                  $frasesPorLinhaIndex++;
                  $fraseFormadaAteOMomento = "";
              }

              $frasesPorLinha[$frasesPorLinhaIndex] = trim($fraseFormadaAteOMomento . " " . $pedaçoPalavra);

            
          }
      } else {
          $fraseFormadaAteOMomento = isset($frasesPorLinha[$frasesPorLinhaIndex]) ? $frasesPorLinha[$frasesPorLinhaIndex] : "";
          $fraseASerFormada = trim($fraseFormadaAteOMomento . " " . $palavra);

          if ( mb_strlen($fraseASerFormada) > $limite ) {
              $frasesPorLinhaIndex++;
              $fraseFormadaAteOMomento = "";
          }

          $frasesPorLinha[$frasesPorLinhaIndex] = trim($fraseFormadaAteOMomento . " " . $palavra);
      }
  }

  return $frasesPorLinha;
}
}
   
    
