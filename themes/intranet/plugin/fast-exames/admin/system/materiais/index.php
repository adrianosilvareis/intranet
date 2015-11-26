<?php

$FeMaterial = new FeMaterial();
$FeMaterial->Execute()->findAll();
if (!$FeMaterial->Execute()->getResult()):
    WSErro("Nenhum material cadastrado!", WS_INFOR);
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
            foreach ($FeMaterial->Execute()->getResult() as $material):
                extract((array) $material);
                ?>    
                <tr>
                    <td><?= $mat_descricao; ?></td>
                    <td><?= ($mat_status ? "Ativo" : "Desativado"); ?></td>
                    <td><?= 'editar/desativar' ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
<?php endif; ?>