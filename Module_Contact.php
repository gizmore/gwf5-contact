<?php
/**
 * Contact Module.
 * Provides contact to admins, and
 * Write users a mail without spoiling their email.
 * @author gizmore
 * @license MIT
 */
final class Module_Contact extends GWF_Module
{
	##############
	### Module ###
	##############
	public function onLoadLanguage() { return $this->loadLanguage('lang/contact'); }
	public function getClasses() { return ['GWF_ContactMessage']; }
	public function getConfig()
	{
		return array(
			GDO_Checkbox::make('contact_captcha')->initial('1'),
			GDO_Checkbox::make('member_captcha')->initial('1'),
			GDO_Email::make('contact_mail')->initial(GWF_BOT_EMAIL)->required(),
		);
	}

	##############
	### Config ###
	##############
	public function cfgCaptchaGuest() { return $this->getConfigValue('contact_captcha', '1'); }
	public function cfgCaptchaMember() { return $this->getConfigValue('member_captcha', '0'); }
	public function cfgCaptchaEnabled() { return GWF_User::current()->isMember() ? $this->cfgCaptchaMember() : $this->cfgCaptchaGuest(); }
	
	##############
	### Navbar ###
	##############
	public function onRenderFor(GWF_Navbar $navbar)
	{
		if ($navbar->isLeft())
		{
			$navbar->addField(GDO_Button::make('link_contact')->href($this->getMethodHREF('Form')));
		}
	}

}
