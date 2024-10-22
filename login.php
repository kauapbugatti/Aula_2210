<?php
include "banco.php";

$pdo = Banco::conectar();

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

$validarLogin = $pdo->prepare("SELECT * FROM tb_alunos WHERE email = :email");
$validarLogin->bindParam(':email', $email);
$validarLogin->execute();

if ($validarLogin->rowCount() == 1) {
    $usuario = $validarLogin->fetch(PDO::FETCH_ASSOC);
    
    if (password_verify($senha, $usuario['senha'])) {
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Senha incorreta');</script>";
    }
} else {
    echo "<script>alert('Usuário não encontrado');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/estilo.css">
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="../aula_Php/assets/img/login.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post" action="login.php">
                        <div class="divider d-flex align-items-center my-4">
                            <p class="font-weight-bold">LOGIN</p>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" name="email" required />
                            <label class="form-label" for="form3Example3">Email address</label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" name="senha" required />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">Remember me</label>
                            </div>
                            <a href="#" class="text-body">Forgot password?</a>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <input type="submit" class="btn btn-primary btn-lg" value="Login" style="padding-left: 2.5rem; padding-right: 2.5rem;">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#" class="link-danger">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 bg-primary">
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
        </div>
    </div>
</body>
</html>
