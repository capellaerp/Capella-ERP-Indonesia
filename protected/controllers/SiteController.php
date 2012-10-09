<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
			$this->layout='//layouts/column2';
			$this->render('index');
	}
	
		public function actionIndexadmin()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		if(!Yii::app()->user->isGuest) 
		{
			$this->layout='//layouts/column3';
			$this->render('indexadmin');
		} else {
			$this->render('index');
		}
	}
	
	public function actionVisiMisi()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
			$this->layout='//layouts/column2';
			$this->render('visimisi');
	}
	
	public function actionsejarahsingkat()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
			$this->layout='//layouts/column2';
			$this->render('sejarahsingkat');
	}
	
		public function actionsaranaprasarana()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
			$this->layout='//layouts/column2';
			$this->render('saranaprasarana');
	}
	
		public function actionstrukturorg()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
			$this->layout='//layouts/column2';
			$this->render('strukturorg');
	}
	
		public function actionkepalasekolah()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
			$this->layout='//layouts/column2';
			$this->render('kepalasekolah');
	}
	
		public function actionkemitraan()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
			$this->layout='//layouts/column2';
			$this->render('kemitraan');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	  $this->layout='//layouts/column2';
//      if($this->error==Yii::app()->errorHandler->error)
//      {
//          if(Yii::app()->request->isAjaxRequest)
//              echo $this->error['message'];
//          else
//              $this->render('error', $error);
//      }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
	  $this->layout='//layouts/column2';
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$this->layout='//layouts/column2';
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionGetNotification()
	{
	  $this->layout='//layouts/column2';
	  $datatext = '';
	  $datatext1 = '';
	  if (Yii::app()->user->id != '') {
		$models = Userinbox::model()->findallbyattributes(array('username'=>Yii::app()->user->id));
		foreach ($models as $model) {
		  if ($model->usermessages != '') {
			$datatext = $model->userfrom.'('.$model->inboxdatetime.'): '.$model->usermessages.'<br>'.$datatext;
		  }
		}
	  }

	  if (Yii::app()->user->id != '') {
		$users = Useraccess::model()->findall(array('select'=>'username',
			'condition'=>"username<>'".Yii::app()->user->id."' and recordstatus=2"));
		foreach ($users as $user) {
			$datatext1 = $user->username.'<br>'.$datatext1;
		}
	  }
	  echo CJSON::encode(array('data'=>$datatext,
		'data1'=>$datatext1));
	}
}