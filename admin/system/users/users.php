<div class="content form_create">

    <article>

        <h1>Usuários: 
            <a href="painel.php?exe=area_trabalho/index" title="Cadastrar Novo" class="user_cad">Área de trabalho</a>
            <a href="painel.php?exe=perfil/index" title="Cadastrar Novo" class="user_cad">Perfil de usuários</a>
            <a href="painel.php?exe=users/create" title="Cadastrar Novo" class="user_cad">Cadastrar Usuário</a>
        </h1>

        <form method="post">
            <label class="label_medium">
                <input name="search" type="text" placeholder="pequise aqui"/>
            </label>
            <button class="btn blue">Pesquise</button>
        </form>

        <?php
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        $user = filter_input(INPUT_GET, 'users', FILTER_VALIDATE_INT);

        require_once '_models/AdminUsers.class.php';
        $AdminUsers = new AdminUsers();

        if ($action):
            switch ($action):
                case 'active':
                    $AdminUsers->ExeStatus($user, '1');
                    WSErro($AdminUsers->getError()[0], $AdminUsers->getError()[1]);
                    break;

                case 'inative':
                    $AdminUsers->ExeStatus($user, '0');
                    WSErro($AdminUsers->getError()[0], $AdminUsers->getError()[1]);
                    break;

                default:
                    WSErro("Ação não foi identificada pelo sistema, favor utilize os botões", WS_ERROR);
                    break;
            endswitch;
        endif;
        ?>

        <ul class="ultable">
            <li class="t_title">
                <span class="ui center">User:</span>
                <span class="un">Nome:</span>
                <span class="ue">E-mail:</span>
                <span class="ur center">Nascimento:</span>
                <span class="ua center">Atualização:</span>
                <span class="ul center">Nível:</span>
                <span class="ed center">-</span>
            </li>

            <?php
            $search = filter_input(INPUT_POST, 'search', FILTER_DEFAULT);

            if ($search):
                $WsUsers = new WsUsers();
                $WsUsers->Execute()->Query("user_nickname like '%$search%' OR user_name like '%$search%'");
            else:
                $WsUsers = $AdminUsers->checkLast();
            endif;

            if ($WsUsers->Execute()->getResult()):
                foreach ($WsUsers->Execute()->getResult() as $users):
                    extract((array) $users);
                    $user_lastupdate = ($user_lastupdate ? date('d/m/Y H:i', strtotime($user_lastupdate)) . ' hs' : '-');
                    $nivel = ['', 'Admin', 'Editor', 'Exec', 'Solic', 'User'];
                    ?>            
                    <li>
                        <span class="ui center"><?= strtoupper($user_nickname); ?></span>
                        <span class="un"><?= $user_name . ' ' . $user_lastname; ?></span>
                        <span class="ue"><?= $user_email; ?></span>
                        <span class="ur center"><?= date('d/m/Y', strtotime($user_birthday)); ?></span>
                        <span class="ua center"><?= $user_lastupdate; ?>Hs</span>
                        <span class="ul center"><?= $nivel[$user_level]; ?></span>
                        <span class="ed center">
                            <a href="painel.php?exe=users/update&users=<?= $user_id; ?>" title="Editar" class="action user_edit">Editar</a>
                            <!--<a href="painel.php?exe=users/users&delete=true&users=<?= $user_id; ?>" title="Deletar" class="action user_dele">Deletar</a>-->
                            <?php if (!$user_status): ?>
                                <a class="action user_ative" href="painel.php?exe=users/users&users=<?= $user_id; ?>&action=active" title="Ativar">Ativar</a>
                            <?php else: ?>
                                <a class="action user_inative" href="painel.php?exe=users/users&users=<?= $user_id; ?>&action=inative" title="Inativar">Inativar</a>
                            <?php endif; ?>
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