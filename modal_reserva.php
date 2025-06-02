<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reservar en SalvaBrasa</title>
  <style>
    .modal-custom {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }
    .modal-content-custom {
      background: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      max-width: 400px;
    }
    .modal-content-custom h2 {
      margin-top: 0;
    }
    button {
      margin-top: 15px;
    }
  </style>
</head>
<body>

  <h1>Formulario de Reserva</h1>
  <form id="formReserva">
    <label>Nombre: <input type="text" name="nombre" required></label><br>
    <label>Correo: <input type="email" name="correo" required></label><br>
    <label>Teléfono: <input type="text" name="telefono" required></label><br>
    <label>Fecha y Hora: <input type="datetime-local" name="fecha_hora" required></label><br>
    <label>Personas: <input type="number" name="personas" required min="1"></label><br>
    <label>Comentarios: <textarea name="comentarios"></textarea></label><br>
    <button type="submit">Reservar</button>
  </form>

  <!-- Modal de Ticket -->
  <div id="modalTicket" class="modal-custom">
    <div class="modal-content-custom">
      <h2>🎟️ Confirmación de Reserva</h2>
      <p><strong>Nombre:</strong> <span id="ticketNombre"></span></p>
      <p><strong>Fecha y Hora:</strong> <span id="ticketFecha"></span></p>
      <p><strong>Número de Personas:</strong> <span id="ticketPersonas"></span></p>
      <button onclick="cerrarModal()">Cerrar</button>
    </div>
  </div>

  <script>
    document.getElementById("formReserva").addEventListener("submit", function(e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch("guardar_reserva.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          document.getElementById("ticketNombre").textContent = data.nombre;
          document.getElementById("ticketFecha").textContent = data.fecha_hora;
          document.getElementById("ticketPersonas").textContent = data.personas;
          document.getElementById("modalTicket").style.display = "flex";
        } else if (data.status === "no_login") {
          window.location.href = "login.php";
        } else {
          alert("Error al guardar: " + (data.message || "Desconocido"));
        }
      })
      .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Hubo un error al procesar la reserva.");
      });
    });

    function cerrarModal() {
      document.getElementById("modalTicket").style.display = "none";
    }
  </script>

</body>
</html>