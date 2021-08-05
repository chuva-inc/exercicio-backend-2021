<?php

class Palavra
{
    // Declaração dos atributos da classe
    private string $palavra;
    private int $tamanho;
    private Palavra $proxima;
    // Para saber o que resta inserir na linha
    private int $posicaoCont = 0;
    private array $letras;
    private bool $end = false;
    function __construct(string $palavra)
    {
        $this->palavra = $palavra;
        $this->tamanho = strlen($palavra);
        $this->contarLetras($palavra);
    }
    

    private function contarLetras(string $palavra): void
    {
        for ($i=0; $i < strlen($palavra); $i++) { 
           $letras[$i] = $palavra[$i];
        }
    }

    public function obterPalavra(int $tamanho): string
    {
        if($this->tamanho <= $tamanho)
        {
            $this->setEnd();
            return $this->palavra;
        }
        else if($this->tamanho > $tamanho)
        {
            if($this->posicaoCont == 0)
                {
                    $palavraRetornar = substr($this->palavra, $this->posicaoCont, $tamanho);
                    $this->posicaoCont += $tamanho;
                    return $palavraRetornar;
                }
                else
                {
                    $palavraRetornar = substr($this->palavra, $this->posicaoCont, $tamanho);
                    if(($this->tamanho - $this->posicaoCont) <= $tamanho)
                    {
                        $this->posicaoCont += $this->posicaoCont;
                        $this->setEnd();
                        return $palavraRetornar;
                    }
                    else
                    {
                        $this->posicaoCont += $tamanho;
                        return $palavraRetornar;
                    }
                }
        }
    }

    public function getTamanho() : int 
    {
        return $this->tamanho;
    }

    private function setEnd() : void
    {
        $this->end = true;
    }
    
    public function isEnd() : bool
    {
        return $this->end;
    }
}

?>