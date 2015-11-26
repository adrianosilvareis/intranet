<?php
$FeAcoes = new FeAcoes();
$FeAcoes->Execute()->findAll();
if (!$FeAcoes->Execute()->getResult()):
    WSErro("Nenhum ação cadastrado!", WS_INFOR);
else:
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($FeAcoes->Execute()->getResult() as $acoes):
                extract((array) $acoes);
                ?>    
                <tr>
                    <td><?= $acao_descricao; ?></td>
                    <td><?= ($acao_status ? "Ativo" : "Desativado"); ?></td>
                    <td><?= 'editar/desativar' ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
<?php endif; ?>