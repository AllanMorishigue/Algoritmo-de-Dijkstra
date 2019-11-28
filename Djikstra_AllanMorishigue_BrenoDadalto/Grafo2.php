<?php 
    //Desenvolvido por Allan Morishigue Bassiga da Cruz
    //Método para encontrar o menor caminho entre 2 vertices de um grafo
    //Diciplina Complexidade e Teoria dos Grafos 

    $qnt_vertice = $_GET['qnt_vertice'];
    $qnt_arestas = $_GET['qnt_arestas'];
?>

<html>
    <head>
        <title> Grafo </title>
    </head>

    <body>
        <div>
            <form action="Grafo3.php">
                <input type="hidden" name="qnt_vertice" value= "<?php echo $qnt_vertice; ?>">
                <input type="hidden" name="qnt_arestas" value= "<?php echo $qnt_arestas; ?>">

                <span>Nomeie os vertices:</span><br><br>

                <?php for($i=0; $i<$qnt_vertice; $i++){ ?>
                    <input type="text" name="nome<?php echo $i; ?>" style="width: 40px;"> 
                    <br>
                <?php } ?>  

                <br><span>Informe as arestas:</span><br><br>

                <?php for($i=0; $i<$qnt_arestas; $i++){ ?>
                    <input type="text" name="arestaA<?php echo $i; ?>" style="width: 40px;">
                    -
                    <input type="text" name="arestaB<?php echo $i; ?>" style="width: 40px;"> 
                    Peso: <input type="text" name="peso<?php echo $i; ?>" style="width: 40px;"> <br><br>
                <?php } ?>  

                <span>Origem/Destino: </span>
                <input type="text" name="origem" style="width: 40px;"> -
                <input type="text" name="destino" style="width: 40px;"><br><br>

                <input type="submit">

            </form>
        </div>
    </body>

</html>