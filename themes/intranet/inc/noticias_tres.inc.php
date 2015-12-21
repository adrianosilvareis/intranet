<section class="section">
    <h1><small><?= $Titulo; ?></small></h1>
    <div class="well">
        <?php
        $cat = Check::CatByName($Categoria);
        $c = 0;
        $Read = new WsPosts();
        $Read->setPost_category($cat);
        $Read->Execute()->Query("post_status = 1 AND (post_category = :cat OR post_cat_parent = :cat) ORDER BY $Ordem DESC LIMIT 3", "cat={$cat}", true);
        if (!$Read->Execute()->getResult()):
            WSErro("Opps! Não temos artigos em destaques!", WS_INFOR);
        else:
            $View = new View();
            $new = $View->Load("noticias_m");
            foreach ($Read->Execute()->getResult() as $bar):
                $bar->datetime = date('Y-m-d', strtotime($bar->post_date));
                $bar->pubdate = date("d/m/Y H:i", strtotime($bar->post_date));
                $bar->post_content = Check::Words($bar->post_content, 30);
                $bar->class = ($c == 0 ? "item active" : "item");
                if (!$bar->post_url):
                    $bar->post_url = "#HOME#/artigo/$bar->post_name";
                endif;
                $View->Show((array) $bar, $new);
                $c++;
            endforeach;
            ?>
        <?php
        endif;
        ?>
    </div>
</section>
