<?php
$categorias = seleccionar("SELECT id_categoria, categoria FROM categorias", "localhost", "el_esfuerzo", "root", "password");
?>

<!-- Modal -->
<div class="modal fade" id="modalBorrar" tabindex="-1" aria-labelledby="modalBorrarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalBorrarLabel">BORRAR?! ADVERTENCIA OPERACION IRREVERSIBLE!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

         <form method="post", action="borrar.php">

            <input type="hidden" id="id" name="id">

            <p class="text-danger fw-bold">¿Estás seguro que deseas eliminar este producto? Esta operación no se puede deshacer.</p>

            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  let modalBorrar = document.getElementById('modalBorrar');

  modalBorrar.addEventListener('show.bs.modal', event => {
    let button = event.relatedTarget;
    let id = button.getAttribute('data-bs-id');

    let inputId = modalBorrar.querySelector('#id');
    inputId.value = id;
});

  modalBorrar.addEventListener('hidden.bs.modal', () => {
    const form = modalBorrar.querySelector('form');
    form.reset();
  });
</script>


