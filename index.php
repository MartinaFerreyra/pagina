<?php
session_start();// Inicia la sesión en PHP para poder acceder a las variables de sesión.
if (!isset($_SESSION['usuario'])) { // Verifica si la variable de sesión 'usuario' NO está definida.
    echo '<script>
            alert("Por favor debes iniciar sesión");
            window.location = "index.php";
          </script>';
    session_destroy();// Destruye cualquier sesión activa para evitar accesos indebidos.
    die();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="header">
        <div class="menu container">
            <a href="#" class="logo">
                <img src="images/logo.png" Logo>
            </a>
            <input type="checkbox" id="menu" />
            <label for="menu">
                <img src="images/menu.svg" class="menu icono" alt="menu">
            </label>

            <nav class="navbar">
                <ul>
                    <li><a href="form.php">Inicio</a></li>
                    <li><a href="#">Servicios</a></li>
                    <li><a href="#">Productos</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </nav>
            <div>
                <ul>
                    <li class="submenu">
                        <img src="images/car.svg" id="img-carrito" alt="carrito">
                        <div id="carrito">
                            <table id="lista-carrito">
                                <thead>
                                    <tr>
                                     
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <a href="#" id="vaciar-carrito" class="btn-2">Vaciar Carrito</a>

                            <!-- Aquí es donde insertamos el nuevo código -->
                            <div class="abajo">
                                <div class="precios">
                                    <p>Total:</p>
                                    <p id="precio">$0</p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
                
                
        <div class="header-content container" `>
            <div class="header-txt">
               
                <h1>Accesorios</h1>
                <P>
                    Bienvenido a nuestra tienda online, donde encontrarás una amplia gama de accesorios para perros y
                    gatos de alta calidad. Sabemos lo importante que es tu mascota para ti, y por eso ofrecemos
                    productos diseñados para su comodidad, diversión y bienestar. 
                    Explora nuestra variedad de opciones y
                    encuentra todo lo que necesitas para consentir a tu amigo peludo
                </P>
                <a href="#" class="btn-1">Informacion</a>
            </div>
            <div class="header-img">
                <img src="images/pyg.png" alt="">

            </div>
        </div>
    </header>

    <section class="information container">

        <div class="information-content">

            <div class="information-1">
                <img src="images/i2.svg" alt="">
                <h3>Métodos de Pago</h3>
                <p>
                    Tarjetas de Crédito y Débito
                </p>
            </div>

            <div class="information-1">
                <img src="images/i3.svg" alt="">
                <h3>Métodos de Envío</h3>
                <p>
                    Envio en todo el pais
                </p>
            </div>

            <div class="information-1">
                <img src="images/i1.svg" alt="">
                <h3>Ubicación de la Sucursal</h3>
                <p>
                    Visitanos
                </p>
            </div>

        </div>
    </section>

    <section class="oferts container">
    
        <div class="ofert-1">
            <img src="images/Juguete.png" alt="">
            <h3>Ofertas</h3>
            <p>premium</p>
        </div>

        <div class="ofert-1">
            <img src="images/gat.png" alt="">
            <h3>Ofertas</h3>
            <p>premium</p>
        </div>
        <div class="ofert-1">
            <img src="images/jugu.png" alt="">
            <h3>Ofertas</h3>
            <p>premium</p>
        </div>
    </section>

    <main class="products container" id="lista-1">
        <h2>Productos destacados</h2>

        <div class="product-content">

            <div class="product">
                <img src="images/comidaç.png" alt="Producto-1">
                <div class="product-txt">
                    <h3>Producto</h3>
                    <p class="precio">$15.00</p>
                    <a href="#" class="agregar-carrito btn-2" data-id="1">Agregar</a>
                </div>
            </div>

            <div class="product">
                <img src="images/fo.png" alt="Producto-2">
                <div class="product-txt">
                    <h3>Producto</h3>
                    <p class="precio">$15.00</p>
                    <a href="#" class="agregar-carrito btn-2" data-id="2">Agregar</a>
                </div>
            </div>


            <div class="product">
                <img src="images/rascador.jpg" alt="Producto-3">
                <div class="product-txt">
                    <h3>Producto</h3>
                    <p class="precio">$15.00</p>
                    <a href="#" class="agregar-carrito btn-2" data-id="3">Agregar</a>
                </div>
            </div>

            <div class="product">
                <img src="images/cama.png" alt="Producto-4">
                <div class="product-txt">
                    <h3>Producto</h3>
                    <p class="precio">$15.00</p>
                    <a href="#" class="agregar-carrito btn-2" data-id="4">Agregar</a>
                </div>
            </div>


            <div class="product">
                <img src="images/peine.png" alt="Producto-5">
                <div class="product-txt">
                    <h3>Producto</h3>
                    <p class="precio">$15.00</p>
                    <a href="#" class="agregar-carrito btn-2" data-id="5">Agregar</a>
                </div>
            </div>


            <div class="product">
                <img src="images/ratones.png" alt="Producto-6">
                <div class="product-txt">
                    <h3>Producto</h3>
                    <p class="precio">$15.00</p>
                    <a href="#" class="agregar-carrito btn-2" data-id="6">Agregar</a>
                </div>
            </div>

            <div class="product">
                <img src="images/correa.png" alt="Producto-7">
                <div class="product-txt">
                    <h3>Producto</h3>
                    <p class="precio">$15.00</p>
                    <a href="#" class="agregar-carrito btn-2" data-id="7">Agregar</a>
                </div>
            </div>
        </div>

    </main>

    <section class="service">

        <div class="service-1">
            <img class="store" src="images/varita.png" alt="">
        </div>
        <div class="service-2">
            <img class="store" src="images/cuch.png" alt="">
        </div>
        <div class="service-3">
            <img class="store" src="images/jugu2.png" alt="">
        </div>
    </section>

    <section class="contact container">

        <form>
            <input type="email" placeholder="Correo">
            <input type="submit" class="btn-3">
        </form>

    </section>
    <footer class="footer-contect container">
        <div class="link">

            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit debitis libero distinctio?
                Reprehenderit perspiciatis commodi ipsa saepe ipsam?

            </h3>
            <ul>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>

            </ul>
        </div>

        <div class="link">

            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit debitis libero distinctio?
                Reprehenderit perspiciatis commodi ipsa saepe ipsam?

            </h3>
            <ul>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>

            </ul>
        </div>

        <div class="link">

            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit debitis libero distinctio?
                Reprehenderit perspiciatis commodi ipsa saepe ipsam?

            </h3>
            <ul>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>

            </ul>
        </div>

        <div class="link">

            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit debitis libero distinctio?
                Reprehenderit perspiciatis commodi ipsa saepe ipsam?

            </h3>
            <ul>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">lorem</a></li>

            </ul>
        </div>


    </footer>

    <script src="script.js"></script>
</body>

</html>