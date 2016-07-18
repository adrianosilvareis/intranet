<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Criar Setor:</h1>
        </header>

        <?php
        require '_models/AdminSetor.class.php';

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);

            $cadastra = new AdminSetor();
            $cadastra->ExeCreate($data);

            if ($cadastra->getResult() == null):
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            else:
                header('Location: painel.php?exe=setor/update&create=true&setId=' . $cadastra->getResult());
            endif;
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
                    <input type="text" class="formTimestamp center" name="setor_date" value="<?= date('d/m/Y H:i:s'); ?>" />
                </label>

                <label class="label_small left">
                    <span class="field">Tipo:</span>
                    <select name="setor_type">
                        <option value=""> Selecione um tipo: </option>
                        <?php
                        $ReadSet = new WsSetorType();
                        $ReadSet->Execute()->findAll();
                        if (!$ReadSet->Execute()->getResult()):
                            echo '<option disabled="disable" value=""> Cadastre antes um tipo! </option>';
                        else:
                            foreach ($ReadSet->Execute()->getResult() as $ses):
                                echo "<option value=\"{$ses->type_id}\" ";

                                if ($ses->type_id == $data['setor_type']):
                                    echo ' selected="seleted" ';
                                endif;

                                echo "> {$ses->type_content} </option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="setor_category">
                        <option value="">Selecione uma categoria</option>
                        <option value="agenda">Agenda</option>
                        <option value="fast-exames" >Fast exames</option>
                        <option value="nao-conformidade">Não conformidade</option>
                        <option value="geral">Geral</option>
                    </select>
                </label>
            </div>

            <div class="gbform"></div>

            <input type="submit" class="btn green" value="Cadastrar Setor" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->