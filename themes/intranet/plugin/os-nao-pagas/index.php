<header>
    <h1>Financeiro</h1>
</header>

<?php
if (!Check::UserLogin(3)):
    echo "<a class=\"btn btn-primary\" style=\"width: 200px; margin: 10px 0;\" href=\"/intranet/admin\" title=\"Login\" alt=\"admin\" >Login</a>";
    WSErro("<b>Área Restrita!</b> Efetue login para acessar.", WS_INFOR);
else:
    if (!isset($Link->getLocal()[2])):
        include_once 'upload.php';
    else:
        include_once 'save.php';
    endif;
endif;
