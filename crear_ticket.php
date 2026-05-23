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
                        <!-- ⚡ Agregamos el id="formTicket" para controlarlo con JS -->
                        <form id="formTicket" action="src/insertar_ticket.php" method="POST">
                          
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
                                <!-- ⚡ Agregamos id="btnGuardar" para cambiar el texto dinámicamente -->
                                <button type="submit" id="btnGuardar" class="btn btn-primary w-100 fw-bold">Guardar Ticket</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 🚀 SCRIPT ASÍNCRONO PARA VELOCIDAD ULTRA RÁPIDA -->
    <script>
    document.getElementById('formTicket').addEventListener('submit', function(e) {
        e.preventDefault(); // Evita que la página se recargue o se quede en blanco

        const boton = document.getElementById('btnGuardar');
        
        // Deshabilitamos el botón y cambiamos el texto para evitar clics duplicados
        boton.disabled = true;
        boton.innerText = "Guardando ticket...";

        // Capturamos todos los datos del formulario de forma automática
        const formData = new FormData(this);

        // Enviamos los datos en segundo plano usando la ruta original del action
            fetch(this.action, {
        method: 'POST',
        body: formData
        })
        .then(response => response.json()) // Convierte la respuesta a JSON
        .then(data => {
        // Si la base de datos devolvió éxito, redirige de inmediato
        if(data.status === 'success') {
            window.location.href = 'agradecimiento.php';
        } else {
            alert('Error en el sistema: ' + data.message);
        }
})
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un problema de red al enviar el ticket.');
            boton.disabled = false;
            boton.innerText = "Guardar Ticket";
        });
    });
    </script>
</body>
</html>