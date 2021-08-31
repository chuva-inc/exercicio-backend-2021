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
    //Defino o valor da variável
    $text = "Sobre os ombros de gigantes eu consigo ver mais longe";
    //Seto um array vazio
    $array = [];
    //Uso um loop for para percorrer a variável sempre que o contador for menor 
    //que a variável $text
    for ($i=0; $i<strlen($text); $i++) {
  
      if ($text[$i] != "-") { 
        $array[] = $text[$i]; 
  }
}
print_r($array); 
        
}

}


