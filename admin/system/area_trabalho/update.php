<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Área:</h1>
        </header>

        <?php
        require '_models/AdminArea.class.php';

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $areaId = filter_input(INPUT_GET, 'areaId', FILTER_VALIDATE_INT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);

            $data['area_id'] = $areaId;
            $cadastra = new AdminArea();
         
            $cadastra->ExeUpdate($data);
            
            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        else:
            $Read = new WsAreaTrabalho();
            $Read->setArea_id($areaId);
            $Read->Execute()->Query("#area_id#");
            if (!$Read->Execute()->getResult()):
                header("Location: painel.php?exe=area_trabalho/index&empty=true");
            else:
                $data = (array) $Read->Execute()->getResult()[0];
            endif;
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if ($checkCreate && empty($cadastra)):
            WSErro("O Área <b>{$data['area_title']}</b> foi cadastrado com sucesso no sistema! Continue atualizando o mesmo!", WS_ACCEPT);
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">
            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="area_title" placeholder="nome da area de trabalho" value="<?php if (isset($data)) echo $data['area_title']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="area_content" rows="10"><?php if (isset($data['area_content'])) echo htmlspecialchars($data['area_content']); ?></textarea>
            </label>

            <label class="label">
                <span class="field">E-mail:</span>
                <input type="email" name="area_email" placeholder="email@servidor.com.br" value="<?php if (isset($data)) echo $data['area_email']; ?>" />
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="area_date" value="<?= (isset($data['area_date']) ? date('d/m/Y H:i:s', strtotime($data['area_date'])) : date('d/m/Y H:i:s')); ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="category_id">
                        <option value=""> Selecione a categoria: </option>
                        <?php
                        $ReadSes = new WsAreaCategory();
                        $ReadSes->Execute()->Query("category_parent IS NULL ORDER BY category_title ASC");

                        if ($ReadSes->Execute()->getRowCount() >= 1):
                            foreach ($ReadSes->Execute()->getResult() as $ses):
                                echo "<option disabled=\"disabled\" value=\"\"> {$ses->category_title} </option>";
                                $ReadSet = new WsAreaCategory;
                                $ReadSet->setCategory_parent($ses->category_id);
                                $ReadSet->Execute()->Query("#category_parent# ORDER BY category_title ASC");

                                if ($ReadSet->Execute()->getRowCount() >= 1):
                                    foreach ($ReadSet->Execute()->getResult() as $cat):
                                        echo "<option ";

                                        if ($data['category_id'] == $cat->category_id):
                                            echo "selected=\"selected\" ";
                                        endif;

                                        echo "value=\"{$cat->category_id}\"> &raquo;&raquo;{$cat->category_title} </option>";
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

            </div>

            <div class="gbform"></div>

            <input type="submit" class="btn green" value="Atualizar Area de Trabalho" name="SendPostForm" />
            <a href="painel.php?exe=area_trabalho/index" class="btn default">Voltar</a>
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->