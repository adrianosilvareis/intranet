<?php

/**
 * Check.class.php [Helpers]
 * Classe responsavel por manipular e validar dados do sistema
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Check {

    private static $Data;
    private static $Format;

    /**
     * <b>Verifica E-mail:</b> Executa validação de formato de e-mail. Se for um email válido retorna true, ou retorna false.
     * @param STRING $Email = Uma conta de e-mail
     * @return BOOL = True para um email válido, ou false
     */
    public static function Email($Email) {
        self::$Data = (string) $Email;
        self::$Format = "/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/";

        if (preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * <b>Tranforma URL:</b> Tranforma uma string no formato de URL amigável e retorna o a string convertida!
     * @param STRING $Name = Uma string qualquer
     * @return STRING = $Data = Uma URL amigável válida
     */
    public static function Name($Name) {
        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ', '-', self::$Data);
        self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);

        return strtolower(utf8_encode(self::$Data));
    }

    /**
     * <b>Tranforma Data:</b> Transforma uma data no formato DD/MM/YY em uma data no formato TIMESTAMP!
     * @param STRING $Name = Data em (d/m/Y) ou (d/m/Y H:i:s)
     * @return STRING = $Data = Data no formato timestamp!
     */
    public static function Data($Data) {
        self::$Format = explode(' ', $Data);
        self::$Data = explode('/', self::$Format[0]);

        if (empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s');
        endif;

        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0] . ' ' . self::$Format[1];
        return self::$Data;
    }

    /**
     * <b>Limita os Palavras:</b> Limita a quantidade de palavras a serem exibidas em uma string!
     * @param STRING $String = Uma string qualquer
     * @return INT = $Limite = String limitada pelo $Limite
     */
    public static function Words($String, $Limite, $Pointer = null) {
        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer );
        $Result = ( self::$Format < $NumWords ? $NewWords . $Pointer : self::$Data );
        return $Result;
    }

    /**
     * <b>Obter categoria:</b> Informe o name (url) de uma categoria para obter o ID da mesma.
     * @param STRING $category_name = URL da categoria
     * @return INT $category_id = id da categoria informada
     */
    public static function CatByName($CategoryName) {

        $Read = new WsCategories;
        $Read->setCategory_name($CategoryName);

        $query = $Read->Execute()->Query('#category_name#');
        if ($Read->Execute()->getResult()):
            return (int) $query[0]->category_id;
        else:
            WSErro("A categoria <b>{$CategoryName}</b> não foi encontrada!", WS_ERROR);
            return null;
        endif;
    }

     /**
     * <b>Obter post:</b> Informe o name (url) de uma categoria para obter o ID da mesma.
     * @param STRING $post_name = URL da postagem
     * @return INT $post_id = id do post informada
     */
    public static function PostByName($PostByName) {

        $Read = new WsPosts();
        $Read->setPost_name($PostByName);

        $query = $Read->Execute()->Query('#post_name#');
        if ($Read->Execute()->getResult()):
            return (int) $query[0]->post_id;
        else:
            WSErro("O post <b>{$PostByName}</b> não foi encontrado!", WS_ERROR);
            return null;
        endif;
    }
    
    /**
     * <b>Contagem de Views:</b> Realiza uma contagem ao post informado.
     * @param INT $post_id
     */
    public static function ContPostViews($post_id) {
        $WsPosts = new WsPosts();
        $WsPosts->setPost_id($post_id);
        extract((array) $WsPosts->Execute()->find());
        $WsPosts->setPost_views($post_views + 1);
        $WsPosts->setPost_last_views(date('Y-m-d H:i:s'));
        $WsPosts->Execute()->update($WsPosts->Execute()->getDados(), 'post_id');
        return $post_url;
    }

    /**
     * <b>Contagem de Views:</b> Realiza uma contagem ao post informado.
     * @param INT $post_id
     */
    public static function ContCategoryViews($category_id) {
        $WsCategories = new WsCategories();
        $WsCategories->setCategory_id($category_id);
        extract((array) $WsCategories->Execute()->find());
        $WsCategories->setCategory_views($category_views + 1);
        $WsCategories->setCategory_last_view(date('Y-m-d H:i:s'));
        $WsCategories->Execute()->update($WsCategories->Execute()->getDados(), 'category_id');
    }

    /**
     * <b>Usuários Online:</b> Ao executar este HELPER, ele automaticamente deleta os usuários expirados. Logo depois
     * executa um READ para obter quantos usuários estÃ£o realmente online no momento!
     * @return INT = Qtd de usuários online
     */
    public static function UserOnline() {
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new WsSiteviewsOnline;
        $deleteUserOnline->setOnline_endview($now);
        $deleteUserOnline->Execute()->delete($deleteUserOnline->getThis(), "online_endview < :online_endview");
        $deleteUserOnline->Execute()->findAll();

        return $deleteUserOnline->Execute()->getRowCount();
    }

    /**
     * <b>Usuário Logado</b> Ao executar este HELPER, ele retorna o usuário que esta logado no momento.
     * 
     * @return obejct ws_user
     */
    public static function UserLogin($Level = null) {
        if (!empty($_SESSION['userlogin']) && !$Level || !empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] >= $Level):
            return $_SESSION['userlogin'];
        else:
            return false;
        endif;
    }

    /**
     * Não permite que usuarios não logados vejam as paginas, quando em manutenção.     * 
     * 
     * @param Array $Local
     */
    public static function Manutencao($Local) {
        if ($Local[0] != 'manutencao'):
            $Login = new Login(3);
            if (!$Login->CheckLogin()):
                header('Location: manutencao');
            endif;
        endif;
    }

    /**
     * <b>Imagem Upload:</b> Ao executar este HELPER, ele automaticamente verifica a existencia da imagem na pasta
     * uploads. Se existir retorna a imagem redimensionada!
     * @return HTML = imagem redimencionada!
     */
    public static function Image($ImageUrl, $ImageDesc, $ImageW = null, $ImageH = null) {
        self::$Data = $ImageUrl;

        if (file_exists(self::$Data) && !is_dir(self::$Data)):
            $patch = HOME;
            $imagem = self::$Data;
            return "<img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\" class='img-thumbnail'/>";
        else:
            return false;
        endif;
    }

    /**
     * Recebe a mensagem de erro e cria o banco de dados por demanda.
     * 
     * @param string $msg
     */
    public static function BDCREATE($msg) {

        if (strpos($msg, "ws_categories") || strpos($msg, "ws_posts") || strpos($msg, "ws_posts_gallery") || strpos($msg, "ws_siteviews") || strpos($msg, "ws_siteviews_agent") || strpos($msg, "ws_siteviews_online") || strpos($msg, "ws_users")):
            $tab = 'framework';
        elseif (strpos($msg, "app_youtube") || strpos($msg, "app_niver")):
            $tab = 'aplicacao';
        elseif (strpos($msg, "app_cidades") || strpos($msg, "app_estados")):
            $tab = 'endereco';
        elseif (strpos($msg, "app_postos") || strpos($msg, "app_contadores") || strpos($msg, "app_impressora") || strpos($msg, "app_modelo") || strpos($msg, "app_taxa_impress")):
            $tab = 'plugin_impress';
        elseif (strpos($msg, "fe_exames") || strpos($msg, "fe_material") || strpos($msg, "fe_metodo") || strpos($msg, "fe_setor") || strpos($msg, "fe_acoes")):
            $tab = 'plugin_fast_exames';
        endif;

        if (!empty($tab)):
            $file = file_get_contents(HOME . "/createbd/{$tab}.sql");
            try {
                $stmt = Conn::prepare($file);
                $stmt->execute();
            } catch (Exception $ex) {
                WSErro("Erro ao criar banco de dados [{$ex}]", WS_ERROR);
            }
        endif;
    }

    public static function getOffset($Limit, $Offset, $All) {
        if ($All < ($Offset + $Limit)):
            if (($All - $Limit) <= 0):
                return 0;
            else:
                return $All - $Limit;
            endif;
        else:
            return $Offset;
        endif;
    }

}
