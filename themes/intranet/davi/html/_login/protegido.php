<?php
// pagina protegida, incluir script de verificação de login
require 'verificarLogin.php';
?>
 
<h1>P&aacute;gina protegida!</h1>
<p>Ol&aacute; <u><?php echo $_SESSION['username']; ?></u>, esta &eacute; a p&aacute;gina protegida</p>
<p><a href="logout.php">Terminar sess&atilde;o</a></p>