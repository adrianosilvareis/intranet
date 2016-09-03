<?php
$search = $Link->getLocal()[1];
$count = ($Link->getData()['count'] ? $Link->getData()['count'] : '0');
$View = new View();
$tpl_cat = $View->Load('article_m');
$tpl_age = $View->Load('agenda_m');
$tpl_ani = $View->Load('niver_m');
$tpl_inco = $View->Load('inco_list');
$tpl_part = $View->Load('part_list');
$tpl_glos = $View->Load('glos_list');
?>

<section class="section">
    <div class="container">
        <section class="section">
            <header>
                <h2>Pesquisa por: "<?= $search; ?>"</h2>
                <p>Sua pesquisa por <?= $search; ?> retornou <?= $count; ?> resultados:</p>
            </header>
        </section>

        <?php
        //
        //POSTs
        //
        $getPage = (int) (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
        $Pager = new Pager(HOME . '/pesquisa/' . $search . '/');
        $Pager->ExePager($getPage, 8);

        $readArt = new WsPosts();
        $readArt->Execute()->Query("post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%') ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "link={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
        if (!$readArt->Execute()->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpe, sua pesquisa não encontrou posts. Você pode resulmir sua pesquisa ou tentar outros termos!", WS_INFOR);
        else:
            $cc = 0;
            echo "<div class='row'>\n";
            foreach ($readArt->Execute()->getResult() as $cat):
                $cat->post_title = Check::Words($cat->post_title, 8);
                $cat->post_content = Check::Words($cat->post_content, 20);
                $cat->datetime = date('Y-m-d', strtotime($cat->post_date));
                $cat->pubdate = date('d/m/Y H:i', strtotime($cat->post_date));
                echo ($cc % 4 == 0 ? "<div class='row'>\n</div>\n" : "");
                echo "<div class='col-md-3'>";
                $View->Show((array) $cat, $tpl_cat);
                echo "</div>\n";
                $cc++;
            endforeach;
            echo "</div>\n";
        endif;

        /**
         * Agenda
         */
        $readAge = new AgendaContatos();
        $readAge->Execute()->FullRead("SELECT * FROM agenda_contatos a "
                . "JOIN ws_setor s ON(s.setor_id = a.setor_id) "
                . "JOIN agenda_endereco e ON(e.endereco_id = a.endereco_id) "
                . "JOIN app_cidades c ON(c.cidade_id = e.app_cidade) "
                . "WHERE a.contato_descricao LIKE '%' :link '%' OR s.setor_content LIKE '%' :link '%'"
                . "ORDER BY contato_descricao LIMIT :limit OFFSET :offset", "link={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
        ?>

        <hr>
        <section class="section">
            <header>
                <h2>Contatos:</h2>
                <p>Sua pesquisa por <?= $search; ?> retornou <?= $readAge->Execute()->getRowCount(); ?> resultados:</p>
            </header>
        </section>

        <?php
        if (!$readAge->Execute()->getResult()):
            WSErro("Desculpe, sua pesquisa não encontrou mais contatos. Você pode resulmir sua pesquisa ou tentar outros termos!", WS_INFOR);
        else:
            $cc = 0;
            echo "<div class='row'>\n";
            foreach ($readAge->Execute()->getResult() as $age):

                echo ($cc % 4 == 0 ? "<div class='row'>\n</div>\n" : "");
                echo "<div class='col-md-3'>";
                $View->Show((array) $age, $tpl_age);
                echo "</div>\n";
                $cc++;
            endforeach;
            echo "</div>\n";
        endif;

        /**
         * Aniversariantes do Mês
         */
        $readAni = new AppNiver();
        $readAni->Execute()->FullRead("SELECT * FROM app_niver "
                . "WHERE niver_nome LIKE '%' :link '%' OR niver_setor LIKE '%' :link '%' "
                . "ORDER BY niver_data", "link={$search}", true);
        ?>

        <hr>
        <section class="section">
            <header>
                <h2>Aniversáriantes do mês:</h2>
                <p>Sua pesquisa por <?= $search; ?> retornou <?= $readAni->Execute()->getRowCount(); ?> resultados:</p>
            </header>
        </section>

        <?php
        if (!$readAni->Execute()->getResult()):
            WSErro("Desculpe, sua pesquisa não encontrou mais aniveráriantes. Você pode resulmir sua pesquisa ou tentar outros termos!", WS_INFOR);
        else:
            $cc = 0;
            echo "<div class='row'>\n";
            foreach ($readAni->Execute()->getResult() as $ani):

                echo ($cc % 4 == 0 ? "<div class='row'>\n</div>\n" : "");
                echo "<div class='col-md-3'>";
                $ani->niver_data = date('d/m/Y', strtotime($ani->niver_data));
                $View->Show((array) $ani, $tpl_ani);
                echo "</div>\n";
                $cc++;
            endforeach;
            echo "</div>\n";
        endif;

        $Pager->ExePaginator("ws_posts", "post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%')", "link={$search}");

        echo '<nav class="paginator">';
        echo $Pager->getPaginator();
        echo '</nav>';
        ?>
        <hr>
    </div>
</section>