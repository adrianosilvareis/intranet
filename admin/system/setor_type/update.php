<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Tipo:</h1>
        </header>

        <?php
        require '_models/AdminSetorType.class.php';

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $typeId = filter_input(INPUT_GET, 'typeId', FILTER_VALIDATE_INT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);

            $data['type_id'] = $typeId;
            $cadastra = new AdminSetorType();
            $cadastra->ExeUpdate($data);

            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        else:
            $Read = new WsSetorType();
            $Read->setType_id($typeId);
            $Read->Execute()->Query("#type_id#");
            if (!$Read->Execute()->getResult()):
                header("Location: painel.php?exe=setor_type/index&empty=true");
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
                <input type="text" name="type_content" placeholder="nome do setor" value="<?php if (isset($data)) echo $data['type_content']; ?>" />
            </label>

            <div class="gbform"></div>

            <input type="submit" class="btn green" value="Atualizar Tipo" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->