<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - CVLUM</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark text-white">
        <a class="navbar-brand text-white">
        <img src="hayata_logo_alt.png" width="30" height="30" class="d-inline-block align-top" alt="logo hayata">
            HAYATA RH
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="buscar.html">Pesquisar Currículo</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
    <img class="rounded mx-auto d-block" src="cvlum_logo.png" alt="CVLUM LOGO">
        <?php
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $area = $_POST['area'];
        $descricao = $_POST['descricao'];
        $curriculo = $_FILES['curriculo'];
        $nome_arquivo = null;
        $caminho_arquivo = null;

        if ($curriculo && $curriculo['error'] == 0) {
            preg_match("/\.(pdf){1}$/i", $curriculo["name"], $ext);
            
            if (!empty($ext)) {
                $nome_arquivo = md5(uniqid(time())) . "." . $ext[1];
                $caminho_arquivo = "documentos/" . $nome_arquivo;

                if (!move_uploaded_file($curriculo["tmp_name"], $caminho_arquivo)) {
                    die("Erro ao salvar o arquivo.");
                }
            } else {
                die("Formato de arquivo não permitido.");
            }
        }

        include 'conexao.php';

        $stmt = $conexao->prepare("INSERT INTO curriculos (nome, email, telefone, area, descricao, cv_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $nome, $email, $telefone, $area, $descricao, $caminho_arquivo);

        if ($stmt->execute()) {
            echo "<h5 class='card-title text-center'>Currículo Enviado!</h5>";
        } else {
            echo "<h5 class='card-title text-center'>Erro ao enviar currículo :c </h5>" . $stmt->error;
        }

        $stmt->close();
        $conexao->close();
        ?>
        
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
            <a href="envio.html" class="btn btn-primary mt-4">Voltar para a tela de envio</a>
        </div>
    </div>

<footer class="text-center py-4 mt-5 bg-dark text-white">
    <img src="cvlum_logo.png" alt="Logo CVLUM" width="50">
    <p>Powered By &copy;CVLUM.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>