<?php 
/**
 * @version $Id$
 * @package Abricos
 * @subpackage Template
 * @copyright Copyright (C) 2012 Abricos. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author Alexander Kuzmin <roosit@abricos.org>
 */


/**
 * Модуль "Шаблоны"
 * 
 * Позволяет заносить кирпичи шаблона в базу для последующего 
 * редактирования его из админки
 */
class TemplateModule extends Ab_Module {
	
	/**
	 * Конструктор
	 */
	public function __construct(){
		$this->version = "0.1.1";
		$this->name = "template";
		$this->permission = new TemplatePermission($this);
	}
	
	/**
	 * @return TemplateManager
	 */
	public function GetManager(){
		if (is_null($this->_manager)){
			require_once 'includes/manager.php';
			$this->_manager = new TemplateManager($this);
		}
		return $this->_manager;
	}

	public function GetContentName(){
		return 'index';
	}
}

class TemplateAction {
	const ADMIN	= 50;
}

class TemplatePermission extends Ab_UserPermission {

	public function TemplatePermission(TemplateModule $module){
		$defRoles = array(
			new Ab_UserRole(TemplateAction::ADMIN, Ab_UserGroup::ADMIN)
		);
		parent::__construct($module, $defRoles);
	}

	public function GetRoles(){
		return array(
			TemplateAction::ADMIN => $this->CheckAction(TemplateAction::ADMIN)
		);
	}
}

// создать экземляр класса модуля и зарегистрировать его в ядре 
Abricos::ModuleRegister(new TemplateModule())

?>