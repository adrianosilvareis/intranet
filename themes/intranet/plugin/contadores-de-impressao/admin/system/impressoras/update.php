<?php
if (file_exists(IMP_PATH . "_models\AdminImpressoras.class.php")):
    include IMP_PATH . "_models\AdminImpressoras.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$impressoraId = filter_input(INPUT_GET, "impressoraId", FILTER_DEFAULT);

if (isset($Dados) && $Dados['SendPostForm']):
    $Dados['impressora_status'] = ($Dados['SendPostForm'] == "Atualizar" ? '0' : '1');
    $Dados['impressora_id'] = $impressoraId;
    unset($Dados["SendPostForm"]);

    $AdminImpressoras = new AdminImpressoras();

    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    else:
        if ($AdminImpressoras->ExeUpdate($Dados)):
            WSErro("Atualizado com sucesso!", WS_ACCEPT);
        else:
            WSErro("Erro ao atualizar!", WS_ERROR);
        endif;
    endif;
else:
    $ImpImpressora = new ImpImpressora();
    $ImpImpressora->Execute()->find("impressora_id=$impressoraId");
    $Dados = (array) $ImpImpressora->Execute()->getResult();
endif;

$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($ImpImpressora)):
    WSErro("Impressora <b>{$Dados['impressora_serial']}</b> cadastrada com sucesso no sistema!", WS_ACCEPT);
endif;
?>

<article>
    <h1>Atualizar Impressora:</h1>

    <div class="row">
        <form class="form col-md-offset-2 col-md-8" name="impressora" method="post">

            <div class="form-group">
                <label>Serial:</label>
                <input name="impressora_serial" type="text" placeholder="Serial" class="form-control" value="<?= $Dados['impressora_serial']; ?>">
            </div>

            <div class="form-group">
                <label>Descrição:</label>
                <input name="impressora_descricao" type="text" placeholder="Descrição" class="form-control" value="<?= $Dados['impressora_descricao']; ?>"> 
            </div>

            <div class="row">

                <?php
                $ImpPostos = new ImpPostos();
                $ImpPostos->Execute()->findAll();
                ?>
                <div class="form-group col-md-4">
                    <label>Posto:</label>
                    <select class="form-control" name="fk_postos">
                        <option value=""> Selecione um posto: </option>
                        <?php
                        foreach ($ImpPostos->Execute()->getResult() as $posto):
                            extract((array) $posto);
                            echo "<option value=\"$postos_id\" "
                            . ($Dados['fk_postos'] == $postos_id ? "selected=true" : "")
                            . ">" . ucfirst(strtolower($postos_nome))
                            . "</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

                <?php
                $ImpModelo = new ImpModelo();
                $ImpModelo->Execute()->findAll();
                ?>
                <div class="form-group col-md-4">
                    <label>Modelo:</label>
                    <select class="form-control" name="fk_modelo">
                        <option value=""> Selecione um modelo: </option>
                        <?php
                        foreach ($ImpModelo->Execute()->getResult() as $modelo):
                            extract((array) $modelo);
                            echo "<option value=\"$modelo_id\" "
                            . ($Dados['fk_modelo'] == $modelo_id ? "selected=true" : "")
                            . "> $modelo_descricao "
                            . "</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

                <?php
                $ImpTaxa = new ImpTaxaImpress();
                $ImpTaxa->Execute()->findAll();
                ?>
                <div class="form-group col-md-4">
                    <label>Taxa:</label>
                    <select class="form-control" name="fk_taxa">
                        <option value=""> Selecione uma taxa: </option>
                        <?php
                        foreach ($ImpTaxa->Execute()->getResult() as $taxa):
                            extract((array) $taxa);
                            echo "<option value=\"$taxa_id\" "
                            . ($Dados['fk_taxa'] == $taxa_id ? "selected=true" : "")
                            . "> $taxa_descricao "
                            . "</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

            </div>


            <input type="submit" class="btn btn-primary" name="SendPostForm" value="Atualizar"/>
            <input type="submit" class="btn btn-success" name="SendPostForm" value="Atualizar Ativo"/>
        </form>
    </div>
</article>