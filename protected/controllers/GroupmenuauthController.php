<?php

class GroupmenuauthController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname='groupmenuauth';
	public $menuauth,$groupaccess;
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

	public function lookupdata()
	{
	  $this->menuauth=new Menuauth('searchwstatus');
	  $this->menuauth->unsetAttributes();  // clear any default values
	  if(isset($_GET['Menuauth']))
		$this->menuauth->attributes=$_GET['Menuauth'];

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
		$model=new Groupmenuauth;
		$this->lookupdata();
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'div'=>$this->renderPartial('_form', array('model'=>$model,
'groupaccess'=>$this->groupaccess,
'menuauth'=>$this->menuauth), true)
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
                  'menuauth'=>$this->menuauth), true)
              ));
          Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Groupmenuauth'], $_POST['Groupmenuauth']['groupmenuid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Groupmenuauth']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Groupmenuauth']['groupaccessid'],'emptygroupname','emptystring'),
            array($_POST['Groupmenuauth']['menuauthidid'],'emptymenuauth','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Groupmenuauth'];
		if ((int)$_POST['Groupmenuauth']['groupmenuid'] > 0)
		{
		  $model=$this->loadModel($_POST['Groupmenuauth']['groupmenuid']);
		  $model->groupaccessid = $_POST['Groupmenuauth']['groupaccessid'];
		  $model->menuaccessid = $_POST['Groupmenuauth']['menuaccessid'];
		  $model->isread = $_POST['Groupmenuauth']['isread'];
		  $model->iswrite = $_POST['Groupmenuauth']['iswrite'];
		  $model->ispost = $_POST['Groupmenuauth']['ispost'];
		  $model->isreject = $_POST['Groupmenuauth']['isreject'];
		  $model->isupload = $_POST['Groupmenuauth']['isupload'];
		  $model->isdownload = $_POST['Groupmenuauth']['isdownload'];
		}
		else
		{
		  $model = new Groupmenuauth();
		  $model->attributes=$_POST['Groupmenuauth'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Groupmenuauth']['groupmenuid']);
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
		$model=new Groupmenuauth('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Groupmenuauth']))
			$model->attributes=$_GET['Groupmenuauth'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
'groupaccess'=>$this->groupaccess,
'menuauth'=>$this->menuauth
		));
	}

	public function actionUpload()
	{
      parent::actionUpload();
	  $folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';// folder for uploaded files
	  $allowedExtensions = array("csv");
	  $sizeLimit = (int)Yii::app()->params['sizeLimit'];// maximum file size in bytes
	  $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
	  $result = $uploader->handleUpload($folder,true);
	  $row = 0;
	  if (($handle = fopen($folder.$uploader->file->getName(), "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if ($row>0) {
			  $model=Groupmenuauth::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Groupmenuauth();
			  }
			  $model->groupmenuid = (int)$data[0];
			  $model->groupaccessid = (int)$data[1];
			  $model->menuaccessid = (int)$data[2];
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
				  $errormessage=$model->getErrors();
				  if (Yii::app()->request->isAjaxRequest)
				  {
					echo CJSON::encode(array(
					  'status'=>'failure',
					  'div'=>$errormessage
					));
				  }
				}
			  }
			  catch (Exception $e)
			  {
				$errormessage=$e->getMessage();
				if (Yii::app()->request->isAjaxRequest)
				  {
					echo CJSON::encode(array(
					  'status'=>'failure',
					  'div'=>$errormessage
					));
				  }
			  }
			}
			$row++;
		  }
		  fclose($handle);
	  }
	  $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	  echo $result;
  }

  public function actionDownload()
  {
    parent::actionDownload();
    $pdf = new PDF();
    $pdf->title='Group Menu List';
    $pdf->AddPage('P');
    $pdf->setFont('Arial','B',12);

    // definisi font
    $pdf->setFont('Arial','B',8);

    // menuliskan tabel
    $header = array('No','ID','Group Name','Menu Name','Is Read','Is Write',
	  'Is Post','Is Reject','Is Upload','Is Download');
    $dataprovider=Groupmenuauth::model()->search();
    $dataprovider->pagination=false;
    $data = $dataprovider->getData();
    $cols = $dataprovider->getKeys();
    $dataku=array(count($data));
    //var_dump($dataku);
    $w= array(10,15,40,30,15,15,15,15,20,20);

    $pdf->SetTableHeader();
    //Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    $pdf->SetTableData();
    //Data
    $fill=false;
    $i=0;
    foreach($data as $datas)
    {
        $i=$i+1;
        $pdf->Cell($w[0],6,$i,'LR',0,'L',$fill);
        $pdf->Cell($w[1],6,$datas['groupmenuid'],'LR',0,'L',$fill);
        $pdf->Cell($w[2],6,Groupaccess::model()->findbypk($datas['groupaccessid'])->groupname,'LR',0,'L',$fill);
        $pdf->Cell($w[3],6,Menuaccess::model()->findbypk($datas['menuaccessid'])->menuname,'LR',0,'L',$fill);
		if ($datas['isread']=='1') {
		  $pdf->Cell($w[4],6,'V','LR',0,'C',$fill);
		} else
		  $pdf->Cell($w[4],6,'','LR',0,'C',$fill);
		if ($datas['iswrite']=='1') {
		  $pdf->Cell($w[5],6,'V','LR',0,'C',$fill);
		} else
		  $pdf->Cell($w[5],6,'','LR',0,'C',$fill);
		if ($datas['ispost']=='1') {
		  $pdf->Cell($w[6],6,'V','LR',0,'C',$fill);
		} else
		  $pdf->Cell($w[6],6,'','LR',0,'C',$fill);
		if ($datas['isreject']=='1') {
		  $pdf->Cell($w[7],6,'V','LR',0,'C',$fill);
		} else
		  $pdf->Cell($w[8],6,'','LR',0,'C',$fill);
		if ($datas['isupload']=='1') {
		  $pdf->Cell($w[8],6,'V','LR',0,'C',$fill);
		} else
		  $pdf->Cell($w[8],6,'','LR',0,'C',$fill);
		if ($datas['isdownload']=='1') {
		  $pdf->Cell($w[9],6,'V','LR',0,'C',$fill);
		} else
		  $pdf->Cell($w[9],6,'','LR',0,'C',$fill);
        $pdf->Ln();
        $fill=!$fill;
    }
    $pdf->Cell(array_sum($w),0,'','T');
    // me-render ke browser
    $pdf->Output('groupmenu.pdf','D');
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Groupmenuauth::model()->findByPk($id);
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
