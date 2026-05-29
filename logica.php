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
    <title>Sistema de Soporte Técnico | MongoDB Atlas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
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
        .header h1 { font-size: 2em; margin-bottom: 10px; }
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
            border-bottom: 3px solid transparent;
        }
        .nav-item:hover { background: #e9ecef; color: #667eea; }
        .nav-item.active { color: #667eea; border-bottom-color: #667eea; background: white; }
        .content { padding: 30px; }
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
        }
        .stat-card h3 { font-size: 2em; }
        .formulario {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .formulario h2 {
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
            padding-left: 15px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .table-container { overflow-x: auto; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; background: white; }
        th { background: #667eea; color: white; padding: 15px; text-align: left; }
        td { padding: 12px 15px; border-bottom: 1px solid #e9ecef; }
        tr:hover { background: #f8f9fa; }
        .alert { padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border-left: 5px solid #28a745; }
        .alert-error { background: #f8d7da; color: #721c24; border-left: 5px solid #dc3545; }
        .alert-info { background: #d1ecf1; color: #0c5460; border-left: 5px solid #17a2b8; }
        .btn { display: inline-block; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; border: none; cursor: pointer; }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5a67d8; }
        .empty-state { text-align: center; padding: 60px; color: #6c757d; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #6c757d; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .query-box {
            background: #1a1a2e;
            color: #00ff88;
            padding: 15px;
            border-radius: 10px;
            font-family: monospace;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Sistema de Registro de Gustos</h1>
            <p>MongoDB Atlas | Cluster Dedicado</p>
        </div>

        <div class="nav">
            <a href="?vista=soporte" class="nav-item <?= $vista == 'soporte' ? 'active' : '' ?>">
                📝 REGISTRAR GUSTOS
            </a>
            <a href="?vista=listado" class="nav-item <?= $vista == 'listado' ? 'active' : '' ?>">
                📋 LISTADO DE REGISTROS
            </a>
        </div>

        <div class="content">
            <?php if ($mensajeExito): ?>
                <div class="alert alert-success"><?= $mensajeExito ?></div>
            <?php endif; ?>

            <?php if (!$conexionExitosa): ?>
                <div class="alert alert-error">
                    <strong>⚠️ Error de conexión:</strong> <?= htmlspecialchars($errorMensaje) ?>
                </div>
            <?php endif; ?>

            <!-- VISTA 1: FORMULARIO PARA REGISTRAR GUSTOS -->
            <?php if ($vista == 'soporte'): ?>
                <div class="formulario">
                    <h2>📝 Registrar Gustos y Preferencias</h2>
                    <form action="guardar.php" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label>👤 Apellidos:</label>
                                <input type="text" name="apellidos" required placeholder="Ej: Pérez Gómez">
                            </div>
                            <div class="form-group">
                                <label>👤 Nombres:</label>
                                <input type="text" name="nombres" required placeholder="Ej: Juan Carlos">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>🎨 Color favorito:</label>
                                <select name="color" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Rojo">🔴 Rojo</option>
                                    <option value="Azul">🔵 Azul</option>
                                    <option value="Verde">🟢 Verde</option>
                                    <option value="Amarillo">🟡 Amarillo</option>
                                    <option value="Morado">🟣 Morado</option>
                                    <option value="Negro">⚫ Negro</option>
                                    <option value="Blanco">⚪ Blanco</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>🍕 Comida favorita:</label>
                                <select name="comida" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Pizza">🍕 Pizza</option>
                                    <option value="Hamburguesa">🍔 Hamburguesa</option>
                                    <option value="Sushi">🍣 Sushi</option>
                                    <option value="Tacos">🌮 Tacos</option>
                                    <option value="Pasta">🍝 Pasta</option>
                                    <option value="Asado">🥩 Asado</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>🎬 Película favorita:</label>
                            <input type="text" name="pelicula" required placeholder="Ej: El Padrino, Inception, Titanic">
                        </div>
                        <button type="submit" class="btn btn-primary">💾 Guardar Registro</button>
                    </form>
                </div>
                <div class="alert alert-info">
                    <strong>🗄️ Almacenamiento:</strong> Cluster dedicado MongoDB Atlas | Base de datos: Prueba4 | Colección: soporte_tecnico
                </div>
            <?php endif; ?>

            <!-- VISTA 2: LISTADO DE TODOS LOS REGISTROS (CONSULTA FIND) -->
            <?php if ($vista == 'listado'): ?>
                <div class="stats">
                    <div class="stat-card">
                        <h3><?= $totalDocumentos ?></h3>
                        <p>Total de Registros</p>
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Apellidos</th>
                                <th>Nombres</th>
                                <th>Color</th>
                                <th>Comida</th>
                                <th>Película</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($totalDocumentos > 0): ?>
                                <?php $contador = 1; foreach ($documentos as $doc): ?>
                                <tr>
                                    <td><?= $contador++ ?></td>
                                    <td><?= htmlspecialchars($doc['fecha'] ?? date('Y-m-d')) ?></td>
                                    <td><?= htmlspecialchars($doc['apellidos'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($doc['nombres'] ?? 'N/A') ?></td>
                                    <td><span class="badge badge-info"><?= htmlspecialchars($doc['color'] ?? 'N/A') ?></span></td>
                                    <td><?= htmlspecialchars($doc['comida'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($doc['pelicula'] ?? 'N/A') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        📭 No hay registros aún. ¡Usa el formulario para agregar uno!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- MOSTRAR LA CONSULTA FIND -->
                <div class="query-box">
                    <strong>📌 CONSULTA UTILIZADA (Requisito #1):</strong><br>
                    <code>
                        // Listar todos los documentos registrados<br>
                        $documentos = $coleccion->find([]);  // find([]) = trae TODOS los documentos<br>
                        $totalDocumentos = $coleccion->countDocuments([]);  // Cuenta el total
                    </code>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer">
            <p>📊 Sistema de Registro de Gustos | MongoDB Atlas | Consulta find([]) - Lista todos los documentos</p>
        </div>
    </div>
</body>
</html>
