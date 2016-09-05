<div class="jumbotron">

    <article>
        <?php extract($_SESSION['userlogin']); ?>


        <h1 style="font-size: 2em;">Olá <?= "{$user_name} {$user_lastname}"; ?>, <small>atualize seus dados aqui!</small></h1>

        <?php
        $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $UserId = $_SESSION['userlogin']['user_id'];

        if ($ClienteData && $ClienteData['SendPostForm']):
            $ClienteData['user_cover'] = ( $_FILES['user_cover']['tmp_name'] ? $_FILES['user_cover'] : null);
            unset($ClienteData['SendPostForm']);

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

        <form method="post" name="UserEditForm" enctype="multipart/form-data" >

            <div class="col-md-12 well">
                <label>
                    Enviar Foto:
                    <input type="file" name="user_cover"/>
                </label>
            </div>

            <div class="col-md-12 well">
                <label class="col-md-5">
                    Nome:
                    <div class="input-group">
                        <span class="input-group-addon glyphicon glyphicon-tag"></span>
                        <input type="text" name="user_name" value="<?= $user_name; ?>" title="Informe seu primeiro nome" class="form-control" required />
                    </div>
                </label>

                <label class="col-md-7">
                    Sobrenome:
                    <div class="input-group">
                        <span class="input-group-addon glyphicon glyphicon-tags"></span>
                        <input type="text" name="user_lastname" value="<?= $user_lastname; ?>" title="Informe seu sobrenome" class="form-control" required />
                    </div>
                </label>
            </div>

            <?php
            $type = Check::AreaTypeByName("trabalho");
            ?>
            <div class="col-md-12 well">
                <label class="col-md-4">
                    Setor:
                    <div class="input-group">
                        <span class="input-group-addon glyphicon glyphicon-map-marker"></span>

                        <select class="form-control" name="area_id">
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
                    </div>
                </label>

                <label class="col-md-4">
                    User:
                    <div class="input-group">
                        <span class="input-group-addon glyphicon glyphicon-user"></span>
                        <input type="text" name="user_nickname" value="<?= (!empty($user_nickname) ? $user_nickname : ""); ?>" title="Usuario" class="form-control" disabled />
                        <input type="hidden" name="user_nickname" value="<?= (!empty($user_nickname) ? $user_nickname : ""); ?>" title="Usuario" class="form-control" />
                    </div>
                </label>

                <label class="col-md-4">
                    E-mail:
                    <div class="input-group">
                        <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                        <input type="email" name="user_email" value="<?= $user_email; ?>" title="Informe seu e-mail" class="form-control" required />
                    </div>
                </label>
            </div>

            <div class="col-md-12">
                <label class="col-md-4 well">
                    Data de Nascimento:
                    <div class="input-group">
                        <span class="input-group-addon glyphicon glyphicon-calendar"></span>
                        <input class="form-control formDate" text="date" name="user_birthday" value="<?= date('d/m/Y', strtotime($user_birthday)); ?>" title="data nascimento" required/>
                    </div>
                </label>

                <div id="updatePassword">
                    <div class="col-md-8 well">
                        <label class="col-md-6">
                            Senha:
                            <div class="input-group">
                                <span class="input-group-addon glyphicon glyphicon-lock"></span>
                                <input type="password" name="user_password" value="" title="Informe sua senha [ de 6 a 12 caracteres! ]" pattern = ".{6,12}" class="form-control" />
                            </div>
                        </label>

                        <label class="col-md-6">
                            Confirmação:
                            <div class="input-group">
                                <span class="input-group-addon glyphicon glyphicon-info-sign"></span>
                                <input type="password" name="user_confirme" value="" title="Informe sua senha [ de 6 a 12 caracteres! ]" pattern = ".{6,12}" class="form-control" />
                            </div>
                        </label>
                    </div>
                </div>
                
                <a id="openPass" class="btn btn-default">Alterar senha</a>
            </div>
            
            <div class="col-md-12">
                <hr>
                <input type="submit" name="SendPostForm" value="Atualizar Perfil" class="btn btn-primary btn-lg" />
            </div>
        </form>
    </article>

    <div class="clearfix"></div>
</div> <!-- content home -->