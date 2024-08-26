<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <!--link para o css do dashboard-->
    <link rel="stylesheet" type="text/css" href="CSSDashboard.css">
</head>
<body>
    <?php
        // INCLUINDO CONFIGURAÇÃO DO BANCO DE DADOS
        include("../config/config.php");
        
        //Verifica se algo foi pesquisado
        if (isset($_GET['search'])){
            $search = $_GET['search'];
            $sql = "SELECT * FROM medicamentos WHERE nome_medicamento  LIKE '$search%'";
        }else{
            $sql = "SELECT * FROM medicamentos";
        }
        
        $result = mysqli_query($conn, $sql);

        //Se a consulta gerar resultado irá armazenar tudo na variável "saida"
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
        }
    ?>
    <header class="header">
        <!--Navbar com a logo e dois links para a página "sobre" e "contato"-->
        <nav class="nav">
            <img src="Captura_de_tela_2024-03-25_164301-removebg-preview.png" alt="">
            <ul class="nav-list">
                <li><a href="">Sobre</a></li>
                <li><a href="">Contato</a></li>
            </ul>
            <div>
                <!--Mensagem de Bem-Vindo personalizada com nome inserido no cadastro-->
                <p>Bem-Vindo Natan</p>
            </div>
            <img src="profile-removebg-preview.png" alt="">
        </nav>
    </header>
    <br>
    <div class="card">
        <a href="adicionar.php" class="botao">Adicionar Produto</a>
        <br> <br>
        <a href="reset.php" class="botao">Apagar Tabela</a>
    </div>
    <br>
    <form action="" method="get">
        <input name="search" type="text">
        <input  type="submit" value="search">
    </form>
    <br>
    <div class="table-container">
        <table border="1">
            <tbody>
                <!--Se a variável "saida" estiver vazia ele não irá tentar imprimir a tabela, caso contrário,
                a tabela aparecerá normalmente-->
                <?php if (!empty($saida)) { ?>
                    <tr>
                        <th>Código de Medicamento:</th>
                        <th>Código de Compra:</th>
                        <th>Nome do Medicamento:</th>
                        <th>Tipo de Medicamento:</th>
                        <th>Categoria:</th>
                        <th>Laboratorio:</th>
                        <th>Lote:</th>
                        <th>Validade:</th>
                        <th>Quantidade:</th>
                        <th>Ações:</th>
                    </tr>
                    <!--Itera sobre todos os elementos da variável "saida" para imprimi-la corretamente-->
                    <?php foreach ($saida as $medicamento) { ?>
                        <tr>
                            <td><?php echo $medicamento['cod_medicamento'] ?></td>
                            <td><?php echo $medicamento['cod_compra'] ?></td>
                            <td><?php echo $medicamento['nome_medicamento'] ?></td>
                            <td><?php echo $medicamento['tipo_medicamento'] ?></td>
                            <td><?php echo $medicamento['categoria']?></td>
                            <td><?php echo $medicamento['laboratorio']?></td>
                            <td><?php echo $medicamento['lote']?></td>
                            <td><?php echo $medicamento['validade']?></td>
                            <td><?php echo $medicamento['quantidade']?></td>
                            <!--Links para editar ou remover um elemento da tabela com base no ID-->
                            <td><a class="corDelete" href="../sisman_db.php?id_delete=<?php echo $medicamento['cod_medicamento']?>">Remover</a>/<a class="editarColor" href="editar.php?id=<?php echo $medicamento['cod_medicamento']?>">Editar</a></td>
                        </tr>
                    <?php } ?>     
                <?php }
                else {  ?> 
                    <!--Como dito anteriormente, se a tabela estiver vazia não irá imprimi-la, por conseguinte
                    aparecerá uma imagem e uma mensagem informando que a tabela está vazia-->
                    <div class="cardVazia">
                        <p>A tabela está sem medicamentos😪 <br>Se tiver adicione medicamento</p>
                    </div>
                <?php } mysqli_close($conn); ?>
            </tbody>
        </table>
    </div>
    <!--Destroi o conteúdo da variável $_POST para evitar problemas com ordenação-->
</body>
</html>