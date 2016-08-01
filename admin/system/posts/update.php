<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Post:</h1>
        </header>

        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $postid = filter_input(INPUT_GET, 'postId', FILTER_VALIDATE_INT);

        if (isset($post) && $post['SendPostForm']):
            $post['post_status'] = ( $post['SendPostForm'] == 'Atualizar' ? '0' : '1');
            $post['post_cover'] = ( $_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');
            unset($post['SendPostForm']);

            require_once '_models/AdminPost.class.php';

            $cadastra = new AdminPost();
            $cadastra->ExeUpdate($postid, $post);

            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);

            if (!empty($_FILES['gallery_covers']['tmp_name'])):
                $sendGallery = new AdminPost();
                $sendGallery->gbSend($_FILES['gallery_covers'], $postid);
            endif;

            if (!empty($_FILES['files']['tmp_name'])):
                $sendFiles = new AdminPost;
                $sendFiles->flSend($_FILES['files'], $postid);
            endif;

        else:
            $WsPosts = new WsPosts;
            $WsPosts->setPost_id($postid);
            $WsPosts->Execute()->find();
            if (!$WsPosts->Execute()->getResult()):
                header('Location: painel.php?exe=posts/index&empty=true');
            else:
                $post = (array) $WsPosts->Execute()->getResult();
                $post['post_date'] = date('d/m/Y H:i:s', strtotime($post['post_date']));
            endif;
        endif;

        if (!empty($_SESSION['errCapa'])):
            WSErro($_SESSION['errCapa'], E_USER_WARNING);
            unset($_SESSION['errCapa']);
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if ($checkCreate && empty($cadastra)):
            WSErro("O post <b>{$post['post_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Enviar Capa:</span>
                    <input type="file" name="post_cover" class="max"/>
                </label>
                
                <label class="label_small">
                    <span class="field">Tipo:</span>
                    <select name="post_type">
                        <option value="" > Selecione um tipo: </option>
                        <option value="membros" <?php
                        if ($post['post_type'] == "membros"): echo "selected=\"selected\" ";
                        endif;
                        ?>> Membros </option>

                        <option value="links" <?php
                        if ($post['post_type'] == "links"): echo "selected=\"selected\" ";
                        endif;
                        ?>> Links </option>

                        <option value="grupos" <?php
                        if ($post['post_type'] == "grupos"): echo "selected=\"selected\" ";
                        endif;
                        ?>> Grupos </option>

                        <option value="posts" <?php
                        if ($post['post_type'] == "posts"): echo "selected=\"selected\" ";
                        endif;
                        ?>> Geral </option>
                    </select>
                </label>
            </div>

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_title" value="<?php if (isset($post['post_title'])) echo $post['post_title']; ?>"/>
            </label>

            <label class="label">
                <span class="field">Site Url:</span>
                <input type="text" name="post_url" value="<?php if (isset($post['post_url'])) echo $post['post_url']; ?>" placeholder="http://www.site.com.br"/>
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="post_content" rows="10"><?php if (isset($post['post_content'])) echo htmlspecialchars($post['post_content']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formTimestamp center" name="post_date" value="<?php
                    if (isset($post['post_date'])): echo $post['post_date'];
                    else: echo date("d/m/Y H:i:s");
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
                                $ReadSet = new WsCategories;
                                $ReadSet->setCategory_parent($ses->category_id);
                                $ReadSet->Execute()->Query("#category_parent# ORDER BY category_title ASC");

                                if ($ReadSet->Execute()->getRowCount() >= 1):
                                    foreach ($ReadSet->Execute()->getResult() as $cat):
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
                        $ReadAut = new WsUsers();
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

            <div class="label gbform" id="gbfoco">

                <label class="label">             
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery_covers[]" />
                </label>

                <?php
                $delGb = filter_input(INPUT_GET, 'gbdel', FILTER_VALIDATE_INT);
                if ($delGb):
                    require_once '_models/AdminPost.class.php';
                    $DellGallery = new AdminPost();
                    $DellGallery->gbRemove($delGb);

                    WSErro($DellGallery->getError()[0], $DellGallery->getError()[1]);
                endif;
                ?>
                <ul class="gallery">
                    <?php
                    $gbi = 0;
                    $Gallery = new WsPostsGallery;
                    $Gallery->setPost_id($postid);
                    $Gallery->Execute()->Query("#post_id#");

                    if ($Gallery->Execute()->getResult()):
                        foreach ($Gallery->Execute()->getResult() as $gb):
                            $gbi++;
                            ?>
                            <li<?php if ($gbi % 5 == 0) echo ' class="right"'; ?>>
                                <div class="img thumb_small">
                                    <?= Check::Image('../uploads/' . $gb->gallery_image, $gbi, 146, 100); ?>
                                </div>  
                                <a href="painel.php?exe=posts/update&postId=<?= $postid; ?>&gbdel=<?= $gb->gallery_id; ?>#gbfoco" class="del">Deletar</a>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>                
            </div>

            <div class="label gbform">
                <label class="label">
                    <span class="field">Enviar Arquivos:</span>
                    <input type="file" multiple name="files[]" />
                </label>

                <?php
                $delfl = filter_input(INPUT_GET, 'fldel', FILTER_VALIDATE_INT);
                if ($delfl):
                    require_once '_models/AdminPost.class.php';
                    $DellGallery = new AdminPost();
                    $DellGallery->flRemove($delfl);

                    WSErro($DellGallery->getError()[0], $DellGallery->getError()[1]);
                endif;
                ?>               

                <ul class="gallery">
                    <?php
                    $gbi = 0;
                    $Files = new WsPostsFile();
                    $Files->setPost_id($postid);
                    $Files->Execute()->Query("#post_id#");

                    if ($Files->Execute()->getResult()):
                        foreach ($Files->Execute()->getResult() as $gb):
                            $gbi++;
                            ?>
                            <li<?php if ($gbi % 5 == 0) echo ' class="right"'; ?>>
                                <div class="link">
                                    <a href="../uploads/<?= $gb->file_url; ?>" ><?= $gb->file_name; ?></a>
                                </div>
                                <a href="painel.php?exe=cartilhas/update&postId=<?= $postid; ?>&fldel=<?= $gb->file_id; ?>#gbfoco" class="del">Deletar</a>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>   
            </div>

            <input type="submit" class="btn blue" value="Atualizar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Atualizar & Publicar" name="SendPostForm" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->