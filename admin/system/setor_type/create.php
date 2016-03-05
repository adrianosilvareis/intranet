<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Criar Tipo:</h1>
        </header>

        <?php
        require '_models/AdminSetorType.class.php';

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);

            $cadastra = new AdminSetorType();
            $cadastra->ExeCreate($data);
            
            if ($cadastra->getResult() == null):
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            else: 
                header('Location: painel.php?exe=setor_type/update&create=true&typeId=' . $cadastra->getResult());
            endif;
        endif;
        ?>
        
        <form name="PostForm" action="" method="post" enctype="multipart/form-data">
            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="type_content" placeholder="Tipo de Setor" value="<?php if (isset($data)) echo $data['type_content']; ?>" />
            </label>

            <div class="gbform"></div>

            <input type="submit" class="btn green" value="Cadastrar tipo" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->