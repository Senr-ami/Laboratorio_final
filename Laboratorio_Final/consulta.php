<!DOCTYPE html>
<html>
    <head>
        <title>Registro de Usuarios</title>
        <link rel="stylesheet" type="text/css" href="estilos_formulario.css">
        <meta charset="UTF-8">
    </head>
    <body>
            <h2 class="h2Consulta">Usuarios registrados</h2>

            <?php
            include("conexion.php");

            $query = "SELECT * FROM usuarios";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table'>";
                echo "<tr><th>ID</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Email</th><th>Login</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Nombre'] . "</td>";
                    echo "<td>" . $row['Apellido1'] . "</td>";
                    echo "<td>" . $row['Apellido2'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['Login'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p class='error'>No se encontraron usuarios registrados.</p>";
            }

            mysqli_close($conn);
            ?>
    </body>
</html>
