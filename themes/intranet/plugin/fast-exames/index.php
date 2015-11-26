<?php
//Check::Manutencao($Link->getLocal());
include_once 'config.inc.php';
$Login = new Login(3);
?>
<header>
    <h1>Fast Exames</h1>
</header>

<?php
if (Check::UserLogin(3) && !empty($Link->getLocal()[2]) && $Link->getLocal()[2] == "admin"):
    include __DIR__ . '/admin/index.php';
elseif (Check::UserLogin(2)):
    include __DIR__ . '/inc/user.php';
elseif (Check::UserLogin(1)):
    WSErro("<b>Área Restrita!</b> Você não tem permissão para acessar esta área.", WS_INFOR);
else:
    $Login->CheckLogin();
    WSErro("<b>Área Restrita!</b> Efetue login para acessar.", WS_INFOR);
endif;
?>