const carrito = document.getElementById("carrito");// Obtiene el elemento con el ID "carrito", que representa el contenedor del carrito de compras.
const lista = document.getElementById("lista-carrito");
const vaciarCarritoBtn = document.getElementById("vaciar-carrito");
const productos = document.querySelectorAll(".agregar-carrito");// Selecciona todos los elementos con la clase "agregar-carrito", que son los botones para añadir productos al carrito.
let productosCarrito = [];// Crea un array vacío para almacenar los productos agregados al carrito.

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
        const row = document.createElement("tr");// Crea una nueva fila en la tabla
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
    let elemento; // Variable para almacenar el elemento HTML que será eliminado.
    let elementoId; // Variable para almacenar el ID del producto que será eliminado.

    if (e.target.classList.contains("borrar")) { // Verifica si el elemento en el que se hizo clic tiene la clase "borrar".
        e.target.parentElement.parentElement.remove();// Elimina la fila completa de la tabla, subiendo dos niveles en el DOM.
        elemento = e.target.parentElement.parentElement;
        elementoId = elemento.querySelector("a").getAttribute("data-id");// Obtiene el ID del producto desde un enlace dentro de la fila.

        productosCarrito = productosCarrito.filter(producto => producto.id !== elementoId);// Filtra el array `productosCarrito` para eliminar el producto con el ID correspondiente.
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