<?php
final class Contact_Messages extends GWF_MethodQueryTable
{
	public function getGDO() { return GWF_ContactMessage::table();  }
	
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
}
