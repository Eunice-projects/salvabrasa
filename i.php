<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/notification.css">
    <script>
    function toggleInfo(infoId) {
        var info = document.getElementById(infoId);

        if (info.style.display === "none" || info.style.display === "") {
            info.style.display = "block";
            info.classList.add('show');
            setTimeout(function() {
                info.classList.add('timeout');
            }, 5000);
        } else {
            info.style.display = "none";
            info.classList.remove('show');
            info.classList.remove('timeout');
        }
    }

    function closeSection(infoId) {
        var info = document.getElementById(infoId);
        info.style.display = "none";
        info.classList.remove('show');
        info.classList.remove('timeout');
    }
    </script>
</head>

<body>

    <div class="contenedor-header">
        <header class="header">
            <div class="logo-conteiner">
                <img src="assets/img/logo5.png" alt="Llama" class="flame-icon">
            </div>
            <nav id="nav">
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="php/menu.php">Menú</a></li>
                    <li><a href="#reservas">Reservas</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>
            <div class="socials-1">
                <a href="#"><img src="assets/img/r1.svg" alt=""></a>
                <a href="#"><img src="assets/img/r2.svg" alt=""></a>
                <a href="#"><img src="assets/img/r3.svg" alt=""></a>
            </div>
        </header>
    </div>
    <main class="contenido-section">
        <section class="hero" style="position: relative;">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>Salvabrasa - Reservas Online</h1>
                <p class="hero-text-una-linea">
                Disfruta de la auténtica cocina a la brasa en Salvabrasa, donde cada experiencia es única. Reserva tu mesa ahora y vive un ambiente familiar con sabores tradicionales y modernos.
                </p></p>
                <div class="barra-inferior-hero" style="display: flex; justify-content: center; align-items: center; gap: 22px; margin-top: 35px;">
                    <span class="enlace-modal" onclick="mostrarModal('modalHistoria')">Historia del restaurante</span>
                    <span class="enlace-modal" onclick="mostrarModal('modalQuienes')">Quiénes somos</span>
                    <a href="#reservas" class="btn-reserva">Reserva Ahora</a>
                </div>
            </div>
        </section>
        <!-- MODAL QUIÉNES SOMOS -->
        <div id="modalQuienes" class="modal-custom" style="display:none;">
            <div class="modal-content-custom">
                <span class="close-btn" onclick="cerrarModal('modalQuienes')">&times;</span>
                <h2>Quiénes Somos</h2>
                <p>
                    El valor de SalvaBrasa es nuestro personal y la calidad de nuestros productos. Cuando usted visita nuestro restaurante, sentirá el cálido recibimiento de nuestros profesionales en servicio, quienes siempre tienen una sonrisa en su rostro, están ansiosos de atenderles y los harán sentir como en su casa, pues estamos agradecidos de que nos visiten y nos sentiremos privilegiados de que usted vuelva a elegirnos.<br><br>
                    Nuestro ambiente cálido y acogedor, que nos caracteriza por nuestra arquitectura y decoración, hacen de SalvaBrasa el mejor restaurante donde usted vivirá y disfrutará una experiencia realmente inolvidable.
                </p>
            </div>
        </div>
        <!-- MODAL HISTORIA -->
        <div id="modalHistoria" class="modal-custom" style="display:none;">
            <div class="modal-content-custom">
                <span class="close-btn" onclick="cerrarModal('modalHistoria')">&times;</span>
                <h2>Historia del restaurante</h2>
                <p>
                    SalvaBrasa se abrió en el centro de San Salvador, el 20 de enero de 2000. 
                    El restaurante presentó una decoración informal, un ambiente cómodo y la sensación de un bar del vecindario. 
                    El menú era simple y consistía en alimentos de gran sabor, precios razonables, servicio nocturno y entretenimiento en vivo cada noche.<br><br>
                    Nuestro costillar especial surgió como la especialidad de la casa, con personas que viajan millas para probar este platillo característico. 
                    SalvaBrasa pronto se convirtió en uno de los steakhouse más populares y exitosos de San Salvador y quedó firmemente establecido en su nicho en el mercado.
                </p>
            </div>
        </div>
        <!-- JavaScript para mostrar y cerrar los modales -->
        <script>
            function mostrarModal(id) {
                document.getElementById(id).style.display = "block";
            }
            function cerrarModal(id) {
                document.getElementById(id).style.display = "none";
            }
            window.onclick = function(event) {
                const modales = ['modalQuienes', 'modalHistoria'];
                modales.forEach(function(id) {
                    const modal = document.getElementById(id);
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                });
            }
        </script>
        <!---------------------------------------Segunda seccion Porque Salvabrasa--------------------------------------------------->
        <section class="salvabrasa-section">
            <div class="image-container">
                <img src="assets/img/Montaje1.png" alt="Interior del restaurante Salvabrasa">
            </div>
            <div class="text-container">
                <h2>¿Por qué elegir Salvabrasa?</h2>
                <div class="feature">
                    <h3>Ingredientes Frescos</h3>
                    <p>De la granja a tu mesa, garantizamos calidad y frescura en cada plato.</p>
                </div>
                <div class="feature">
                    <h3>Experiencia Culinaria</h3>
                    <p>Cocina tradicional a la brasa con un toque moderno e innovador.</p>
                </div>
                <div class="feature">
                    <h3>Ambiente Familiar</h3>
                    <p>Un espacio cálido y acogedor para disfrutar en buena compañía.</p>
                </div>
                <div class="feature">
                    <h3>Servicio Personalizado</h3>
                    <p>Atención dedicada para hacer tu visita inolvidable.</p>
                </div>
            </div>
        </section>
        <!---------------------------------------Menu destacado--------------------------------------------------->
        <section class="menu-destacado">
            <h2>Menú Destacado</h2>

            <div class="menu-item">
                <img src="assets/img/Carne_Ribeye.png" alt="Ribeye">
                <div class="menu-info">
                    <h3>Ribeye a la Brasa</h3>
                    <p>Ribeye de ternera cortado en trozos de textura suave y firme.<strong>$25.00</strong></p>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/img/Carnes_Tomahawk.png" alt="Tomahawk">
                <div class="menu-info">
                    <h3>Tomahawk</h3>
                    <p>Tomahawk de ternera cortado en trozos de textura suave y sabor único.<strong>$29.99</strong>
                    </p>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/img/Entrada_CarpaccioSalmon.jpeg" alt="Salmón">
                <div class="menu-info">
                    <h3>Carpaccio de Salmón</h3>
                    <p>Carpaccio con arugula, alcaparras, puerro y toques cítricos y especias.<strong>$8.00</strong>
                    </p>
                </div>
            </div>
        </section>
        <!---------------------------------------Reservar--------------------------------------------------->
        <section id="reservas">
            <h2 class="titulo-reservas">Reservas</h2>
            <hr class="hr-style">
            <form id="reservaForm" action="guardar_reserva.php" method="POST">
                <div class="form-group">
                    <label for="fecha">Fecha y hora</label>
                    <input type="datetime-local" id="fecha" name="fecha" required>
                </div>

                <div class="form-group">
                    <label for="personas">Número de personas</label>
                    <input type="number" id="personas" name="personas" required min="1">
                </div>

                <div class="form-group">
                    <label for="asiento">Preferencia de asiento</label>
                    <select id="asiento" name="asiento" required>
                        <option value="">Selecciona</option>
                        <option value="interior">Interior</option>
                        <option value="exterior">Exterior</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono">
                </div>

                <div class="form-group">
                    <label for="comentarios">Comentarios adicionales</label>
                    <textarea id="comentarios" name="comentarios" rows="3"></textarea>
                </div>

                <button type="submit" onclick="return verificarLogin()" class="btn-reservar">Reservar ahora</button>
            </form>
            <script>
            function verificarLogin() {
                const usuarioLogueado = localStorage.getItem("usuario_logueado");

                if (!usuarioLogueado) {
                    alert("Por favor inicia sesión para realizar una reserva.");
                    window.location.href = "login.php";
                    return false;
                }
                return true;
            }
            </script>
        </section>

        <!-- Modal para el recibo -->
        <div id="reciboModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Recibo de Reservación</h3>
                <p id="reciboFecha"></p>
                <p id="reciboPersonas"></p>
                <p id="reciboAsiento"></p>
                <p id="reciboNombre"></p>
                <p id="reciboEmail"></p>
                <p id="reciboTelefono"></p>
                <p id="reciboComentarios"></p>
            </div>
        </div>
        <!---------------------------------------Contacto--------------------------------------------------->
        <section id="contacto">
            <h2 class="titulo-contacto">Contacto</h2>
            <hr class="hr-style">
            <div class="contacto-grid">
                <div class="contacto-item">
                    <h3>📍 Dirección</h3>
                    <p>Calle Principal 123, Nueva San Salvador, La Libertad, El Salvador</p>
                </div>
                <div class="contacto-item">
                    <h3>📞 Teléfono</h3>
                    <p>+503 1234 5678</p>
                </div>
                <div class="contacto-item">
                    <h3>📧 Correo Electrónico</h3>
                    <p><a href="mailto:infosalvabrasa@restaurante.com">infosalvabrasa@restaurante.com</a></p>
                </div>
                <div class="contacto-item">
                    <h3>⏰ Horario de Atención</h3>
                    <p>Lunes a Viernes: 11:30 AM - 10:00 PM</p>
                    <p>Sábado y Domingo: 11:30 AM - 11:00 PM</p>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 SalvaBrasa</p>
    </footer>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/modal.js"></script>
</body>
</html>