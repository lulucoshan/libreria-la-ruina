<?php
$categorias = seleccionar("SELECT id_categoria, categoria FROM categorias", "localhost", "el_esfuerzo", "root", "password");
?>

<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalEditarLabel">Editar producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

         <form method="post", action="actualizar.php">

            <input type="hidden" id="id" name="id">


            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" step="0.01" id="precio" name="precio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select id="categoria" name="categoria" class="form-select" required>
                    <option value=""> seleccionar... </option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria[0]; ?>"><?php echo $categoria[1]; ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control" required>
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
  let modalEditar = document.getElementById('modalEditar');

  modalEditar.addEventListener('hidden.bs.modal', () => {
    const form = modalEditar.querySelector('form');
    form.reset();
  });
</script>


