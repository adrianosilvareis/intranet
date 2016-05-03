<div ng-if="view !== 'todos'">
    <div ng-include="getAllList()"></div>
</div>

<div ng-if="view === 'todos'">
    <article class="col-md-6">
        <h1>Recebido:</h1>
        <?php include 'listas/recebido_aberto.html'; ?>
        <?php include 'listas/recebido_fechado.html'; ?>
    </article>

    <article class="col-md-6">
        <h1>Enviado:</h1>
        <?php include 'listas/enviado_aberto.html'; ?>
        <?php include 'listas/enviado_fechado.html'; ?>
    </article>
</div>