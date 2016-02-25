<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Setor:</h1>
        </header>

        <?php
        require '_models/AdminSetor.class.php';

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $setId = filter_input(INPUT_GET, 'setId', FILTER_VALIDATE_INT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);

            $data['setor_id'] = $setId;
            $cadastra = new AdminSetor();
            $cadastra->ExeUpdate($data);

            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        else:
            $Read = new WsSetor();
            $Read->setSetor_id($setId);
            $Read->Execute()->Query("#setor_id#");
            if (!$Read->Execute()->getResult()):
                header("Location: painel.php?exe=setor/index&empty=true");
            else:
                $data = (array) $Read->Execute()->getResult()[0];
            endif;
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if ($checkCreate && empty($cadastra)):
            WSErro("O tipo <b>{$data['type_content']}</b> foi cadastrado com sucesso no sistema! Continue atualizando o mesmo!", WS_ACCEPT);
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">
            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="setor_content" placeholder="nome do setor" value="<?php if (isset($data)) echo $data['setor_content']; ?>" />
            </label>

            <label class="label">
                <span class="field">E-mail:</span>
                <input type="email" name="setor_email" placeholder="email@servidor.com.br" value="<?php if (isset($data)) echo $data['setor_email']; ?>" />
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="post_date" value="<?= (isset($data['setor_date']) ? date('d/m/Y H:i:s', strtotime($data['setor_date'])) : date('d/m/Y H:i:s')); ?>" />
                </label>

                <label class="label_small left">
                    <span class="field">Tipo:</span>
                    <select name="setor_type">
                        <option value="null"> Selecione um tipo: </option>
                        <?php
                        $ReadSet = new WsSetorType();
                        $ReadSet->Execute()->findAll();
                        if (!$ReadSet->Execute()->getResult()):
                            echo '<option disabled="disable" value="null"> Cadastre antes um tipo! </option>';
                        else:
                            foreach ($ReadSet->Execute()->getResult() as $ses):
                                echo "<option value=\"{$ses->type_id}\" ";

                                if ($ses->type_id == $data['type_content']):
                                    echo ' selected="seleted" ';
                                endif;

                                echo "> {$ses->type_content} </option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>
            </div>

            <div class="gbform"></div>

            <input type="submit" class="btn green" value="Atualizar Setor" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->