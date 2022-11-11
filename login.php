<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edusogno</title>
        <link rel="stylesheet" href="assets/styles/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">     
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <script src="assets/js/script.js" defer></script> 
    </head>
    <body>
        <?php 
            require_once ('inserimento.php');//DATABASE CONNECTION DATA

            $email = $connessione->real_escape_string ($_POST['email']);
            $password = $connessione->real_escape_string ($_POST['password']);

            if($_SERVER ["REQUEST_METHOD"] === "POST"){

                $sql_select = "SELECT * FROM utenti WHERE email = '$email'";
                if($result = $connessione->query($sql_select)){
                    if($result->num_rows == 1){
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        if(password_verify($password,$row['password'])){
                            session_start();

                            $_SESSION['loggato'] = true;
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['nome'] = $row['nome'];
                            $_SESSION['email'] = $row['email'];

                            header("location: private.php");
                        }else{
                            echo '<div class="register">';
                            echo '<p style="background-color:#FFCCCB; padding:10px">La password inserita non è corretta.</p>';
                            echo '</div>';
                            header('Refresh: 3; URL=index.php');
                        }
                    }else{
                        echo '<div class="register">';
                        echo '<p style="background-color:#FFCCCB; padding:10px">L\'email inserita non risulta registrata.</p>';
                        echo '</div>';
                        header('Refresh: 3; URL=index.php');
                    }
                }else{
                    echo '<div class="register">';
                    echo '<p style="background-color:#FFCCCB; padding:10px">Errore in fase di Log-in, riprovare più tardi o contattare l\'amministratore.</p>';
                    echo '<a href="logout.php">Torna alla pagina di Login.</a>';
                    echo '</div>';
                }

                $connessione->close();
            };
          
        ?>
    </body>
</html>
