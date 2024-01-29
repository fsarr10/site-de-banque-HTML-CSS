<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Comptes Bancaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <div class='container'>
        <a class="navbar-brand fw-bold">Listes des comptes</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNav'>
            <ul class='navbar-nav ml-auto container justify-content-end'>
                <li class='nav-item active'>
                    <a href="admin.html"><button class='btn btn-success rounded-pill' type='submit'>Accueil</button></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
  <a href="creation.php"><svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="40" height="40" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
    <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
     </svg><label class="text-success fw-bold">Ajouter un compte</label></a>

<?php
$servername = "localhost";
$username = "ghost";
$password = "passer";
$dbname = "python_api";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

$sql = "SELECT * FROM banque";
$result = $conn->query($sql);

if ($result === FALSE) {
    echo 'Erreur lors de l\'exécution de la requête SQL : ' . $conn->error;
} else {
    echo '<div class="container mt-4">';
    echo '<h1>Liste des Comptes Bancaires</h1>';
    echo '<table class="table table-bordered">';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th scope="col">Prénom</th>';
    echo '<th scope="col">Nom</th>';
    echo '<th scope="col">Code</th>';
    echo '<th scope="col">Numéro de Compte</th>';
    echo '<th scope="col">Solde</th>';
    echo '<th scope="col">Supprimer</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['prenom'] . '</td>';
        echo '<td>' . $row['nom'] . '</td>';
        echo '<td>' . $row['code'] . '</td>';
        echo '<td>' . $row['numcompte'] . '</td>';
        echo '<td>' . $row['solde'] . '</td>';
        echo '<td><a href="supprimer.php"><button class="btn btn-danger">Supprimer</button><a/></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

$conn->close();
?>

</body>
</html>
