<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Transfert</title>
</head>
<body>
<nav class='navbar navbar-expand-lg navbar-dark bg-success'>
    <div class='container'>
        <a class="navbar-brand fw-bold" href="">Transfert</a>
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
                    <h3 class="text-center"><strong>Transfert</strong></h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">Numcompte source</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="text" placeholder="Numcompte Source" name="numcompte_source" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">Numcompte destination</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="text" placeholder="Numcompte Destination" name="numcompte_destination" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">Somme</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="text" placeholder="Somme" name="somme" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">code</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="password" placeholder="Code" name="code" required>
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
    $numcompte_source = $_POST["numcompte_source"];
    $numcompte_destination = $_POST["numcompte_destination"];
    $somme = $_POST["somme"];
    $code = $_POST["code"];

    $check_source_query = "SELECT * FROM banque WHERE numcompte = '$numcompte_source' AND code = '$code'";
    $check_destination_query = "SELECT * FROM banque WHERE numcompte = '$numcompte_destination'";

    $check_source_result = $conn->query($check_source_query);
    $check_destination_result = $conn->query($check_destination_query);

    if ($check_source_result->num_rows > 0 && $check_destination_result->num_rows > 0) {
        $update_source_query = "UPDATE banque SET solde = solde - $somme WHERE numcompte = '$numcompte_source'";
        $update_destination_query = "UPDATE banque SET solde = solde + $somme WHERE numcompte = '$numcompte_destination'";

        $update_source_result = $conn->query($update_source_query);
        $update_destination_result = $conn->query($update_destination_query);

        if ($update_source_result === TRUE && $update_destination_result === TRUE) {
            echo "<div style='text-align: center; margin-top: 20px;'>Transfert effectué avec succès.</div>";
        } else {
            echo "<div style='text-align: center; margin-top: 20px;'>Erreur lors de la mise à jour des soldes.</div>";
        }
    } else {
        echo "<div style='text-align: center; margin-top: 20px;'>Numéro de compte source, destination inexistant ou code incorrect.</div>";
    }
}
?>

</body>
</html>
