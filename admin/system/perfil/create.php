<div class="content form_create">    

    <article>

        <header>
            <h1>Criar perfil:</h1>
        </header>

        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post) && $post['SendPostForm']):
            $post['perfil_status'] = ( $post['SendPostForm'] == 'Cadastrar' ? '0' : '1');
            unset($post['SendPostForm']);

            require '_models/AdminPerfil.class.php';
            $cadastra = new AdminPerfil();
            $cadastra->ExeCreate($post);

            if ($cadastra->getResult()):
                header('Location: painel.php?exe=perfil/update&create=true&perfilId=' . $cadastra->getResult());
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="perfil_title" value="<?php if (isset($post['perfil_title'])) echo $post['perfil_title']; ?>" placeholder="Titulo do perfil"/>
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="perfil_content" rows="10"><?php if (isset($post['perfil_content'])) echo htmlspecialchars($post['perfil_content']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formTimestamp center" name="perfil_date" value="<?php
                    if (isset($post['perfil_date'])): echo $post['perfil_date'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>

            </div><!--/line-->

            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostForm" />
            <a href="painel.php?exe=perfil/index" class="btn default" >VOLTAR</a>
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->