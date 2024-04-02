<?php

$dbservername = 'localhost';
$dbusername = 'root';
$dbpassword = '';

$con = new mysqli($dbservername, $dbusername, $dbpassword, "dblibrary") or die("Impossible de se connecter");

if ($con->connect_error) {
    die('Erreur : ' . $con->connect_error);
}
// echo 'Connexion réussie';

if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    print_r($_POST);

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $verif = mysqli_query($con, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($verif) != 0) {
        echo "<div class='msg'><p class='msgp'>E-mail non correct</p></div> <br>";
    }

    if($email == "" || $username == "" || $password == ""){
        echo "<div class='msg'><p class='msgp'>Des champs obligatoires n'ont pas été remplis !</p></div> <br>";
    }

    else {
        mysqli_query($con, "INSERT INTO users(email, username, phone, password) VALUES('$email', '$username', '$phone', '$hash')") or die("Une erreur est survenue");
        header("Location:./compte_cree.php");
    }

}

$con->close();

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style2.css">
        <title>Document</title>
    </head>

    <body id="singup">

    <div class="first">
        <div class="nav">
            <a href="../index.php">Acceuil</a>
            <a href="#">login</a>
        </div>
    </div>

        <div class="main_form">
            <div class="container">
                <form class="formulaire" method="post">
                    <label for="" class="labelUp">E-mail :</label>
                    <input type="email" name="email" placeholder="exemple@gmail.com">

                    <label for="" class="labelUp">Username :</label>
                    <input type="text" name="username" placeholder="azerty78">

                    <label for="" class="labelUp">Phone (facultatif) :</label>

                    <input type="text" name="phone" placeholder="0* ** ** ** **">

                    <label for="" class="labelUp">Password :</label>
                    <input type="password" name="password" placeholder="complex passord">

                    <button value="submit" type="submit" name="submit">
                        <span>submit</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="singinBtn">
            <a href="singin.php">
                <button class="Btn" href="singin.php">
                    <span>Sing in</span>
                </button>
            </a>
        </div>

    </body>
</html>

