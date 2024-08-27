<?php
include('../../config/config.php');
if(isset($_GET['id_paciente'])) {
    $id_paciente = $_GET['id_paciente'];
   $sql = "SELECT * FROM pacientes WHERE cod_paciente = '$id_paciente'";
   $result = $conn->query($sql);
}
?>


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome Paciente:</th>
            <th scope="col">CPF:</th>
            <th scope="col">CNS:</th>
            <th scope="col">CEP:</th>
            <th scope="col">Logradouro:</th>
            <th scope="col">Número:</th>
            <th scope="col">Complemento:</th>
            <th scope="col">Bairro:</th>
            <th scope="col">Cidade:</th>
            <th scope="col">Estado:</th>
        </tr>
    </thead>
    <tbody>
        <?php if($result->num_rows > 0):?>
        <?php while($row = $result->fetch_assoc()):?>
        <td><?php echo htmlspecialchars($row['nome_paciente']); ?></td>
        <td><?php echo htmlspecialchars($row['cpf_paciente']); ?></td>
        <td><?php echo htmlspecialchars($row['cns_paciente']); ?></td>
        <td><?php echo htmlspecialchars($row['cep']); ?></td>
        <td><?php echo htmlspecialchars($row['logradouro']); ?></td>
        <td><?php echo htmlspecialchars($row['numero']); ?></td>
        <td><?php echo htmlspecialchars($row['complemento']); ?></td>
        <td><?php echo htmlspecialchars($row['bairro']); ?></td>
        <td><?php echo htmlspecialchars($row['cidade']); ?></td>
        <td><?php echo htmlspecialchars($row['estado']); ?></td>
        
        <?php endwhile; ?>
        <?php endif ?>

    </tbody>
</table>