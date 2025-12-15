let carrito = [];

function agregarLibro(id, titulo, precio) {
    const item = carrito.find(l => l.id === id);
    if (item) item.cantidad++;
    else carrito.push({ id, titulo, precio, cantidad: 1 });
    renderCarrito();
}

function renderCarrito() {
    const tbody = document.getElementById('carritoBody');
    tbody.innerHTML = '';

    carrito.forEach(item => {
        tbody.innerHTML += `
        <tr>
            <td>${item.titulo}</td>
            <td><input type="number" min="1" value="${item.cantidad}"
                onchange="cambiarCantidad('${item.id}', this.value)"></td>
            <td>$${item.precio}</td>
            <td>$${(item.precio * item.cantidad).toFixed(2)}</td>
            <td><button onclick="eliminar('${item.id}')" class="btn btn-danger btn-sm">✕</button></td>
        </tr>`;
    });

    document.getElementById('totalVenta').innerText = calcularTotal();
}

function cambiarCantidad(id, cantidad) {
    const item = carrito.find(i => i.id === id);
    item.cantidad = parseInt(cantidad);
    renderCarrito();
}

function eliminar(id) {
    carrito = carrito.filter(i => i.id !== id);
    renderCarrito();
}

function calcularTotal() {
    return carrito.reduce((t, i) => t + i.precio * i.cantidad, 0).toFixed(2);
}

async function confirmarVenta() {
    const res = await fetch('guardarVenta.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ carrito })
    });

    const data = await res.json();

    if (data.ok) {
        window.open(`ticket.php?id=${data.id_venta}`, '_blank');
        location.reload();
    }
}
