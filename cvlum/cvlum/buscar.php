<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Currículos - CVLUM</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark text-white">
        <a class="navbar-brand text-white" href="pag_inicial.html">
        <img src="hayata_logo_alt.png" width="30" height="30" class="d-inline-block align-top" alt="logo hayata">
            HAYATA RH
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="envio.html">Enviar Currículo</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h2 class="mb-4">Resultados da Pesquisa</h2>
        <?php
        include 'conexao.php';

        $palavraChave = $_POST['palavraChave'];

        $sql = "SELECT nome, area, descricao, cv_url FROM curriculos WHERE nome LIKE ? OR area LIKE ? OR descricao LIKE ?";
        $stmt = $conexao->prepare($sql);
        $palavraChave = "%".$palavraChave."%";
        $stmt->bind_param("sss", $palavraChave, $palavraChave, $palavraChave);
        $stmt->execute();

        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            while($linha = $resultado->fetch_assoc()) {
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $linha['nome'] . "</h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>Área de Atuação: " . $linha['area'] . "</h6>";
                echo "<p class='card-text'>" . $linha['descricao'] . "</p>";
                echo "<a href='" . $linha['cv_url'] . "' class='card-link' download>Download do Currículo</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum currículo encontrado para a palavra-chave.</p>";
        }

        $stmt->close();
        $conexao->close();
        ?>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2 text-left">
            <a href="buscar.html" class="btn btn-primary mt-4">Voltar para tela busca</a>
        </div>
    </div>
    <footer class="text-center py-5 mt-5 bg-dark text-white">
    <img src="cvlum_logo.png" alt="Logo CVLUM" width="50">
    <p>Powered By &copy;CVLUM.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
