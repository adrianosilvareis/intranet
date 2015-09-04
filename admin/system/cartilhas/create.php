<div class="content form_create">    
    
    <article>

        <header>
            <h1>Criar Cartilhas:</h1>
        </header>

        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post) && $post['SendPostForm']):
            $post['post_status'] = ( $post['SendPostForm'] == 'Cadastrar' ? '0' : '1');
            $post['post_cover'] = ( $_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null);
            $post['post_type'] = 'cartilhas';
            unset($post['SendPostForm']);
            
            require '_models/AdminPost.class.php';
            $cadastra = new AdminPost();
            
            $cadastra->ExeCreate($post);

            if ($cadastra->getResult()):
                if (!empty($_FILES['gallery_covers']['tmp_name'])):
                    $sendGallery = new AdminPost;
                    $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult());
                endif;
                
                if (!empty($_FILES['files']['tmp_name'])):
                    $sendFiles = new AdminPost;
                    $sendFiles->flSend($_FILES['files'], $cadastra->getResult());
                endif;
                
                header('Location: painel.php?exe=cartilhas/update&create=true&postId=' . $cadastra->getResult());
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="post_cover" />
            </label>

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_title" value="<?php if (isset($post['post_title'])) echo $post['post_title']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="post_content" rows="10"><?php if (isset($post['post_content'])) echo htmlspecialchars($post['post_content']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="post_date" value="<?php
                    if (isset($post['post_date'])): echo $post['post_date'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="post_category">
                        <option value=""> Selecione a categoria: </option>
                        <?php
                        $ReadSes = new WsCategories;
                        $ReadSes->Execute()->Query("category_parent IS NULL ORDER BY category_title ASC");
                        if ($ReadSes->Execute()->getRowCount() >= 1):
                            foreach ($ReadSes->Execute()->getResult() as $ses):
                                echo "<option disabled=\"disabled\" value=\"\"> {$ses->category_title} </option>";
                                $ReadCat = new WsCategories;
                                $ReadCat->setCategory_parent($ses->category_id);
                                $ReadCat->Execute()->Query("#category_parent# ORDER BY category_title ASC");
                                if ($ReadCat->Execute()->getRowCount() >= 1):
                                    foreach ($ReadCat->Execute()->getResult() as $cat):
                                        echo "<option ";

                                        if ($post['post_category'] == $cat->category_id):
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

                <label class="label_small">
                    <span class="field">Author:</span>
                    <select name="post_author">
                        <option value="<?= $_SESSION['userlogin']['user_id'] ?>"> <?= "{$_SESSION['userlogin']['user_name']} {$_SESSION['userlogin']['user_lastname']}"; ?> </option>
                        <?php
                        $ReadAut = new WsUsers;
                        $ReadAut->setUser_id($_SESSION['userlogin']['user_id']);
                        $ReadAut->setUser_level(2);
                        $ReadAut->Execute()->Query("user_id != :user_id AND user_level >= :user_level ORDER BY user_name ASC");
                        if ($ReadAut->Execute()->getRowCount() >= 1):
                            foreach ($ReadAut->Execute()->getResult() as $aut):
                                echo "<option ";

                                if ($post['post_author'] == $aut->user_id):
                                    echo "selected = \"selected\" ";
                                endif;

                                echo "value=\"{$aut->user_id}\"> {$aut->user_name} {$aut->user_lastname} </option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

            </div><!--/line-->

            <div class="label gbform">
                <label class="label">             
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery_covers[]" />
                </label>           
            </div>

            <div class="label gbform">
                <label class="label">
                    <span class="field">Enviar Arquivos:</span>
                    <input type="file" multiple name="files[]" />
                </label>
            </div>

            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostForm" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->