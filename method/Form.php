<?php
final class Contact_Form extends GWF_MethodForm
{
	public function contactFields()
	{
		return ['cmsg_email', 'cmsg_title', 'cmsg_message'];
	}
	
	public function createForm(GWF_Form $form)
	{
		$this->title('ft_contact_form', [$this->getSiteName()]);
		$form->addFields(GWF_ContactMessage::table()->getGDOColumns($this->contactFields()));
		$form->getField('cmsg_email')->initial(GWF_User::current()->getMail());
		if (Module_Contact::instance()->cfgCaptchaEnabled())
		{
			$form->addField(GDO_Captcha::make());
		}
		$form->addField(GDO_Submit::make()->label('btn_send'));
		$form->addField(GDO_AntiCSRF::make());
	}
	
	public function formValidated(GWF_Form $form)
	{
		$message = GWF_ContactMessage::blank($form->values())->insert();
		$this->sendMail($message);
		return GWF_Message::message('msg_contact_mail_sent')->add($this->renderPage());
	}
	
	public function sendMail(GWF_ContactMessage $message)
	{
		
	}
	
}