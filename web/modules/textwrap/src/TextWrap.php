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
  function wrap(string $text, int $length): array {
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

    $k = 0;
    $posicao = 0;
    $count = 0;
    $quebra[0] = '';
    $n = 0;

    foreach($arr as $word){
        $n++;

        $tamanho = mb_strlen($word, 'utf-8');
        
        $quebra = preg_split('/(.{'.$length.'})/u', $word,  -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
        
        if($tamanho <= $length):
            $words[$posicao] = $word;
            $posicao++;
        else:
            for($i = 0; $i < count($quebra); $i++){
            
                $words[$posicao] = $quebra[$i];
                $posicao++;
            
            }
        endif;

      }

      $arr = $words;

      $j = 0;
      $pos = 0;
      
      $arr2[0] = '';

      for($i = 0; $i < count($arr); $i++){

        if(strcmp($arr2[$j], '') == 0):
                
          $arr2[$j] = $arr[$i];
                  
        else:
                
          if(mb_strlen($arr2[$j], 'utf8') + mb_strlen($arr[$i], 'utf8') + 1 <= $length):

            $arr2[$j] =  $arr2[$j] . ' ' .  $arr[$i];
              
          else:
            $i--;
            $j++;
            $arr2[$j] = '';
                
          endif;
        endif;      
      }
      return $arr2;
  }

}
