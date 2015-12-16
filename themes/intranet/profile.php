<div class="jumbotron">

    <article>

        <?php extract($_SESSION['userlogin']); ?>

        <h1 style="font-size: 2em;">Olá <?= "{$user_name} {$user_lastname}"; ?>, atualize seu perfíl!</h1>

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

            if ($cadastra->getResult()):
                WSErro("Seus dados foram atualizados com sucesso! <i>O sistema será atualizado no próximo login!!!</i>", WS_ACCEPT);
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        else:
            extract($_SESSION['userlogin']);
        endif;
        ?>

        <form method="post" name="UserEditForm" >

            <label class="col-md-4">
                Nome:
                <input 
                    type="text" 
                    name="user_name" 
                    value="<?= $user_name; ?>" 
                    title="Informe seu primeiro nome" 
                    class="form-control"
                    required
                    />
            </label>

            <label class="col-md-6">
                Sobrenome:
                <input
                    type="text"
                    name="user_lastname"
                    value="<?= $user_lastname; ?>"
                    title="Informe seu sobrenome"
                    class="form-control"
                    required
                    />
            </label>

            <label class="col-md-10">
                E-mail:
                <input
                    type="email"
                    name="user_email"
                    value="<?= $user_email; ?>"
                    title="Informe seu e-mail"
                    class="form-control"
                    required
                    />
            </label>

            <label class="col-md-4">
                Senha:
                <input
                    type="password"
                    name="user_password"
                    required="true"
                    value=""
                    title="Informe sua senha [ de 6 a 12 caracteres! ]"
                    pattern = ".{6,12}"
                    class="form-control"
                    />
            </label>

            <div class="col-md-12">
                <input type="submit" name="SendPostForm" value="Atualizar Perfil" class="btn btn-primary btn-lg" />
            </div>

        </form>


    </article>

    <div class="clearfix"></div>
</div> <!-- content home -->