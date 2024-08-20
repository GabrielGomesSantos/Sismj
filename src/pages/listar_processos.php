<?php
require_once('../../config/config.php');

// $id_funcionario = $_SESSION['ID'];


$items_per_page = 6;

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;


$sql = "SELECT * FROM `processos`";
$result = $conn->query($sql);

if ($result === FALSE) {
  echo "Erro em o buscar os dados " . $conn->error;
}
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
  <!-- <link rel="stylesheet" href="../../assets/css/bootstrap.min.css"> -->
  <!-- Bootstrap CSS -->

  <!-- Style -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <!-- Style -->

  <!-- Fonte Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Fonte Awesome -->

  <!-- Titulo Lembrar de mudar! -->
  <link rel="shortcut icon" href="../../assets/images/favico.ico">
  <title>Remover Funcionario</title>
</head>


<body>
<?php include('sidebar.html')?>
  <div class="container d-flex align-items-center">
    <div class="row">
      <div class="col">
        <a href="cadastrar_processo.php" class='btn btn-success m-3'>Cadastrar Processo</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Número do Processo:</th>
              <th scope="col">Cópia do Processo:</th>
              <th scope="col">Receita:</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result->num_rows > 0): ?>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <th scope="row"><?php echo $row['cod_processo'] ?></th>
                  <td><?php echo $row['numero_processo'] ?></td>
                  <td><?php echo $row['copia_processo'] ?></td>
                  <td><?php echo $row['receita'] ?></td>
                  <td>
                    <a href="listar_medicamentos_processos.php?id_processo=<?php echo $row['cod_processo']?>" class='btn btn-success'>Medicamentos</a>
                  </td>
                  <td><a href="remover_processo.php?id_processo=<?php echo $row['cod_processo'] ?>" class="btn btn-danger"><i
                        class="bi bi-trash-fill"> Excluir</i></a></td>
                  <td><a href="editar_processo.php?id_processo=<?php echo $row['cod_processo'] ?>" class="btn btn-warning"><i
                        class="bi bi-pencil text-white"> Editar</i></a></td>
                </tr>
              <?php endwhile; ?>
            <?php endif ?>
      
          </tbody>
        </table>

      </div>
    </div>
  </div>
  


  <script src="../../assets/js/jquery-3.3.1.min.js"></script>
  <script src="../../assets/js/popper.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
  <script src="../../assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>


</body>


</html>