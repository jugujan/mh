<?php
class MhdisplayModuleFrontController extends ModuleFrontController
{
  public function initContent()
  {
    parent::initContent();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = Tools :: getValue('mhemail', false);
	$passwd = Tools :: getValue('mhpasswd', false);
	$_POST['mhpasswd']=null;
        $this->context->smarty->assign('email', $email);
        $this->context->smarty->assign('passwd', $passwd);
 	$customer = new Customer();
        $authentication=$customer->getByEmail(trim($email),trim($passwd));
	if (isset($authentication->active) && !$authentication->active) {
        	$this->context->smarty->assign('mhmsg', 'Compte inexistant');
            } elseif (!$authentication || !$customer->id) {
        	$this->context->smarty->assign('mhmsg', 'echec');
            } else {
		$this->context->cookie->id_compare = isset($this->context->cookie->id_compare) ? $this->context->cookie->id_compare: CompareProduct::getIdCompareByIdCustomer($customer->id);
                $this->context->cookie->id_customer = (int)($customer->id);
                $this->context->cookie->customer_lastname = $customer->lastname;
                $this->context->cookie->customer_firstname = $customer->firstname;
                $this->context->cookie->logged = 1;
                $customer->logged = 1;
                $this->context->cookie->is_guest = $customer->isGuest();
                $this->context->cookie->passwd = $customer->passwd;
                $this->context->cookie->email = $customer->email;
                $this->context->customer = $customer;
        	$this->context->smarty->assign('mhmsg', 'reussie');
        	$this->context->smarty->assign('id', $this->context->customer->id);
		
	    }
        $this->setTemplate('resultats.tpl');
    }
    else {
    	$this->setTemplate('display.tpl');
    }
  }
}
?>
