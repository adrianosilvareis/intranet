<?php
if (file_exists(IMP_PATH . "_models\AdminImpressoras.class.php")):
    include IMP_PATH . "_models\AdminImpressoras.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($Dados) && $Dados['SendPostForm']):
    $Dados['impressora_status'] = ($Dados['SendPostForm'] == "Cadastrar" ? '0' : '1');
    unset($Dados["SendPostForm"]);

    $AdminImpressoras = new AdminImpressoras();

    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    elseif ($AdminImpressoras->FindSerial($Dados['impressora_serial'])):
        $impressora = $AdminImpressoras->FindSerial($Dados['impressora_serial']);
        WSErro("Impressora <b>{$impressora->impressora_serial}</b> já existe no sistema!", WS_INFOR);
    else:
        if ($AdminImpressoras->ExeCreate($Dados)):
            WSErro("Cadastrado com sucesso!", WS_ACCEPT);
            header("Location: " . IMP_INCLUDE . "admin/&exe=impressoras/update&create=true&impressoraId=" . $AdminImpressoras->getResult());
        else:
            WSErro("Erro no cadastro!", WS_ERROR);
        endif;
    endif;
endif;
?>
<article>
    <h1>Criar Impressora:</h1>

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
                $AppPostos = new AppPostos();
                $AppPostos->Execute()->findAll();
                ?>
                <div class="form-group col-md-4">
                    <label>Posto:</label>
                    <select class="form-control" name="fk_postos">
                        <option value=""> Selecione um posto: </option>
                        <?php
                        foreach ($AppPostos->Execute()->getResult() as $posto):
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
                $AppModelo = new AppModelo();
                $AppModelo->Execute()->findAll();
                ?>
                <div class="form-group col-md-4">
                    <label>Modelo:</label>
                    <select class="form-control" name="fk_modelo">
                        <option value=""> Selecione um modelo: </option>
                        <?php
                        foreach ($AppModelo->Execute()->getResult() as $modelo):
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
                $AppTaxa = new AppTaxaImpress();
                $AppTaxa->Execute()->findAll();
                ?>
                <div class="form-group col-md-4">
                    <label>Taxa:</label>
                    <select class="form-control" name="fk_taxa">
                        <option value=""> Selecione uma taxa: </option>
                        <?php
                        foreach ($AppTaxa->Execute()->getResult() as $taxa):
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


            <input type="submit" class="btn btn-primary" name="SendPostForm" value="Cadastrar"/>
            <input type="submit" class="btn btn-success" name="SendPostForm" value="Cadastrar Ativo"/>
        </form>
    </div>
</article>