<?php

class SubdistrictController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'subdistrict';

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
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
		$model=new Subdistrict;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model), true)
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
if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'subdistrictid'=>$model->subdistrictid,
				'cityid'=>$model->cityid,
                'cityname'=>($model->city!==null)?$model->city->cityname:"",
				'subdistrictname'=>$model->subdistrictname,
				'zipcode'=>$model->zipcode,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)
				));
            Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Subdistrict'], $_POST['Subdistrict']['subdistrictid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Subdistrict']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Subdistrict']['cityid'],'emptycityname','emptystring'),
                array($_POST['Subdistrict']['subdistrictname'],'emptysubdistrict','emptystring'),
                array($_POST['Subdistrict']['zipcode'],'emptyzipcode','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Subdistrict'];
		if ((int)$_POST['Subdistrict']['subdistrictid'] > 0)
		{
		  $model=$this->loadModel($_POST['Subdistrict']['subdistrictid']);
		  $model->cityid = $_POST['Subdistrict']['cityid'];
		  $model->subdistrictname = $_POST['Subdistrict']['subdistrictname'];
		  $model->zipcode = $_POST['Subdistrict']['zipcode'];
		  $model->recordstatus = $_POST['Subdistrict']['recordstatus'];
		}
		else
		{
		  $model = new Subdistrict();
		  $model->attributes=$_POST['Subdistrict'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Subdistrict']['subdistrictid']);
              $this->GetSMessage('ccsdinsertsuccess');
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
	 * If deletion is successful, the browser will be redirected to the 'index' page.
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
    $model=new Subdistrict('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Subdistrict']))
			$model->attributes=$_GET['Subdistrict'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
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
						$model=Subdistrict::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Subdistrict();
						}
						$model->subdistrictid = (int)$data[0];
						$city = City::model()->findbyattributes(array('cityname'=>$data[1]));
						if ($city !== null)
						{
							$model->cityid = $city->cityid;
						}
						$model->subdistrictname = $data[2];
						$model->zipcode = $data[3];
						$model->recordstatus = (int)$data[4];
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
    $pdf = new PDF();
    $pdf->title='Absence Status List';
    $pdf->AddPage('P');
    $pdf->setFont('Arial','B',12);

    // definisi font
    $pdf->setFont('Arial','B',8);

    // menuliskan tabel
    $header = array('No','ID','Short Status','Long Status','Priority');
    $model=new Absstatus('searchwstatus');
    $dataprovider=$model->searchwstatus();
    $dataprovider->pagination=false;
    $data = $dataprovider->getData();
    $cols = $dataprovider->getKeys();
    $dataku=array(count($data));
    //var_dump($dataku);
    $w= array(20,25,30,40,50);

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
        $pdf->Cell($w[1],6,$datas['absstatusid'],'LR',0,'L',$fill);
        $pdf->Cell($w[2],6,$datas['shortstat'],'LR',0,'C',$fill);
        $pdf->Cell($w[3],6,$datas['longstat'],'LR',0,'L',$fill);
        $pdf->Cell($w[4],6,$datas['priority'],'LR',0,'C',$fill);
        $pdf->Ln();
        $fill=!$fill;
    }
    $pdf->Cell(array_sum($w),0,'','T');
    // me-render ke browser
    $pdf->Output('absencestatus.pdf','D');
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Subdistrict::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='subdistrict-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
