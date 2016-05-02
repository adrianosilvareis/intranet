<section ng-app="naoConformidade" ng-controller="registroList">
    <h1>Painel de controle <small>Evento indesejado</small></h1>  
    
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Cadastro de Evento Indesejado</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home"><?php include 'system/user/view.php'; ?></div>
            <div role="tabpanel" class="tab-pane" id="profile"><?php include 'system/user/cadastro.php'; ?></div>
        </div>
    </div>

</section>