<?php
final class Contact_Messages extends GWF_MethodQueryTable
{
	use GWF_MethodAdmin;
	
	public function getPermission() { return 'staff'; }
	
	public function getGDO() { return GWF_ContactMessage::table();  }
	
	public function execute()
	{
		return $this->renderNavBar('Contact')->add(parent::execute());
	}
	
	public function getHeaders()
	{
		$gdo = $this->getGDO();
		return array(
			$gdo->gdoColumn('cmsg_id'),
			$gdo->gdoColumn('cmsg_created_at'),
			$gdo->gdoColumn('cmsg_user_id'),
			$gdo->gdoColumn('cmsg_email'),
			$gdo->gdoColumn('cmsg_title'),
			GDO_Button::make('link_message'),
		);
	}
	
	public function getQuery()
	{
		return $this->getGDO()->select('*');
	}
}
