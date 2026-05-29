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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Soporte Técnico | MongoDB</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .nav {
            display: flex;
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        .nav-item {
            flex: 1;
            text-align: center;
            padding: 15px;
            text-decoration: none;
            color: #6c757d;
            font-weight: 600;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .nav-item:hover {
            background: #e9ecef;
            color: #667eea;
        }

        .nav-item.active {
            color: #667eea;
            border-bottom-color: #667eea;
            background: white;
        }

        .content {
            padding: 30px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .stat-card h3 {
            font-size: 2em;
            margin-bottom: 5px;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #667eea;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 5px solid #dc3545;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 5px solid #28a745;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }

        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }

        .empty-state {
            text-align: center;
            padding: 60px;
            color: #6c757d;
        }

        .empty-state h3 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Sistema de Gestión de Soporte</h1>
            <p>MongoDB Atlas | Base de Datos Prueba4 - Colección Gustos</p>
        </div>

        <div class="nav">
            <a href="?vista=todos" class="nav-item <?= ($vista ?? 'todos') == 'todos' ? 'active' : '' ?>">
                📋 TODOS LOS DOCUMENTOS
            </a>
            <a href="?vista=usuarios" class="nav-item <?= ($vista ?? '') == 'usuarios' ? 'active' : '' ?>">
                👥 SOLO USUARIOS
            </a>
            <a href="soporte.php" class="nav-item">
                📝 FORMULARIO DE SOPORTE
            </a>
        </div>

        <div class="content">
            <?php if (isset($errorMensaje) && $errorMensaje): ?>
                <div class="alert alert-error">
                    <strong>❌ Error:</strong> <?= htmlspecialchars($errorMensaje) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($conexionExitosa) && $conexionExitosa): ?>
                <div class="stats">
                    <div class="stat-card">
                        <h3><?= $total ?? 0 ?></h3>
                        <p>Total Documentos</p>
                    </div>
                    <div class="stat-card">
                        <h3><?= $totalUsuarios ?? 0 ?></h3>
                        <p>Usuarios Registrados</p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre/Contacto</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($documentos) && iterator_count($documentos) > 0): ?>
                            <?php foreach ($documentos as $doc): ?>
                            <tr>
                                <td><?= htmlspecialchars(substr($doc['_id'], -8)) ?></td>
                                <td><?= htmlspecialchars(substr($doc['_id'], -8)) ?></td>
                                <td><?= htmlspecialchars($doc['apellidos'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($doc['nombres'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($doc['Color'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($doc['comida'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($doc['Película'] ?? 'N/A') ?></td>
                            
                                <td><?= htmlspecialchars($doc['fecha'] ?? date('Y-m-d')) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <h3>📭 No hay documentos registrados</h3>
                                    <p>Usa el formulario de soporte para agregar tu primer registro</p>
                                    <a href="soporte.php" class="btn btn-primary" style="margin-top: 15px;">➕ Ir al Formulario</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="footer">
            <p>📊 Sistema desarrollado con PHP + MongoDB Atlas | Total registros: <?= $total ?? 0 ?></p>
        </div>
    </div>
</body>
</html>
