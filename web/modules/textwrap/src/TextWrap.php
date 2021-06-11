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
      if(!empty($text)){
        $array = [];
        $words = [];
        foreach(explode(" ",$text) as $word){
            $size_word = mb_strlen($word,'UTF-8');
            if($size_word>$length){
                $split_word = array();
                $size = mb_strlen($word, "UTF-8");
                for ($i = 0; $i < $size; $i += $l) {
                    $split_word[] = mb_substr($str, $i, $l, "UTF-8");
                }
                $lettersOfWord = array_chunk($split_word,$length);
                foreach($lettersOfWord as $letters){
                    $words[] = implode("",$letters);
                }
            }else{
                $words[] = $word;
            }
        }
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
