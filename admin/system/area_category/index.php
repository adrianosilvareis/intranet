<div class="content cat_list">

    <section>
        
        <a href="painel.php?exe=area_trabalho/index" class="btn default" style="float: right; border: 1px solid #ccc; margin-left: 5px;">Voltar</a>
        <a href="painel.php?exe=area_category/create" class="user_cad" style="float: right;">Nova Categoria</a>
        
        <h1>Categorias:</h1>

        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Você tentou editar uma categoria que não existe no sistema!", WS_INFOR);
        endif;

        $delCat = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
        if ($delCat):
            require('_models/AdminAreaCategory.class.php');
            $deletar = new AdminAreaCategory();
            $deletar->ExeDelete($delCat);
            WSErro($deletar->getError()[0], $deletar->getError()[1]);
        endif;

        $ReadSes = new WsAreaCategory();
        $ReadSes->Execute()->Query("category_parent IS NULL ORDER BY category_title ASC");
        
        if (!$ReadSes->Execute()->getResult()):
            WSErro("Desculpa, ainda não temos categorias cadastrados", WS_INFOR);
        else:
            foreach ($ReadSes->Execute()->getResult() as $ses):
                extract((array) $ses);
        
                $ReadSes->setCategory_parent($category_id);
                $ReadSes->Execute()->Query("#category_parent#");
                $ContSesCats = $ReadSes->Execute()->getRowCount();
                ?>
                <section>

                    <header>
                        <h1><?= $category_title; ?>  <span>( <?= $ContSesCats; ?> Categorias )</span></h1>
                        <p class="tagline"><?= $category_content; ?></p>
                        <ul class="info post_actions">
                            <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($category_date)); ?>Hs</li>
                            <li><a class="act_edit" href="painel.php?exe=area_category/update&catid=<?= $category_id; ?>" title="Editar">Editar</a></li>
                            <li><a class="act_delete" href="painel.php?exe=area_category/index&delete=<?= $category_id; ?>" title="Excluir">Deletar</a></li>
                        </ul>
                    </header>

                    <h2>Sub categorias:</h2>

                    <?php
                    $ReadSes->setCategory_parent($category_id);
                    $ReadSes->Execute()->Query("#category_parent#");
                    if (!$ReadSes->Execute()->getResult()):

                    else:
                        $a = 0;
                        foreach ($ReadSes->Execute()->getResult() as $sub):
                            $a++;
                            $ReadCatPosts = new WsAreaTrabalho();
                            $ReadCatPosts->setCategory_id($sub->category_id);
                            $ReadCatPosts->Execute()->Query("#category_id#");
                            $ContCatPost = $ReadCatPosts->Execute()->getRowCount();
                            ?>
                            <article<?php if ($a % 3 == 0) echo ' class="right"'; ?>>
                                <h1><a target="_blank" href="../categoria/<?= $sub->category_name; ?>" title="Ver Categoria"><?= $sub->category_title; ?></a>  ( <?= $ContCatPost ?> areas )</h1>
                                <ul class="info post_actions">
                                    <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($sub->category_date)); ?>Hs</li>
                                    <li><a class="act_edit" href="painel.php?exe=area_category/update&catid=<?= $sub->category_id; ?>" title="Editar">Editar</a></li>
                                    <li><a class="act_delete" href="painel.php?exe=area_category/index&delete=<?= $sub->category_id; ?>" title="Excluir">Deletar</a></li>
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