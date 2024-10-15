<?php
$server = "localhost";
$userDb = "root";
$passDb = "12345";
$nameDb = "petshop";
$port = 3306;

$connect = mysqli_connect($server, $userDb, $passDb, $nameDb, $port);

if (!$connect) {
    die("Falha na conexão: " . mysqli_connect_error());
}

function login($connect)
{
    if (isset($_POST['signin'])) {
        $check_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if ($check_email === false) {
            echo '<label style="color: red; font-size: 2rem;">E-mail inválido!</label>';
            return;
        }
        $email = mysqli_real_escape_string($connect, $check_email);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        if (!empty($email) && !empty($password)) {
            $query = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
            $executar = mysqli_query($connect, $query);

            if (!$executar) {
                // Erro ao executar a consulta
                echo '<label style="color: red; font-size: 2rem;">Erro ao executar a consulta: ' . mysqli_error($connect) . '</label>';
                return;
            }

            $verifica = mysqli_num_rows($executar);
            $usuario = mysqli_fetch_assoc($executar);

            if ($verifica > 0) {

                // Inicia uma sessão (login)
                session_start();
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['name'] = $usuario['name'];
                $_SESSION['password'] = $usuario['password'];
                $_SESSION['ativa'] = true;
                header("location: shop.php"); // Redireciona para a página de administração
                exit;
            } else {
                echo '<label style="color: red; font-size: 2rem;">E-mail ou senha não encontrados!</label>';
            }
        } else {
            echo '<label style="color: red; font-size: 2rem;">E-mail ou senha incorretos!</label>';
        }
    }
}

function logout()
{
	session_start();
	session_unset();
	session_destroy();
	header("location: index.html"); // Redireciona para a página inicial
}

function sign_up($connect)
{
	if (isset($_POST['signup']) and !empty($_POST['email']) and !empty($_POST['password'])) {
		$erros = array();
		$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		$nome = mysqli_real_escape_string($connect, $_POST['name']);
		$senha = ($_POST['password']);


		$queryEmail = "SELECT email FROM usuarios WHERE email = '$email' ";
		$buscaEmail = mysqli_query($connect, $queryEmail);
		$verifica = mysqli_num_rows($buscaEmail); # traz número de linhas
		if (!empty($verifica)) {
			$erros[] = "E-mail já cadastrado!";
		}

    if (strlen($senha) < 8) {
        $erros[] = "Tamanho da senha deve ser de no mínimo 8 caracteres";
    }
			
		

		if (empty($erros)) {
			$query = "INSERT INTO usuarios (name,email,password) 
			values ('$nome','$email','$senha')";
            $result = mysqli_query($connect, $query);
			echo "<script>
                    alert('cadastrado realizado com sucesso.');
                    window.location.href = 'login.php';
                </script>";
		} else {
			foreach ($erros as $erro) {
				echo "<p>$erro</p>";
			}
		}
	}
}


