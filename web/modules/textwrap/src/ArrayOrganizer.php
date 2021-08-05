<?php
    require_once "palavra.php";

    function arrayOrganizer(array $conteudo, int $length): array
    {
        $palavra1 = new Palavra($conteudo[0]);
        $palavra2 = new Palavra($conteudo[1]);
        $linhaTemp = "";
        $resultadoFinal[] = "";
        //$palavrasEmObj[] = array(new Palavra($conteudo[0]));

        $contArray = 0;
        $contPalavras = 0;
        $continuar = 1;
        $pisoMinimo = 0;
        
        /*while($continuar)
        {
            $palavraAux = $palavrasEmObj[$contArray]->getWord($contPalavras);
            $qntArrays = ($palavraAux->getTamanho() / $length) + 1;

            for ($i=$contArray; $i < $qntArrays; $i++) { 
                $resultadoFinal[$i] = $palavraAux->obterPalavra($length);
                if($palavraAux->isEnd())
                {
                    $contPalavras++;
                }
            }
            $contArray++;

        }*/
        //$linhaTempAnt = "";
        while($continuar == 1)
        {
            //echo "<h3>" . $contArray . "</h3>";
            if(isset($conteudo[$contPalavras]))
            {
                $palavra1 = new Palavra($conteudo[$contPalavras]);
                $continuar = 1;
            }
            else
            {
                $palavra1 = "#";
                $continuar = 0;
            }

            if($palavra1 != "#")
            {
                    
                    if($palavra1->getTamanho() == $length)
                    {
                        $linhaTemp = $palavra1->obterPalavra($length);
                        $resultadoFinal[$contArray] = $linhaTemp;
                        $linhaTemp = "";
                        $contArray++;
                        $contPalavras++;
                        $continuar = 1;
                        echo "<h3>É o mesmo tamanho, continuou: " . $linhaTemp . "</h3>";
                    }
                    else if($palavra1->getTamanho() + strlen($linhaTemp) <= $length - 1)
                    {
                        $linhaTemp .= $palavra1->obterPalavra($palavra1->getTamanho()) . " ";
                        $contPalavras++;
                        $pisoMinimo++;
                        $continuar = 1;
                        echo "<h3>Foi menor, deu certo: " . $linhaTemp . "</h3>";
                        $palavraBemAux = new Palavra($conteudo[$contPalavras]);

                        if($palavraBemAux->getTamanho() + strlen($linhaTemp) > $length - 1)
                        {
                            $resultadoFinal[$contArray] = $linhaTemp;
                            $linhaTemp = "";
                            $contArray++;

                        }
                    }
                    else if($palavra1->getTamanho() > $length)
                    {
                        echo("Vish! Ela é maior!<br>");
                        $vezesRodar = ($palavra1->getTamanho()/ $length) + 1;
                        while($vezesRodar > 1)
                        {
                            //echo($vezesRodar . "<br>");
                            $linhaTemp = $palavra1->obterPalavra($length);
                            
                            $resultadoFinal[$contArray] = $linhaTemp;
                            //$linhaTemp = "";
                            $contArray++;
                            echo "<h3> Cortando:" . $linhaTemp . "</h3>";
                            $vezesRodar--;
                        }
                        $linhaTemp = "";
                        $contPalavras++;
                        $pisoMinimo++;
                        $continuar = 1;
                    }
                    else if($palavra1->getTamanho() + strlen($linhaTemp) > $length - 1)
                    {
                        $resultadoFinal[$contArray] = $linhaTemp;
                        $linhaTemp = "";
                        $contArray++;
                        $continuar = 1;
                        echo "<h3>É maior, não rolou! Pulando linha...</h3>";
                    }

                    else
                    {
                        echo "<br>Não entrou em nenhum dos casos anteriores.<br>";
                        $continuar = 0;
                    }

            }
            if($contPalavras == count($conteudo))
            {
                $contPalavras = $pisoMinimo;
                $continuar = 0;
                $resultadoFinal[$contArray] = $linhaTemp;
            }
        }
        //var_dump($resultadoFinal);
        return array_filter($resultadoFinal);
    }

