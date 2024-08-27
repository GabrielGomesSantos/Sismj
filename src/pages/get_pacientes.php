<?php
include('../../config/config.php');
if(isset($_GET['id_paciente'])) {
    $id_paciente = $_GET['id_paciente'];
   $sql = "SELECT * FROM pacientes WHERE cod_paciente = '$id_paciente'";
   $result = $conn->query($sql);
}
?>

        <?php if($result->num_rows > 0):?>
        <?php while($row = $result->fetch_assoc()):?>
        <div class="mb-3">
            <label class="form-label">Nome:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['nome_paciente']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">CPF:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['cpf_paciente']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">CNS:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['cns_paciente']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Logradouro:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['logradouro']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Número:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['numero']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Complemento:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['complemento']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Bairro:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['bairro']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Cidade:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['cidade']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">CEP:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['cep']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Estado:</label><br>
            <input placeholder="<?php echo htmlspecialchars($row['estado']); ?>" disabled>
        </div>

        <?php endwhile; ?>
        <?php endif ?>

