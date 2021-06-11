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
//   public function string_split(string $str):array{
//     if (!empty($str)) {
//         $newArray = array();
//         $size = mb_strlen($str, "UTF-8");
//         for ($i = 0; $i < $size; $i += $l) {
//             $newArray[] = mb_substr($str, $i, $l, "UTF-8");
//         }
//         return $newArray;
//     }
//   }
//   public function IdentifierBigWords(array $words,int $length):array{
//     $array = [];
//     foreach($words as $word){
//         $size_word = mb_strlen($word,'UTF-8');
//         if($size_word>$length){
//             $split_word = this->string_split($word);
//             $lettersOfWord = array_chunk($split_word,$length);
//             foreach($lettersOfWord as $letters){
//                 $array[] = implode("",$letters);
//             }
//         }else{
//             $array[] = $word;
//         }
//     }
//     return $array;
//   }
  public function wrap(string $text, int $length): array {
      //Aqui verifico se o texto passado está vazio
      if(!empty($text)){
          $array=[];
          $words = [];
          foreach(explode(" ",$text) as $word){
                $size_word = mb_strlen($word,'UTF-8');
                if($size_word>$length){
                    // $split_word = this->string_split($word);
                    $split_word = [];
                    $size = mb_strlen($word, "UTF-8");
                    for ($i = 0; $i < $size; $i += $l) {
                        $split_word[] = mb_substr($str, $i, $l, "UTF-8");
                    }
                    $lettersOfWord = array_chunk($split_word,$length);
                    foreach($lettersOfWord as $letters){
                        $array[] = implode("",$letters);
                    }
                }else{
                    $array[] = $word;
                }
            }
        //   $words = this->IdentifierBigWords(explode(" ",$text),$length);
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
