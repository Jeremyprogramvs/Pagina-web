<?php

        session_start();

        include 'conexion_db.php';

        $login_usuario = $_POST['login_usuario'];
        $login_contraseña = $_POST['login_contraseña'];

        $validar_login = mysqli_query($conexion, "SELECT * FROM login WHERE login_usuario =
         '$login_usuario' AND login_contraseña ='$login_contraseña'");

        if(mysqli_num_rows($validar_login) > 0){
            $_SESSION['usuario'] = $usuario;
            header("location: ../agroservicio.html");
            exit;
        }else{
            echo '
            <script>
            alert("Usuario no esxiste, inserte un usuario existente");
            window.location = "../logi.html";
            </script>
            ';
            exit;
        }



?>
