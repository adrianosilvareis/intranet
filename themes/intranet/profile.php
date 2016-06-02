<div class="jumbotron">

    <article>
        <?php extract($_SESSION['userlogin']);?>
        
        
        <h1 style="font-size: 2em;">Olá <?= "{$user_name} {$user_lastname}"; ?>, <small>atualize seus dados aqui!</small></h1>

        <?php
        $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $UserId = $_SESSION['userlogin']['user_id'];

        if ($ClienteData && $ClienteData['SendPostForm']):
            unset($ClienteData['SendPostForm']);

            extract($ClienteData);
            require('admin/_models/AdminUsers.class.php');
            $cadastra = new AdminUsers;
            $ClienteData['user_level'] = null;
            
            $cadastra->ExeUpdate($UserId, $ClienteData);

            if ($ClienteData['user_password'] == $ClienteData['user_confirme']):
                if ($cadastra->getResult()):
                    WSErro("Seus dados foram atualizados com sucesso! <i>O sistema será atualizado no próximo login!!!</i>", WS_ACCEPT);
                else:
                    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
                endif;
            else:
                WSErro("A Senha e a confirmação devem ser iguais.", WS_ERROR);
            endif;
        else:
            extract($_SESSION['userlogin']);
        endif;
        ?>

        <form method="post" name="UserEditForm" >

            <div class="col-md-12 well">
                <label class="col-md-5">
                    Nome:
                    <input type="text" name="user_name" value="<?= $user_name; ?>" title="Informe seu primeiro nome" class="form-control" required />
                </label>

                <label class="col-md-7">
                    Sobrenome:
                    <input type="text" name="user_lastname" value="<?= $user_lastname; ?>" title="Informe seu sobrenome" class="form-control" required />
                </label>
            </div>

            <?php
            $type = Check::AreaTypeByName("trabalho");
          
            ?>
            <div class="col-md-12 well">
                <label class="col-md-4">
                    Setor:
                    <select class="form-control" name="setor_id">
                        <option value="">Selecione uma area de trabalho</option>
                        <?php
                        if (!empty($type)):
                            $WsSetor = new WsAreaTrabalho();
                            $WsSetor->setCategory_id($type);
                            $WsSetor->setCategory_parent($type);
                            $WsSetor->Execute()->FullRead("SELECT * FROM ws_area_trabalho WHERE (category_id = :category_id OR category_parent = :category_parent) AND area_status = 1");
                            
                            foreach ($WsSetor->Execute()->getResult() as $setor) :
                                $select = (isset($area_id) && $area_id == $setor->area_id ? "selected='selected'" : '');
                                echo "\n<option value='{$setor->area_id}' {$select}>{$setor->area_title}</option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

                <label class="col-md-4">
                    User:
                    <input type="text" name="user_nickname" value="<?= (!empty($user_nickname) ? $user_nickname : ""); ?>" title="Usuario" class="form-control" disabled />
                    <input type="hidden" name="user_nickname" value="<?= (!empty($user_nickname) ? $user_nickname : ""); ?>" title="Usuario" class="form-control" />
                </label>

                <label class="col-md-4">
                    E-mail:
                    <input type="email" name="user_email" value="<?= $user_email; ?>" title="Informe seu e-mail" class="form-control" required />
                </label>
            </div>

            <div class="col-md-8 well">
                <label class="col-md-6">
                    Senha:
                    <input type="password" name="user_password" required="true" value="" title="Informe sua senha [ de 6 a 12 caracteres! ]" pattern = ".{6,12}" class="form-control" />
                </label>

                <label class="col-md-6">
                    Confirmação:
                    <input type="password" name="user_confirme" required="true" value="" title="Informe sua senha [ de 6 a 12 caracteres! ]" pattern = ".{6,12}" class="form-control" />
                </label>
            </div>

            <div class="col-md-12">
                <input type="submit" name="SendPostForm" value="Atualizar Perfil" class="btn btn-primary btn-lg" />
            </div>
        </form>
    </article>

    <div class="clearfix"></div>
</div> <!-- content home -->