<script>
document.cookie = 'usuarioAtualizouPerfil=SIM; expires=;expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/';
document.cookie = 'usuarioVisualizouModal=SIM; expires=;expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/';
</script>


<?php

setcookie("usuarioAtualizouPerfil", "SIM", time()-3600);

var_dump($_COOKIE);