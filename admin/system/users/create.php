<div class="content form_create">

    <article>

        <h1>Cadastrar Usuário!</h1>

        <?php
        $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($ClienteData && $ClienteData['SendPostForm']):
            unset($ClienteData['SendPostForm']);
            require_once '_models/AdminUsers.class.php';
            $AdminUsers = new AdminUsers;
            $AdminUsers->ExeCreate($ClienteData);

            if ($AdminUsers->getResult()):
                header('Location: painel.php?exe=users/update&create=true&users=' . $AdminUsers->getResult());
            else:
                WSErro($AdminUsers->getError()[0], $AdminUsers->getError()[1]);
            endif;
        endif;
        ?>

        <form action = "" method = "post" name = "UserCreateForm">
            <label class="label">
                <span class="field">User:</span>
                <input
                    type = "text"
                    name = "user_nickname"
                    value="<?php if (!empty($ClienteData['user_nickname'])) echo $ClienteData['user_nickname']; ?>"
                    title = "Informe seu usuario"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">Nome:</span>
                <input
                    type = "text"
                    name = "user_name"
                    value="<?php if (!empty($ClienteData['user_name'])) echo $ClienteData['user_name']; ?>"
                    title = "Informe seu primeiro nome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">Sobrenome:</span>
                <input
                    type = "text"
                    name = "user_lastname"
                    value="<?php if (!empty($ClienteData['user_lastname'])) echo $ClienteData['user_lastname']; ?>"
                    title = "Informe seu sobrenome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">E-mail:</span>
                <input
                    type = "email"
                    name = "user_email"
                    value="<?php if (!empty($ClienteData['user_email'])) echo $ClienteData['user_email']; ?>"
                    title = "Informe seu e-mail"
                    required
                    />
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
                    <select name="area_id" title="Selecione o nível de usuário" required >
                        <option value = "">Selecione o Nível</option>
                        <?php
                        $WsAreaTrabalho = new WsAreaTrabalho();
                        $WsAreaTrabalho->Execute()->findAll();
                        foreach ($WsAreaTrabalho->Execute()->getResult() as $setor) :
                            echo "\n<option value='{$setor->area_id}'>{$setor->area_title}</option>";
                        endforeach;
                        ?>
                    </select>
                </label>

                <label class="label_medium">
                    <span class="field">Nível:</span>
                    <select name="perfil_id" title="Selecione o nível de usuário" required >
                        <option value="">Selecione o Nível</option>
                        <?php
                        $WsPerfil = new WsPerfil();
                        $WsPerfil->Execute()->findAll();
                        foreach ($WsPerfil->Execute()->getResult() as $perfil) :
                            echo "\n<option value='{$perfil->perfil_id}'>{$perfil->perfil_title}</option>";
                        endforeach;
                        ?>
                    </select>
                </label>
            </div><!-- LABEL LINE -->

            <input type="submit" name="SendPostForm" value="Cadastrar Usuário" class="btn green" />
        </form>

    </article>
    <div class="clear"></div>
</div> <!-- content home -->