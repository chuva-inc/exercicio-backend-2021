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
    // Verificação para valores nulos de length
    if($length > 0):
      $j = 0;
      // Define a chave inicial para a primeira palavra que ira ser add
      $arr[0] = '';

      // Divide a frase em um array de palavras (ainda nao leva em considereação o limite)
      for($i = 0; $i < strlen($text); $i++){   
          // Se o caracter não é espaço em branco, então é uma palavra
          if(!(strcmp($text[$i], ' ') == 0)):
              $arr[$j] = $arr[$j] . $text[$i];          
          else:   
              // Consome mais espaços em brancos, se houver
              while(strcmp($text[$i], ' ') == 0){  
                $i++;
              }
              $i--;
              // Atualiza para a próxima palavra que será add no array
              $j++;
              $arr[$j] = '';
              
          endif;
      }

      $k = 0;
      $posicao = 0;
      $count = 0;
      $quebra[0] = array();
      $n = 0;
      // Para cada palavra, será verificado se o seu tamanho é maior que o limite,
      // para as que forem, será quebrada em partes
      foreach($arr as $word){
          // recupero o tamanho de cada palavra levando em conta caracteres multibyte (utilizei o charset utf-8 pq é o utilizado atualmente em app web)
          $tamanho = mb_strlen($word, 'utf-8');
          // Se a palavra é menor ou igual que o limite, então ela não deve ser quebrada
          if($tamanho <= $length):
              $words[$posicao] = $word;
              $posicao++;
          else:
              // Utilizei regex para dividir as palavras de acordo com o limite
              // o pattern consome carcteres até o tamanho length e ai a quebra é feita
              // o parâmetro -1 nos garante que pedaços da palavra serao retornados, por exemplo ao dividir um numero impar de caracteres por 2
              // PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE garante que tudo não vazio sera retornado
              $quebra = preg_split('/(.{'.$length.'})/u', $word,  -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
              
              // Adiciona ao array de palavras as partes da palavra quebrada
              for($i = 0; $i < count($quebra); $i++){
              
                  $words[$posicao] = $quebra[$i];
                  $posicao++;
              
              }
          endif;
        }

      $j = 0;
      $pos = 0;
      $arr2[0] = '';
      // Concatena as palavras de acordo com o limite definido
      for($i = 0; $i < count($words); $i++){

        // Verifica se é a primera palavra da linha
        if(strcmp($arr2[$j], '') == 0):
                  
          $arr2[$j] = $words[$i];
        // Há mais palavras na linha        
        else:
          // Para adicionar outra palavra, o tamanho da mesma somado com as ja existentes mais ou espaço entre elas deve ser 
          // menor que o limite definido        
          if(mb_strlen($arr2[$j], 'utf8') + mb_strlen($words[$i], 'utf8') + 1 <= $length):

            $arr2[$j] =  $arr2[$j] . ' ' .  $words[$i];
                
          else:
            // Se não coube a palavra, então atualizamos a linha e voltamos novamente nesse mesma palavra para 
            // adiciona-la novamente
            $i--;
            $j++;
            $arr2[$j] = '';
                  
          endif;
        endif;      
      }
      return $arr2;

    else:
      return [];
    endif;
  }

}
