<?php
/**
 * @version $Id$
 * @package Abricos
 * @subpackage Template
 * @copyright Copyright (C) 2012 Abricos. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author  Alexander Kuzmin <roosit@abricos.org>
 */

require_once 'dbquery.php';

class TemplateManager extends Ab_ModuleManager {
	
	/**
	 * @var TemplateModule
	 */
	public $module = null;
	
	/**
	 * @var TemplateManager
	 */
	public static $instance = null; 
	
	public function __construct(TemplateModule $module){
		parent::__construct($module);
		
		TemplateManager::$instance = $this;
	}
	
	public function IsAdminRole(){
		return $this->IsRoleEnable(TemplateAction::ADMIN);
	}
	
	public function AJAX($d){
		switch($d->do){
		}
		return null;
	}
	

	public function DSProcess($name, $rows){
		if (!$this->IsAdminRole()){ return null; }
		$p = $rows->p;
		$db = $this->db;
	
		switch ($name){
			case 'brick':
				foreach ($rows as $r){
					if ($r->f == 'u'){ Ab_CoreQuery::BrickSave(Abricos::$db, $r->d); }
				}
				break;
			case 'brickparam':
				foreach ($rows as $r){
					if ($r->f == 'a'){
						Ab_CoreQuery::BrickParamAppend(Abricos::$db, $r->d);
					}else if ($r->f == 'u'){
						Ab_CoreQuery::BrickParamSave(Abricos::$db, $r->d);
					}else if ($r->f == 'd'){
						Ab_CoreQuery::BrickParamRemove(Abricos::$db, $r->d->id);
					}
				}
				break;
			case 'bricks':
				foreach ($rows as $r){
					if ($r->f == 'd'){
						Ab_CoreQuery::BrickRemove(Abricos::$db, $r->d->id);
					}
					if ($r->f == 'r'){
						Ab_CoreQuery::BrickRestore(Abricos::$db, $r->d->id);
					}
				}
				break;
		}
	}
	
	public function DSGetData($name, $rows){
		if (!$this->IsAdminRole()){ return null; }
		
		$p = $rows->p;
		$db = $this->db;
	
		switch ($name){
			case 'brick':
				return Ab_CoreQuery::BrickById($db, $p->bkid, true);
			case 'brickparam':
				return Ab_CoreQuery::BrickParamList($db, $p->bkid);
			case 'bricks':
				return Ab_CoreQuery::BrickList($db, $p->tp, 'yes');
		}
	
		return null;
	}
	

	
}

?>