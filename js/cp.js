/*
@version $Id$
@copyright Copyright (C) 2012 Abricos. All rights reserved.
@license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

var Component = new Brick.Component();
Component.requires = {
	mod:[{name: 'user', files: ['cpanel.js']}]
};
Component.entryPoint = function(){
	
	if (Brick.Permission.check('template', '50') < 1){ return; }

	var cp = Brick.mod.user.cp;

	var menuItem = new cp.MenuItem(this.moduleName);
	menuItem.icon = '/modules/template/images/cp_icon.gif';
	menuItem.entryComponent = 'manager';
	menuItem.entryPoint = 'Brick.mod.template.API.showTemplateWidget';
	cp.MenuManager.add(menuItem);
	
};
