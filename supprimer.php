<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Suppression</title>
</head>
<body>
<nav class='navbar navbar-expand-lg navbar-dark bg-success'>
    <div class='container'>
        <a class="navbar-brand fw-bold" href="">Suppression</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNav'>
            <ul class='navbar-nav ml-auto container justify-content-end'>
                <li class='nav-item active'>
                    <a href="admin.html"><button class='btn btn-dark rounded-pill' type='submit'>Accueil</button></a>
                </li>
                <li class='nav-item active'>
                    <a href="listecompte.php"><button class='btn btn-dark rounded-pill' type='submit'>Liste des clients</button></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><strong>Suppression</strong></h3>
                </div>
                <div class="card-body">
                   <form method="POST" action="">
                          <div class="form-group">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">Prenom</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="text" placeholder="Prenom" name="prenom" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">Nom</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="text" placeholder="Nom" name="nom" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <input class="btn btn-success fw-bold" type="submit" name="submit" value="Valider">
                            <input class="btn btn-danger fw-bold" type="reset" name="submit" value="Annuler">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];

    $check_query = "SELECT * FROM banque WHERE prenom = '$prenom' AND nom = '$nom'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $delete_query = "DELETE FROM banque WHERE prenom = '$prenom' AND nom = '$nom'";
        $delete_result = $conn->query($delete_query);

        if ($delete_result === TRUE) {
            echo "<div style='text-align: center; margin-top: 50px;'>Compte supprimé avec succès.</div>";
        } else {
            echo "<div style='text-align: center; margin-top: 50px;'>Erreur lors de la suppression du compte.</div>";
        }
    } else {
        echo "<div style='text-align: center; margin-top: 50px;'>Compte inexistant avec le prénom $prenom et le nom $nom.</div>";
    }
}
?>

</body>
</html>
