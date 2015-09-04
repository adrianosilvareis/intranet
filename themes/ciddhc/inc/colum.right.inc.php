<aside class="col-md-4">
    <h1 class="semantica">SIDERBAR RIGHT</h1>
    <section class="nomargin section">
        <h1 class="nomargin"><a href="<?= HOME ?>/categoria/links/" class="btn btn-site">Links</a></h1>
        <?php
        $cat = Check::CatByName('links');
        $Read->Execute()->Query("post_status = 1 AND post_type = 'post' AND (post_cat_parent = :cat OR post_category = :cat) ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "cat={$cat}&limit=2&offset=0", true);
        if (!$Read->Execute()->getResult()):
            echo "<div style='display: block;margin-top:40px;'>\n";
            WSErro("Desculpe, não temos posts no momento, favor volte mais tarde!", WS_INFOR);
            echo "</div>\n";
        else:
            foreach ($Read->Execute()->getResult() as $row):
                echo "<div class='lateral'>";
                $row->datetime = date('Y-m-d', strtotime($row->post_date));
                $row->pubdate = date("d/m/Y H:i", strtotime($row->post_date));
                $View->Show((array) $row, $tpl_m);
                echo "</div>";
            endforeach;
        endif;
        ?>
    </section>

    <!--facebook-->
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-like"></div><!--facebook-->

</aside>