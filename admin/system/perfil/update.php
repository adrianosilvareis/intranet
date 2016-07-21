<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Perfil:</h1>
        </header>

        <?php
        $perfil = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $perfilid = filter_input(INPUT_GET, 'perfilId', FILTER_VALIDATE_INT);

        if (isset($perfil) && $perfil['SendPostForm']):
            $perfil['perfil_status'] = ( $perfil['SendPostForm'] == 'Atualizar' ? '0' : '1');
            unset($perfil['SendPostForm']);

            require_once '_models/AdminPerfil.class.php';

            $cadastra = new AdminPerfil();
            $cadastra->ExeUpdate($perfilid, $perfil);

            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        else:
            $WsPerfil = new WsPerfil();
            $WsPerfil->setPerfil_id($perfilid);
            $WsPerfil->Execute()->find();
            if (!$WsPerfil->Execute()->getResult()):
                header('Location: painel.php?exe=perfil/index&empty=true');
            else:
                $perfil = (array) $WsPerfil->Execute()->getResult();
                $perfil['perfil_date'] = date('d/m/Y H:i:s', strtotime($perfil['perfil_date']));
            endif;
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if ($checkCreate && empty($cadastra)):
            WSErro("O perfil <b>{$perfil['perfil_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="perfil_title" value="<?php if (isset($perfil['perfil_title'])) echo $perfil['perfil_title']; ?>"/>
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="perfil_content" rows="10"><?php if (isset($perfil['perfil_content'])) echo htmlspecialchars($perfil['perfil_content']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formTimestamp center" name="perfil_date" value="<?php
                    if (isset($perfil['perfil_date'])): echo $perfil['perfil_date'];
                    else: echo date("d/m/Y H:i:s");
                    endif;
                    ?>" />
                </label>

            </div><!--/line-->

            <input type="submit" class="btn blue" value="Atualizar" name="SendPostForm" />
            <a href="painel.php?exe=acessos/index#/<?= $perfilid; ?>" class="btn green" >Adicionar Itens</a>
            <a href="painel.php?exe=perfil/index" class="btn default" >VOLTAR</a>
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->