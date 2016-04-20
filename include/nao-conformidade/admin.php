
<header id="navtab">
    <nav>
        <h1><a href="#dashboard" title="Dashboard" data-toggle="tab" onclick="alterClass('#dashboard')">Dashboard</a></h1>

        <!--Query String-->
        <ul class="menu">
            <li id="registro" class="li"><a class="opensub" onclick="return false;" href="#">Registro</a>
                <ul class="sub">
                    <li><a href="#reg_create" onclick="alterClass('#registro')" data-toggle="tab">Criar Registro</a></li>
                    <li><a href="#reg_list" onclick="alterClass('#registro')" data-toggle="tab">Listar / Editar Registro</a></li>
                </ul>
            </li>

            <li id="origem" class="li"><a class="opensub" onclick="return false;" href="#">Origem</a>
                <ul class="sub">
                    <li><a href="#ori_create" onclick="alterClass('#origem')" data-toggle="tab">Criar Origem</a></li>
                    <li><a href="#ori_list" onclick="alterClass('#origem')" data-toggle="tab">Listar / Editar Origem</a></li>
                </ul>
            </li>

            <li id="setor" class="li"><a class="opensub" onclick="return false;" href="#">Setor</a>
                <ul class="sub">
                    <li><a href="#set_create" onclick="alterClass('#setor')" data-toggle="tab">Criar Setor</a></li>
                    <li><a href="#set_list" onclick="alterClass('#setor')" data-toggle="tab">Listar / Editar Setor</a></li>
                </ul>
            </li>

            <!--<li class="li"><a href="../" target="_blank" class="opensub">Ver Site</a></li>-->
        </ul>
    </nav>
</header>

<div class="tab-content" ng-app="naoConformidade">

    <div class="tab-pane" id="dashboard"></div>
    <!--registro-->
    <div class="tab-content">
        <div class="tab-pane" id="reg_create"><?php require '/system/registro/registro.php'; ?></div>
        <div class="tab-pane" id="reg_list"><?php require '/system/registro/index.php'; ?></div>
    </div>

    <!--origem-->
    <div class="tab-content" ng-controller="origem">
        <div class="tab-pane" id="ori_create"><?php require '/system/origem/origem.php'; ?></div>
        <div class="tab-pane" id="ori_list"><?php require '/system/origem/index.php'; ?></div>
    </div>

    <!--setor-->
    <div class="tab-content" ng-controller="setor">
        <div class="tab-pane" id="set_create"><?php require '/system/setor/setor.php'; ?></div>
        <div class="tab-pane" id="set_list"><?php require '/system/setor/index.php'; ?></div>
    </div>

</div>