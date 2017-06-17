<?php $form instanceof GWF_Form; $module = Module_Contact::instance(); ?>

<?php 
GDO_Box::make()->title('GELLI')->content('TEST')->render()->add($form->render());
?>


