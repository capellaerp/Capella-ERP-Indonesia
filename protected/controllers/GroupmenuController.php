<?php

class GroupmenuController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname='groupmenu';
	public $menuaccess,$groupaccess;
    private $_lastId = null;

	public function actionHelp()
	{
	  $txt = '';
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $txt = '_help'; break;
				case 2 : $txt = '_helpmodif'; break;
			}
		}
	  parent::actionHelp($txt);
	}

    //group gridview
    protected function gridGroupName($data,$row)
    {
       if($this->_lastId != $data->groupaccessid)
        {
            $this->_lastId = $data->groupaccessid; //remember the last product id
            return $data->groupaccess->groupname;
        }
        else
             return '';
    }

	public function lookupdata()
	{
	  $this->menuaccess=new Menuaccess('searchwstatus');
	  $this->menuaccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Menuaccess']))
		$this->menuaccess->attributes=$_GET['Menuaccess'];

	  $this->groupaccess=new Groupaccess('searchwstatus');
	  $this->groupaccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Groupaccess']))
		$this->groupaccess->attributes=$_GET['Groupaccess'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
		$model=new Groupmenu;
		$this->lookupdata();
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'div'=>$this->renderPartial('_form', array('model'=>$model,
'groupaccess'=>$this->groupaccess,
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
      $id=$_POST['id'];
      $model=$this->loadModel($id[0]);
      $this->lookupdata();
      if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
          echo CJSON::encode(array(
              'status'=>'success',
              'groupmenuid'=>$model->groupmenuid,
              'groupaccessid'=>$model->groupaccessid,
              'groupname'=>$model->groupaccess->groupname,
              'menuaccessid'=>$model->menuaccessid,
              'menuname'=>$model->menuaccess->menuname,
              'isread'=>$model->isread,
              'iswrite'=>$model->iswrite,
              'ispost'=>$model->ispost,
              'isreject'=>$model->isreject,
              'isupload'=>$model->isupload,
              'isdownload'=>$model->isdownload,
              'div'=>$this->renderPartial('_form', array('model'=>$model,
                  'groupaccess'=>$this->groupaccess,
                  'menuaccess'=>$this->menuaccess), true)
              ));
          Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Groupmenu'], $_POST['Groupmenu']['groupmenuid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Groupmenu']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Groupmenu']['groupaccessid'],'emptygroupname','emptystring'),
            array($_POST['Groupmenu']['menuaccessid'],'emptymenuname','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Groupmenu'];
		if ((int)$_POST['Groupmenu']['groupmenuid'] > 0)
		{
		  $model=$this->loadModel($_POST['Groupmenu']['groupmenuid']);
		  $model->groupaccessid = $_POST['Groupmenu']['groupaccessid'];
		  $model->menuaccessid = $_POST['Groupmenu']['menuaccessid'];
		  $model->isread = $_POST['Groupmenu']['isread'];
		  $model->iswrite = $_POST['Groupmenu']['iswrite'];
		  $model->ispost = $_POST['Groupmenu']['ispost'];
		  $model->isreject = $_POST['Groupmenu']['isreject'];
		  $model->isupload = $_POST['Groupmenu']['isupload'];
		  $model->isdownload = $_POST['Groupmenu']['isdownload'];
		}
		else
		{
		  $model = new Groupmenu();
		  $model->attributes=$_POST['Groupmenu'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Groupmenu']['groupmenuid']);
              $this->GetSMessage('sogmnsertsuccess');
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
		  $model->delete();
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
		$model=new Groupmenu('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Groupmenu']))
			$model->attributes=$_GET['Groupmenu'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
'groupaccess'=>$this->groupaccess,
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
						$model=Groupmenu::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Groupmenu();
						}
						$model->groupmenuid = (int)$data[0];
						$groupaccess = Groupaccess::model()->findbyattributes(array('groupname'=>$data[1]));
						if ($groupaccess !== null)
						{
							$model->groupaccessid = $groupaccess->groupaccessid;
						}
						$menuaccess = Menuaccess::model()->findbyattributes(array('menuname'=>$data[2]));
						if ($menuaccess !== null)
						{
							$model->menuaccessid = $menuaccess->menuaccessid;
						}
						$model->isread = (int)$data[3];
						$model->iswrite = (int)$data[4];
						$model->ispost = (int)$data[5];
						$model->isreject = (int)$data[6];
						$model->isupload = (int)$data[7];
						$model->isdownload = (int)$data[8];
						$model->recordstatus = (int)$data[9];
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
			else
			{
				$this->messages = $this->messages . ' memory or harddisk full';
			}
			fclose($handle);
		}
		else
		{
			$this->messages = $this->messages . ' check your directory permission';
		}
		if ($this->messages == '') {
			$this->messages = 'success';
		}		
		echo $this->messages;
  }

  public function actionDownload()
	{
		parent::actionDownload();
		$sql = "select a.groupmenuid,b.groupname,c.menuname,a.isread,a.iswrite,a.ispost,a.isreject,a.isupload,a.isdownload
from groupmenu a
left join groupaccess b on b.groupaccessid = a.groupaccessid
left join menuaccess c on c.menuaccessid = a.menuaccessid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.groupmenuid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Group Menu List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C','C','C','C','C'));
		$this->pdf->setwidths(array(40,40,10,10,15,15,20,20));
		$this->pdf->Row(array('Group Name','Menu Name','Read','Write','Post','Reject','Upload','Download'));
		$this->pdf->setaligns(array('L','L','L','L','L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['groupname'],$row1['menuname'],$row1['isread']
		  ,$row1['iswrite']
		  ,$row1['ispost']
		  ,$row1['isreject']
		  ,$row1['isupload']
		  ,$row1['isdownload']));
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
		$model=Groupmenu::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='groupmenu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
