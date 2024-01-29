<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Creation de compte bancaire</title>
</head>

<body>
    <nav class='navbar navbar-expand-lg navbar-dark bg-success'>
        <div class='container'>
            <a class="navbar-brand fw-bold" href="">Creation de compte</a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav ml-auto container justify-content-end'>
                    <li class='nav-item active'>
                        <a href="admin.html"><button class='btn btn-dark rounded-pill' type='submit'>Accueil</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto" style="margin-top: 50px;">
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
    $code = $_POST["code"];
    $numcompte = $_POST["numcompte"];
    $solde = $_POST["solde"];

    $check_query = "SELECT * FROM banque WHERE numcompte = '$numcompte'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo '<h3 class="text-danger">Le numéro de compte existe déjà. Veuillez choisir un autre numéro de compte.</h3>';
    } else {
        
        $insert_query = "INSERT INTO banque (prenom, nom, code, numcompte, solde) VALUES ('$prenom', '$nom', '$code', '$numcompte', '$solde')";
        $insert_result = $conn->query($insert_query);

        if ($insert_result === TRUE) {
            echo '<h3 class="text-success">Création de compte réussie.</h3>';
            echo '<p>Redirection vers la <a href="listecompte.php">liste des comptes</a>...</p>';
            header("refresh:3;url=listecompte.php");  // Redirection après 3 secondes
        } else {
            echo '<h3 class="text-danger">Erreur lors de la création du compte : ' . $conn->error . '</h3>';
        }
    }
}

?>

           
<div class="container mt-5">
  <form method="POST" action="creation.php">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><strong>Creation</strong></h3>
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
                        <div class="form-group">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">Code</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="password" placeholder="Code" name="code" required>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <label class="form-label">Solde</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control required" type="text" placeholder="Solde" name="solde" required>
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

</body>

</html>
