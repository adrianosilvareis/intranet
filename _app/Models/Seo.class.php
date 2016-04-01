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
    private $seoLibs;

    function __construct($File, $Link) {
        $this->File = strip_tags(trim($File));
        $this->Link = strip_tags(trim($Link));
    }

    public function getTags() {
        $this->checkData();
        return $this->seoTags;
    }

    public function getLibs() {
        return $this->seoLibs;
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

            //SEO:: Indicadores
            case 'indicadores':
                $this->Data = ['Indicadores de qualidade - ' . SITENAME . ' - ' . SITEDESC, SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                break;

            case 'profile':
                $this->Data = ['Dados cadastrais - ' . SITENAME . ' - ' . SITEDESC, SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                break;

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

            //SEO:: PAGES
            case 'pages':
                switch ($this->Link) {
                    //SEO:: Contato
                    case 'contato':
                        $this->Data = ['Fale conosco - ' . SITENAME, SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: Qualidade
                    case 'qualidade':
                        $this->Data = ['Formularios da Qualidade - ' . SITENAME, SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: SOBRE
                    case 'sobre':
                        $this->Data = ['Sobre a Intranet - ' . SITENAME, SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: INSTITUCIONAL
                    case 'institucional':
                        $this->Data = ['Instituição Tommasi - ' . SITENAME, SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
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
                    //SEO:: Contadores de Impresão
                    case 'contadores-de-impressao':
                        $this->Data = ['Contadores de impressão - Registra os contadores de cada Mês', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: Fast Exames
                    case 'fast-exames':
                        $this->Data = ['Fast Exames Tommasi - Formulario de alteração de exames', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: Agenda
                    case 'agenda':
                        $this->Data = ['Agenda telefonica - Lista Telefonica Tommasi', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                        break;

                    //SEO:: Aniversarios
                    case 'aniversarios':
                        $this->Data = ['Aniversariantes do mês - ' . SITENAME . '| Parabéns a todos do grupo tommasi.', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
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
//            $this->setLib();
            $this->setProd();
        endif;
    }

    private function setProd() {
        $this->seoLibs .= "<!--LIBS PRODUCAO-->\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/lib.min.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/all.min.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/downtime.min.js'></script>" . "\n";
        $this->seoLibs .= "<link rel='stylesheet' href='" . HOME . "/css/default.css'/>" . "\n";
        $this->seoLibs .= "<link rel='stylesheet' href='" . HOME . "/css/bootstrap.min.css'/>" . "\n";
        $this->seoLibs .= "<link rel='stylesheet' href='" . HOME . "/css/bootstrap-multiselect.css'/>" . "\n";

        $this->seoLibs .= "<!--CDN-->\n";
        $this->seoLibs .= "<link rel='stylesheet' href='" . HOME . "/cdn/shadowbox/shadowbox.css'>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/cdn/jcycle.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/cdn/shadowbox/shadowbox.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/cdn/_plugins.conf.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/cdn/_scripts.conf.js'></script>" . "\n";
    }

    private function setTags() {
        $this->Tags['Title'] = $this->Data[0];
        $this->Tags['Content'] = Check::Words(html_entity_decode($this->Data[1]), 25);
        $this->Tags['Link'] = $this->Data[2];
        $this->Tags['Image'] = $this->Data[3];
        $this->Tags = array_map('strip_tags', $this->Tags);
        $this->Tags = array_map('trim', $this->Tags);
        $this->Data = null;

        $this->seoTags .= "<!--[if lt IE 9]><script src='" . HOME . "/_cdn/html5.js'></script><![endif]-->" . "\n";
        $this->seoTags .= "<meta charset='UTF-8'>" . "\n";
        //NORMAL PAGE
        $this->seoTags .= "<!--NORMAL PAGE-->\n";
        $this->seoTags .= "<title>{$this->Tags['Title']}</title>" . "\n";
        $this->seoTags .= "<meta name='description' content='{$this->Tags['Content']}'/>" . "\n";
        $this->seoTags .= "<meta name='robots' content='index, fallow'/>" . "\n";
        $this->seoTags .= "<link rel='canonical' href='{$this->Tags['Link']}'>" . "\n";
        //ICONES
        $this->seoTags .= "<!--ICONES-->\n";
        $this->seoTags .= "<link rel='shortcut icon' href='" . HOME . '/themes/' . THEME . "/images/icon/labo.png'/>" . "\n";
        $this->seoTags .= "<link rel='apple-touch-icon' href='" . HOME . '/themes/' . THEME . "/images/icon/labo.png'/>" . "\n";
        //FACEBOOK
        $this->seoTags .= "<!--FACEBOOK-->\n";
        $this->seoTags .= "<meta property='og:site_name' content='" . SITENAME . "' />" . "\n";
        $this->seoTags .= "<meta property='og:locale' content='pt-BR' />" . "\n";
        $this->seoTags .= "<meta property='og:title' content='{$this->Tags['Title']}' />" . "\n";
        $this->seoTags .= "<meta property='og:description' content='{$this->Tags['Content']}' />" . "\n";
        $this->seoTags .= "<meta property='og:image' content='{$this->Tags['Image']}' />" . "\n";
        $this->seoTags .= "<meta property='og:url' content='{$this->Tags['Link']}' />" . "\n";
        $this->seoTags .= "<meta property='og:type' content='article' />" . "\n";
        //Item GROUP (TWITTER)
        $this->seoTags .= "<!--TWITTER-->\n";
        $this->seoTags .= "<meta itemprop='name' content='{$this->Tags['Title']}' />" . "\n";
        $this->seoTags .= "<meta itemprop='description' content='{$this->Tags['Content']}' />" . "\n";
        $this->seoTags .= "<meta itemprop='url' content='{$this->Tags['Link']}' />" . "\n";
        $this->seoTags .= "<meta itemprop='image' content='{$this->Tags['Image']}' />" . "\n";
        $this->Tags = null;
    }

    private function setLib() {
        //LIBS    
        $this->seoLibs .= "<!--LIBS-->\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/jquery/jquery.min.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/jquery/jmask.min.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/angular/angular.min.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/angular/angular-messages.min.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/angular/angular-route.min.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/bootstrap/js/bootstrap.min.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/bootstrap/js/bootstrap-multiselect.min.js'></script>" . "\n";
        $this->seoLibs .= "<link rel='stylesheet' href='" . HOME . "/_lib/bootstrap/css/bootstrap-multiselect.css' type=\"text/css\"/>" . "\n";
        $this->seoLibs .= "<link rel='stylesheet' href='" . HOME . "/_lib/bootstrap/css/bootstrap.css'>" . "\n";
        $this->seoLibs .= "<link rel='stylesheet' href='" . HOME . "/css/default.css'/>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/intranet.js'></script>" . "\n";

        $this->seoLibs .= "<!--Google Charts-->\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/google-chart/loader.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/google-charts/start.js'></script>" . "\n";

        $this->seoLibs .= "<!--CDN-->\n";
        $this->seoLibs .= "<link rel='stylesheet' href='" . HOME . "/_lib/cdn/shadowbox/shadowbox.css'>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/cdn/jcycle.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/cdn/shadowbox/shadowbox.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/cdn/_plugins.conf.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/_lib/cdn/_scripts.conf.js'></script>" . "\n";

        $this->seoLibs .= "<!--ANGULAR DEFAULT PACKET-->\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/jquery/event/classe.event.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/services/objetoAPI.services.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/directive/uiFormat.module.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/directive/uiCep.directive.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/directive/uiSite.directive.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/directive/uiTel.directive.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/filter/filter.module.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/filter/maxlength.filter.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/filter/name.filter.js'></script>" . "\n";
        $this->seoLibs .= "<script src='" . HOME . "/js/angular/filter/timestampBr.filter.js'></script>" . "\n";
    }

}
