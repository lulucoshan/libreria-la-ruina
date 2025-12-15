<div class="modal fade" id="modalCarrito" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">

        <h5>Carrito de venta</h5>

        <table class="table">
        <thead>
        <tr>
        <th>Libro</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
        <th></th>
        </tr>
        </thead>
        <tbody id="carritoBody"></tbody>
        </table>

        <h4>Total: $<span id="totalVenta">0</span></h4>

        <button class="btn btn-success" onclick="confirmarVenta()">
        Confirmar venta
        </button>

        </div>
    </div>
</div>
