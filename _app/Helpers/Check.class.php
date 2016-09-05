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
     * <b>Lista Arquivos: </b> Transformda arquivos recebido de formulario em uma lista ordenada.
     * @param array $Files = array com todos atributos misturados
     * @return array = arquivos separados.
     */
    public static function ListFiles($Files) {

        self::$Data = $Files;

        $gbCount = count(self::$Data['tmp_name']);
        $gbKeys = array_keys(self::$Data);

        $gbFiles = array();

        for ($gb = 0; $gb < $gbCount; $gb++):
            foreach ($gbKeys as $keys):
                $gbFiles[$gb][$keys] = $_FILES['files'][$keys][$gb];
            endforeach;
        endfor;

        return $gbFiles;
    }

    /**
     * Recebe um array e o nome do arquivo que sera retornado, e transforma em um arquivo .csv
     * @param string $filename
     * @param array $file
     */
    public static function ToCsv($filename, $file) {
        
        $filename = $filename . '.csv';
        
        header('Content-type: text/csv');
        header("Content-Disposition: attachement; filename=$filename");
        
        $output = fopen("php://output", "w");
        $header = array_keys((array) $file[0]);

        fputcsv($output, $header, ";");
        
        foreach ($file as $row) {
            fputcsv($output, $row, ";");
        }

        fclose($output);
    }

    /**
     * Converte string em float, retirando as virgulas incorretas
     * 
     * @param string $num
     * @return float
     */
    public static function toFloat($num) {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
                ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }

        return floatval(
                preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
                preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
        );
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
     * <b>Transforma Titulo</b> Trasnforma os nomes de arquivos, para um formato limpo.
     * 
     * @param string $Name
     * @return string
     */
    public static function FileName($Name) {
        $Title = self::Name($Name);
        $arrayFile = explode("-", $Title);
        $type = array_pop($arrayFile);
        $FileName = implode("_", $arrayFile);
        return $FileName . ".$type";
    }

    /**
     * Função que remove campos nulos e movimenta os demais.
     * 
     * @param array $Array
     * @return array
     */
    public static function array_filter_shift(array $Array) {

        for ($i = 0; $i < count($Array); $i++):
            if (!empty($Array[$i])):
                $arrayClear[] = $Array[$i];
            endif;
        endfor;

        return $arrayClear;
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
     * Tempo 
     * 
     * @param String(TIMESTAMP) $dataini
     * @param String(TIMESTAMP) $datafim
     * @return String
     */
    public static function DataDiff($dataini, $datafim, $metaD = null, $metaH = null, $metaM = null) {

        $dtini = self::DateToInteger($dataini);
        $dtfim = self::DateToInteger($datafim);

        # Diminui a datafim que é a maior com a dataini
        $time = ($dtfim - $dtini);

        $return = self::RecuperaData($time);

        $metaD = (empty($metaD) && empty($metaH) && empty($metaM) ? 3 : $metaD);

        if (!empty($metaD) && $return['days'] > $metaD ||
                empty($metaD) && !empty($metaH) && $return['hours'] > $metaH ||
                empty($metaD) && empty($metaH) && !empty($metaM) && $return['mins'] > $metaM):
            return "<span style='color:red'>" . $return['return'] . "</span>";
        endif;

        return $return['return'];
    }

    static function RecuperaData($time) {

        # Recupera os dias
        $days = floor($time / 86400);
        # Recupera as horas
        $hours = floor(($time - ($days * 86400)) / 3600);
        # Recupera os minutos
        $mins = floor(($time - ($days * 86400) - ($hours * 3600)) / 60);
        # Recupera os segundos
        $secs = floor($time - ($days * 86400) - ($hours * 3600) - ($mins * 60));

        # Monta o retorno no formato
        # 5d 10h 15m 20s
        # somente se os itens forem maior que zero
        $retorno = "";
        $retorno .= ($days > 0) ? $days . 'd ' : "";
        $retorno .= ($hours > 0) ? $hours . 'h ' : "";
        $retorno .= ($mins > 0) ? $mins . 'm ' : "";
        $retorno .= ($secs > 0) ? $secs . 's ' : "";

        return ["return" => $retorno, "days" => $days, "hours" => $hours, "mins" => $mins, "secs" => $secs];
    }

    /**
     * 
     * @param INT $Valor
     */
    public static function Monetize($Valor) {

        $number = doubleval($Valor);

        $format_number = number_format($number, 2, ',', ' ');

        $monetize = "R$ " . $format_number;

        return $monetize;
    }

    /**
     * Equivalente a strtotime
     */
    static function DateToInteger($data) {
        # Split para dia, mes, ano, hora, minuto e segundo da data final
        $_split_datehour = explode(' ', $data);
        $_split_data = explode("-", $_split_datehour[0]);
        $_split_hour = explode(":", $_split_datehour[1]);
        return mktime($_split_hour[0], $_split_hour[1], (integer) $_split_hour[2], $_split_data[1], $_split_data[2], $_split_data[0]);
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

    public static function AreaById($area_id) {
        $WsAreaTrabalho = new WsAreaTrabalho();
        $WsAreaTrabalho->setArea_id($area_id);
        
        $WsAreaTrabalho->Execute()->find();
        
        return $WsAreaTrabalho->Execute()->getResult();
    }

    /**
     * Encontra o tipo de setor a partir da descrição
     * 
     * @param string $TypeName
     * @return int
     */
    public static function SetTypeByName($TypeName) {
        $Read = new WsSetorType();
        $Read->setType_content($TypeName);
        $query = $Read->Execute()->Query("#type_content# AND type_status = 1");

        if ($Read->Execute()->getResult()):
            return (int) $query[0]->type_id;
        else:
            WSErro("O tipo de setor <b>{$TypeName}</b> não foi encontrado!", WS_ERROR);
            return null;
        endif;
    }

    /**
     * Encontra o Id da area a partir da descrição.
     * @param string $TypeName
     * @return int
     */
    public static function AreaTypeByName($TypeName) {
        $Read = new WsAreaCategory();
        $Read->setCategory_title($TypeName);
        $query = $Read->Execute()->Query("#category_title#");

        if ($Read->Execute()->getResult()):
            return (int) $query[0]->category_id;
        else:
            WSErro("O tipo de área <b>{$TypeName}</b> não foi encontrado!", WS_ERROR);
            return null;
        endif;
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

    public static function CatParentByName($CategoryName) {
        $Read = new WsCategories;

        if (self::CatByName($CategoryName)):
            $Read->setCategory_parent(self::CatByName($CategoryName));
            $Read->Execute()->Query("#category_parent#");
        endif;

        if ($Read->Execute()->getResult()):
            return $Read->Execute()->getResult();
        else:
            WSErro("A subcategoria de {$CategoryName} não foi encontrada!", WS_INFOR);
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
     * <b>Usuários Usando a página:</b> Ao executar este HELPER, ele automaticamente verifica usuarios que estejam usando a url atual. 
     * @return BOOLEAN = Ultrapassou o numero de usuarios máximo.
     */
    public static function UsingPage($maxUsing = NULL) {
        $max = (!empty($maxUsing) ? $maxUsing : 1);

        $online_url = $_SESSION['useronline']['online_url'];
        $online_session = $_SESSION['useronline']['online_session'];

        $userOnline = new WsSiteviewsOnline;
        $userOnline->setOnline_url($online_url);
        $userOnline->setOnline_session($online_session);

        $userOnline->Execute()->Query("online_url = :online_url AND online_session != :online_session");

        return ($userOnline->Execute()->getRowCount() < $max ? true : false);
    }

    /**
     * <b>Usuário Logado</b> Ao executar este HELPER, ele retorna o usuário que esta logado no momento.
     * 
     * @return obejct ws_user
     */
    public static function UserLogin($Level = null) {
        if (!empty($_SESSION['userlogin']) && !$Level || !empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] <= $Level):
            return $_SESSION['userlogin'];
        else:
            return false;
        endif;
    }

    /**
     * Verifica se o usuario logado tem acesso o acesso informado!
     * 
     * @param type $acesso
     * @return boolean
     */
    public static function UserPermission($acesso, $system = NULL) {
        $acessos = $_SESSION['userlogin']['perfil']->acessos;

        $acesso_name = self::Name($acesso);
        $Read = new WsAcesso();
        $Read->setAcesso_name($acesso_name);
        $Read->setAcesso_tag($acesso_name);

        $Read->Execute()->Query("(#acesso_name# OR #acesso_tag#)");
        $result = $Read->Execute()->getResult();

        if ($result):
            foreach ($acessos as $value) :
                if ($value->acesso_id == $result[0]->acesso_id):
                    return true;
                endif;
            endforeach;

            $message = "Não tem permissão";
            $status = WS_ALERT;
            self::mensagem($system, false, $message, $status);
        else:
            $message = "Acesso não encontrado";
            $status = WS_INFOR;
            self::mensagem($system, false, $message, $status);
        endif;
    }

    private static function mensagem($system, $result, $message, $status) {
        if (!empty($system)):
            self::JsonReturn($result, $message, $status);
        else:
            WSErro($message, $status);
        endif;
    }

    public static function JsonReturn($result, $message, $status) {
        if ($result):
            echo json_encode($result);
        else:
            $error = [
                'message' => $message,
                'status' => $status
            ];
            echo json_encode($error);
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

        if (strpos($msg, "ws_setor_type") || strpos($msg, "ws_setor") || strpos($msg, "app_youtube") || strpos($msg, "app_niver") || strpos($msg, "ws_categories") || strpos($msg, "ws_posts") || strpos($msg, "ws_posts_gallery") || strpos($msg, "ws_siteviews") || strpos($msg, "ws_siteviews_agent") || strpos($msg, "ws_siteviews_online") || strpos($msg, "ws_users") || strpos($msg, "app_cidades") || strpos($msg, "app_estados")):
            $tab = 'framework';
        elseif (strpos($msg, "agenda_contatos") || strpos($msg, "agenda_endereco") || strpos($msg, "agenda_endereco")):
            $tab = 'agenda';
        elseif (strpos($msg, "imp_postos") || strpos($msg, "imp_contadores") || strpos($msg, "imp_impressora") || strpos($msg, "imp_modelo") || strpos($msg, "imp_taxa_impress")):
            $tab = 'plugin_impress';
        elseif (strpos($msg, "fe_exames") || strpos($msg, "fe_material") || strpos($msg, "fe_acoes")):
            $tab = 'plugin_fast_exames';
        elseif (strpos($msg, "dt_downtime") || strpos($msg, "dt_equipamentos")):
            $tab = 'downtime';
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
