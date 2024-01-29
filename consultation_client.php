<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Consultation</title>
</head>
<body>
<nav class='navbar navbar-expand-lg navbar-dark bg-success'>
    <div class='container'>
        <a class="navbar-brand fw-bold" href="">Consultation du solde</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNav'>
            <ul class='navbar-nav ml-auto container justify-content-end'>
                <li class='nav-item active'>
                    <a href="client.html"><button class='btn btn-dark rounded-pill' type='submit'>Accueil</button></a>
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
                    <h3 class="text-center"><strong>Consultation</strong></h3>
                </div>
                <div class="card-body">
                   <form method="POST" action="">
                          <div class="form-group">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">Numcompte</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="text" placeholder="Numcompte" name="numcompte" required>
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
    $numcompte = $_POST["numcompte"];
    $code = $_POST["code"];

    $query = "SELECT solde FROM banque WHERE numcompte = '$numcompte' AND code = '$code'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $solde = $row['solde'];
        echo "<div style='text-align: center; margin-top: 50px;'><h1>Votre solde est : $solde</h1></div>";
    } else {
        echo "<div style='text-align: center; margin-top: 50px;'>Identifiants incorrects. Veuillez réessayer.</div>";
    }
}
?>

</body>
</html>
