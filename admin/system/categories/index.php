<div class="content cat_list">

    <section>

        <h1>Categorias:</h1>

        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Você tentou editar uma categoria que não existe no sistema!", WS_INFOR);
        endif;

        $delCat = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
        if ($delCat):
            require('_models/AdminCategory.class.php');
            $deletar = new AdminCategory();
            $deletar->ExeDelete($delCat);
            WSErro($deletar->getError()[0], $deletar->getError()[1]);
        endif;

        $ReadSes = new WsCategories;
        $ReadSes->Execute()->Query("category_parent IS NULL ORDER BY category_title ASC");
        if (!$ReadSes->Execute()->getResult()):
            WSErro("Desculpa, ainda não temos categorias cadastrados", WS_INFOR);
        else:
            foreach ($ReadSes->Execute()->getResult() as $ses):
                extract((array) $ses);

                $ReadPosts = new WsPosts;
                $ReadPosts->setPost_cat_parent($category_id);
                $ReadPosts->Execute()->Query("#post_cat_parent#");
                $ContSesPosts = $ReadPosts->Execute()->getRowCount();

                $ReadSes->setCategory_parent($category_id);
                $ReadSes->Execute()->Query("#category_parent#");
                $ContSesCats = $ReadSes->Execute()->getRowCount();
                ?>
                <section>

                    <header>
                        <h1><?= $category_title; ?>  <span>( <?= $ContSesPosts; ?> posts ) ( <?= $ContSesCats; ?> Categorias )</span></h1>
                        <p class="tagline"><?= $category_content; ?></p>

                        <ul class="info post_actions">
                            <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($category_date)); ?>Hs</li>
                            <li><a class="act_view" target="_blank" href="../categoria/<?= $category_name; ?>" title="Ver no site">Ver no site</a></li>
                            <li><a class="act_edit" href="painel.php?exe=categories/update&catid=<?= $category_id; ?>" title="Editar">Editar</a></li>
                            <li><a class="act_delete" href="painel.php?exe=categories/index&delete=<?= $category_id; ?>" title="Excluir">Deletar</a></li>
                        </ul>
                    </header>

                    <h2>Sub categorias de vídeo aulas:</h2>

                    <?php
                    $ReadSes->setCategory_parent($category_id);
                    $ReadSes->Execute()->Query("#category_parent#");
                    if (!$ReadSes->Execute()->getResult()):

                    else:
                        $a = 0;
                        foreach ($ReadSes->Execute()->getResult() as $sub):
                            $a++;
                            $ReadCatPosts = new WsPosts();
                            $ReadCatPosts->setPost_category($sub->category_id);
                            $ReadCatPosts->Execute()->Query("#post_category#");
                            ?>
                            <article<?php if ($a % 3 == 0) echo ' class="right"'; ?>>
                                <h1><a target="_blank" href="../categoria/<?= $sub->category_name; ?>" title="Ver Categoria"><?= $sub->category_title; ?></a>  ( <?= $ReadCatPosts->Execute()->getRowCount(); ?> posts )</h1>

                                <ul class="info post_actions">
                                    <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($sub->category_date)); ?>Hs</li>
                                    <li><a class="act_view" target="_blank" href="../categoria/<?= $sub->category_name; ?>" title="Ver no site">Ver no site</a></li>
                                    <li><a class="act_edit" href="painel.php?exe=categories/update&catid=<?= $sub->category_id; ?>" title="Editar">Editar</a></li>
                                    <li><a class="act_delete" href="painel.php?exe=categories/index&delete=<?= $sub->category_id; ?>" title="Excluir">Deletar</a></li>
                                </ul>
                            </article>
                            <?php
                        endforeach;
                    endif;
                    ?>

                </section>

                <?php
            endforeach;
        endif;
        ?>

        <div class="clear"></div>
    </section>
</div> <!-- content home -->