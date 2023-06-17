<?php
    include("conexion.php");

    $nombre = $apellido1 = $apellido2 = $email = $login = $password = "";
    $nombreErr = $apellido1Err = $apellido2Err = $emailErr = $loginErr = $passwordErr = "";
    $successMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = test_input($_POST["nombre"]);
        $apellido1 = test_input($_POST["apellido1"]);
        $apellido2 = test_input($_POST["apellido2"]);
        $email = test_input($_POST["email"]);
        $login = test_input($_POST["login"]);
        $password = test_input($_POST["password"]);

        // Validación de los campos
        if (empty($nombre)) {
            $nombreErr = "* Por favor, ingrese un nombre válido.";
        }

        if (empty($apellido1)) {
            $apellido1Err = "* Por favor, ingrese un primer apellido válido.";
        }

        if (empty($apellido2)) {
            $apellido2Err = "* Por favor, ingrese un segundo apellido válido.";
        }

        if (empty($email)) {
            $emailErr = "* Por favor, ingrese un email válido.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "* Por favor, ingrese un formato de email válido.";
        }

        if (empty($login)) {
            $loginErr = "* Por favor, ingrese un nombre de usuario válido.";
        }

        if (empty($password)) {
            $passwordErr = "* Por favor, ingrese una contraseña válida.";
        } elseif (strlen($password) < 4 || strlen($password) > 8) {
            $passwordErr = "* La contraseña debe tener entre 4 y 8 caracteres.";
        }

        // Para insertar los datos en la base de datos
        if (empty($nombreErr) && empty($apellido1Err) && empty($emailErr) && empty($loginErr) && empty($passwordErr)) {
            // Verificar si el correo electrónico ya está en uso
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $emailErr = "Este correo electrónico ya está registrado.";
            } else {
                // Insertar los datos en la base de datos
                $query = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, login, password) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password')";
                if (mysqli_query($conn, $query)) {
                    $successMessage = "¡Registro completado con éxito!";
                    $nombre = $apellido1 = $apellido2 = $email = $login = $password = ""; // Limpiar los campos después del registro exitoso
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    }

    // Limpiar y validar los datos
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registro de Usuarios</title>
        <link rel="stylesheet" type="text/css" href="estilos_formulario.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="divForm">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form">
                <h2>Registro</h2>

                <div class="inputContainer">
                    <input type="text" name="nombre" class="input" value="<?php echo $nombre; ?>" placeholder="a" maxlength="20" required>
                    <label for="" class="label">Nombre:</label>
                </div>

                <div class="inputContainer">
                    <input type="text" name="apellido1" class="input" value="<?php echo $apellido1; ?>" placeholder="a" maxlength="20" required>
                    <label for="" class="label">Primer apellido:</label>
                </div>

                <div class="inputContainer">
                    <input type="text" name="apellido2" class="input" value="<?php echo $apellido2; ?>" placeholder="a" maxlength="20" required>
                    <label for="" class="label">Segundo apellido:</label>
                </div>

                <div class="inputContainer">
                    <input type="text" name="email" class="input" value="<?php echo $email; ?>" placeholder="a" maxlength="50" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                    <label for="" class="label">Email:</label>
                </div>

                <div class="inputContainer">
                    <input type="text" name="login" class="input" value="<?php echo $login; ?>" placeholder="a" maxlength="15" required>
                    <label for="" class="label">Nombre de usuario:</label>
                </div>

                <div class="inputContainer">
                    <input type="password" name="password" class="input" value="" placeholder="a" minlength="4" maxlength="8" required>
                    <label for="" class="label">Contraseña:</label>
                </div>

                <input type="submit" name="submit" class="submitButton" value="Registrarse">
                
                <div class="errorContainer">
                    <span class="error"><?php echo $nombreErr; ?></span><br>
                    <span class="error"><?php echo $apellido1Err; ?></span><br>
                    <span class="error"><?php echo $apellido2Err; ?></span><br>
                    <span class="error"><?php echo $emailErr; ?></span><br>
                    <span class="error"><?php echo $loginErr; ?></span><br>
                    <span class="error"><?php echo $passwordErr; ?></span>
                </div>

                <?php if (!empty($successMessage)) { ?>
                    <p class="exito"><?php echo $successMessage; ?></p>
                    <div class="botonConsultaContainer">
                        <a href="consulta.php" class="botonConsulta">Consulta</a>
                </div>
                <?php } ?>
            </form>
        </div>
    </body>
</html>
