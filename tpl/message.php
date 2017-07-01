<?php
$message instanceof GWF_ContactMessage;
$user = $message->getUser();
$username = $user ? $user->displayName() : t('guest');
$username = GWF_HTML::escape("$username <{$message->getEmail()}>");
?>
<md-card>
  <md-card-title>
    <md-card-title-text>
      <span class="md-headline"><?php l('card_title_contact_message', [GWF5::instance()->getSiteName()]); ?></span>
      <span class="md-subhead"><?php lt($message->getCreatedAt()); ?></span>
    </md-card-title-text>
  </md-card-title>
  <md-card-content layout="column" layout-align="space-between">
    <div><?php l('msg_by', [$username]); ?></div>
    <div><?php l('msg_title', [GWF_HTML::escape($message->getTitle())]); ?></div>
    <hr/>
    <div><?php echo GWF_HTML::escape($message->getMessage()); ?></div>
  </md-card-content>
  <md-card-actions layout="row" layout-align="end center">
    <?php echo GDO_Back::make()->renderCell(); ?>
  </md-card-actions>
</md-card>
