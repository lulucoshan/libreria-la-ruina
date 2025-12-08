<?php
$categorias = seleccionar("SELECT id_categoria, categoria FROM categorias_libros", "localhost", "libreria_la_ruina", "root", "password");
?>

<!-- Modal -->
<div class="modal fade" id="modalInsertar" tabindex="-1" aria-labelledby="modalInsertarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalInsertarLabel">Insertar producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form method="post", action="guardar.php">
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
                        <option value="<?php echo $categoria[0]; ?>"><?php echo $categoria[1]; ?></option>
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

            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  const modalInsertar = document.getElementById('modalInsertar');

  modalInsertar.addEventListener('hidden.bs.modal', () => {
    const form = modalInsertar.querySelector('form');
    form.reset(); // clears all fields
  });
</script>


