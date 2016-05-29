<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Criar Área:</h1>
        </header>

        <?php
        require '_models/AdminArea.class.php';

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);
            $data['category_id'] = 1;
            $data['area_status'] = 1;
            $cadastra = new AdminArea();
            $cadastra->ExeCreate($data);

            if ($cadastra->getResult() == null):
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            else:
                header('Location: painel.php?exe=area_trabalho/update&create=true&setId=' . $cadastra->getResult());
            endif;
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
                    <input type="text" class="formDate center" name="area_date" value="<?= date('d/m/Y H:i:s'); ?>" />
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
                                $ReadSet = new WsAreaCategory();
                                $ReadSet->setCategory_parent($ses->category_id);
                                $ReadSet->Execute()->Query("#category_parent# ORDER BY category_title ASC");
                                if ($ReadSet->Execute()->getRowCount() >= 1):
                                    foreach ($ReadSet->Execute()->getResult() as $cat):
                                        echo "<option ";

                                        if ($data['post_category'] == $cat->category_id):
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

            <input type="submit" class="btn green" value="Cadastrar Area" name="SendPostForm" />
            <a href="painel.php?exe=area_trabalho/index" class="btn default">Voltar</a>
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->