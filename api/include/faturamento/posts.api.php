<?php

$Read = new WsPosts();
$category_id = Check::CatByName("convenios");

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setPost_id($id);
            $Read->setPost_status('1');
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Convênio não encontrado!', '404');
        else:
            $Read->Execute()->Query("post_status = 1 AND (post_category = :cat OR post_cat_parent = :cat) ORDER BY post_title DESC", "cat={$category_id}");
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma convênio cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->post_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'post_id');
            echo json_encode($request);
        else:
            //salvar
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->post_id = (int) $Read->Execute()->MaxFild("post_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setPost_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
