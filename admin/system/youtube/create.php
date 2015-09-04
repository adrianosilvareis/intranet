<div class="content form_create">    
    
    <article>

        <header>
            <h1>Criar Videos do youtube:</h1>
        </header>

        <?php
        $tube = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($tube) && $tube['SendPostForm']):
            $tube['youtube_status'] = ( $tube['SendPostForm'] == 'Cadastrar' ? '0' : '1');
            unset($tube['SendPostForm']);
            
            require '_models/AdminYoutube.class.php';
            $cadastra = new AdminYoutube();
            
            $cadastra->ExeCreate($tube);

            if ($cadastra->getResult()):
                header('Location: painel.php?exe=youtube/update&create=true&tubeId=' . $cadastra->getResult());
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="youtube_title" value="<?php if (isset($tube['youtube_title'])) echo $tube['youtube_title']; ?>" />
            </label>

            <label class="label">
                <span class="field">URL:</span>
                <input type="text" name="youtube_url" value="<?php if (isset($tube['youtube_url'])) echo $tube['youtube_url']; ?>" placeholder="YZnd1dYiIbc" />
           </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="youtube_date" value="<?php
                    if (isset($tube['youtube_date'])): echo $tube['youtube_date'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Author:</span>
                    <select name="youtube_author">
                        <option value="<?= $_SESSION['userlogin']['user_id'] ?>"> <?= "{$_SESSION['userlogin']['user_name']} {$_SESSION['userlogin']['user_lastname']}"; ?> </option>
                        <?php
                        $ReadAut = new WsUsers;
                        $ReadAut->setUser_id($_SESSION['userlogin']['user_id']);
                        $ReadAut->setUser_level(2);
                        $ReadAut->Execute()->Query("user_id != :user_id AND user_level >= :user_level ORDER BY user_name ASC");
                        if ($ReadAut->Execute()->getRowCount() >= 1):
                            foreach ($ReadAut->Execute()->getResult() as $aut):
                                echo "<option ";

                                if ($tube['youtube_author'] == $aut->user_id):
                                    echo "selected = \"selected\" ";
                                endif;

                                echo "value=\"{$aut->user_id}\"> {$aut->user_name} {$aut->user_lastname} </option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

            </div><!--/line-->

            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostForm" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->