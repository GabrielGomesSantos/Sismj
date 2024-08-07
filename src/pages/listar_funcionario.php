<?php
    require_once('C:/xampp/htdocs/Sismj/config/config.php');
    $perfil = '';
    $sql = "SELECT * FROM funcionarios";
    $result = $conn->query($sql);
?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Required meta tags -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->

    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Style -->

    <!-- Fonte Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonte Awesome -->
    
    <!-- Titulo Lembrar de mudar! -->
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Remover Funcionario</title>
</head>

<?php include('navbar.php')?>

<body>
<a href="cadastrar_funcionario.php" class="btn btn-primary mt-5 mb-5 text-white">Cadastrar Funcionario</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID:</th>
      <th scope="col">Nome:</th>
      <th scope="col">CPF:</th>
      <th scope="col">Matricula:</th>
      <th scope="col">Email:</th>
      <th scope="col">Senha:</th>
      <th scope="col">Perfil:</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php if($result->num_rows > 0):?>
    <?php while($row = $result->fetch_assoc()):?>
    <tr>
      <th scope="row"><?php echo $row['cod_funcionario'] ?></th>
      <td><?php echo $row['nome_funcionario'] ?></td>
      <td><?php echo $row['cpf_funcionario'] ?></td>
      <td><?php echo $row['matricula'] ?></td>
      <td><?php echo $row['email_funcionario'] ?></td>
      <td><?php echo $row['senha'] ?></td>
      <?php
      switch ($row['perfil']) {
        case 1:
            $perfil = "Gestor";
            break;
        case 2:
            $perfil = "Atendente";
            break;
        default:
            echo "Perfil desconhecido!";
            break;
    }
    
      ?>
      <td><?php echo $perfil ?></td>
      <td><a href="remover_funcionario.php?id_funcionario=<?php echo $row['cod_funcionario']?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
      <td><a href="editar_funcionario.php?id_funcionario=<?php echo $row['cod_funcionario']?>" class="btn btn-warning"><i class="bi bi-pencil text-white"></i></a></td>
    </tr>
    <?php endwhile;?>
    <?php endif?>
  </tbody>
</table>


    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <?php include('footer.php')?>
</body>


</html>