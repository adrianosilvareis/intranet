<?php if (!empty($fixo) || !empty($cat)): ?>
    <aside class="col-md-3 siderbar">

        <!--siderbar looper-->
        <div class="row">
            <?php
            $Read = new WsPosts();
            $Read->setPost_category($cat);
            $Read->Execute()->Query("post_status = 1 AND (post_category = :cat OR post_cat_parent = :cat) ORDER BY post_date LIMIT 3", "cat={$cat}", true);
            if (!$Read->Execute()->getResult()):
                WSErro("Opps! Não temos artigos para a barra lateral", WS_INFOR);
            else:
                $View = new View();
                $siderbar = $View->Load("article_siderbar");
                foreach ($Read->Execute()->getResult() as $bar):
                    $bar->datetime = date('Y-m-d', strtotime($bar->post_date));
                    $bar->pubdate = date("d/m/Y H:i", strtotime($bar->post_date));
                    $bar->post_content = Check::Words($bar->post_content, 6);
                    if (!$bar->post_url):
                        $bar->post_url = "#HOME#/plugin/$bar->post_name";
                    endif;
                    $View->Show((array) $bar, $siderbar);
                endforeach;
            endif;

            if (isset($fixo)):
                $Read->Execute()->Query("post_status = 1 AND (post_category = :cat OR post_cat_parent = :cat) ORDER BY post_date LIMIT 3", "cat={$fixo}", true);
                if (!$Read->Execute()->getResult()):
                    WSErro("Opps! Não temos artigos para a barra lateral", WS_INFOR);
                else:
                    $View = new View();
                    $siderbar = $View->Load("article_siderbar_fixo");
                    foreach ($Read->Execute()->getResult() as $bar):
                        $bar->datetime = date('Y-m-d', strtotime($bar->post_date));
                        $bar->pubdate = date("d/m/Y H:i", strtotime($bar->post_date));
                        $bar->post_content = Check::Words($bar->post_content, 6);
                        if (!$bar->post_url):
                            $bar->post_url = "#HOME#/plugin/$bar->post_name";
                        endif;
                        $View->Show((array) $bar, $siderbar);
                    endforeach;
                endif;
            endif;
            ?>
        </div>

    </aside>

    <?php
 endif;