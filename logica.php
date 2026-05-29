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
    <title>Sistema de Soporte Técnico | MongoDB Atlas</title>
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

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
        }

        /* NAVEGACIÓN - DOS VISTAS (Requisito #2) */
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

        /* CONTENIDO */
        .content {
            padding: 30px;
        }

        /* TARJETAS DE ESTADÍSTICAS */
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

        .stat-card h3 {
            font-size: 2em;
            margin-bottom: 5px;
        }

        /* FORMULARIO DE SOPORTE TÉCNICO (Requisito #3) */
        .formulario {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .formulario h2 {
            margin-bottom: 20px;
            color: #333;
            border-left: 4px solid #667eea;
            padding-left: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        /* TABLA - LISTADO DE DOCUMENTOS (Requisito #1) */
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

        /* ALERTAS */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 5px solid #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 5px solid #dc3545;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 5px solid #17a2b8;
        }

        /* BOTONES */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
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

        /* ESTADO VACÍO */
        .empty-state {
            text-align: center;
            padding: 60px;
            color: #6c757d;
        }

        .empty-state h3 {
            margin-bottom: 10px;
        }

        /* FOOTER */
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-error {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        /* CONSULTA DESTACADA */
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
        <!-- HEADER -->
        <div class="header">
            <h1>🎯 Sistema de Soporte Técnico</h1>
            <p>MongoDB Atlas | Cluster Dedicado</p>
        </div>

        <!-- DOS VISTAS (Requisito #2) -->
        <div class="nav">
            <a href="?vista=soporte" class="nav-item <?= ($vista ?? 'soporte') == 'soporte' ? 'active' : '' ?>">
                📝 FORMULARIO DE SOPORTE
            </a>
            <a href="?vista=listado" class="nav-item <?= ($vista ?? '') == 'listado' ? 'active' : '' ?>">
                📋 LISTADO DE NOVEDADES
            </a>
        </div>

        <div class="content">
            <!-- MENSAJES DE ÉXITO O ERROR -->
            <?php if (isset($mensajeExito) && $mensajeExito): ?>
                <div class="alert alert-success">
                    ✅ <?= htmlspecialchars($mensajeExito) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errorMensaje) && $errorMensaje): ?>
                <div class="alert alert-error">
                    ❌ <?= htmlspecialchars($errorMensaje) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($conexionExitosa) && !$conexionExitosa): ?>
                <div class="alert alert-error">
                    <strong>⚠️ Error de conexión a MongoDB Atlas:</strong><br>
                    Verifica que:
                    <ul style="margin-top: 10px; margin-left: 20px;">
                        <li>El usuario y contraseña sean correctos</li>
                        <li>En Network Access tengas añadida la IP 0.0.0.0/0</li>
                        <li>El cluster esté activo</li>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- ========================================== -->
            <!-- VISTA 1: FORMULARIO DE SOPORTE TÉCNICO (Requisito #3) -->
            <!-- ========================================== -->
            <?php if (($vista ?? 'soporte') == 'soporte'): ?>
                <div class="formulario">
                    <h2>📝 Reportar Novedad o Falla Técnica</h2>
                    <form action="guardar.php" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label>👤 Nombre completo:</label>
                                <input type="text" name="nombre" required placeholder="Ej: Juan Pérez">
                            </div>
                            <div class="form-group">
                                <label>📧 Correo electrónico:</label>
                                <input type="email" name="email" required placeholder="ejemplo@correo.com">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>📞 Teléfono / Contacto:</label>
                                <input type="text" name="telefono" placeholder="Opcional: 3001234567">
                            </div>
                            <div class="form-group">
                                <label>⚠️ Tipo de fallo:</label>
                                <select name="tipo_fallo" required>
                                    <option value="">Seleccione el tipo de fallo...</option>
                                    <option value="Error de conexión">🔌 Error de conexión</option>
                                    <option value="Datos no se muestran">📊 Datos no se muestran</option>
                                    <option value="Error en formulario">📝 Error en formulario</option>
                                    <option value="Página no carga">🌐 Página no carga</option>
                                    <option value="Error en MongoDB">🗄️ Error en MongoDB</option>
                                    <option value="Sugerencia">💡 Sugerencia</option>
                                    <option value="Otro">❓ Otro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>📝 Descripción detallada del problema:</label>
                            <textarea name="descripcion" rows="5" required placeholder="Describa detalladamente qué sucede, cuándo ocurre y cómo reproducir el error..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">📤 Enviar Reporte</button>
                    </form>
                </div>

                <!-- INFORMACIÓN DEL CLUSTER -->
                <div class="alert alert-info">
                    <strong>🗄️ Almacenamiento:</strong> Los datos se guardan en un cluster dedicado de MongoDB Atlas<br>
                    <strong>📁 Base de datos:</strong> Prueba4 | <strong>Colección:</strong> soporte_tecnico
                </div>
            <?php endif; ?>

            <!-- ========================================== -->
            <!-- VISTA 2: LISTADO DE DOCUMENTOS (Requisito #1) -->
            <!-- ========================================== -->
            <?php if ($vista == 'listado'): ?>
                <!-- ESTADÍSTICAS -->
                <div class="stats">
                    <div class="stat-card">
                        <h3><?= isset($totalDocumentos) ? $totalDocumentos : 0 ?></h3>
                        <p>Total de Reportes</p>
                    </div>
                    <div class="stat-card">
                        <h3>📋</h3>
                        <p>Novedades Registradas</p>
                    </div>
                </div>

                <!-- TABLA CON EL LISTADO DE TODOS LOS DOCUMENTOS -->
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Tipo de Fallo</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($totalDocumentos) && $totalDocumentos > 0): ?>
                                <?php 
                                $contador = 1;
                                foreach ($documentos as $doc): 
                                ?>
                                <tr>
                                    <td><?= $contador++ ?></td>
                                    <td><?= htmlspecialchars($doc['fecha'] ?? date('Y-m-d')) ?></td>
                                    <td><?= htmlspecialchars($doc['nombre'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($doc['email'] ?? $doc['telefono'] ?? 'N/A') ?></td>
                                    <td>
                                        <span class="badge <?= $doc['tipo_fallo'] == 'Error de conexión' ? 'badge-error' : 'badge-info' ?>">
                                            <?= htmlspecialchars($doc['tipo_fallo'] ?? 'N/A') ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars(substr($doc['descripcion'] ?? 'Sin descripción', 0, 60)) ?>...</td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <h3>📭 No hay reportes registrados</h3>
                                        <p>Usa el formulario de soporte para agregar tu primera novedad</p>
                                        <a href="?vista=soporte" class="btn btn-primary" style="margin-top: 15px;">📝 Ir al Formulario</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- ========================================== -->
                <!-- PUNTO 1: CONSULTA QUE LISTA TODOS LOS DOCUMENTOS -->
                <!-- ========================================== -->
                <div class="query-box">
                    <strong>📌 CONSULTA UTILIZADA (Requisito #1):</strong><br>
                    <code>
                        // Código PHP para listar todos los documentos registrados<br>
                        $documentos = $coleccion->find([]);  // find([]) = trae TODOS los documentos<br>
                        $totalDocumentos = $coleccion->countDocuments([]);  // Cuenta el total<br><br>
                        // Esto es equivalente a: SELECT * FROM soporte_tecnico
                    </code>
                </div>

                <!-- INFORMACIÓN DEL ALMACENAMIENTO (Requisito #3) -->
                <div class="alert alert-info" style="margin-top: 20px;">
                    <strong>🗄️ Almacenamiento en Cluster Dedicado - MongoDB Atlas:</strong><br>
                    ✅ Base de datos: <strong>Prueba4</strong><br>
                    ✅ Colección: <strong>soporte_tecnico</strong><br>
                    ✅ Los datos se guardan en la nube con replicación automática
                </div>
            <?php endif; ?>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <p>📊 Sistema de Soporte Técnico | MongoDB Atlas Cluster Dedicado | <?= date('Y') ?></p>
            <p>🔍 Consulta find([]) - Lista todos los documentos registrados</p>
        </div>
    </div>
</body>
</html>
