<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Realizado</title>
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
                    <a class="nav-link text-white" href="cvlum_login.html">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Cadastro realizado com sucesso!</h2>
                <p>Seu cadastro foi concluído. Você pode agora fazer <a href="cvlum_login.html">login</a>.</p>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 mt-5 bg-dark text-white">
        <img src="cvlum_logo.png" alt="Logo CVLUM" width="50">
        <p>Powered By &copy;CVLUM.</p>
    </footer>

    <?php
        include 'conexao.php';
        $email = $_POST['email'];
        $hash    = password_hash( $_POST['senha'], PASSWORD_DEFAULT);

        $stmt = $conexao->prepare("INSERT INTO usuarios (email, senha_hash) values (?, ?)");
        $stmt->bind_param("ss", $email, $hash);
        $stmt->execute();

        header('Location: login.html');
        exit;

    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>