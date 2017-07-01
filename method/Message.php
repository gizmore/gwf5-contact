<?php
final class Contact_Message extends GWF_Method
{
	use GWF_MethodAdmin;
	
	public function getPermission() { return 'staff'; }
	
	private $message;
	
	public function init()
	{
		$this->message = GWF_ContactMessage::table()->find(Common::getRequestString('id'));
	}
	
	public function execute()
	{
		return $this->renderNavBar('Contact')->add($this->templateMessage($this->message));
	}
	
	public function templateMessage(GWF_ContactMessage $message)
	{
		return $this->templatePHP('message.php', ['message' => $message]);
	}
	
}
