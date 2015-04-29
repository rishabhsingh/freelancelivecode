<?php
/* * ****************************************************
 *  Leo Prestashop SliderShow for Prestashop 1.6.x
 *
 * @package   leosliderlayer
 * @version   3.0
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) October 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
 * ***************************************************** */
class SliderLayer extends ObjectModel
{
	public $title;
	public $link;
	public $image;
        public $id_group;
        public $position;
        public $active;
        public $params;
        public $thumbnail;
        public $video;
        public $layersparams;

	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'leosliderlayer_slides',
		'primary' => 'id_leosliderlayer_slides',
		'multilang' => true,
		'fields' => array(
			'active' =>			array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
                        'id_group'=>                    array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true),
			'position' =>		        array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true),
			// Lang fields
			'title' =>			array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 255),
			'link' =>			array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isUrl', 'required' => false, 'size' => 255),
			'image' =>			array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 255),
			'thumbnail' =>			array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 255),
                        'params' =>                     array('type' => self::TYPE_HTML, 'lang' => false),
                        'video' =>                   array('type' => self::TYPE_HTML, 'lang' => true),
                        'layersparams' =>               array('type' => self::TYPE_HTML, 'lang' => true)
		)
	);

	public	function __construct($id_slide = null, $id_lang = null, $id_shop = null, Context $context = null)
	{
		parent::__construct($id_slide, $id_lang, $id_shop);
	}

	public function add($autodate = true, $null_values = false)
	{
		$context = Context::getContext();
		$id_shop = $context->shop->id;

		$res = parent::add($autodate, $null_values);
		return $res;
	}
        
	public function delete()
	{
		$res = true;

		/*$images = $this->image;
		foreach ($images as $image)
		{
			if (preg_match('/sample/', $image) === 0)
				if ($image && file_exists(dirname(__FILE__).'/images/'.$image))
					$res &= @unlink(dirname(__FILE__).'/images/'.$image);
		}*/

		$res &= $this->reOrderPositions();

		$res &= Db::getInstance()->execute('
			DELETE FROM `'._DB_PREFIX_.'leosliderlayer_slides`
			WHERE `id_leosliderlayer_slides` = '.(int)$this->id
		);

		$res &= parent::delete();
		return $res;
	}
        
        public static function sliderExist($id_slider) {
            return  Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT gr.`id_leosliderlayer_slides` as id
                    FROM `' . _DB_PREFIX_ . 'leosliderlayer_slides` gr
                            WHERE gr.`id_leosliderlayer_slides` = ' . (int) $id_slider);
        }
        
        
	public function reOrderPositions()
	{
		$id_slide = $this->id;
		$context = Context::getContext();
		$id_shop = $context->shop->id;

		$max = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT MAX(hss.`position`) as position
			FROM `'._DB_PREFIX_.'leosliderlayer_slides` hss
			WHERE hss.`id_group` = '.$this->id_group
		);

		if ((int)$max == (int)$id_slide)
			return true;

		$rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT hss.`position` as position, hss.`id_leosliderlayer_slides` as id_slide
			FROM `'._DB_PREFIX_.'leosliderlayer_slides` hss
			WHERE hss.`id_group` = '.(int)$this->id_group.' AND hss.`position` > '.(int)$this->position
		); 

		foreach ($rows as $row)
		{
			$current_slide = new SliderLayer($row['id_slide']);
			--$current_slide->position;
			$current_slide->update();
			unset($current_slide);
		}

		return true;
	}

}
