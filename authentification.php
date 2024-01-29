<?php
$servername = "localhost";
$username = "ghost";
$password = "passer";
$dbname = "python_api";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numcompte = $_POST["numcompte"];
    $code = $_POST["code"];

    $query = "SELECT * FROM banque WHERE numcompte = '$numcompte' AND code = '$code'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($numcompte == 1000 && $code == 2407) {
            header("Location: admin.html");
            exit();
        } else {
            header("Location: client.html");
            exit();
        }
    } else {
        echo "Identifiants incorrects, Veuillez <a href='auth.html'>réessayer</a></p>"; 
        echo "<p></p>"; 
        echo "<p>Si vous n'avez pas encore de compte, <a href='creation_client.php'>Créer un compte</a></p>"; 
    }
   
}
?>
