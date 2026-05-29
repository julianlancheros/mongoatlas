<?php

date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d H:i:s");  

require 'vendor/autoload.php'; // Cargar Composer

    $cliente = new MongoDB\Client("mongodb+srv://julianlancheros131_db_user:2bycl66kojRj0LRB@taller4servidores.oybiloa.mongodb.net/?appName=Taller4Servidores");
    $db = $cliente->Prueba4;	// Nombre de BD
    $coleccion = $db->gustos;	//Nombre de la coleccion	
    $resultado = $coleccion->insertOne([
        "apellidos" => $_POST["apellidos"],
        "nombres" => $_POST["nombres"],
        "color" => $_POST["color"],
        "comida" => $_POST["comida"],
        "pelicula" => $_POST["pelicula"],
        "registro" => $hoy
    ]);
    echo "<center><h3 style='border:1px solid green;background-color:rgb(64,145,108);color:white;padding:1%;'>Documento insertado con ID: " . $resultado->getInsertedId() . "</h3></center>";
    
include "index.html";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Documentos</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Listado de Documentos - Colección "Gustos"</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Gusto</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documentos as $doc): ?>
            <tr>
                <td><?= $doc['_id'] ?></td>
                <td><?= $doc['Apellidos'] ?? 'N/A' ?></td>
                <td><?= $doc['Nombres'] ?? 'N/A' ?></td>
                <td><?= $doc['Color favorito'] ?? 'N/A' ?></td>
                <td><?= $doc['Comida favorita'] ?? 'N/A' ?></td>
                <td><?= $doc['Tipo de literatura y cine'] ?? 'N/A' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Total de documentos: <?= $coleccion->countDocuments([]) ?></p>
</body>
</html>
