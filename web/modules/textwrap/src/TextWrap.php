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
      //Aqui verifico se o texto passado está vazio
      if(!empty($text)){
        $array=[];
        $words = [];
        $wordNow = "";
        $lines = "";

        foreach($words as $key => $word){
            if(!empty($wordNow)){
                $size_word = mb_strlen($wordNow." ".$word,"UTF-8");
                if($size_word<=$length){
                    $lines .= " ".$word;
                    $wordNow .= " ".$word;
                }else{
                    $lines .= "&".$word;
                    $wordNow = $word;
                }
            }else{
                $lines = $word;
                $wordNow = $word;
            }
        }
        return explode("&",$lines);
      }
      return [""];
  }

}
