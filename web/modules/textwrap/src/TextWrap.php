<?php
declare(strict_types=1);

namespace Drupal\textwrap; 

class TextWrap implements TextWrapInterface {

  public function wrap(string $text, int $length): array {
    $ArrayFinal = [];
    $ArrayInicial = explode(" ", $text);
    for ($i = 0; $i < count($ArrayInicial); $i++) {
      $concat = "";
      $TamanhoStringIndexArray = mb_strlen($ArrayInicial[$i]); 
      if ($TamanhoStringIndexArray <= $length) {
        $concat .=  $ArrayInicial[$i];
        for ($j = $i + 1; $j < count($ArrayInicial); $j++){
          if (mb_strlen($concat) + mb_strlen($ArrayInicial[$j]) < $length) {
            $concat .= " ";
            $concat .=  $ArrayInicial[$j];
            $i = $j;
          } else{
            break;
          }
        }
        array_push($ArrayFinal, $concat); 
      } else {
        array_push($ArrayFinal, $ArrayInicial[$i]);
      }
    }
    return $ArrayFinal;
  }
}
