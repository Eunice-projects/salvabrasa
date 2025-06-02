<?php
session_start();
session_destroy();
?>
<script>
  localStorage.removeItem("usuario_logueado");
  window.location.href = "i.php";
</script>


