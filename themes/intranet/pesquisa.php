<?php
$search = $Link->getLocal()[1];
$count = ($Link->getData()['count'] ? $Link->getData()['count'] : '0');
$View = new View();
$tpl_cat = $View->Load('article_m');
$tpl_age = $View->Load('agenda_m');
$tpl_inc = $View->Load('inco_list');
$tpl_par = $View->Load('part_list');
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

        $Pager->ExePaginator("ws_posts", "post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%')", "link={$search}");

        echo '<nav class="paginator">';
        echo $Pager->getPaginator();
        echo '</nav>';

        $readInco = new SftOutputInco();

        $sql = "SELECT i.inco_dt_regis as 'data', i.inco_ob_obsinco as 'OBS', i.inco_os_numos as 'os',"
                . "a.aten_nm_nmaten as 'Atendente', a.aten_us_usaten as 'user_aten',"
                . "m.descricao as 'convenio', c.codigo as 'COD. CONV.',"
                . "n.ncon_nm_nmncon as 'nao_conformidade',"
                . "s.status_nm_descricao as 'status',"
                . "u.unid_nm_nmunid as 'unidade', u.unid_cod_codigo as 'Uni. num.'"
                . "FROM sft_output_inco i "
                . "JOIN sft_input_aten a ON(a.aten_id_idaten = i.fk_aten)"
                . "JOIN fat_convenio c ON(c.id = i.fk_conv)"
                . "JOIN fat_mascara_convenio m ON(m.id = c.mascara_convenio_id)"
                . "JOIN sft_input_ncon n ON(n.ncon_id_idncon = i.fk_ncon)"
                . "JOIN sft_input_stat s ON(s.status_id_idstatus = i.fk_stat)"
                . "JOIN sft_input_unid u ON(u.unid_id_idunid = i.fk_unid)"
                . "WHERE u.unid_nm_nmunid LIKE '%' :link '%' OR a.aten_nm_nmaten LIKE '%' :link '%'"
                . "ORDER by i.inco_dt_regis DESC LIMIT 50;";

        $readInco->Execute()->FullRead($sql, "link={$search}", true);
        ?>

        <hr>
        <section class="section">
            <header>
                <h2>Inconsistências:</h2>
                <p>Sua pesquisa por <?= $search; ?> retornou <?= $readInco->Execute()->getRowCount(); ?> resultados:</p>
            </header>
        </section>
        
        <?php
        if (!$readInco->Execute()->getResult()):
            WSErro("Desculpe, sua pesquisa não encontrou mais inconsistências. Você pode resulmir sua pesquisa ou tentar outros termos!", WS_INFOR);
        else:
            $cc = 0;
            echo "<div class='row' style='height: 280px; overflow: auto;'>\n";
            echo "<table class='table table-hover table-striped'>";
            echo "<thead>
                        <tr>
                            <th>OS</th>
                            <th>Atendente</th>
                            <th>data</th>
                            <th>convenio</th>
                            <th>Não conformidade</th>
                            <th>Unidade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($readInco->Execute()->getResult() as $inc):
                $inc->data = date("d/m/Y", strtotime($inc->data));
                $View->Show((array) $inc, $tpl_inc);
            endforeach;
            echo "</tbody>"
            . "</table >";
            echo "</div>\n";
        endif;
        
        
        $readPart = new SftOutputPart();
        $sql = "SELECT 
            p.part_data_regist as 'data', p.part_nm_paciente as 'paciente', p.part_os_ospart as 'os', p.part_vl_debito as 'debito',
            p.part_vl_desc as 'desconto', p.part_vl_liquido as 'liquido', p.part_vl_pago as 'pago', p.part_vl_total as 'total',
            a.aten_nm_nmaten as 'atendente', a.aten_us_usaten as 'user_aten', 
            u.unid_nm_nmunid as 'unidade'
            FROM sft_output_part p JOIN sft_input_aten a ON(a.aten_id_idaten = p.fk_aten)
            JOIN sft_input_unid u ON(u.unid_id_idunid = p.fk_unid)
            WHERE u.unid_nm_nmunid LIKE '%' :link '%' OR a.aten_nm_nmaten LIKE '%' :link '%'";
        
        $readPart->Execute()->FullRead($sql, "link={$search}", true);
        
        ?>

        <hr>
        <section class="section">
            <header>
                <h2>Os Não Pagas:</h2>
                <p>Sua pesquisa por <?= $search; ?> retornou <?= $readPart->Execute()->getRowCount(); ?> resultados:</p>
            </header>
        </section>
        
        <?php
        if (!$readPart->Execute()->getResult()):
            WSErro("Desculpe, sua pesquisa não encontrou os não pagas. Você pode resulmir sua pesquisa ou tentar outros termos!", WS_INFOR);
        else:
            $cc = 0;
            echo "<div class='row' style='height: 280px; overflow: auto;'>\n";
            echo "<table class='table table-hover table-striped'>";
            echo "<thead>
                        <tr>
                            <th>OS</th>
                            <th>Atendente</th>
                            <th>Unidade</th>
                            <th>Data</th>
                            <th>Paciente</th>
                            <th>Total</th>
                            <th>Desconto</th>
                            <th>Liquido</th>
                            <th>Valor pago</th>
                            <th>Debito</th>   
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($readPart->Execute()->getResult() as $par):
                $par->total = Check::Monetize($par->total);
                $par->desconto = Check::Monetize($par->desconto);
                $par->liquido = Check::Monetize($par->liquido);
                $par->pago = Check::Monetize($par->pago);
                $par->debito = Check::Monetize($par->debito);
                $View->Show((array) $par, $tpl_par);
            endforeach;
            echo "</tbody>"
            . "</table >";
            echo "</div>\n";
        endif;
        
        
//        SELECT g.glos_dt_regis as 'data', g.glos_ob_obsglos as 'OBS', g.glos_os_numos as 'OS', g.glos_vl_vlos as 'Valor',
//        a.aten_nm_nmaten as 'atendente', a.aten_us_usaten as 'user_aten',
//        m.descricao as 'convenio', c.codigo as 'Cod. Convenio',
//        n.ncon_nm_nmncon as 'nao_conformidade', s.status_nm_descricao as 'status',
//        u.unid_cod_codigo as 'numero_unidade', u.unid_nm_nmunid as 'unidade'
//
//        FROM sft_output_glos g
//        JOIN sft_input_aten a ON(a.aten_id_idaten = g.fk_aten)
//        JOIN fat_convenio c ON(c.id = g.fk_conv)
//        JOIN fat_mascara_convenio m ON(m.id = c.mascara_convenio_id)
//        JOIN sft_input_ncon n ON(n.ncon_id_idncon = g.fk_ncon)
//        JOIN sft_input_stat s ON(s.status_id_idstatus = g.fk_stat)
//        JOIN sft_input_unid u ON(u.unid_id_idunid = g.fk_unid)
//        WHERE u.unid_nm_nmunid like "%alto%";

        ?>

    </div>
</section>