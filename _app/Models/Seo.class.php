<?php

/**
 * Seo.class.php [MODEL]
 * Classe de apoio para o modelo LINK. Pode ser utilizada para gerar SSEO para as páginas do sistem!
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Seo {

    private $File;
    private $Link;
    private $Data;
    private $Tags;

    /* DADOS POVOADOS */
    private $seoTags;
    private $seoData;

    function __construct($File, $Link) {
        $this->File = strip_tags(trim($File));
        $this->Link = strip_tags(trim($Link));
    }

    public function getTags() {
        $this->checkData();
        return $this->seoTags;
    }

    public function getData() {
        $this->checkData();
        return $this->seoData;
    }

    /**
     * ****************************************
     * *************** PRIVATES ***************
     * ****************************************
     */
    private function checkData() {
        if (!$this->seoData):
            $this->getSeo();
        endif;
    }

    private function getSeo() {

        switch ($this->File):
            //SEO:: ARTIGO
            case 'artigo':
                $Admin = (isset($_SESSION['userlogin']['user_level']) && $_SESSION['userlogin']['user_level'] == 3 ? true : false);
                $Check = ($Admin ? '' : 'post_status = 1 AND ');

                $ReadSeo = new WsPosts;
                $ReadSeo->setPost_name($this->Link);
                $ReadSeo->Execute()->Query("{$Check} #post_name#");

                if (!$ReadSeo->Execute()->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract((array) $ReadSeo->Execute()->getResult()[0]);
                    $this->seoData = (array) $ReadSeo->Execute()->getResult()[0];
                    $this->Data = [$post_title . ' - ' . SITENAME, $post_content, HOME . "/artigo/{$post_name}", HOME . "/uploads/{$post_cover}"];

                    //post:: conta viws do post
                    Check::ContPostViews($post_id);
                endif;
                break;

            //SEO:: NOTICIAS
            case 'noticias':
                $ReadSeo = new WsPosts;
                $ReadSeo->setPost_type($this->Link);
                $ReadSeo->Execute()->Query("#post_type#");

                if (!$ReadSeo->Execute()->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract((array) $ReadSeo->Execute()->getResult()[0]);
                    $this->seoData = (array) $ReadSeo->Execute()->getResult();
                    $this->Data = [$post_type . ' - ' . SITENAME, $post_content, HOME . "/noticias/{$post_type}", INCLUDE_PATH . '/images/site.png'];
                endif;
                break;

            //SEO:: CATEGORIA
            case 'categoria':
                $ReadSeo = new WsCategories;
                $ReadSeo->setCategory_name($this->Link);
                $ReadSeo->Execute()->Query("#category_name#");

                if (!$ReadSeo->Execute()->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract((array) $ReadSeo->Execute()->getResult()[0]);
                    $this->seoData = (array) $ReadSeo->Execute()->getResult()[0];
                    $this->Data = [$category_title . ' - ' . SITENAME, $category_content, HOME . "/categoria/{$category_name}", INCLUDE_PATH . '/images/site.png'];

                    //categories:: conta views da categoria
                    Check::ContCategoryViews($category_id);
                endif;
                break;

            //SEO:: Grupo
            case 'grupo':
                $ReadSeo = new WsCategories;
                $ReadSeo->setCategory_name($this->Link);
                $ReadSeo->Execute()->Query("#category_name#");
                
                if (!$ReadSeo->Execute()->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract((array) $ReadSeo->Execute()->getResult()[0]);
                    $this->seoData = (array) $ReadSeo->Execute()->getResult()[0];
                    $this->Data = [$category_title . ' - ' . SITENAME, $category_content, HOME . "/categoria/{$category_name}", INCLUDE_PATH . '/images/site.png'];
                    
                    //categories:: conta views da categoria
                    Check::ContCategoryViews($category_id);
                endif;
                break;

            //SEO:: membros
            case 'membros':
                $ReadSeo = new WsCategories;
                $ReadSeo->setCategory_name($this->Link);
                $ReadSeo->Execute()->Query("#category_name#");

                if (!$ReadSeo->Execute()->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract((array) $ReadSeo->Execute()->getResult()[0]);
                    $this->seoData = (array) $ReadSeo->Execute()->getResult()[0];
                    $this->Data = [$category_title . ' - ' . SITENAME, $category_content, HOME . "/membros/{$category_name}", INCLUDE_PATH . '/images/site.png'];

                    //categories:: conta views da categoria
                    Check::ContCategoryViews($category_id);
                endif;

                break;

            //SEO::PESQUISA
            case 'pesquisa':
                $ReadSeo = new WsPosts;
                $ReadSeo->Execute()->Query("post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%')", "link={$this->Link}");

                if (!$ReadSeo->Execute()->getResult()):
                    $this->Data = ["Pesquisa por: \"{$this->Link}\"" . ' - ' . SITENAME, "Sua pesquisa por {$this->Link} retornou {$this->seoData['count']} resultados!", HOME . "/pesquisa/{$this->Link}", INCLUDE_PATH . '/images/site.png'];
                    $this->seoTags = null;
                else:
                    $this->seoData['count'] = $ReadSeo->Execute()->getRowCount();
                    $this->Data = ["Pesquisa por: \"{$this->Link}\"" . ' - ' . SITENAME, "Sua pesquisa por {$this->Link} retornou {$this->seoData['count']} resultados!", HOME . "/pesquisa/{$this->Link}", INCLUDE_PATH . '/images/site.png'];
                endif;
                break;

            //SEO:: INDEX
            case 'index':
                $this->Data = [SITENAME . ' - ' . SITEDESC, SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                break;
            
            //SEO:: INDEX
            case 'sobre':
                $this->Data = [SITENAME . ' - ' . SITEDESC, SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                break;

            //SEO:: PAGES
            case 'pages':
                switch ($this->Link) {
                    //SEO:: Contato
                    case 'contato':
                        $this->Data = [SITENAME . ' - Fale conosco', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: Aniversarios
                    case 'aniversarios':
                        $this->Data = [SITENAME . ' - Aniversariantes do mês | Parabéns a todos do grupo tommasi.', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: Qualidade
                    case 'qualidade':
                        $this->Data = [SITENAME . ' - Formularios da Qualidade.', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: 404
                    default :
                        $this->Data = ['404 Oppss, Nada encontrado!', SITEDESC, HOME . '/404', INCLUDE_PATH . '/images/site.png'];
                        break;
                }
                break;

            //SEO:: PLUGIN
            case 'plugin':
                switch ($this->Link) {
                    //SEO:: Contato
                    case 'contadores-de-impressao':
                        $this->Data = [SITENAME . ' - Contadores de impressão', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: 404
                    default :
                        $this->Data = [SITENAME . ' - Plugin', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;
                }
                break;

            //SEO:: 404
            default :
                $this->Data = ['404 Oppss, Nada encontrado!', SITEDESC, HOME . '/404', INCLUDE_PATH . '/images/site.png'];
                break;

        endswitch;

        if ($this->Data):
            $this->setTags();
        endif;
    }

    private function setTags() {
        $this->Tags['Title'] = $this->Data[0];
        $this->Tags['Content'] = Check::Words(html_entity_decode($this->Data[1]), 25);
        $this->Tags['Link'] = $this->Data[2];
        $this->Tags['Image'] = $this->Data[3];
        $this->Tags = array_map('strip_tags', $this->Tags);
        $this->Tags = array_map('trim', $this->Tags);

        $this->Data = null;

        $this->seoTags = "\n";
        $this->seoTags .= "<!--[if lt IE 9]><script src='../../_cdn/html5.js'></script><![endif]-->" . "\n";

        $this->seoTags .= "\n";
        $this->seoTags .= "<meta charset='UTF-8'>" . "\n";

        //NORMAL PAGE
        $this->seoTags .= "<title>{$this->Tags['Title']}</title>" . "\n";
        $this->seoTags .= "<meta name='description' content='{$this->Tags['Content']}'/>" . "\n";
        $this->seoTags .= "<meta name='robots' content='index, fallow'/>" . "\n";
        $this->seoTags .= "<link rel='canonical' href='{$this->Tags['Link']}'>" . "\n";
        $this->seoTags .= "\n";
        //ICONES
        $this->seoTags .= "<link rel='shortcut icon' href='" . HOME . '/themes/' . THEME . "/images/icon/labo.png'/>" . "\n";
        $this->seoTags .= "<link rel='apple-touch-icon' href='" . HOME . '/themes/' . THEME . "/images/icon/labo.png'/>" . "\n";
        $this->seoTags .= "\n";

        //FACEBOOK
        $this->seoTags .= "<meta property='og:site_name' content='" . SITENAME . "' />" . "\n";
        $this->seoTags .= "<meta property='og:locale' content='pt-BR' />" . "\n";
        $this->seoTags .= "<meta property='og:title' content='{$this->Tags['Title']}' />" . "\n";
        $this->seoTags .= "<meta property='og:description' content='{$this->Tags['Content']}' />" . "\n";
        $this->seoTags .= "<meta property='og:image' content='{$this->Tags['Image']}' />" . "\n";
        $this->seoTags .= "<meta property='og:url' content='{$this->Tags['Link']}' />" . "\n";
        $this->seoTags .= "<meta property='og:type' content='article' />" . "\n";
        $this->seoTags .= "" . "\n";

        //Item GROUP (TWITTER)
        $this->seoTags .= "<meta itemprop='name' content='{$this->Tags['Title']}' />" . "\n";
        $this->seoTags .= "<meta itemprop='description' content='{$this->Tags['Content']}' />" . "\n";
        $this->seoTags .= "<meta itemprop='url' content='{$this->Tags['Link']}' />" . "\n";
        $this->seoTags .= "<meta itemprop='image' content='{$this->Tags['Image']}' />" . "\n";
        $this->seoTags .= "\n";

        //LIBS        
        $this->seoTags .= "<link rel='stylesheet' href='" . HOME . "/lib/bootstrap/css/bootstrap2.css'>" . "\n";
        $this->seoTags .= "<link rel='stylesheet' href='" . HOME . '/themes/' . THEME . "/css/default.css'/>" . "\n";
        $this->seoTags .= "<script src='" . HOME . "/lib/jquery/jquery-min.js'></script>" . "\n";
        $this->seoTags .= "<script src='" . HOME . "/lib/jquery-mask/jmask.js'></script>" . "\n";
        $this->seoTags .= "<script src='" . HOME . "/lib/bootstrap/js/bootstrap.js'></script>" . "\n";
        $this->seoTags .= "<script src='" . HOME . '/themes/' . THEME . "/js/intranet.js'></script>" . "\n";
        
        
        $this->seoTags .= "<link rel='stylesheet' href='../_cdn/shadowbox/shadowbox.css'>" . "\n";
        $this->seoTags .= "<script src='../_cdn/jcycle.js'></script>" . "\n";
        $this->seoTags .= "<script src='../_cdn/shadowbox/shadowbox.js'></script>" . "\n";
        $this->seoTags .= "<script src='../_cdn/_plugins.conf.js'></script>" . "\n";
        $this->seoTags .= "<script src='../_cdn/_scripts.conf.js'></script>" . "\n";
           
        $this->Tags = null;
    }

}
