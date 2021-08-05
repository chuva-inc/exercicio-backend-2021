<?php
    // Por: João Portilho
    // A função abaixo faz a transformação da frase substituindo os espaços entre as palavras por '-'. 
    // Depois faz a seleção das palavras menos esse traço, e em seguida retorna os valores organizados em um
    // array.
    function wordExtractor(string $text): array{
        // Substituição do espaço por '-'
        $text = str_replace(" ", "-", $text);
        // Faz-se uma adição no final da frase para que se possa entender onde ela termina
        $text[strlen($text)] = "-";
        // Inicia-se a contagem a partir de -1, para que se possa selecionar tudo, desde 0.
        $barraAnterior = -1;
        // Esta é a posição do array que salvaremos, que é incrementada quando entra-se no if
        $posicao = 0;
        // Inicia-se um arrayAux que será null de inicio, até ser preenchido
        $arrayAux[] = NULL;
        // Laço de repetição para extrair as palavras
        for ($i = 0; $i < strlen($text); $i++) {
            if ($text[$i] == "-" && $barraAnterior < $i) {
              // Utiliza-se a função de substr para extrair uma substring começa do traço + 1 e termina
              // em traço - 1, para o traço não aparecer no array.
              $arrayAux[$posicao] = substr($text, $barraAnterior+1, ($i - $barraAnterior)-1);
              // Se já retiramos a palavra, não faz sentido manter a barra anterior dessa palavra, então
              // precisamos alterar para a última posição, já que se pode iniciar por ela da próxima vez
              $barraAnterior = $i;
              // Incrementa-se um na variável de posição
              $posicao++;
            } 
          }
        // Limpando as variáveis usadas
        unset($text);
        unset($barraAnterior);
        unset($posicao);
        unset($i);
        // Retorna-se o arrayAux com todas as palavras separadas
        return $arrayAux;
    }

?>