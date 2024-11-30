<?php
include 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = $conexao->prepare("SELECT senha_hash FROM usuarios WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();

$resultado = $query->get_result();
if ($resultado->num_rows > 0) {
    $linha = $resultado->fetch_assoc();
    if (password_verify($senha, $linha['senha_hash'])) {
        header('Location: pag_inicial.html');
        exit;
    } else {
        echo "E-mail ou senha incorretos!";
    }
} else {
    echo "E-mail ou senha incorretos!";
}

$query->close();
$conexao->close();

?>
<a href="login.html" class="btn btn-primary mt-4"> Voltar para a tela de login e tentar novamente.</a>