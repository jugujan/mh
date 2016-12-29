<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class Mh extends Module
{
public function __construct()
  {
    $this->name = 'mh';
    $this->tab = 'Others';
    $this->version = '1.0';
    $this->author = 'jr';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '2.0');
    $this->dependencies = array('blockcart');
    $this->bootstrap = true;
    $this->display = 'view';
 
    parent::__construct();
 
    $this->displayName = $this->l('MH');
    $this->description = $this->l('Description of my module.');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    if (!Configuration::get('MYMODULE_NAME'))      
      $this->warning = $this->l('No name provided');
  }
public function install()
	{
  	if (parent::install() == false)
    		return false;
	//$this->registerHook('displayNav');
    	$this->registerHook('header');
  	return true;
	}
public function uninstall() {
	if (parent::uninstall()==false)
  		return false;
	return true;	
	}

/*
public function hookDisplayNav($params)
	{
  	$this->context->smarty->assign(
      	array(
          	'mh_name' => Configuration::get('MYMODULE_NAME'),
          	'mh_link' => $this->context->link->getModuleLink('mh', 'display')
      	)
  	);
  	return $this->display(__FILE__, 'mh.tpl');
	}
   
public function hookDisplayRightColumn($params)
	{
  		return $this->hookDisplayNav($params);
	}
*/
   
public function hookDisplayHeader()
	{
  		$this->context->controller->addCSS($this->_path.'css/mh.css', 'all');
		$this->context->controller->addJS(_PS_JS_DIR_.'validate.js');
	}   
}
?>
