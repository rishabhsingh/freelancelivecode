<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptsmegamenu
 * @version   2.5
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

class Btmegamenu extends ObjectModel {

    public $id;
    public $id_ptsmegamenu;
    public $image;
    public $icon_class;
    public $id_parent = 1;
    public $is_group = 0;
    public $width;
    public $submenu_width;
    public $colum_width;
    public $submenu_colum_width;
    public $item;
    public $colums = 1;
    public $type;
    public $is_content = 0;
    public $show_title = 1;
    public $type_submenu;
    public $level_depth;
    public $active = 1;
    public $position;
    public $show_sub;
    public $url;
    public $target;
    public $privacy;
    public $position_type;
    public $menu_class;
    public $content;
    public $submenu_content;
    public $level;
    public $left;
    public $right;
    public $date_add;
    public $date_upd;
    //---Languages
    public $title;
    public $text;
    public $description;
    public $content_text;
    public $submenu_content_text;
    public $submenu_catids;
    public $is_cattree = 1;


    private $shopUrl;

    private $_editString = '';

    private $megaConfig = array();

    private $_editStringCol = '';

    private $_isLiveEdit = true;

    private $_module = null; 

    public $id_shop = '';

    public function setModule( $module  ){
        $this->_module = $module;
    }
    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'ptsmegamenu',
        'primary' => 'id_ptsmegamenu',
        'multilang' => true,
        'fields' => array(
            'image' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName'),
            'id_parent' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
            'is_group' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'width' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 255),
            'submenu_width' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 255),
            'colum_width' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 255),
            'submenu_colum_width' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 255),
            'item' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 255),
            'colums' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 255),
            'type' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 255),
            'is_content' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'show_title' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'type_submenu' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 10),
            'is_cattree' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'level_depth' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'position' => array('type' => self::TYPE_INT),
            'show_sub' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'url' => array('type' => self::TYPE_STRING, 'validate' => 'isUrl', 'size' => 255),
            'target' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 25),
            'privacy' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'size' => 6),
            'position_type' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 25),
            'menu_class' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 25),
            'icon_class' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 125),
            'content' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'submenu_content' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'level' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'left' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'right' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            
            // Languages fields
            'title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 255),
            'text' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => false, 'size' => 255),
            'description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'),
            'content_text' => array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
            'submenu_content_text' => array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
            'submenu_catids' => array('type' => self::TYPE_STRING, 'lang' => false, 'validate' => 'isString')
        ),
    );
    

    public function copyFromPost()
    {  
        /* Classical fields */
        foreach ($_POST AS $key => $value)
            if (key_exists($key, $this) AND $key != 'id_'.$this->table)
                $this->{$key} = $value;

        /* Multilingual fields */
        if (sizeof($this->fieldsValidateLang))
        {
            $languages = Language::getLanguages(false);
            foreach ($languages AS $language)
                foreach ($this->fieldsValidateLang AS $field => $validation)
                    if (isset($_POST[$field.'_'.(int)($language['id_lang'])]))
                        $this->{$field}[(int)($language['id_lang'])] = $_POST[$field.'_'.(int)($language['id_lang'])];
        }
    }



    public function add($autodate = true, $null_values = false) {
        $this->position = Btmegamenu::getLastPosition((int) $this->id_parent);
        $this->level_depth = $this->calcLevelDepth();
        $context = Context::getContext();
        $id_shop = $context->shop->id;
        $res = parent::add($autodate, $null_values);
        $res &= Db::getInstance()->execute('
			INSERT INTO `' . _DB_PREFIX_ . 'ptsmegamenu_shop` (`id_shop`, `id_ptsmegamenu`)
			VALUES(' . (int) $id_shop . ', ' . (int) $this->id . ')'
        );
        $this->cleanPositions($this->id_parent);
        return $res;
    }

    public function update($null_values = false) {
        $this->level_depth = $this->calcLevelDepth();
        return parent::update($null_values);
    }

    protected function recursiveDelete(&$to_delete, $id_ptsmegamenu) {
        if (!is_array($to_delete) || !$id_ptsmegamenu)
            die(Tools::displayError());

        $result = Db::getInstance()->executeS('
		SELECT `id_ptsmegamenu`
		FROM `' . _DB_PREFIX_ . 'ptsmegamenu`
		WHERE `id_parent` = ' . (int) $id_ptsmegamenu);
        foreach ($result as $row) {
            $to_delete[] = (int) $row['id_ptsmegamenu'];
            $this->recursiveDelete($to_delete, (int) $row['id_ptsmegamenu']);
        }
    }

    public function delete() {
        if ($this->id == 1)
            return false;
        $this->clearCache();

        // Get children categories
        $to_delete = array((int) $this->id);
        $this->recursiveDelete($to_delete, (int) $this->id);
        $to_delete = array_unique($to_delete);

        // Delete CMS Category and its child from database
        $list = count($to_delete) > 1 ? implode(',', $to_delete) : (int) $this->id;
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'ptsmegamenu` WHERE `id_ptsmegamenu` IN (' . $list . ')');
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'ptsmegamenu_shop` WHERE `id_ptsmegamenu` IN (' . $list . ')');
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'ptsmegamenu_lang` WHERE `id_ptsmegamenu` IN (' . $list . ')');
        Btmegamenu::cleanPositions($this->id_parent);
        return true;
    }

    public function deleteSelection($menus) {
        $return = 1;
        foreach ($menus as $id_ptsmegamenu) {
            $objMenu = new Btmegamenu($id_ptsmegamenu);
            $return &= $objMenu->delete();
        }
        return $return;
    }

    public function calcLevelDepth() {
        $parentBtmegamenu = new Btmegamenu($this->id_parent);
        if (!$parentBtmegamenu)
            die('parent Menu does not exist');
        return $parentBtmegamenu->level_depth + 1;
        
    }

    public function updatePosition($way, $position) {
        if (!$res = Db::getInstance()->executeS('
			SELECT cp.`id_ptsmegamenu`, cp.`position`, cp.`id_parent`
			FROM `' . _DB_PREFIX_ . 'ptsmegamenu` cp
			WHERE cp.`id_parent` = ' . (int) $this->id_parent . '
			ORDER BY cp.`position` ASC'
                ))
            return false;
        foreach ($res as $menu)
            if ((int) $menu['id_ptsmegamenu'] == (int) $this->id)
                $moved_menu = $menu;

        if (!isset($moved_menu) || !isset($position))
            return false;
        // < and > statements rather than BETWEEN operator
        // since BETWEEN is treated differently according to databases
        return (Db::getInstance()->execute('
			UPDATE `' . _DB_PREFIX_ . 'ptsmegamenu`
			SET `position`= `position` ' . ($way ? '- 1' : '+ 1') . '
			WHERE `position`
			' . ($way ? '> ' . (int) $moved_menu['position'] . ' AND `position` <= ' . (int) $position : '< ' . (int) $moved_menu['position'] . ' AND `position` >= ' . (int) $position) . '
			AND `id_parent`=' . (int) $moved_menu['id_parent']) && Db::getInstance()->execute('
			UPDATE `' . _DB_PREFIX_ . 'ptsmegamenu`
			SET `position` = ' . (int) $position . '
			WHERE `id_parent` = ' . (int) $moved_menu['id_parent'] . '
			AND `id_ptsmegamenu`=' . (int) $moved_menu['id_ptsmegamenu']));
    }

    public static function cleanPositions($id_parent) {
        $result = Db::getInstance()->executeS('
		SELECT `id_ptsmegamenu`
		FROM `' . _DB_PREFIX_ . 'ptsmegamenu`
		WHERE `id_parent` = ' . (int) $id_parent . '
		ORDER BY `position`');
        $sizeof = count($result);
        for ($i = 0; $i < $sizeof; ++$i) {
            $sql = '
			UPDATE `' . _DB_PREFIX_ . 'ptsmegamenu`
			SET `position` = ' . (int) $i . '
			WHERE `id_parent` = ' . (int) $id_parent . '
			AND `id_ptsmegamenu` = ' . (int) $result[$i]['id_ptsmegamenu'];
            Db::getInstance()->execute($sql);
        }
        return true;
    }

    public static function getLastPosition($id_parent) {
        return (Db::getInstance()->getValue('SELECT MAX(position)+1 FROM `' . _DB_PREFIX_ . 'ptsmegamenu` WHERE `id_parent` = ' . (int) $id_parent));
    }

    public function getInfo($id_ptsmegamenu, $id_lang = null, $id_shop = null) {
        if (!$id_lang)
            $id_lang = Context::getContext()->language->id;
        if (!$id_shop)
            $id_shop = Context::getContext()->shop->id;
        $sql = 'SELECT m.*, md.title, md.description, md.content_text, md.submenu_content_text
				FROM ' . _DB_PREFIX_ . 'megamenu m
				LEFT JOIN ' . _DB_PREFIX_ . 'ptsmegamenu_lang md ON m.id_ptsmegamenu = md.id_ptsmegamenu AND md.id_lang = ' . (int) $id_lang
                . ' JOIN ' . _DB_PREFIX_ . 'ptsmegamenu_shop bs ON m.id_ptsmegamenu = bs.id_ptsmegamenu AND bs.id_shop = ' . (int) ($id_shop);
        $sql .= ' WHERE m.id_ptsmegamenu=' . (int) $id_ptsmegamenu;

        return Db::getInstance()->executeS($sql);
    }

    public function getChild($id_ptsmegamenu = null, $id_lang = null, $id_shop = null, $active = false) {
        if (!$id_lang)
            $id_lang = Context::getContext()->language->id;
        if (!$id_shop)
            $id_shop = Context::getContext()->shop->id;

        $sql = ' SELECT m.*, md.title, md.text, md.description, md.content_text, md.submenu_content_text
				FROM ' . _DB_PREFIX_ . 'ptsmegamenu m
				LEFT JOIN ' . _DB_PREFIX_ . 'ptsmegamenu_lang md ON m.id_ptsmegamenu = md.id_ptsmegamenu AND md.id_lang = ' . (int) $id_lang
                . ' JOIN ' . _DB_PREFIX_ . 'ptsmegamenu_shop bs ON m.id_ptsmegamenu = bs.id_ptsmegamenu AND bs.id_shop = ' . (int) ($id_shop);
        if ($active)
            $sql .= ' WHERE m.`active`=1 ';

        if ($id_ptsmegamenu != null) {
            $sql .= ' WHERE id_parent=' . (int) $id_ptsmegamenu;
        }
        $sql .= ' ORDER BY `position` ';
        return Db::getInstance()->executeS($sql);
    }

    public function hasChild($id) {
        return isset($this->children[$id]);
    }

    public function getNodes($id) {
        return $this->children[$id];
    }

    public function getTree($id = null) {
        $childs = $this->getChild($id);

        foreach ($childs as $child) {
            $this->children[$child['id_parent']][] = $child;
        }
        $parent = 1;
        $output = $this->genTree($parent, 1);
        return $output;
    }

    public function getDropdown($id = null, $selected = 1) {
        $this->children = array();
        $childs = $this->getChild($id);
        foreach ($childs as $child) {
            $this->children[$child['id_parent']][] = $child;
        }
        $output  = array( array('id'=> '1', 'title' => 'Root', 'selected'=>'' ) );
        $output = $this->genOption(1, 1, $selected, $output );

        return $output;
    }

    public function genOption($parent, $level = 0, $selected, $output=array() ) {
      
        if ($this->hasChild($parent)) {
            $data = $this->getNodes($parent);
            foreach ($data as $menu) {
                $select = $selected == $menu['id_ptsmegamenu'] ? 'selected="selected"' : "";
                $output[] = array('id'=> $menu['id_ptsmegamenu'],'title' => str_repeat("-", $level) . " " . $menu['title'] . ' (ID:' . $menu['id_ptsmegamenu'] . ')', 'selected'=> $selected );
                if ($menu['id_ptsmegamenu'] != $parent)
                    $output   = $this->genOption( $menu['id_ptsmegamenu'], $level + 1, $selected, $output );
            }
        }
        return $output;
    }

    public function genTree($parent, $level) {
        if ($this->hasChild($parent)) {
            $data = $this->getNodes($parent);
            $t = $level == 1 ? " sortable" : "";
            $output = '<ol class="level' . $level . $t . ' ">';

            foreach ($data as $menu) {
                $cls = Tools::getValue('id_ptsmegamenu') == $menu['id_ptsmegamenu']?"selected":"";

              


                $output .='<li id="list_' . $menu['id_ptsmegamenu'] . '" class="'.$cls.'">
				<div><span class="disclose"><span></span></span>' . ($menu['title'] ? $menu['title'] : "") . ' (ID:' . $menu['id_ptsmegamenu'] . ') <span class="quickedit" rel="id_' . $menu['id_ptsmegamenu'] . '">E</span><span class="quickdel" rel="id_' . $menu['id_ptsmegamenu'] . '">D</span></div>';
                if ($menu['id_ptsmegamenu'] != $parent)
                    $output .= $this->genTree($menu['id_ptsmegamenu'], $level + 1);
                $output .= '</li>';
            }

            $output .= '</ol>';
            return $output;
        }
        return;
    }   

    /**
     *
     */
    public function renderAttrs( $menu ){  
        $t = sprintf( $this->_editString, $menu['id_ptsmegamenu'], $menu['is_group'], $menu['colums']  );
        if( $this->_isLiveEdit  ){  
            if( isset($menu['megaconfig']->subwidth) &&  $menu['megaconfig']->subwidth ){
                $t .= ' data-subwidth="'.$menu['megaconfig']->subwidth.'" ';
            }
            $t .= ' data-submenu="'.(isset($menu['megaconfig']->submenu)?$menu['megaconfig']->submenu:$this->hasChild($menu['id_ptsmegamenu'])).'"'; 
            $t .= ' data-align="'.(isset($menu['megaconfig']->align)?$menu['megaconfig']->align:"aligned-left").'"';
        }   
        return $t;
    }

    /**
     *
     */
    public function parserMegaConfig( $params ){
        if( !empty($params) ) { 
            foreach( $params as $param ){
                if( $param  && $param->submenu){
                    $this->megaConfig[$param->id] = $param;
                }
            }   
        }
    }
    
    public function hasMegaMenuConfig( $menu ){
        $id = $menu['id_ptsmegamenu'];
        return isset( $this->megaConfig[$id] )?$this->megaConfig[$id] :array(); 
    }

    public function getFrontTree( $parent = 1,  $edit=false, $params=array() ) {
        $this->parserMegaConfig( $params ); 
        if( $edit ){ 
            $this->_editString  = ' data-id="%s" data-group="%s"  data-cols="%s" ';
        }else {
            $this->_isLiveEdit = false;
            $this->model_menu_widget = new PtsMegamenuWidget();
            $this->model_menu_widget->setTheme( Context::getContext()->shop->getTheme());
            $this->model_menu_widget->langID =  Context::getContext()->language->id;
            $this->model_menu_widget->loadWidgets();
            $this->model_menu_widget->loadEngines();

        }
        $this->_editStringCol = ' data-colwidth="%s" data-class="%s" ' ;


        $childs = $this->getChild(null, null, null, true);
        
        foreach ($childs as $child) {
            
            $child['megaconfig'] = $this->hasMegaMenuConfig( $child );
            $child['megamenu_id'] = $child['id_ptsmegamenu'];
            $child['title']  = htmlentities(stripslashes($child['title']), ENT_COMPAT, 'UTF-8'); 

            if( isset($child['megaconfig']->group) ){
                $child['is_group'] = $child['megaconfig']->group;
            } 

            if( isset($child['megaconfig']->submenu) && $child['megaconfig']->submenu == 0){
                $child['menu_class'] = $child['menu_class'] .' disable-menu';
            }  

            $this->children[$child['id_parent']][] = $child;

        }

       
        $parent = 1;
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $this->image_base_url = Tools::htmlentitiesutf8($protocol . $_SERVER['HTTP_HOST'] . __PS_BASE_URI__) . 'modules/ptsmegamenu/img/';
        $this->shopUrl = $this->image_base_url;

        $output = '';
        if ($this->hasChild($parent)) {
            $data = $this->getNodes($parent);
            // render menu at level 0
           
            $page_name = Dispatcher::getInstance()->getController();
            $true = false;
            $output = '<ul class="nav navbar-nav megamenu">';
            foreach ($data as $menu) {

                if( isset($menu['megaconfig']->align) ){
                    $menu['menu_class'] .= ' '.$menu['megaconfig']->align;
                }


                if( $this->hasChild($menu['megamenu_id']) || $menu['type_submenu'] == 'html'){
                    $output .= '<li class="parent dropdown '.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>
                    <a class="dropdown-toggle has-subhtml" data-toggle="dropdown" href="'.$this->getLink( $menu ).'" target="'.$menu['target'].'">';
                    
                    if( $menu['icon_class'] ){
                        $output .= '<span class="hasicon menu-icon-class"><span class="'.$menu['icon_class'].'"></span>';
                    }elseif( $menu['image'] ) {
                        $output .= '<span class="hasicon menu-icon" style="background:url(\'' . $this->image_base_url . $menu['image'] . '\') no-repeat;">';
                    }
                    
                    $output .= '<span class="menu-title">'.$menu['title']."</span>";
                    if($menu['text'])
                        $output .= '<span class="sub-title">'.$menu['text']."</span>";
                    if( $menu['description'] ){
                        $output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
                    }
                    
                    if( $menu['image'] || $menu['icon_class'] ){  $output .= '</span>'; }
                    $output .= "<b class=\"caret\"></b></a>";
					
                    $output .= $this->genFrontTree( $menu['megamenu_id'], 1, $menu );        
                    $output .= '</li>';
                } else if ( !$this->hasChild($menu['megamenu_id']) && $menu['megaconfig'] && $menu['megaconfig']->rows ){
                    $output .= $this->genMegaMenuByConfig( $menu['megamenu_id'], 1, $menu );
                }else {
                    $output .= '<li class="'.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>
                    <a href="'.$this->getLink( $menu ).'" target="'.$menu['target'].'">';
                    
                    if( $menu['icon_class'] ){
                        $output .= '<span class="hasicon menu-icon-class"><span class="'.$menu['icon_class'].'"></span>';
                    }elseif( $menu['image'] ) {
                        $output .= '<span class="hasicon menu-icon" style="background:url(\'' . $this->image_base_url . $menu['image'] . '\') no-repeat;">';
                    }
                    
                    $output .= '<span class="menu-title">'.$menu['title']."</span>";
                    if($menu['text'])
                        $output .= '<span class="sub-title">'.$menu['text']."</span>";
                    if( $menu['description'] ){
                        $output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
                    }
                    if( $menu['image'] ||  $menu['icon_class'] ){ $output .= '</span>';  }
                    $output .= '</a></li>';
                }
            }
            $output .= '</ul>';
        }

        
        $this->_module = null;

        return $output;
    }


    public function renderWidgetsInCol( $col ){

         if( is_object($col) && isset($col->widgets)  && !$this->_editString ){
            $widgets = $col->widgets; 
            $widgets = explode( '|wid-', '|'.$widgets );
            if( !empty($widgets) ){
                unset( $widgets[0] );


                $output = '';
                foreach( $widgets as $wid ){
                    $content = $this->model_menu_widget->renderContent( $wid );

                    $output .= $this->_module->getWidgetContent($wid, $content['type'], $content['data'] );

                  
                }

                return $output;
            }
         }
    }

    /**
     * set data configuration for column
     */
    public function getColumnDataConfig( $col ){
        $output = '';
        if( is_object($col)  && $this->_isLiveEdit ){
            $vars = get_object_vars($col);
            foreach( $vars as $key => $var ){
                $output .= ' data-'.$key.'="'.$var . '" ' ;
            }
        }
        return $output;
    }

    /**
     * display mega content based on user configuration
     */
    public function genMegaMenuByConfig( $parentId, $level,$menu  ){
     
        $attrw = '';
        $class = $level > 1 ? "dropdown-submenu":"dropdown";
        $output = '<li class="'.$menu['menu_class'].' parent '.$class.' " '.$this->renderAttrs($menu).'>
                    <a href="'.$this->getLink( $menu ).'" class="dropdown-toggle" data-toggle="dropdown" target="'.$menu['target'].'">';
                    
                    if( $menu['icon_class'] ){
                        $output .= '<span class="hasicon menu-icon-class"><span class="'.$menu['icon_class'].'"></span>';
                    }elseif( $menu['image'] ) {
                        $output .= '<span class="hasicon menu-icon" style="background:url(\'' . $this->image_base_url . $menu['image'] . '\') no-repeat;">';
                    }
                    
                    $output .= '<span class="menu-title">'.$menu['title']."</span>";
                    if($menu['text'])
                        $output .= '<span class="sub-title">'.$menu['text']."</span>";
                    if( $menu['description'] ){
                        $output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
                    }
                    if( $menu['image'] || $menu['icon_class'] ){ $output .= '</span>';  }
                    $output .= "<b class=\"caret\"></b></a>";

        if( isset($menu['megaconfig']->subwidth) &&  $menu['megaconfig']->subwidth ){
            $attrw .= ' style="width:'.$menu['megaconfig']->subwidth.'px"' ;
        }
        $class  = 'dropdown-menu';
        $output .= '<div class="'.$class.'" '.$attrw.' ><div class="dropdown-menu-inner">';

        foreach( $menu['megaconfig']->rows  as $row ){
        
            $output .= '<div class="row">';
                foreach( $row->cols as $col ){
                     $output .= '<div class="mega-col col-sm-'.$col->colwidth.'" '.$this->getColumnDataConfig( $col ).'> <div class="mega-col-inner">';
                        $output .= $this->renderWidgetsInCol( $col );
                     $output .= '</div></div>';
                }
            $output .= '</div>';
        }

        $output .= '</div></div>';
        $output .= '</li>';
        return $output; 
    }

    /**
     * 
     */
    public function getSelect($menu) {
        global $link, $cookie;
        $page_name = Dispatcher::getInstance()->getController();
        $value = (int) $menu['item'];
        $result = '';
        switch ($menu['type']) {
            case 'product':
                if ($value == Tools::getValue('id_product') && $page_name == 'product')
                    $result = ' active';
                break;
            case 'category':
                if ($value == Tools::getValue('id_category') && $page_name == 'category')
                    $result = ' active';
                break;
            case 'cms':
                if ($value == Tools::getValue('id_cms') && $page_name == 'cms')
                    $result = ' active';
                break;
            case 'manufacturer':
                if ($value == Tools::getValue('id_manufacturer') && $page_name == 'manufacturer')
                    $result = ' active';
                break;
            case 'supplier':
                if ($value == Tools::getValue('id_supplier') && $page_name == 'supplier')
                    $result = ' active';
                break;
            case 'url':
                $value = $menu['url'];
                if (strpos($value, 'http') !== false) {
                    $result = '';
                } else {
                    if ($value == $page_name) {
                        $result = ' active';
                    } elseif (($value == 'index' || $value == 'index.php') && $page_name == 'index') {
                        $result = ' active';
                    }
                }
                break;
            default:
                $result = '';
                break;
        }
        return $result;
    }
    
    
    public function genFrontTree($parentId, $level, $parent) {

        $attrw = '';
        $class = $parent['is_group']?"dropdown-mega":"dropdown-menu";
        
        if( isset($parent['megaconfig']->subwidth) &&  $parent['megaconfig']->subwidth ){
            $attrw .= ' style="width:'.$parent['megaconfig']->subwidth.'px"' ;
        }
        

        if( $parent['type_submenu'] == 'html' ){
            $output = '<div class="'.$class.'"><div class="menu-content">';
            $output .= html_entity_decode($parent['submenu_content_text']);
            $output .= '</div></div>';
            return $output;
        }elseif( $this->hasChild($parentId) ){
            
            $data = $this->getNodes( $parentId );           
            $parent['colums'] = (int)$parent['colums'];
            if( $parent['colums'] > 1  ){

                if( !empty($parent['megaconfig']->rows) ) {
                    
                    $cols   = array_chunk( $data, ceil(count($data)/$parent['colums'])  );
                    $output = '<div class="'.$class.' level'.$level.'" '.$attrw.' ><div class="dropdown-menu-inner">';
                    foreach( $parent['megaconfig']->rows as $rows ){ 
                        foreach( $rows as $rowcols ){
                            $output .='<div class="row">';
                            
                            foreach( $rowcols as $key => $col ) {
                                $col->colwidth = isset($col->colwidth)?$col->colwidth:6;
                                if( isset($col->type) && $col->type == 'menu' && isset($cols[$key]) ){
                                    $scol = '<div class="mega-col col-sm-'.$col->colwidth.'" data-type="menu" '.$this->getColumnDataConfig( $col ).'><div class="mega-col-inner">';
                                    $scol .= '<ul>';
                                    foreach( $cols[$key] as $menu ) {
                                         $scol .= $this->renderMenuContent( $menu, $level+1 );
                                    }
                                    $scol .='</ul></div></div>';
                                }else {
                                    $scol = '<div class="mega-col col-sm-'.$col->colwidth.'"  '.$this->getColumnDataConfig( $col ).'><div class="mega-col-inner">';
                                         $scol .= $this->renderWidgetsInCol( $col );
                                    $scol .= '</div></div>';    
                                }
                                $output .= $scol;
                            }

                            $output .= '</div>';
                        }
                    }
                    $output .= '</div></div>';

                }else { 
                    $output = '<div class="'.$class.' mega-cols cols'.$parent['colums'].'" '.$attrw.' ><div class="dropdown-menu-inner"><div class="row">';
                    $cols   = array_chunk( $data, ceil(count($data)/$parent['colums'])  );

                    $oSpans = $this->getColWidth( $parent, (int)$parent['colums'] );
                
                    foreach( $cols as $i =>  $menus ){

                        $output .='<div class="mega-col '.$oSpans[$i+1].' col-'.($i+1).'" data-type="menu"><div class="inner"><ul>';
                            foreach( $menus as $menu ) {
                                $output .= $this->renderMenuContent( $menu, $level+1 );
                            }
                        $output .='</ul></div></div>';
                    }

                    $output .= '</div></div></div>';
                }   
                return $output;
            }else {

                

                $failse = false; 
                if( !empty($parent['megaconfig']->rows) ) {
                    $output = '<div class="'.$class.' level'.$level.'" '.$attrw.' ><div class="dropdown-menu-inner">';
                    foreach( $parent['megaconfig']->rows as $rows ){ 
                        foreach( $rows as $rowcols ){
                            $output .='<div class="row">';
                            foreach( $rowcols as $col ) {
                                
                                if( isset($col->type) && $col->type == 'menu' ){
                                    $scol = '<div class="mega-col col-sm-'.$col->colwidth.'" data-type="menu" '.$this->getColumnDataConfig( $col ).'><div class="mega-col-inner">';
                                    $scol .= '<ul>';
                                    foreach( $data as $menu ){
                                        $scol .= $this->renderMenuContent( $menu , $level+1 );
                                    }   
                                    $scol .= '</ul>';
                                    
                                }else {
                                    $scol = '<div class="mega-col col-sm-'.$col->colwidth.'"  '.$this->getColumnDataConfig( $col ).'><div class="mega-col-inner">';
                                    $scol .= $this->renderWidgetsInCol( $col );
                                }
                                $scol .= '</div></div>';
                                $output .= $scol;
                            }   
                            $output .= '</div>';
                        }

                    }$output .= '</div></div>';
                } else {
                    $output = '<div class="'.$class.' level'.$level.'" '.$attrw.' ><div class="dropdown-menu-inner">';
                    $row = '<div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu" ><div class="inner"><ul>';
                    foreach( $data as $menu ){
                        $row .= $this->renderMenuContent( $menu , $level+1 );
                    }   
                    $row .= '</ul></div></div></div></div></div>';

                    $output .= $row;
                    
                }
                
            }

            return $output;

        }
        return ;
    }

    public function genCatNoTree($context, $categories) {
        $html = '<ul class="dropdown-menu level1">';
        foreach ($categories as $key=>$val){
            $html .= '<li>
                         <a href='.$context->link->getCategoryLink($val["id_category"], $val['link_rewrite']).' title='.$val["name"].'>
                           <span class="menu-title">'.$val["name"].'</span>
                          </a>
                      </li>';
        }
        $html .= '</ul>';
        
        return $html;
    }
    
    public function getCategorie($submenu_catids, $context) {
        $groups = implode(', ', Customer::getGroupsStatic((int) $context->customer->id));

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT DISTINCT c.id_parent, c.id_category, c.level_depth ,cl.name, cl.link_rewrite
            FROM `' . _DB_PREFIX_ . 'category` c
            INNER JOIN `' . _DB_PREFIX_ . 'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.`id_lang` = ' . (int) $context->language->id . Shop::addSqlRestrictionOnLang('cl') . ')
            INNER JOIN `' . _DB_PREFIX_ . 'category_shop` cs ON (cs.`id_category` = c.`id_category` AND cs.`id_shop` = ' . (int) $context->shop->id . ')
            WHERE (c.`active` = 1 OR c.`id_category` = ' . (int) Configuration::get('PS_HOME_CATEGORY') . ')
            AND c.`id_category` != ' . (int) Configuration::get('PS_ROOT_CATEGORY') . '
            AND c.id_category IN (SELECT id_category FROM `' . _DB_PREFIX_ . 'category_group` WHERE `id_group` IN (' . pSQL($groups) . ') AND id_category IN (' . $submenu_catids . '))
            ORDER BY `level_depth` ASC, cs.`position`');
        return $result;

       
    }
    
    public function genCatByTree($parent, $context, $result) {
        $context = Context::getContext();
        $resultParents = array();
        $resultIds = array();

        foreach ($result as &$row) {
            $resultParents[$row['id_parent']][] = &$row;
            $resultIds[$row['id_category']] = &$row;
        }
        
        //get cat
        $blockCategTree = array();
        $ptsProcessCat = array();
        foreach ($resultParents as $rkey => $rrow) {
            if (!in_array($rkey, $ptsProcessCat)) {
                $resultCat  = $this->getCatTree($ptsProcessCat, $context, $resultParents, $resultIds, 0, $rkey, 0);
                $blockCategTree[$rkey] = $resultCat;
            }
        }
        
        $oSpans = $this->getColWidth($parent, (int) $parent['colums']);
        
        $level = 1;
        
        foreach ($blockCategTree as $key=>$val){
            if($val["children"]){
                $this->genCatBySubTree($html, $val["children"], $level, $oSpans, $parent["target"], (int) $parent['colums']);
            }
        }
        
        unset($ptsProcessCat, $resultParents, $resultIds);
        
        //die($html);
        return $html;
    }
    
    public function genCatBySubTree(&$html, $result, $level, $oSpans, $target, $columns) {
        $index    = 1;
        $closeTag = 0;
        
        foreach($result as $val){
            $classLi = '';
            $classUl = 'dropdown-menu';
            //$classUl = 'dropdown-mega';
            $classDiv = '';
            
            if($val["currentDepth"]==1){
                if($index==1 || (($index-1)%$columns)==0) {
                    //open div row tag
                    $html .= ($closeTag?'</div><div class="row">':'<div class="row">');
                    $closeTag++;
                }    
                if(isset($oSpans[$index])) $classDiv = $oSpans[$index];
                else {
                	if(isset($oSpans[$index-$columns])) $classDiv = $oSpans[$index-$columns];
                	else $classDiv = "col-md-12";
                }
                $modColumn = $index%$columns;
                if($modColumn==0) $modColumn = $columns;
                if(isset($oSpans[$modColumn])) $classDiv = $oSpans[$modColumn];
                else $classDiv = "col-md-12";
                
                //open mega div + ul
                $html .= '<div class="mega-col '.$classDiv.' col-'.$index.'"><ul>';
                $classLi = 'mega-group ';
                $classUl = 'dropdown-mega';
            }
            if($val["children"]) $classLi .= 'parent dropdown-submenu';
            $html .= '<li class="'.$classLi.'">';
            $html .= '<a class="dropdown-toggle" target='.$target.' href="'.$val["link"].'"><span class="menu-title">'.$val["name"].'</span>';
            if($val["children"] && $val["currentDepth"]>1) $html .= '<b class="caret"></b>';
            

            $html .= '</a>';
            if($val["children"]){
                $html .= '<ul class="'.$classUl.' level'.$level.'">';
                $this->genCatBySubTree($html, $val["children"], $level+1, $oSpans, $target, $columns);
                $html .= '</ul>';
            }
            $html .= '</li>';
            
            //close mega div + ul
            if($val["currentDepth"]==1){
                $html .= '</ul></div>';
            }
            
            $index++;
        }
        //close div row tag
        $html .= ($closeTag?'</div>':'');
        //$level++;
    }
    
    
    public function getCatTree(&$ptsProcessCat, $context, $resultParents, $resultIds, $maxDepth, $id_category = null, $currentDepth = 0){
        $children = array();
        if (isset($resultParents[$id_category]) && count($resultParents[$id_category]) && ($maxDepth == 0 || $currentDepth < $maxDepth))
            foreach ($resultParents[$id_category] as $subcat)
                $children[] = $this->getCatTree($ptsProcessCat, $context, $resultParents, $resultIds, $maxDepth, $subcat['id_category'], $currentDepth + 1);
        $ptsProcessCat[] = $id_category;
        
		$link_rewrite = "";
		$name = "";
		if(isset($resultIds[$id_category]['link_rewrite'])) $link_rewrite = $resultIds[$id_category]['link_rewrite'];
		if(isset($resultIds[$id_category]['link_rewrite'])) $name = $resultIds[$id_category]['name'];
		
        $return = array('id' => $id_category, 'link' => $context->link->getCategoryLink($id_category, $link_rewrite),
                'name' => $name, 'currentDepth' => $currentDepth,
                'children' => $children);
        
        return $return;
    }

    /**
     *
     */
    public function renderMenuContent( $menu , $level ){

        $output = '';
        $class = $menu['is_group']?"mega-group":"";


        $menu['menu_class'] = ' '.$class;
        if( $menu['type'] == 'html' ){ 
            $output .= '<li class="'.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>';    
            $output .= '<div class="menu-content">'.html_entity_decode($menu['content_text']).'</div>'; 
            $output .= '</li>';
            return $output;
        }
        if( $this->hasChild($menu['megamenu_id']) ){

            $output .= '<li class="parent dropdown-submenu'.$menu['menu_class'].'" '.$this->renderAttrs($menu). '>';
            if( $menu['show_title'] ){
                $output .= '<a class="dropdown-toggle" data-toggle="dropdown" href="'.$this->getLink( $menu ).'">';
                $t = '%s';
               
                if( $menu['icon_class'] ){
                     $output .= '<span class="hasicon menu-icon-class"><span class="'.$menu['icon_class'].'"></span>';
                }elseif( $menu['image'] ) {
                    $output .= '<span class="hasicon menu-icon" style="background:url(\'' . $this->image_base_url . $menu['image'] . '\') no-repeat;">';
                }

                
                $output .= '<span class="menu-title">'.$menu['title']."</span>";
                if($menu['text'])
                    $output .= '<span class="sub-title">'.$menu['text']."</span>";
                if( $menu['description'] ){
                    $output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
                }
                $output .= "<b class=\"caret\"></b>";
                if ( $menu['image'] || $menu['icon_class'] ) {
                    $output .= '</span>';
                }
                $output .= '</a>';
            }   
            $output .= $this->genFrontTree( $menu['megamenu_id'], $level, $menu );
            $output .= '</li>';

        } else if (  $menu['megaconfig'] && $menu['megaconfig']->rows ){
            $output .= $this->genMegaMenuByConfig( $menu['megamenu_id'], $level, $menu );
        }else {
            $output .= '<li class="'.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>';
            if( $menu['show_title'] ){ 
                $output .= '<a href="'.$this->getLink( $menu ).'">';
            
                if( $menu['icon_class'] ){
                     $output .= '<span class="hasicon menu-icon-class"><span class="'.$menu['icon_class'].'"></span>';
                }elseif( $menu['image'] ) {
                    $output .= '<span class="hasicon menu-icon" style="background:url(\'' . $this->image_base_url . $menu['image'] . '\') no-repeat;">';
                }

                $output .= '<span class="menu-title">'.$menu['title']."</span>";
                if($menu['text'])
                    $output .= '<span class="sub-title">'.$menu['text']."</span>";
                if( $menu['description'] ){
                    $output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
                }
                if ( $menu['image'] || $menu['icon_class'] ) {
                    $output .= '</span>';
                }

                $output .= '</a>';
            }
            $output .= '</li>';
        }
        return $output;
    }
    

    public function getLink($menu) { 
        global $link, $cookie;
        if( $this->_editString ){
            return "#";
        }
        $value = (int) $menu['item'];
        $result = '';
        switch ($menu['type']) {
            case 'product':
                if (Validate::isLoadedObject($objPro = new Product($value, true, $cookie->id_lang))) {
                    $result = htmlentities($link->getProductLink((int) $objPro->id, $objPro->link_rewrite, NULL, NULL, $cookie->id_lang), ENT_COMPAT, 'UTF-8');
                }
                break;
            case 'category':
                if (Validate::isLoadedObject($objCate = new Category($value, $cookie->id_lang))) {
                    $result = htmlentities($link->getCategoryLink((int) $objCate->id, $objCate->link_rewrite, $cookie->id_lang), ENT_COMPAT, 'UTF-8');
                }
                break;
            case 'cms':
                if (Validate::isLoadedObject($objCMS = new CMS($value, $cookie->id_lang))) {
                    $result = htmlentities($link->getCMSLink((int) $objCMS->id, $objCMS->link_rewrite, $cookie->id_lang), ENT_COMPAT, 'UTF-8');
                }
                break;
            case 'url':
                $value = $menu['url'];
                if (strpos($value, 'http') !== false) {
                    $result = htmlentities($value, ENT_COMPAT, 'UTF-8');
                } elseif($value == "#"){
                    $result = $value;
                } else {
                    $result = htmlentities($link->getPageLink($value, false, $cookie->id_lang), ENT_COMPAT, 'UTF-8');
                }
                break;
            case 'manufacturer':
                if (Validate::isLoadedObject($objManu = new Manufacturer($value, $cookie->id_lang))) {
                    $result = htmlentities($link->getManufacturerLink((int) $objManu->id, $objManu->link_rewrite, $cookie->id_lang), ENT_COMPAT, 'UTF-8');
                }
                break;
            case 'supplier':
                if (Validate::isLoadedObject($objSupp = new Supplier($value, $cookie->id_lang))) {
                    $result = htmlentities($link->getSupplierLink((int) $objSupp->id, $objSupp->link_rewrite, $cookie->id_lang), ENT_COMPAT, 'UTF-8');
                }
                break;
            default: 
                $result = '#';
                break;    
        }
        return $result;
    }


    /**
     *
     */
    public function getColWidth( $menu, $cols ){
        $output = array();
        
        $split = preg_split('#\s+#',$menu['submenu_colum_width'] );
        if( !empty($split) && !empty($menu['submenu_colum_width']) ){
            foreach( $split as $sp ) {
                $tmp = explode("=",$sp);
                if( count($tmp) > 1 ){
                    $output[trim(preg_replace("#col#","",$tmp[0]))]=(int)$tmp[1];
                }
            }
        }
        $tmp = array_sum($output);
        $spans = array();
        $t = 0; 
        for( $i=1; $i<= $cols; $i++ ){
            if( array_key_exists($i,$output) ){
                $spans[$i] = 'col-sm-'.$output[$i];
            }else{      
                if( (12-$tmp)%($cols-count($output)) == 0 ){
                    $spans[$i] = "col-sm-".((12-$tmp)/($cols-count($output)));
                }else {
                    if( $t == 0 ) {
                        $spans[$i] = "col-sm-".( ((11-$tmp)/($cols-count($output))) + 1 ) ;
                    }else {
                        $spans[$i] = "col-sm-".( ((11-$tmp)/($cols-count($output))) + 0 ) ;
                    }
                    $t++;
                }                   
            }
        }
        return $spans;
    }
}