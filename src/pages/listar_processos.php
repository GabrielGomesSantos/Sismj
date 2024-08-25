<?php
require_once('../../config/config.php');

$id_funcionario = $_SESSION['ID'];


$items_per_page = 6;

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;


$sql = "SELECT * FROM `processos`";
$result = $conn->query($sql);

if ($result === FALSE) {
  echo "Erro em o buscar os dados " . $conn->error;
}
?>
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

