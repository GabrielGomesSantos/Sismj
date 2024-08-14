<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
   
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Link para o CSS do dashboard -->
    <link rel="stylesheet" type="text/css" href="CSSDashboard.css">
</head>
<body>
    <?php
        // INCLUINDO CONFIGURAÇÃO DO BANCO DE DADOS
        include("../config.php");
       
        //Verifica se algo foi pesquisado
        if (isset($_GET['search'])){
            $search = $_GET['search'];
            $sql = "SELECT * FROM medicamentos WHERE nome_medicamento LIKE '$search%'";
        } else {
            $sql = "SELECT * FROM medicamentos";
        }
       
        $result = mysqli_query($conn, $sql);

        //Se a consulta gerar resultado irá armazenar tudo na variável "saida"
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
        }
    ?>
    

        <div class="d-flex align-items-center">
      <!-- Mensagem de Bem-Vindo personalizada com nome inserido no cadastro -->
            <p class="mb-0 me-3">Bem-Vindo Natan</p>
            <img src="profile-removebg-preview.png" alt="" width="30" height="30">
          </div>
        </div>
    </nav>

    </header>
    <br>
    <div class="card">
        <a href="adicionar.php" class="btn btn-primary">Adicionar Produto</a>
        <br><br>
        <a href="reset.php" class="btn btn-danger">Apagar Tabela</a>
    </div>
    <br>
    <form action="" method="get" class="d-flex">
        <input name="search" type="text" class="form-control me-2" placeholder="Buscar medicamento">
        <input type="submit" value="Search" class="btn btn-outline-success">
    </form>
    <br>
    <div class="table-container">
    <table class="table table-secondary table-bordered">
        <thead>
            <tr>
                <th scope="col">Código de Medicamento</th>
                <th scope="col">Código de Compra</th>
                <th scope="col">Nome do Medicamento</th>
                <th scope="col">Tipo de Medicamento</th>
                <th scope="col">Categoria</th>
                <th scope="col">Laboratório</th>
                <th scope="col">Lote</th>
                <th scope="col">Validade</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($saida)) { ?>
                <?php foreach ($saida as $medicamento) { ?>
                    <tr>
                        <th scope="row"><?php echo $medicamento['cod_medicamento'] ?></th>
                        <td><?php echo $medicamento['cod_compra'] ?></td>
                        <td><?php echo $medicamento['nome_medicamento'] ?></td>
                        <td><?php echo $medicamento['tipo_medicamento'] ?></td>
                        <td><?php echo $medicamento['categoria']?></td>
                        <td><?php echo $medicamento['laboratorio']?></td>
                        <td><?php echo $medicamento['lote']?></td>
                        <td><?php echo $medicamento['validade']?></td>
                        <td><?php echo $medicamento['quantidade']?></td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="../sisman_db.php?id_delete=<?php echo $medicamento['cod_medicamento']?>">Remover</a>
                            <a class="btn btn-warning btn-sm" href="editar.php?id=<?php echo $medicamento['cod_medicamento']?>">Editar</a>
                        </td>
                    </tr>
                <?php } ?>    
            <?php } else {  ?>
                <div class="alert alert-warning" role="alert">
                    A tabela está sem medicamentos 😪 <br>Se tiver, adicione medicamento.
                </div>
            <?php } mysqli_close($conn); ?>
        </tbody>
    </table>
</div>

   
    <!-- Bootstrap JS (opção com Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>