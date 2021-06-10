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

  $j = 0;
  $arr[0] = '';
  for($i = 0; $i < strlen($text); $i++){
          
      if(!(strcmp($text[$i], ' ') == 0)):
          $arr[$j] = $arr[$j] . $text[$i];          
      else:   
          while(strcmp($text[$i], ' ') == 0){  
            $i++;
          }
          $i--;
          $j++;
          $arr[$j] = '';
          
      endif;
  }
  

}
