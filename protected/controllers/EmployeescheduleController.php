<?php

class EmployeescheduleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname = 'employeeschedule';

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
	public $employee;

	public function lookupdata()
	{
	  $this->employee=new Employee('searchwstatus');
	  $this->employee->unsetAttributes();  // clear any default values
	  if(isset($_GET['Employee']))
		$this->employee->attributes=$_GET['Employee'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
	  $this->lookupdata();
	  $model=new Employeeschedule;
    $model->recordstatus=1;
	  if (Yii::app()->request->isAjaxRequest)
	  {
		echo CJSON::encode(array(
			'status'=>'success',
			'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				'employee'=>$this->employee), true)
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
			'employeescheduleid'=>$model->employeescheduleid,
			'employeeid'=>$model->employeeid,
			'fullname'=>$model->employee->fullname,
			'month'=>$model->month,
			'year'=>$model->year,
			'd1' => $model->d1,
			'd1_name'=>($model->d100!==null)?$model->d100->absschedulename:"",
			'd2' => $model->d2,
			'd2_name'=>($model->d200!==null)?$model->d200->absschedulename:"",
			'd3' => $model->d3,
			'd3_name'=>($model->d300!==null)?$model->d300->absschedulename:"",
			'd4' => $model->d4,
			'd4_name'=>($model->d400!==null)?$model->d400->absschedulename:"",
			'd5' => $model->d5,
			'd5_name'=>($model->d500!==null)?$model->d500->absschedulename:"",
			'd6' => $model->d6,
			'd6_name'=>($model->d600!==null)?$model->d600->absschedulename:"",
			'd7' => $model->d7,
			'd7_name'=>($model->d700!==null)?$model->d700->absschedulename:"",
			'd8' => $model->d8,
			'd8_name'=>($model->d800!==null)?$model->d800->absschedulename:"",
			'd9' => $model->d9,
			'd9_name'=>($model->d900!==null)?$model->d900->absschedulename:"",
			'd10' => $model->d10,
			'd10_name'=>($model->d1000!==null)?$model->d1000->absschedulename:"",
			'd11' => $model->d11,
			'd11_name'=>($model->d1100!==null)?$model->d1100->absschedulename:"",
			'd12' => $model->d12,
			'd12_name'=>($model->d1200!==null)?$model->d1200->absschedulename:"",
			'd13' => $model->d13,
			'd13_name'=>($model->d1300!==null)?$model->d1300->absschedulename:"",
			'd14' => $model->d14,
			'd14_name'=>($model->d1400!==null)?$model->d1400->absschedulename:"",
			'd15' => $model->d15,
			'd15_name'=>($model->d1500!==null)?$model->d1500->absschedulename:"",
			'd16' => $model->d16,
			'd16_name'=>($model->d1600!==null)?$model->d1600->absschedulename:"",
			'd17' => $model->d17,
			'd17_name'=>($model->d1700!==null)?$model->d1700->absschedulename:"",
			'd18' => $model->d18,
			'd18_name'=>($model->d1800!==null)?$model->d1800->absschedulename:"",
			'd19' => $model->d19,
			'd19_name'=>($model->d1900!==null)?$model->d1900->absschedulename:"",
			'd20' => $model->d20,
			'd20_name'=>($model->d2000!==null)?$model->d2000->absschedulename:"",
			'd21' => $model->d21,
			'd21_name'=>($model->d2100!==null)?$model->d2100->absschedulename:"",
			'd22' => $model->d22,
			'd22_name'=>($model->d2200!==null)?$model->d2200->absschedulename:"",
			'd23' => $model->d23,
			'd23_name'=>($model->d2300!==null)?$model->d2300->absschedulename:"",
			'd24' => $model->d24,
			'd24_name'=>($model->d2400!==null)?$model->d2400->absschedulename:"",
			'd25' => $model->d25,
			'd25_name'=>($model->d2500!==null)?$model->d2500->absschedulename:"",
			'd26' => $model->d26,
			'd26_name'=>($model->d2600!==null)?$model->d2600->absschedulename:"",
			'd27' => $model->d27,
			'd27_name'=>($model->d2700!==null)?$model->d2700->absschedulename:"",
			'd28' => $model->d28,
			'd28_name'=>($model->d2800!==null)?$model->d2800->absschedulename:"",
			'd29' => $model->d29,
			'd29_name'=>($model->d2900!==null)?$model->d2900->absschedulename:"",
			'd30' => $model->d30,
			'd30_name'=>($model->d3000!==null)?$model->d3000->absschedulename:"",
			'd31' => $model->d31,
			'd31_name'=>($model->d3100!==null)?$model->d3100->absschedulename:"",
			'recordstatus'=>$model->employee->addressbook->recordstatus,
			'div'=>$this->renderPartial('_form', array('model'=>$model,
				'employee'=>$this->employee), true)
			));
		Yii::app()->end();
        }
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Employeeschedule'],
              $_POST['Employeeschedule']['employeescheduleid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Employeeschedule']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Employeeschedule']['employeeid'],'htesemptyemployeeid','emptystring'),
                array($_POST['Employeeschedule']['month'],'htesemptymonth','emptystring'),
                array($_POST['Employeeschedule']['year'],'htesemptyyear','emptystring'),
            )
        );
        if ($messages == '') {
		  //$dataku->attributes=$_POST['Employeeschedule'];
		  if ((int)$_POST['Employeeschedule']['employeescheduleid'] > 0)
		  {
			$connection=Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try
			{
			  $sql = 'call UpdateEmployeeSchedule(:vemployeescheduleid, :vemployeeid, :vmonth, :vyear,
				:vd1, :vd2, :vd3, :vd4, :vd5, :vd6, :vd7, :vd8, :vd9, :vd10, :vd11,
				:vd12, :vd13, :vd14, :vd15, :vd16, :vd17, :vd18, :vd19, :vd20, :vd21,
				:vd22, :vd23, :vd24, :vd25, :vd26, :vd27, :vd28, :vd29, :vd30, :vd31,
				:vlastupdateby)';
			  $command=$connection->createCommand($sql);
			  $command->bindParam(':vemployeescheduleid',$_POST['Employeeschedule']['employeescheduleid'],PDO::PARAM_INT);
			  $command->bindParam(':vemployeeid',$_POST['Employeeschedule']['employeeid'],PDO::PARAM_INT);
			  $command->bindParam(':vmonth',$_POST['Employeeschedule']['month'],PDO::PARAM_INT);
			  $command->bindParam(':vyear',$_POST['Employeeschedule']['year'],PDO::PARAM_INT);
			  $command->bindParam(':vd1',$_POST['Employeeschedule']['d1'],PDO::PARAM_INT);
			  $command->bindParam(':vd2',$_POST['Employeeschedule']['d2'],PDO::PARAM_INT);
			  $command->bindParam(':vd3',$_POST['Employeeschedule']['d3'],PDO::PARAM_INT);
			  $command->bindParam(':vd4',$_POST['Employeeschedule']['d4'],PDO::PARAM_INT);
			  $command->bindParam(':vd5',$_POST['Employeeschedule']['d5'],PDO::PARAM_INT);
			  $command->bindParam(':vd6',$_POST['Employeeschedule']['d6'],PDO::PARAM_INT);
			  $command->bindParam(':vd7',$_POST['Employeeschedule']['d7'],PDO::PARAM_INT);
			  $command->bindParam(':vd8',$_POST['Employeeschedule']['d8'],PDO::PARAM_INT);
			  $command->bindParam(':vd9',$_POST['Employeeschedule']['d9'],PDO::PARAM_INT);
			  $command->bindParam(':vd10',$_POST['Employeeschedule']['d10'],PDO::PARAM_INT);
			  $command->bindParam(':vd11',$_POST['Employeeschedule']['d11'],PDO::PARAM_INT);
			  $command->bindParam(':vd12',$_POST['Employeeschedule']['d12'],PDO::PARAM_INT);
			  $command->bindParam(':vd13',$_POST['Employeeschedule']['d13'],PDO::PARAM_INT);
			  $command->bindParam(':vd14',$_POST['Employeeschedule']['d14'],PDO::PARAM_INT);
			  $command->bindParam(':vd15',$_POST['Employeeschedule']['d15'],PDO::PARAM_INT);
			  $command->bindParam(':vd16',$_POST['Employeeschedule']['d16'],PDO::PARAM_INT);
			  $command->bindParam(':vd17',$_POST['Employeeschedule']['d17'],PDO::PARAM_INT);
			  $command->bindParam(':vd18',$_POST['Employeeschedule']['d18'],PDO::PARAM_INT);
			  $command->bindParam(':vd19',$_POST['Employeeschedule']['d19'],PDO::PARAM_INT);
			  $command->bindParam(':vd20',$_POST['Employeeschedule']['d20'],PDO::PARAM_INT);
			  $command->bindParam(':vd21',$_POST['Employeeschedule']['d21'],PDO::PARAM_INT);
			  $command->bindParam(':vd22',$_POST['Employeeschedule']['d22'],PDO::PARAM_INT);
			  $command->bindParam(':vd23',$_POST['Employeeschedule']['d23'],PDO::PARAM_INT);
			  $command->bindParam(':vd24',$_POST['Employeeschedule']['d24'],PDO::PARAM_INT);
			  $command->bindParam(':vd25',$_POST['Employeeschedule']['d25'],PDO::PARAM_INT);
			  $command->bindParam(':vd26',$_POST['Employeeschedule']['d26'],PDO::PARAM_INT);
			  $command->bindParam(':vd27',$_POST['Employeeschedule']['d27'],PDO::PARAM_INT);
			  $command->bindParam(':vd28',$_POST['Employeeschedule']['d28'],PDO::PARAM_INT);
			  $command->bindParam(':vd29',$_POST['Employeeschedule']['d29'],PDO::PARAM_INT);
			  $command->bindParam(':vd30',$_POST['Employeeschedule']['d30'],PDO::PARAM_INT);
			  $command->bindParam(':vd31',$_POST['Employeeschedule']['d31'],PDO::PARAM_INT);
			  $post=Useraccess::model()->find("username=':postID'", array(':postID'=>Yii::app()->user->name));
			  $command->bindParam(':vlastupdateby', $post,PDO::PARAM_INT);
			  $command->execute();
			  $transaction->commit();
              $this->DeleteLock($this->menuname, $_POST['Employeeschedule']['employeescheduleid']);
			  $this->GetSMessage('htesinsertsuccess');
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollBack();
				$this->GetMessage($e->getMessage());
			}
		  }
		  else
		  {
			$model = new Employeeschedule();
			$model->attributes=$_POST['Employeeschedule'];
			$connection=Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try
			{
			  $sql = 'call InsertEmployeeSchedule(:vemployeeid, :vmonth, :vyear,
				:vd1, :vd2, :vd3, :vd4, :vd5, :vd6, :vd7, :vd8, :vd9, :vd10, :vd11,
				:vd12, :vd13, :vd14, :vd15, :vd16, :vd17, :vd18, :vd19, :vd20, :vd21,
				:vd22, :vd23, :vd24, :vd25, :vd26, :vd27, :vd28, :vd29, :vd30, :vd31,
				:vcreatedby)';
			  $command=$connection->createCommand($sql);
			  $command->bindParam(':vemployeeid',$_POST['Employeeschedule']['employeeid'],PDO::PARAM_INT);
			  $command->bindParam(':vmonth',$_POST['Employeeschedule']['month'],PDO::PARAM_INT);
			  $command->bindParam(':vyear',$_POST['Employeeschedule']['year'],PDO::PARAM_INT);
			  $command->bindParam(':vd1',$_POST['Employeeschedule']['d1'],PDO::PARAM_INT);
			  $command->bindParam(':vd2',$_POST['Employeeschedule']['d2'],PDO::PARAM_INT);
			  $command->bindParam(':vd3',$_POST['Employeeschedule']['d3'],PDO::PARAM_INT);
			  $command->bindParam(':vd4',$_POST['Employeeschedule']['d4'],PDO::PARAM_INT);
			  $command->bindParam(':vd5',$_POST['Employeeschedule']['d5'],PDO::PARAM_INT);
			  $command->bindParam(':vd6',$_POST['Employeeschedule']['d6'],PDO::PARAM_INT);
			  $command->bindParam(':vd7',$_POST['Employeeschedule']['d7'],PDO::PARAM_INT);
			  $command->bindParam(':vd8',$_POST['Employeeschedule']['d8'],PDO::PARAM_INT);
			  $command->bindParam(':vd9',$_POST['Employeeschedule']['d9'],PDO::PARAM_INT);
			  $command->bindParam(':vd10',$_POST['Employeeschedule']['d10'],PDO::PARAM_INT);
			  $command->bindParam(':vd11',$_POST['Employeeschedule']['d11'],PDO::PARAM_INT);
			  $command->bindParam(':vd12',$_POST['Employeeschedule']['d12'],PDO::PARAM_INT);
			  $command->bindParam(':vd13',$_POST['Employeeschedule']['d13'],PDO::PARAM_INT);
			  $command->bindParam(':vd14',$_POST['Employeeschedule']['d14'],PDO::PARAM_INT);
			  $command->bindParam(':vd15',$_POST['Employeeschedule']['d15'],PDO::PARAM_INT);
			  $command->bindParam(':vd16',$_POST['Employeeschedule']['d16'],PDO::PARAM_INT);
			  $command->bindParam(':vd17',$_POST['Employeeschedule']['d17'],PDO::PARAM_INT);
			  $command->bindParam(':vd18',$_POST['Employeeschedule']['d18'],PDO::PARAM_INT);
			  $command->bindParam(':vd19',$_POST['Employeeschedule']['d19'],PDO::PARAM_INT);
			  $command->bindParam(':vd20',$_POST['Employeeschedule']['d20'],PDO::PARAM_INT);
			  $command->bindParam(':vd21',$_POST['Employeeschedule']['d21'],PDO::PARAM_INT);
			  $command->bindParam(':vd22',$_POST['Employeeschedule']['d22'],PDO::PARAM_INT);
			  $command->bindParam(':vd23',$_POST['Employeeschedule']['d23'],PDO::PARAM_INT);
			  $command->bindParam(':vd24',$_POST['Employeeschedule']['d24'],PDO::PARAM_INT);
			  $command->bindParam(':vd25',$_POST['Employeeschedule']['d25'],PDO::PARAM_INT);
			  $command->bindParam(':vd26',$_POST['Employeeschedule']['d26'],PDO::PARAM_INT);
			  $command->bindParam(':vd27',$_POST['Employeeschedule']['d27'],PDO::PARAM_INT);
			  $command->bindParam(':vd28',$_POST['Employeeschedule']['d28'],PDO::PARAM_INT);
			  $command->bindParam(':vd29',$_POST['Employeeschedule']['d29'],PDO::PARAM_INT);
			  $command->bindParam(':vd30',$_POST['Employeeschedule']['d30'],PDO::PARAM_INT);
			  $command->bindParam(':vd31',$_POST['Employeeschedule']['d31'],PDO::PARAM_INT);
			  $post=Useraccess::model()->find("username=':postID'", array(':postID'=>Yii::app()->user->name));
			  $command->bindParam(':vcreatedby', $post,PDO::PARAM_INT);
			  $command->execute();
			  $transaction->commit();
              $this->DeleteLock($this->menuname, $_POST['Employeeschedule']['employeescheduleid']);
			  $this->GetSMessage('htesinsertsuccess');
			}
			catch (Exception $e)
			{
			  $transaction->rollBack();
			  $this->GetMessage($e->getMessage());
            }
          }
		}
	  }
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
              $empid = Employee::model()->findbyattributes(array('oldnik'=>$data[0]));
              $model = new Employeeschedule();
              if ($empid != null) {
                  $model=Employeeschedule::model()->findByattributes(array('employeeid'=>$empid->employeeid,'month'=>$data[2],'year'=>$data[3]));
                  if ($model == null) {
                    $model = new Employeeschedule();
                  }
                  $model->employeeid = $empid->employeeid;
                  $model->month = $data[2];
                  $model->year = $data[3];
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[4]));
                  if ($d != null) {
                    $model->d1 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[5]));
                  if ($d != null) {
                    $model->d2 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[6]));
                  if ($d != null) {
                    $model->d3 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[7]));
                  if ($d != null) {
                    $model->d4 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[8]));
                  if ($d != null) {
                    $model->d5 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[9]));
                  if ($d != null) {
                    $model->d6 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[10]));
                  if ($d != null) {
                    $model->d7 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[11]));
                  if ($d != null) {
                    $model->d8 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[12]));
                  if ($d != null) {
                    $model->d9 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[13]));
                  if ($d != null) {
                    $model->d10 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[14]));
                  if ($d != null) {
                    $model->d11 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[15]));
                  if ($d != null) {
                    $model->d12 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[16]));
                  if ($d != null) {
                    $model->d13 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[17]));
                  if ($d != null) {
                    $model->d14 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[18]));
                  if ($d != null) {
                    $model->d15 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[19]));
                  if ($d != null) {
                    $model->d16 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[20]));
                  if ($d != null) {
                    $model->d17 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[21]));
                  if ($d != null) {
                    $model->d18 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[22]));
                  if ($d != null) {
                    $model->d19 = $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[23]));
                  if ($d != null) {
                    $model->d20= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[24]));
                  if ($d != null) {
                    $model->d21= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[25]));
                  if ($d != null) {
                    $model->d22= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[26]));
                  if ($d != null) {
                    $model->d23= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[27]));
                  if ($d != null) {
                    $model->d24= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[28]));
                  if ($d != null) {
                    $model->d25= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[29]));
                  if ($d != null) {
                    $model->d26= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[30]));
                  if ($d != null) {
                    $model->d27= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[31]));
                  if ($d != null) {
                    $model->d28= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[32]));
                  if ($d != null) {
                    $model->d29= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[33]));
                  if ($d != null) {
                    $model->d30= $d->absscheduleid;
                  }
                  $d = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[34]));
                  if ($d != null) {
                    $model->d31= $d->absscheduleid;
                  }
                  $model->recordstatus = Wfgroup::model()->findstatusbyuser('insempsched');
                  
              }
              try
              {
				if(!$model->save())
				{
				  $this->messages = $this->messages . Catalogsys::model()->getcatalog(' upload error at '.$data[0]);
				}
                else
                {
                  $a = Yii::app()->user->name;
                  $connection=Yii::app()->db;
                  $transaction=$connection->beginTransaction();
                  try
                  {
                    $sql = 'call ApproveEmployeeSchedule(:vid, :vlastupdateby)';
                    $command=$connection->createCommand($sql);
                    $command->bindvalue(':vid',$model->employeescheduleid,PDO::PARAM_INT);
                    $command->bindvalue(':vlastupdateby', $a,PDO::PARAM_STR);
                    $command->execute();
                    $transaction->commit();
                  }
                  catch(Exception $e) // an exception is raised if a query fails
                  {
                      $this->messages = $this->messages . Catalogsys::model()->getcatalog(' upload error at '.$data[0]);
                  }
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
    $sql = "select a.employeeid,a.fullname, a.oldnik, b.levelorgname, c.structurename,d.positionname,e.employeetypename,
        f.sexname,joindate,email,phoneno,alternateemail,hpno,a.addressbookid
      from employee a
      left join levelorg b on b.levelorgid = a.levelorgid
      left join orgstructure c on c.orgstructureid = a.orgstructureid
      left join position d on d.positionid = a.positionid
      left join employeetype e on e.employeetypeid = a.employeetypeid
      left join sex f on f.sexid = a.sexid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.employeeid = ".$_GET['id'];
		}
		$sql = $sql . " order by employeeid ";
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Employee List';
	  $this->pdf->AddPage('L');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    foreach($dataReader as $row)
    {
      if (file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/employee/photo-'.$row['oldnik'].'.jpg'))
      {
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/employee/photo-'. $row['oldnik'] .'.jpg',10,30,30);
      }
      $this->pdf->setFont('Arial','B',10);
      $this->pdf->text(50,30,'Nama: '.$row['fullname']);
      $this->pdf->setFont('Arial','',8);
      $this->pdf->text(50,35,'Golongan: '.$row['levelorgname']);
      $this->pdf->text(50,40,'Struktur: '.$row['structurename']);
      $this->pdf->text(50,45,'Posisi: '.$row['positionname']);
      $this->pdf->text(50,50,'Jenis Kelamin: '.$row['sexname']);
      $this->pdf->text(50,55,'Email Utama: '.$row['email']);
      $this->pdf->text(50,65,'Email ke-2: '.$row['alternateemail']);
      $this->pdf->text(50,70,'Telp: '.$row['phoneno']);
      $this->pdf->text(50,75,'No HP: '.$row['hpno']);

      $sql1 = "select month,year,getschednamebyschedid(d1) as vd1,
        getschednamebyschedid(d2) as vd2,
        getschednamebyschedid(d3) as vd3,
        getschednamebyschedid(d4) as vd4,
        getschednamebyschedid(d5) as vd5,
        getschednamebyschedid(d6) as vd6,
        getschednamebyschedid(d7) as vd7,
        getschednamebyschedid(d8) as vd8,
        getschednamebyschedid(d9) as vd9,
        getschednamebyschedid(d10) as vd10,
        getschednamebyschedid(d11) as vd11,
        getschednamebyschedid(d12) as vd12,
        getschednamebyschedid(d13) as vd13,
        getschednamebyschedid(d14) as vd14,
        getschednamebyschedid(d15) as vd15,
        getschednamebyschedid(d16) as vd16,
        getschednamebyschedid(d17) as vd17,
        getschednamebyschedid(d18) as vd18,
        getschednamebyschedid(d19) as vd19,
        getschednamebyschedid(d20) as vd20,
        getschednamebyschedid(d21) as vd21,
        getschednamebyschedid(d22) as vd22,
        getschednamebyschedid(d23) as vd23,
        getschednamebyschedid(d24) as vd24,
        getschednamebyschedid(d25) as vd25,
        getschednamebyschedid(d26) as vd26,
        getschednamebyschedid(d27) as vd27,
        getschednamebyschedid(d28) as vd28,
        getschednamebyschedid(d29) as vd29,
        getschednamebyschedid(d30) as vd30,
        getschednamebyschedid(d31) as vd31
        from employeeschedule a
        where employeeid = ".$row['employeeid'].
        " order by year desc, month desc";
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,90,'Schedule List');
      $this->pdf->SetY(95);
      $this->pdf->setaligns(array('C','C','C','C','C','C','C','C','C','C','C','C',
          'C','C','C','C','C','C','C','C','C','C','C','C','C','C'
          ,'C','C','C','C','C','C','C'));
      $this->pdf->setwidths(array(10,10,8,8,8,8,8,8,8,8,8,8
          ,8,8,8,8,8,8,8,8,8,8,8,8,8,8
          ,8,8,8,8,8,8,8));
      $this->pdf->Row(array('Month','Year','1','2','3','4','5','6','7','8','9','10',
          '11','12','13','14','15','16','17','18','19','20','21','22','23','24',
          '25','26','27','28','29','30','31'));
      $this->pdf->setaligns(array('L','L','L','L','L','L','L','L','L','L','L','L'
          ,'L','L','L','L','L','L','L','L','L','L','L','L','L','L'
          ,'L','L','L','L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['month'],$row1['year'],$row1['vd1'],$row1['vd2'],
            $row1['vd3'],$row1['vd4'],$row1['vd5'],$row1['vd6'],$row1['vd7'],
            $row1['vd8'],$row1['vd9'],$row1['vd10'],$row1['vd11'],$row1['vd12']
            ,$row1['vd13'],$row1['vd14'],$row1['vd15'],$row1['vd16'],$row1['vd17']
            ,$row1['vd18'],$row1['vd19'],$row1['vd20'],$row1['vd21'],$row1['vd22']
            ,$row1['vd23'],$row1['vd24'],$row1['vd25'],$row1['vd26'],$row1['vd27']
            ,$row1['vd28'],$row1['vd29'],$row1['vd30'],$row1['vd31']));
      }
      $this->pdf->AddPage('L');
    }

    // me-render ke browser
    $this->pdf->Output();
  }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
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

    public function actionApprove()
	{
      parent::actionApprove();
      $id=$_POST['id'];
      foreach($id as $ids)
      {
        //$model=$this->loadModel($ids);
                $a = Yii::app()->user->name;
        $connection=Yii::app()->db;
          $transaction=$connection->beginTransaction();
          try
          {
            $sql = 'call ApproveEmployeeSchedule(:vid, :vlastupdateby)';
            $command=$connection->createCommand($sql);
            $command->bindvalue(':vid',$ids,PDO::PARAM_INT);
            $command->bindvalue(':vlastupdateby', $a,PDO::PARAM_STR);
            $command->execute();
            $transaction->commit();
            $this->GetSMessage('pprinsertsuccess');
          }
          catch(Exception $e) // an exception is raised if a query fails
          {
              $transaction->rollBack();
              $this->GetMessage($e->getMessage());
          }
      }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
    parent::actionIndex();
	  $this->lookupdata();
	  $model=new Employeeschedule('searchwstatus');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Employeeschedule']))
		  $model->attributes=$_GET['Employeeschedule'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		  'model'=>$model,
		  'employee'=>$this->employee
	  ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Employeeschedule::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='employeeschedule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
