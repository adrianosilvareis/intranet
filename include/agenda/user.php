
<div style="min-height: 400px;" ng-controller="user">

    <div class="form row" style="margin-bottom: 10px" id="formContato">
        <?php include 'inc/contatoView.inc.php'; ?>
    </div>

    <div class="row col-md-12" id="contatoLista">
        <?php include 'inc/contatoList.inc.php'; ?>
    </div>

    <div ng-if="setores.length === 0">
        <div ng-if="carregando.length === 4">
            <?php WSErro("Não exite contatos Cadastrados", WS_INFOR); ?>
        </div>
        <div ng-if="carregando.length !== 4">
            <img src="<?= HOME ?>/<?= REQUIRE_PATH ?>/images/ajax-loader.gif" class="img-responsive">
        </div>
    </div>
</div>