const carrito = document.getElementById("carrito");
const lista = document.getElementById("lista-carrito");
const vaciarCarritoBtn = document.getElementById("vaciar-carrito");
const productos = document.querySelectorAll(".agregar-carrito");
let productosCarrito = [];

// Evento para agregar al carrito
productos.forEach(producto => {
    producto.addEventListener("click", agregarProducto);
});

// Función para agregar el producto al carrito
function agregarProducto(e) {
    e.preventDefault();
    const producto = e.target.parentElement;
    const productoInfo = {
        id: producto.querySelector("a").getAttribute("data-id"),
        nombre: producto.querySelector("h3").textContent,
        precio: producto.querySelector(".precio").textContent,
    };

    productosCarrito.push(productoInfo);
    mostrarCarrito();
}

// Función para mostrar los productos en el carrito
function mostrarCarrito() {
    limpiarCarrito();

    productosCarrito.forEach(producto => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${producto.nombre}</td>
            <td>${producto.precio}</td>
            <td><a href="#" class="borrar" data-id="${producto.id}">X</a></td>
        `;

        lista.querySelector("tbody").appendChild(row); 
    });

    actualizarTotal();
}

// Función para eliminar un producto del carrito
function eliminarElemento(e) {
    e.preventDefault();
    let elemento;
    let elementoId;

    if (e.target.classList.contains("borrar")) {
        e.target.parentElement.parentElement.remove();
        elemento = e.target.parentElement.parentElement;
        elementoId = elemento.querySelector("a").getAttribute("data-id");

        productosCarrito = productosCarrito.filter(producto => producto.id !== elementoId);
        actualizarTotal();
    }
}

// Función para vaciar el carrito
function vaciarCarrito() {
    limpiarCarrito();  // Solo se borran los productos (en <tbody>)

    productosCarrito = [];
    actualizarTotal();
    return false;
}

// Función para actualizar el total del carrito
function actualizarTotal() {
  const total = productosCarrito.reduce((acc, producto) => {
      return acc + parseFloat(producto.precio.replace('$', ''));
  }, 0);

  // Mostrar el total sin decimales si es un número entero
  const totalFormateado = total % 1 === 0 ? total.toFixed(0) : total.toFixed(2);

  document.getElementById("precio").textContent = `$${totalFormateado}`;
}

// Limpiar carrito
function limpiarCarrito() {
    const tbody = lista.querySelector("tbody");
    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }
}

// Evento de vaciar carrito
vaciarCarritoBtn.addEventListener("click", vaciarCarrito);

// Agregar evento para eliminar un producto
lista.addEventListener("click", eliminarElemento);