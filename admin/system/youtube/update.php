<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Post:</h1>
        </header>

        <?php
        $tube = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $tubeId = filter_input(INPUT_GET, 'tubeId', FILTER_VALIDATE_INT);


        if (isset($tube) && $tube['SendPostForm']):
            $tube['youtube_status'] = ( $tube['SendPostForm'] == 'Atualizar' ? '0' : '1');
            unset($tube['SendPostForm']);

            require_once '_models/AdminYoutube.class.php';

            $cadastra = new AdminYoutube();
            $cadastra->ExeUpdate($tubeId, $tube);

            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        else:
            $Read = new AppYoutube();
            $Read->setYoutube_id($tubeId);
            $Read->Execute()->find();
            if (!$Read->Execute()->getResult()):
                header('Location: painel.php?exe=youtube/index&empty=true');
            else:
                $tube = (array) $Read->Execute()->getResult();
                $tube['youtube_date'] = date('d/m/Y H:i:s', strtotime($tube['youtube_date']));
            endif;
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if ($checkCreate && empty($cadastra)):
            WSErro("O video <b>{$tube['youtube_title']}</b> foi cadastrado com sucesso no sistema, continue alterando o mesmo!", WS_ACCEPT);
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

            <input type="submit" class="btn blue" value="Atualizar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Atualizar & Publicar" name="SendPostForm" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->