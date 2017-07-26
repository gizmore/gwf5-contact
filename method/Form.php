<?php
final class Contact_Form extends GWF_MethodForm
{
    public function isUserRequired() { return false; }
    
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
		return GWF_Message::message('msg_contact_mail_sent', [$this->getSiteName()])->add($this->renderPage());
	}
	
	public function sendMail(GWF_ContactMessage $message)
	{
		foreach (GWF_User::withPermission('staff') as $user)
		{
			$staffname = $user->displayName();
			$sitename = $this->getSiteName();
			$email = htmlspecialchars($message->getEmail());
			$username = $message->getUser()->displayName();
			$title = htmlspecialchars($message->getTitle());
			$text = htmlspecialchars($message->getMessage());
			
			$mail = new GWF_Mail();
			$mail->setSender(GWF_BOT_EMAIL);
			$mail->setSenderName(GWF_BOT_EMAIL);
			$mail->setSubject(t('mail_subj_contact', [$sitename]));
			$mail->setReply($message->getEmail());
			$args = [$staffname, $sitename, $username, $email, $title, $text];
			$mail->setBody(t('mail_body_contact', $args));
			$mail->sendToUser($user);
		}
	}
	
}