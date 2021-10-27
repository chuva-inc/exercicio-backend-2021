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
  
  /* declare(strict_types = 1); */

    $wordIn = "Divino";
    $wordPieces;

    function wordBreak($word, $maxLength = 15){


        global $wordPieces;

        if (strlen($word) > $maxLength) {
            echo "numero maximo excedido";
            return;
        }

        for ($i = 0; $i < strlen($word); $i++) {
            if($word[$i] ===  ","){echo "sem virgulas";return;}
            if($word[$i] ===  " "){echo "sem espaço";return;}
            if(is_numeric($word[$i])){echo "sem numeros";return;}
            
        }


        $wordPieces = str_split($word, 1);

        for ($i = 0; $i < count($wordPieces); $i++) {
            echo "| ". $wordPieces[$i] . " |"."<br>";
        }
    }

    wordBreak($wordIn);
  
    
    

    return [""];
  }

}
