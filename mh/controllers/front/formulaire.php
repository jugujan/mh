<?php
class MhformulaireModuleFrontController extends ModuleFrontController
{
  public function initContent()
  {
    parent::initContent();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = Tools :: getValue('mhemail', false);
	$nom = Tools :: getValue('mhnom', false);
	$raisoc = Tools :: getValue('mhraisoc', false);
	
        $this->context->smarty->assign('email', $email);
        $this->context->smarty->assign('nom', $nom);
        $this->context->smarty->assign('raisoc', $raisoc);
 	$customer = new Customer();
	$customer->lastname=$nom;
	$customer->email=$email;
	$customer->company=$raisoc;
	$customer->id_shop=1;
	$customer->id_shop_group=1;
	$customer->id_default_group=1;
	$customer->id_guest=0;
	$customer->id_lang=1;
	$customer->firstname=$nom;
	$customer->passwd=md5(_COOKIE_KEY_.'admin');
	$this->context->customer = $customer;
	$customer->add($autodate = true, $null_values = true);
        $this->setTemplate('resultats2.tpl');
    }
    else {
    	$this->setTemplate('formulaire.tpl');
    }
  }
}
?>
