<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li><a class="btn btn-primary" href="#dashboard" data-toggle="tab">Dashboard</a></li>
    <li><a href="#contato" data-toggle="tab">Contato</a></li>
    <li><a href="#setor" data-toggle="tab">Setor</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="dashboard" ng-controller="agenda">
        <?php include 'system/home.php'; ?>
    </div>

    <div class="tab-pane" id="contato" ng-controller="agendaContato">

        <ul class="nav nav-tabs">
            <li><a href="#pessoa" data-toggle="tab">Contato</a></li>
            <li><a href="#endereco" data-toggle="tab">Endereço</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active panel panel-default"></div>
            <div class="tab-pane" id="pessoa">
                <?php include 'system/contatos/index.php'; ?>
            </div>
            <div class="tab-pane" id="endereco">
                <?php include 'system/contatos/endereco/index.php'; ?>
            </div>
        </div>

    </div>

    <div class="tab-pane" id="setor">
        <?php include 'system/setor/index.php'; ?>
    </div>
</div>