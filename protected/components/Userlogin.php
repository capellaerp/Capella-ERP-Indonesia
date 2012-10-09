<?php
Yii::import('zii.widgets.CPortlet');
class Userlogin extends CPortlet
{
    public $title='';
 
    protected function renderContent()
    {
        $form=new LoginForm;
        if(isset($_POST['LoginForm']))
        {
            $form->attributes=$_POST['LoginForm'];
            if($form->validate() && $form->login())
                $this->controller->refresh();
        }
        $this->render('Userlogin',array('model'=>$form));
    }
}