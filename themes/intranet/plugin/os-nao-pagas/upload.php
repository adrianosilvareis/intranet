<?php
$uploads = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($uploads) && $uploads['sendPostForm']):
    $uploads['post_files'] = ( $_FILES['Arquivo']['tmp_name'] ? $_FILES['Arquivo'] : null);
    unset($uploads['sendPostForm']);
    $Upload = new Upload('uploads/');
    $Upload->File($uploads['post_files']);
    header("Location: " . HOME . "/plugin/os-nao-pagas/save&file=" . $Upload->getResult());
endif;

if (!Check::UserLogin(2)):
    echo "<a class=\"btn btn-primary\" style=\"width: 200px; margin: 10px 0;\" href=\"/intranet/admin\" title=\"Login\" alt=\"admin\" >Login</a>";
    WSErro("<b>Área Restrita!</b> Efetue login para acessar.", WS_INFOR);
else:
    ?>
    <div class="section" style="height: 350px;;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Uploads</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <form name="PostForm" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="file" class="form-control" placeholder="Selecione um arquivo" name="Arquivo">
                                <span class="input-group-btn">
                                    <input class="btn btn-success" type="submit" value="Go" name="sendPostForm"/>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
endif;
