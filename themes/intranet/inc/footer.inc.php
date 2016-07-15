<footer class="navbar bg-sucesso footer">
    <div class="container">

        <section class="row text-center">
            <h1 class="notitle">Intranet Tommasi | Informativos</h1>

            <article class="col-md-4 well">

                <h1 class="notitle">Grupo Tommasi</h1>
                <div class="col-md-2"><a title="Analitica" href="http://www.tommasianalitica.com.br/" target="_blank"><img src="<?= HOME . '/themes/' . THEME ?>/images/icon/analitica.png" alt="Analitica" class="img-responsive"></a></div>
                <div class="col-md-2"><a title="Crio Banco" href="http://www.criobanco.com.br/" target="_blank"><img src="<?= HOME . '/themes/' . THEME ?>/images/icon/crio.png" alt="" class="img-responsive"></a></div>
                <div class="col-md-2"><a title="e-DNA" href="http://e-dna.com.br/" target="_blank"><img src="<?= HOME . '/themes/' . THEME ?>/images/icon/dna.png" alt="" class="img-responsive"></a></div>
                <div class="col-md-2"><a title="Importação" href="http://www.tommasitrading.com.br/portugues/" target="_blank"><img src="<?= HOME . '/themes/' . THEME ?>/images/icon/import.png" alt="" class="img-responsive"></a></div>
                <div class="col-md-2"><a title="Instituto Tommasi" href="http://www.institutotommasi.org.br/" target="_blank"><img src="<?= HOME . '/themes/' . THEME ?>/images/icon/insti.png" alt="" class="img-responsive"></a></div>
                <div class="col-md-2"><a title="Tommasi Laboratorio" href="http://www.tommasi.com.br/" target="_blank"><img src="<?= HOME . '/themes/' . THEME ?>/images/icon/labo.png" alt="" class="img-responsive"></a></div>
            </article>

            <div class="col-md-4 col-md-offset-4"><p class="text-branco">Suporte 24H: (27) 9 9901-3339</p></div>
        </section>

        <section class="row">

            <div class="col-md-4" style="float: right">
                <h1 class="title-page">Fale Conosco</h1>

                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        
                        if (!empty($Contato) && !empty($Contato['SendFormContato'])):
                            unset($Contato['SendFormContato']);

                            $Contato['Assunto'] = MAILASSUNTO;
                            $Contato['DestinoNome'] = MAILNAME;
                            $Contato['DestinoEmail'] = MAILDESTINO;
                            $SendMail = new Email;
                            $SendMail->Enviar($Contato);
                            if ($SendMail->getError()):
                                WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
                            endif;
                        endif;
                        ?>
                        <form name="SendFormContato" action="#contato" method="post">
                            <div class="form-group">
                                <label class="control-label" >Nome</label>
                                <input class="form-control" placeholder="Digite seu nome"
                                       type="text" title="Informe seu nome" name="RemetenteNome" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" >Email</label>
                                <input class="form-control" placeholder="Digite seu email"
                                       type="email" title="Informe seu e-mail" name="RemetenteEmail" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" >Mensagem</label>
                                <textarea class="form-control" placeholder="Digite sua mensagem" 
                                          title="Envie sua mensagem" name="Mensagem" required rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-block btn-info" name="SendFormContato" value="enviar">Enviar</button>
                        </form>            
                    </div>
                </div>
            </div>
        </section>
        
        <section class="row">
            <h1 class="notitle">copy</h1>
            <p class="copy shadow-bottom"><a href="http://facebook.com/adriano.reis23">&copy; Adriano Reis -  Todos os direitos reservados.</a></p>
        </section>
    </div>
</footer>
