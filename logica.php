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
</head>
<body>
    <h1>Listado de Documentos</h1>
    
    <?php if ($total > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Gusto</th>
            </tr>
            <?php foreach ($documentos as $doc): ?>
            <tr>
                <td><?= $doc['_id'] ?></td>
                <td><?= $doc['nombre'] ?? 'N/A' ?></td>
                <td><?= $doc['gusto'] ?? 'N/A' ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><strong>Total: <?= $total ?> documentos</strong></p>
    <?php else: ?>
        <p>No hay documentos para mostrar</p>
    <?php endif; ?>
</body>
</html>
