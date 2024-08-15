<?php
    require_once('../../config/config.php');;
    $perfil = '';
    $sql = "SELECT * FROM medicos";
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
    <title>Remover medico</title>
</head>

<?php include('navbar.php')?>

<body>
<a href="cadastrar_medico.php" class="btn btn-primary mt-5 mb-5 text-white">Cadastrar medico</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID:</th>
      <th scope="col">Nome:</th>
      <th scope="col">CPF:</th>
      <th scope="col">CRM:</th>
      <th scope="col">Especialidade:</th>
      <th scope="col">Celular:</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php if($result->num_rows > 0):?>
    <?php while($row = $result->fetch_assoc()):?>
    <tr>
      <th scope="row"><?php echo $row['cod_medico'] ?></th>
      <td><?php echo $row['nome_medico'] ?></td>
      <td><?php echo $row['cpf_medico'] ?></td>
      <td><?php echo $row['crm'] ?></td>
      <td><?php echo $row['especialidade'] ?></td>
      <td><?php echo $row['celular'] ?></td>
      <td><a href="remover_medico.php?id_medico=<?php echo $row['cod_medico']?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
      <td><a href="editar_medico.php?id_medico=<?php echo $row['cod_medico']?>" class="btn btn-warning"><i class="bi bi-pencil text-white"></i></a></td>
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