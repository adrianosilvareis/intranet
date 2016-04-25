<section ng-app="naoConformidade" ng-controller="registroList">
    <h1>Painel de controle <small>Evento indesejado</small></h1>  
    
    <div ng-if="view !== 'todos'">
        <div ng-include="getAllList()"></div>
    </div>
    
    <div ng-if="view === 'todos'">
        <article class="col-md-6">
            <h1>Recebido:</h1>
            <?php include '/system/user/listas/recebido_aberto.html'; ?>
            <?php include 'system/user/listas/recebido_fechado.html'; ?>
        </article>

        <article class="col-md-6">
            <h1>Enviado:</h1>
            <?php include 'system/user/listas/enviado_aberto.html'; ?>
            <?php include 'system/user/listas/enviado_fechado.html'; ?>
        </article>
    </div>

</section>