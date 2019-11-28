<?php
    //Desenvolvido por Allan Morishigue Bassiga da Cruz
    //Método para encontrar o menor caminho entre 2 vertices de um grafo
    //Diciplina Complexidade e Teoria dos Grafos 
    
    error_reporting(0);

    $qnt_vertice = $_GET['qnt_vertice'];
    $qnt_arestas = $_GET['qnt_arestas'];
    $origem = $_GET['origem'];
    $destino = $_GET['destino'];
    $vetArestaA = [];
    $vetArestaB = [];
    $expandir = [];
    $vetor = [];
    $anterior = [];
    $fim = false;
    $contIteracao = 1;

    for($i=0; $i<$qnt_vertice; $i++){
            $vertice = $_GET["nome"."$i"];
            array_push($vetor, $vertice);
    }

    $tam = count($vetor);

    //Printando vertices
    echo "Representação matemática do grafo V: <br>";
    echo "V(G) {";
    for($i=0; $i<$tam; $i++){
        echo $vetor[$i].",";
    }
    echo "}";

    //Printando arestas
    echo "<br> E(G) {";
    for($i=0; $i<$qnt_arestas; $i++){
        $keyA = 0;
        $keyB = 0;
        $arestaA = $_GET["arestaA"."$i"];
        array_push($vetArestaA, $arestaA);
        $arestaB = $_GET["arestaB"."$i"];
        array_push($vetArestaB, $arestaB);
        $peso = $_GET["peso"."$i"];
        
        echo "(".$arestaA.",".$arestaB. ");";

        //Preenchendo matriz
        $keyA = array_search($arestaA, $vetor);
        $keyB = array_search($arestaB, $vetor);

        if(($keyA>=0) && ($keyB>=0)){
            $matriz[$arestaA][$arestaB] = $peso;
            $matriz[$arestaB][$arestaA] = $peso;
        }else{
            echo "Não existe o vertice (".$arestaA.") ou o (".$arestaB.")<br><br>";
        }
    }
    echo "}<br><br>";

    echo "Método de Djikstra<br><br>";
    for($i=0; $i<$tam; $i++){
        $distanciaAcumulada[$i] = 1000;
        $expandir[$i] = 0;
        $anterior[$i] = 0;
        if($vetor[$i] == $origem){
            $distanciaAcumulada[$i] = 0;
        }
    }

    $atual = $origem;
    //print_r($vetArestaA);
    //print_r($vetArestaB);
    $contWhile = 5;
    //while($atual != $destino){
    while($fim == false){
        for($i=0; $i<$tam; $i++){
            if($vetor[$i] == $atual){
                $indexAtual = $i;
            }
        }
        //echo "while <br>";
        for($i=0; $i<sizeof($vetArestaA); $i++){
           // echo "for $i<br>";
            if(($atual == $vetArestaA[$i]) && ($expandir[$i] == 0)){
                //echo "if - 1 <br>";
               // echo $indexAtual."----".$atual."---".$vetArestaB[$i]."---"."<br>";
                $distanciaNova = $distanciaAcumulada[$indexAtual] + $matriz[$atual][$vetArestaB[$i]];
               // echo "distancia nova: $distanciaNova <br>";
               // echo "distancia acumulada de $i:".$distanciaAcumulada[$i]." <br>";
                $idx = array_search($vetArestaB[$i], $vetor);
               // echo "idx: $idx <br>";

                if($distanciaNova < $distanciaAcumulada[$idx]){
                   // echo "if - 2 <br>";
                    $distanciaAcumulada[$idx] = $distanciaNova;
                    $anterior[$idx] = $atual;
                }
            }elseif(($atual == $vetArestaB[$i]) && ($expandir[$i] == 0)){
                //echo "if - 1 <br>";
               // echo $indexAtual."----".$atual."---".$vetArestaA[$i]."---"."<br>";
                $distanciaNova = $distanciaAcumulada[$indexAtual] + $matriz[$atual][$vetArestaA[$i]];
               // echo "distancia nova: $distanciaNova <br>";
               // echo "distancia acumulada de $i:".$distanciaAcumulada[$i]." <br>";
                $idx = array_search($vetArestaA[$i], $vetor);
               // echo "idx: $idx <br>";

                if($distanciaNova < $distanciaAcumulada[$idx]){
                    //echo "if - 2 <br>";
                    $distanciaAcumulada[$idx] = $distanciaNova;
                    $anterior[$idx] = $atual;
                }
            }

        }
        $expandir[$indexAtual] = 1;
        echo "<br>Iteração $contIteracao: <br>";
        echo"expandir: ";print_r($expandir);echo"<br>";
        echo"distancia acumulada: ";print_r($distanciaAcumulada);echo"<br>";
        echo"anterior: ";print_r($anterior);echo"<br><br>";

        $contIteracao++;
        $contWhile--;
        $menor = 10000;
        for($i=0; $i<sizeof($distanciaAcumulada); $i++){
            if(($menor > $distanciaAcumulada[$i]) && ($distanciaAcumulada[$i] != 0) && ($expandir[$i] == 0)){
               // echo "entrou $i<br>";
                $menor = $distanciaAcumulada[$i];
               // echo "menor $menor indice: $i<br>";
                $proximo = $vetor[$i];
            }
            
        }
        //echo "proximo: $proximo <br><br>";
        if($proximo != $destino){
            $atual = $proximo;
        }else{
            $fim = true;
        }
    }    

    $vetorAnt = [];
    echo "<br>O menor caminho de ".strtoupper($origem)." até ".strtoupper($destino)." é: <br>";
    $procura = $destino;
    while($ant != $origem){
        $idxProcura = array_search($procura, $vetor);
        $ant = $anterior[$idxProcura];
        array_push($vetorAnt, $ant);
        $procura = $ant;
    }
    $reverter = array_reverse($vetorAnt);
    array_push($reverter, $destino);
    for($i=0; $i<sizeof($reverter); $i++){
        echo strtoupper($reverter[$i])." - ";
    }

    echo "<br><br><br> Matriz: <pre>".print_r($matriz, true)."</pre>"; 
?>

