<header>
    <h1>Financeiro</h1>
</header>

<?php
if (!isset($Link->getLocal()[2])):
    include_once 'upload.php';
else:
    include_once 'save.php';
    endif;
