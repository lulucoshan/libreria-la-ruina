<?php
$categorias = seleccionar("SELECT id_categoria, categoria FROM categorias_libros");
?>

<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalEditarLabel">Insertar producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form method="post", action="actualizar.php" enctype="multipart/form-data">

            <input type="hidden" id="id" name="id">

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" step="0.01" name="precio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select name="categoria" class="form-select" required>
                    <option value=""> seleccionar... </option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['categoria']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="idioma" class="form-label">Idioma</label>
                <input type="text" name="idioma" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">En existencia</label>
                <input type="number" name="stock" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="portada" class="form-label">Portada</label>
                <input type="file" name="portada" class="form-control" accept="image/png, image/webp, image/jpeg">
            </div>

            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--script para limpiar el modal despues de que se cierre-->
<script>
  const modalEditar = document.getElementById('modalEditar');

  modalEditar.addEventListener('hidden.bs.modal', () => {
    const form = modalEditar.querySelector('form');
    form.reset(); // limpia todos los campos
  });
</script>