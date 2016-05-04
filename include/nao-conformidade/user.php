<section ng-controller="registroUser">
    <h1>Painel de controle <small>Evento indesejado</small></h1>  
    
    <div ng-if="registro">
        <?php include 'system/registro/registro.php'; ?>
    </div>
    
    <div ng-if="!registro">
        <?php include 'system/user/view.php'; ?>
    </div>

</section>