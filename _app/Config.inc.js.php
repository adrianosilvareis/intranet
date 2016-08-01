<?php require_once ("Config.inc.php"); ?>
<?php session_start() ?>

var CONFIG = {
    BASEDIR: "<?= BASEDIR ?>",
    THEME: "<?= THEME ?>",
    HOME: "<?= HOME ?>",
    API: "<?= HOME ?>/api"
};

var perfilUsuario = <?php echo json_encode($_SESSION['userlogin']['perfil']); ?>
