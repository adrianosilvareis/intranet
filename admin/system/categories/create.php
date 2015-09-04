<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Criar Categoria:</h1>
        </header>

        <?php
        require '_models/AdminCategory.class.php';

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);

            $cadastra = new AdminCategory();
            $cadastra->ExeCreate($data);
            
            if ($cadastra->getResult() == null):
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            else: 
                header('Location: painel.php?exe=categories/update&create=true&catid=' . $cadastra->getResult());
            endif;
        endif;
        ?>
        
        <form name="PostForm" action="" method="post" enctype="multipart/form-data">
            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="category_title" value="<?php if (isset($data)) echo $data['category_title']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea name="category_content" rows="5"><?php if (isset($data)) echo $data['category_content']; ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="category_date" value="<?= date('d/m/Y H:i:s'); ?>" />
                </label>

                <label class="label_small left">
                    <span class="field">Seção:</span>
                    <select name="category_parent">
                        <option value="null"> Selecione a Seção: </option>
                        <?php
                        $ReadCat = new WsCategories();
                        $ReadCat->Execute()->Query("category_parent is NULL ORDER BY category_title ASC");
                        if (!$ReadCat->Execute()->getResult()):
                            echo '<option disabled="disable" value="null"> Cadastre antes uma seção! </option>';
                        else:
                            foreach ($ReadCat->Execute()->getResult() as $ses):
                                echo "<option value=\"{$ses->category_id}\" ";

                                if ($ses->category_id == $data['category_parent']):
                                    echo ' selected="seleted" ';
                                endif;

                                echo "> {$ses->category_title} </option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>
            </div>

            <div class="gbform"></div>

            <input type="submit" class="btn green" value="Cadastrar Categoria" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->