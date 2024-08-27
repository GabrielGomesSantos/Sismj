<?php 
require_once('../../config/config.php');

if(isset($_GET['id_processo'])) {
    $id_processo = $_GET['id_processo'];
    $sql = "SELECT * FROM medicamentos_processo WHERE cod_processo = $id_processo";
    
    $result = $conn->query($sql);
   
?>
    <table class="table table-striped">
        <a href="cadastrar_medicamento_processo.php?id_processo=<?php echo $id_processo?> "
            class="btn btn-primary mt-3 mb-3 text-white">Cadastrar Medicamento</a>

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do Medicamento:</th>
                <th scope="col">Tipo de Medicamento:</th>
                <th scope="col">Categoria Medicamento:</th>
                <th scope="col">Laboratorio</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result->num_rows > 0):?>
            <?php while($row = $result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row['cod_medicamento_processo']?></td>
                <td><?php echo $row['nome_medicamento']?></td>
                <td><?php echo $row['tipo_medicamento']?></td>
                <td><?php echo $row['categoria_medicamento']?></td>
                <td><?php echo $row['laboratorio']?></td>
                <td><?php echo $row['quantidade']?></td>
                <td><a href="editar_medicamento_processo.php?id_medicamento_processo=<?php echo $row['cod_medicamento_processo']?>" class="btn btn-warning">Editar</a></td>
            </tr>
            <?php endwhile;?>
            <?php endif?>
        </tbody>
    </table>
<?php 

}


?>