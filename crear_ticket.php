<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoportePro - Crear Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0 fw-bold">Crear Nuevo Ticket</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="src/insertar_ticket.php" method="POST">
                          
                            <div class="mb-3">

                                <label for="nombre_usuario" class="form-label">Tu Nombre</label>
                                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" placeholder="Ej. Juan Pérez" required>
                            </div>

                            <div class="mb-3">
                                <label for="departamento" class="form-label">Departamento</label>
                                <select name="departamento" id="departamento" class="form-select" required>
                                    <option value="" disabled selected>-- Selecciona tu departamento --</option>
                                    <option value="Sistemas">Sistemas</option>
                                    <option value="Contabilidad">Contabilidad</option>
                                    <option value="Publicaciones">Publicaciones</option>
                                    <option value="Almacén">Almacén</option>
                                    <option value="Litografía">Litografía</option>
                                    <option value="Profesores Español">Profesores Español</option>
                                    <option value="Profesores Matemáticas">Profesores Matemáticas</option>
                                    <option value="Otros Profesores">Otros Profesores</option>
                                    <option value="Virtual">Virtual</option>
                                    <option value="Coordinadores">Coordinadores</option>
                                    <option value="Atencion al Cliente">Atencion al Cliente</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="titulo" class="form-label fw-semibold">Título del problema</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ej: Falla en la impresora del segundo piso" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label fw-semibold">Descripción detallada</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Describe claramente el inconveniente técnico..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="prioridad" class="form-label fw-semibold">Prioridad</label>
                                <select class="form-select" id="prioridad" name="prioridad">
                                    <option value="baja">Baja</option>
                                    <option value="media" selected>Media</option>
                                    <option value="alta">Alta</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2 pt-2">
                                <button type="submit" class="btn btn-primary w-100 fw-bold">Guardar Ticket</button>
                                <a href="index.php" class="btn btn-outline-secondary w-100">Cancelar</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>