<div class="content form_create">

    <article>

        <h1>Usuários: <a href="painel.php?exe=users/create" title="Cadastrar Novo" class="user_cad">Cadastrar Usuário</a></h1>

        <?php
        $delUser = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_BOOLEAN);
        $user = filter_input(INPUT_GET, 'users', FILTER_VALIDATE_INT);
        require_once '_models/AdminUsers.class.php';
        $AdminUsers = new AdminUsers();
        if ($delUser):
            $AdminUsers->ExeDelete($user);
            WSErro($AdminUsers->getError()[0], $AdminUsers->getError()[1]);
        endif;
        ?>

        <ul class="ultable">
            <li class="t_title">
                <span class="ui center">Res:</span>
                <span class="un">Nome:</span>
                <span class="ue">E-mail:</span>
                <span class="ur center">Registro:</span>
                <span class="ua center">Atualização:</span>
                <span class="ul center">Nível:</span>
                <span class="ed center">-</span>
            </li>

            <?php
            $WsUsers = $AdminUsers->checkLast();
            if ($WsUsers->Execute()->getResult()):
                foreach ($WsUsers->Execute()->getResult() as $users):
                    extract((array) $users);
                    $user_lastupdate = ($user_lastupdate ? date('d/m/Y H:i', strtotime($user_lastupdate)) . ' hs' : '-');
                    $nivel = ['', 'User', 'Editor', 'Admin'];
                    ?>            
                    <li>
                        <span class="ui center"><?= $user; ?></span>
                        <span class="un"><?= $user_name . ' ' . $user_lastname; ?></span>
                        <span class="ue"><?= $user_email; ?></span>
                        <span class="ur center"><?= date('d/m/Y', strtotime($user_registration)); ?></span>
                        <span class="ua center"><?= $user_lastupdate; ?>Hs</span>
                        <span class="ul center"><?= $nivel[$user_level]; ?></span>
                        <span class="ed center">
                            <a href="painel.php?exe=users/update&users=<?= $user_id; ?>" title="Editar" class="action user_edit">Editar</a>
                            <a href="painel.php?exe=users/users&delete=true&users=<?= $user_id; ?>" title="Deletar" class="action user_dele">Deletar</a>
                        </span>
                    </li>
                    <?php
                endforeach;
            endif;
            ?>

        </ul>


    </article>

    <div class="clear"></div>
</div> <!-- content home -->