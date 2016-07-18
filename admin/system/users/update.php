<div class="content form_create">

    <article>

        <h1>Atualizar Usuário!</h1>

        <?php
        $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $User = filter_input(INPUT_GET, 'users', FILTER_VALIDATE_INT);

        if ($ClienteData && $ClienteData['SendPostForm']):
            unset($ClienteData['SendPostForm']);
            require_once '_models/AdminUsers.class.php';
            $AdminUsers = new AdminUsers;
            $AdminUsers->ExeUpdate($User, $ClienteData);

            WSErro($AdminUsers->getError()[0], $AdminUsers->getError()[1]);
        else:
            $Read = new WsUsers();
            $Read->setUser_id($User);
            $Read->Execute()->Query("#user_id#");
            if ($Read->Execute()->getResult()):
                $ClienteData = (array) $Read->Execute()->getResult()[0];
                unset($ClienteData['user_password']);
            endif;
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if ($checkCreate && empty($AdminUsers)):
            WSErro("O Usuário <b>{$ClienteData['user_name']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
        endif;
        ?>

        <form action = "" method = "post" name = "UserCreateForm">

            <label class="label">
                <span class="field">User:</span>
                <input type = "text" name = "user_nickname" value="<?php if (!empty($ClienteData['user_nickname'])) echo strtoupper($ClienteData['user_nickname']); ?>" title = "Informe seu usuario" required />
            </label>

            <label class="label">
                <span class="field">Nome:</span>
                <input type="text" name="user_name" value="<?php if (!empty($ClienteData['user_name'])) echo $ClienteData['user_name']; ?>" title="Informe seu primeiro nome" required />
            </label>

            <label class="label">
                <span class="field">Sobrenome:</span>
                <input type="text" name="user_lastname" value="<?php if (!empty($ClienteData['user_lastname'])) echo $ClienteData['user_lastname']; ?>" title = "Informe seu sobrenome" required />
            </label>

            <label class="label">
                <span class="field">E-mail:</span>
                <input type="email" name="user_email" value="<?php if (!empty($ClienteData['user_email'])) echo $ClienteData['user_email']; ?>" title="Informe seu e-mail" required />
            </label>

            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Senha:</span>
                    <input type="password" name="user_password" value="<?php if (!empty($ClienteData['user_password'])) echo $ClienteData['user_password']; ?>" title="Informe sua senha [ de 6 a 12 caracteres! ]" pattern=".{6,12}" required />
                </label>

                <label class="label_medium">
                    <span class="field">Data Nascimento:</span>
                    <input class="formDate" type="text" name="user_birthday" value="<?php if (!empty($ClienteData['user_birthday'])) echo $ClienteData['user_birthday']; ?>" title="Informe sua data de nascimento" required />
                </label>
            </div>

            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Setor de trabalho:</span>
                    <select name = "area_id" title = "Selecione o nível de usuário" required >
                        <option value = "">Selecione o Nível</option>
                        <?php
                        $WsAreaTrabalho = new WsAreaTrabalho();
                        $WsAreaTrabalho->Execute()->findAll();
                        foreach ($WsAreaTrabalho->Execute()->getResult() as $setor) :
                            $select = (isset($ClienteData['area_id']) && $ClienteData['area_id'] == $setor->area_id ? "selected='selected'" : '');
                            echo "\n<option value='{$setor->area_id}' {$select}>{$setor->area_title}</option>";
                        endforeach;
                        ?>
                    </select>
                </label>

                <label class="label_medium">
                    <span class="field">Perfil de acesso:</span>
                    <select name="perfil_id" title="Selecione o nível de usuário" required >
                        <option value="">Selecione o Nível</option>
                        <?php
                        unset($select);
                        $WsPerfil = new WsPerfil();
                        $WsPerfil->Execute()->findAll();
                        foreach ($WsPerfil->Execute()->getResult() as $perfil) :
                            $select = (isset($ClienteData['perfil_id']) && $ClienteData['perfil_id'] == $perfil->perfil_id ? "selected='selected'" : '');
                            echo "\n<option value='{$perfil->perfil_id}' {$select}>{$perfil->perfil_title}</option>";
                        endforeach;
                        ?>
                    </select>
                </label>
            </div><!-- LABEL LINE -->

            <input type="submit" name="SendPostForm" value="Atualizar Usuário" class="btn blue" />
        </form>

    </article>
    <div class="clear"></div>
</div> <!-- content home -->