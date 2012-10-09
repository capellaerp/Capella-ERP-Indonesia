<?php

class MenuauthController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'menuauth';
public function actionHelp()
	{
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $this->txt = '_help'; break;
				case 2 : $this->txt = '_helpmodif'; break;
			}
		}
	  parent::actionHelp();
	}

    public $menuaccess;

	public function lookupdata()
	{
	  $this->menuaccess=new Menuaccess('searchwstatus');
	  $this->menuaccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Menuaccess']))
		$this->menuaccess->attributes=$_GET['Menuaccess'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
      $this->lookupdata();
	  $model=new Menuauth;

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
                  'menuaccess'=>$this->menuaccess), true)
			  ));
		  Yii::app()->end();
	  }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
	  parent::actionUpdate();
      $this->lookupdata();
      $id=$_POST['id'];
      $model=$this->loadModel($id[0]);
      if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'menuauthid'=>$model->menuauthid,
				'menuaccessid'=>$model->menuaccessid,
                'menuname'=>($model->menuaccess!==null)?$model->menuaccess->menuname:"",
				'menuobject'=>$model->menuobject,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
                  'menuaccess'=>$this->menuaccess), true)
				));
            Yii::app()->end();
        }
      }
	}

   public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Menuauth'], $_POST['Menuauth']['menuauthid']);
    }

    public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Menuauth']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Menuauth']['menuaccessid'],'emptymenuname','emptystring'),
            array($_POST['Menuauth']['menuobject'],'emptymenuobject','emptystring'),
            )
        );
        if ($messages == '') {
          if ((int)$_POST['Menuauth']['menuauthid'] > 0)
          {
            $model=$this->loadModel($_POST['Menuauth']['menuauthid']);
            $model->menuaccessid = $_POST['Menuauth']['menuaccessid'];
            $model->menuobject = $_POST['Menuauth']['menuobject'];
            $model->recordstatus = $_POST['Menuauth']['recordstatus'];
          }
          else
          {
            $model = new Menuauth();
            $model->attributes=$_POST['Menuauth'];
          }
          try
            {
              if($model->save())
              {
                $this->DeleteLock($this->menuname, $_POST['Menuauth']['menuauthid']);
                $this->GetSMessage('sumansertsuccess');
              }
              else
              {
                $this->GetMessage($model->getErrors());
              }
            }
            catch (Exception $e)
            {
              $this->GetMessage($e->getMessage());
            }
          }
	  }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		parent::actionDelete();
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=$this->loadModel($ids);
		  $model->recordstatus=0;
		  $model->save();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	  parent::actionIndex();
      $this->lookupdata();
		$model=new Menuauth('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Menuauth']))
			$model->attributes=$_GET['Menuauth'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
                  'menuaccess'=>$this->menuaccess
		));
	}

	public function actionUpload()
	{
		parent::actionUpload();
		$folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';// folder for uploaded files
		$file = $folder . basename($_FILES['uploadfile']['name']); 
		if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) 
		{ 
			$row = 0;
			if (($handle = fopen($file, "r")) !== FALSE) 
			{
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
				{
					if ($row>0) {
						$model=Menuauth::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Menuauth();
						}
						$model->menuauthid = (int)$data[0];
						$menuname = Menuaccess::model()->findbyattributes(array('menuname'=>$data[1]));
						if ($menuname !==null)
						{
							$model->menuaccessid = $menuname->menuaccessid;
						}
						$model->menuobject = $data[2];
						$model->recordstatus = (int)$data[3];
						try
						{
							if(!$model->save())
							{
								$this->messages = $this->messages . Catalogsys::model()->getcatalog(' upload error at '.$data[0]);
							}
						}
						catch (Exception $e)
						{
							$this->messages = $this->messages .  $e->getMessage();
						}
					}
					$row++;
				}
			}
		}
	}

  public function actionDownload()
  {
	parent::actionDownload();
    $sql = "select b.menuname, a.menuobject
				from menuauth a 
				left join menuaccess b on b.menuaccessid = a.menuaccessid";
	if ($_GET['id'] !== '') {
			$sql = $sql . "where a.menuauthid = ".$_GET['id'];
	}
	$command=$this->connection->createCommand($sql);
	$dataReader=$command->queryAll();
		
	$this->pdf->title='Menu Object Authentication List';
	$this->pdf->AddPage('P');
	$this->pdf->setFont('Arial','B',12);

	// definisi font
	$this->pdf->setFont('Arial','B',8);

	$this->pdf->setaligns(array('C','C','C','C'));
	$this->pdf->setwidths(array(40,40,40,60));
	$this->pdf->Row(array('Menu Name','Menu Object'));
	$this->pdf->setaligns(array('L','L','L','L'));
	foreach($dataReader as $row1)
	{
	  $this->pdf->row(array($row1['menuname'],$row1['menuobject']));
	}
	$this->pdf->Output();
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Menuauth::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='menuauth-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
