<?php

class EmployeeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'employee';

	public function actionHelp()
	{
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $this->txt = '_help'; break;
				case 2 : $this->txt = '_helpmodif'; break;
				case 3 : $this->txt = '_helpservice'; break;
				case 4 : $this->txt = '_helpservicemodif'; break;
				case 5 : $this->txt = '_helppic'; break;
				case 6 : $this->txt = '_helppicmodif'; break;
				case 7 : $this->txt = '_helplocation'; break;
				case 8 : $this->txt = '_helplocationmodif'; break;
				case 9 : $this->txt = '_helpdocument'; break;
				case 10 : $this->txt = '_helpdocumentmodif'; break;
				case 11 : $this->txt = '_helpnetwork'; break;
				case 12 : $this->txt = '_helpnetworkmodif'; break;
			}
		}
		parent::actionHelp();
	}

	public $employeeaddress, $employeeeducation, $employeeinformal, $employeewo, $employeefamily;

	public function lookupdata()
	{
		$this->employeeaddress=new Employeeaddress('search');
		$this->employeeaddress->unsetAttributes();  
		if(isset($_GET['Employeeaddress']))
		$this->employeeaddress->attributes=$_GET['Employeeaddress'];
		
		$this->employeeeducation=new Employeeeducation('search');
		$this->employeeeducation->unsetAttributes();  
		if(isset($_GET['Employeeeducation']))
		$this->employeeeducation->attributes=$_GET['Employeeeducation'];
		
		$this->employeeinformal=new Employeeinformal('search');
		$this->employeeinformal->unsetAttributes();  
		if(isset($_GET['Employeeinformal']))
		$this->employeeinformal->attributes=$_GET['Employeeinformal'];		
		
		$this->employeewo=new Employeewo('search');
		$this->employeewo->unsetAttributes();  
		if(isset($_GET['Employeewo']))
		$this->employeewo->attributes=$_GET['Employeewo'];		
		
		$this->employeefamily=new Employeefamily('search');
		$this->employeefamily->unsetAttributes();  
		if(isset($_GET['Employeefamily']))
		$this->employeefamily->attributes=$_GET['Employeefamily'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
	  $this->lookupdata();
	  $ab = new Addressbook;
	  $ab->recordstatus=1;
	  $ab->isemployee=1;
	  $ab->fullname='fullname';
	  $ab->save();
		$model=new Employee;
		$model->fullname='fullname';
$model->addressbookid = $ab->addressbookid;		
		if (Yii::app()->request->isAjaxRequest)
        {
			if ($model->save()) {
			  echo CJSON::encode(array(
				  'status'=>'success',
				  'employeeid'=>$model->employeeid,
				  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'employeeaddress'=>$this->employeeaddress,
				  'employeeeducation'=>$this->employeeeducation,
				  'employeeinformal'=>$this->employeeinformal,
				  'employeewo'=>$this->employeewo,
				  'employeefamily'=>$this->employeefamily), true)
				  ));
			  Yii::app()->end();
			}
        }
	}

	public function actionCreateaddress()
	{
		parent::actionCreate();
		$employeeaddress=new Employeeaddress;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formaddress',
				  array('model'=>$employeeaddress), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionCreateeducation()
	{
		parent::actionCreate();
		$employeeeducation=new Employeeeducation;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formeducation',
				  array('model'=>$employeeeducation), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionCreateinformal()
	{
		parent::actionCreate();
		$employeeinformal=new Employeeinformal;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_forminformal',
				  array('model'=>$employeeinformal), true)
				));
            Yii::app()->end();
        }
	}

	public function actionCreatewo()
	{
		parent::actionCreate();
		$employeewo=new Employeewo;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formwo',
				  array('model'=>$employeewo), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionCreatefamily()
	{
		parent::actionCreate();
		$employeefamily=new Employeefamily;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formfamily',
				  array('model'=>$employeefamily), true)
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
		parent::actionCreate();
		$id=$_POST['id'];
	  $model=$this->loadModel($id[0]);

	  $this->lookupdata();

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'employeeid'=>$model->employeeid,
			  'addressbookid'=>$model->addressbookid,
			  'fullname'=>$model->fullname,
			  'oldnik'=>$model->oldnik,
			  'orgstructureid'=>$model->orgstructureid,
			  'structurename'=>($model->orgstructure!==null)?$model->orgstructure->structurename:"",
			  'positionid'=>$model->positionid,
			  'positionname'=>($model->position!==null)?$model->position->positionname:"",
			  'employeetypeid'=>$model->employeetypeid,
			  'employeetypename'=>($model->employeetype!==null)?$model->employeetype->employeetypename:"",
			  'sexid'=>$model->sexid,
			  'sexname'=>($model->sex!==null)?$model->sex->sexname:"",
			  'birthcityid'=>$model->birthcityid,
			  'birthcityname'=>($model->birthcity!==null)?$model->birthcity->cityname:"",
			  'birthdate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->birthdate)),
			  'religionid'=>$model->religionid,
			  'religionname'=>($model->religion!==null)?$model->religion->religionname:"",
			  'maritalstatusid'=>$model->maritalstatusid,
			  'maritalstatusname'=>($model->maritalstatus!==null)?$model->maritalstatus->maritalstatusname:"",
			  'referenceby'=>$model->referenceby,
			  'joindate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->joindate)),
			  'employeestatusid'=>$model->employeestatusid,
			  'employeestatusname'=>($model->employeestatus!==null)?$model->employeestatus->employeestatusname:"",
			  'istrial'=>$model->istrial,
			  'resigndate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->resigndate)),
			  'levelorgid'=>$model->levelorgid,
			  'levelorgname'=>($model->levelorg!==null)?$model->levelorg->levelorgname:"",
              'taxno'=>$model->taxno,
			  'accountno'=>$model->accountno,
                'div'=>$this->renderPartial('_form', array('model'=>$model,'employeeaddress'=>$this->employeeaddress,
				  'employeeeducation'=>$this->employeeeducation,
				  'employeeinformal'=>$this->employeeinformal,
				  'employeewo'=>$this->employeewo,
				  'employeefamily'=>$this->employeefamily), true)
				));
            Yii::app()->end();
        }
	}

	public function actionUpdateaddress()
	{
		$id=$_POST['id'];
	  $employeeaddress=$this->loadModeldetail($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'addressid'=>$employeeaddress->addressid,
                'addresstypeid'=>$employeeaddress->addresstypeid,
                'addresstypename'=>($employeeaddress->addresstype!==null)?$employeeaddress->addresstype->addresstypename:"",
                'addressname'=>$employeeaddress->addressname,
                'rt'=>$employeeaddress->rt,
                'rw'=>$employeeaddress->rw,
                'cityid'=>$employeeaddress->cityid,
                'cityname'=>($employeeaddress->city!==null)?$employeeaddress->city->cityname:"",
                'kelurahanid'=>$employeeaddress->kelurahanid,
                'kelurahanname'=>($employeeaddress->kelurahan!==null)?$employeeaddress->kelurahan->kelurahanname:"",
                'subdistrictid'=>$employeeaddress->subdistrictid,
                'subdistrictname'=>($employeeaddress->subdistrict!==null)?$employeeaddress->subdistrict->subdistrictname:"",
                'div'=>$this->renderPartial('_formaddress',
				  array('model'=>$employeeaddress), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionUpdateeducation()
	{
		$id=$_POST['id'];
	  $employeeeducation=$this->loadModeleducation($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'employeeeducationid'=>$employeeeducation->employeeeducationid,
				'educationid'=>$employeeeducation->educationid,
				'educationname'=>($employeeeducation->education!==null)?$employeeeducation->education->educationname:"",
				'schoolname'=>$employeeeducation->schoolname,
				'schooldegree'=>$employeeeducation->schooldegree,
				'cityid'=>$employeeeducation->cityid,
				'cityname'=>$employeeeducation->city->cityname,
				'yeargraduate'=>$employeeeducation->yeargraduate,
				'isdiploma'=>$employeeeducation->isdiploma,
				'recordstatus'=>$employeeeducation->recordstatus,
                'div'=>$this->renderPartial('_formeducation',
				  array('model'=>$employeeeducation), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionUpdateinformal()
	{
		$id=$_POST['id'];
	  $employeeinformal=$this->loadModelinformal($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'employeeinformalid'=>$employeeinformal->employeeinformalid,
				'informalname'=>$employeeinformal->informalname,
				'organizer'=>$employeeinformal->organizer,
				'period'=>$employeeinformal->period,
				'isdiploma'=>$employeeinformal->isdiploma,
				'sponsoredby'=>$employeeinformal->sponsoredby,
				'iswo'=>$employeeinformal->iswo,
				'recordstatus'=>$employeeinformal->recordstatus,
                'div'=>$this->renderPartial('_forminformal',
				  array('model'=>$employeeinformal), true)
				));
            Yii::app()->end();
        }
	}

	public function actionUpdatewo()
	{
		$id=$_POST['id'];
	  $employeewo=$this->loadModelinformal($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'employeeinformalid'=>$employeewo->employeeinformalid,
				'informalname'=>$employeewo->informalname,
				'organizer'=>$employeewo->organizer,
				'period'=>$employeewo->period,
				'isdiploma'=>$employeewo->isdiploma,
				'sponsoredby'=>$employeewo->sponsoredby,
				'iswo'=>$employeewo->iswo,
				'recordstatus'=>$employeewo->recordstatus,
                'div'=>$this->renderPartial('_formwo',
				  array('model'=>$employeewo), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionUpdatefamily()
	{
		$id=$_POST['id'];
	  $employeefamily=$this->loadModelfamily($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'employeefamilyid'=>$employeefamily->employeeinformalid,
				'familyrelationid'=>$employeefamily->familyrelationid,
				'familyrelationname'=>($employeefamily->familyrelation!==null)?$employeefamily->familyrelation->familyrelationname:"",
				'familyname'=>$employeefamily->familyname,
				'sexid'=>$employeefamily->sexid,
				'sexname'=>($employeefamily->sex!==null)?$employeefamily->sex->sexname:"",
				'cityid'=>$employeefamily->cityid,
				'cityname'=>($employeefamily->city!==null)?$employeefamily->city->cityname:"",
				'cityid'=>$employeefamily->cityid,
				'birthdate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($employeefamily->birthdate)),
				'educationid'=>$employeefamily->educationid,
				'educationname'=>($employeefamily->education!==null)?$employeefamily->education->educationname:"",
				'occupationid'=>$employeefamily->occupationid,
				'occupationname'=>($employeefamily->occupation!==null)?$employeefamily->occupation->occupationname:"",
				'recordstatus'=>$employeefamily->recordstatus,
                'div'=>$this->renderPartial('_formfamily',
				  array('model'=>$employeefamily), true)
				));
            Yii::app()->end();
        }
	}
	
    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Employee'], $_POST['Employee']['employeeid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Employee']))
	  {
         $messages = $this->ValidateData(
                array(array($_POST['Employee']['fullname'],'emptyfullname','emptystring'),
                array($_POST['Employee']['orgstructureid'],'emptyorgstructure','emptystring'),
                array($_POST['Employee']['positionid'],'emptyposition','emptystring'),
              array($_POST['Employee']['employeetypeid'],'emptyemployeetype','emptystring'),
              array($_POST['Employee']['sexid'],'emptysex','emptystring'),
              array($_POST['Employee']['birthcityid'],'emptybirthcity','emptystring'),
              array($_POST['Employee']['birthdate'],'emptybirthdate','emptystring'),
              array($_POST['Employee']['maritalstatusid'],'emptymaritalstatus','emptystring'),
              array($_POST['Employee']['joindate'],'emptyjoindate','emptystring'),
              array($_POST['Employee']['employeestatusid'],'emptyemployeestatus','emptystring'),
              array($_POST['Employee']['levelorgid'],'emptylevelorg','emptystring'),
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Employee']['employeeid'] > 0)
		{
		  $model=$this->loadModel($_POST['Employee']['employeeid']);
		  $ab = Addressbook::model()->findbypk($model->addressbookid);
		  $ab->fullname = $_POST['Employee']['fullname'];
		  $ab->save();
		  $model->fullname = $_POST['Employee']['fullname'];
		  $model->oldnik = $_POST['Employee']['oldnik'];
		  $model->orgstructureid = $_POST['Employee']['orgstructureid'];
		  $model->positionid = $_POST['Employee']['positionid'];
		  $model->levelorgid = $_POST['Employee']['levelorgid'];
		  $model->employeetypeid = $_POST['Employee']['employeetypeid'];
		  $model->sexid = $_POST['Employee']['sexid'];
		  $model->birthcityid = $_POST['Employee']['birthcityid'];
		  $model->birthdate = $_POST['Employee']['birthdate'];
		  $model->religionid = $_POST['Employee']['religionid'];
		  $model->maritalstatusid = $_POST['Employee']['maritalstatusid'];
		  $model->referenceby = $_POST['Employee']['referenceby'];
		  $model->joindate = $_POST['Employee']['joindate'];
		  $model->employeestatusid = $_POST['Employee']['employeestatusid'];
		  $model->istrial = $_POST['Employee']['istrial'];
		  $model->accountno = $_POST['Employee']['accountno'];
		  $model->taxno = $_POST['Employee']['taxno'];
		}
		else
		{
		  $model = new Employee();
		  $model->attributes=$_POST['Employee'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Employee']['fullname']);
              $this->GetSMessage('insertsuccess');
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
	
	public function actionCancelWriteaddress()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Employeeaddress'], $_POST['Employeeaddress']['addressid']);
    }
	
	public function actionWriteaddress()
	{
	  if(isset($_POST['Employeeaddress']))
	  {
	  $messages = $this->ValidateData(
                array(
				array($_POST['Employeeaddress']['addresstypeid'],'emptyaddresstype','emptystring'),
				array($_POST['Employeeaddress']['addressname'],'emptyaddressname','emptystring'),
				array($_POST['Employeeaddress']['cityid'],'emptycity','emptystring'),
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Employeeaddress']['addressid'] > 0)
		{
		  $model=Employeeaddress::model()->findbyPK($_POST['Employeeaddress']['addressid']);
		  $model->addressbookid = $_POST['Employeeaddress']['addressbookid'];
		  $model->addresstypeid = $_POST['Employeeaddress']['addresstypeid'];
		  $model->addressname = $_POST['Employeeaddress']['addressname'];
		  $model->rt = $_POST['Employeeaddress']['rt'];
		  $model->rw = $_POST['Employeeaddress']['rw'];
		  $model->cityid = $_POST['Employeeaddress']['cityid'];
		  $model->kelurahanid = $_POST['Employeeaddress']['kelurahanid'];
		  $model->subdistrictid = $_POST['Employeeaddress']['subdistrictid'];
		}
		else
		{
		  $model = new Employeeaddress();
		  $model->attributes=$_POST['Employeeaddress'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Employeeaddress']['addressid']);
              $this->GetSMessage('ppinsertsuccess');
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

	public function actionCancelWriteeducation()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Employeeeducation'], $_POST['Employeeeducation']['employeeeducationid']);
    }
	
	public function actionWriteeducation()
	{
	  if(isset($_POST['Employeeeducation']))
	  {
	  $messages = $this->ValidateData(
                array(
				array($_POST['Employeeeducation']['educationid'],'emptyeducationid','emptystring'),
				array($_POST['Employeeeducation']['schoolname'],'emptyschoolname','emptystring'),
				array($_POST['Employeeeducation']['cityid'],'emptycity','emptystring'),
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Employeeeducation']['employeeeducationid'] > 0)
		{
		  $model=Employeeaddress::model()->findbyPK($_POST['Employeeeducation']['employeeeducationid']);
		  $model->employeeid = $_POST['Employeeeducation']['employeeid'];
		  $model->educationid = $_POST['Employeeeducation']['educationid'];
		  $model->cityid = $_POST['Employeeeducation']['cityid'];
		  $model->yeargraduate = $_POST['Employeeeducation']['yeargraduate'];
		  $model->isdiploma = $_POST['Employeeeducation']['isdiploma'];
		  $model->recordstatus = $_POST['Employeeeducation']['recordstatus'];
		}
		else
		{
		  $model = new Employeeeducation();
		  $model->attributes=$_POST['Employeeeducation'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Employeeeducation']['employeeeducationid']);
              $this->GetSMessage('ppinsertsuccess');
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
	
	public function actionCancelWriteinformal()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Employeeinformal'], $_POST['Employeeinformal']['employeeinformalid']);
    }

	public function actionWriteinformal()
	{
	  if(isset($_POST['Employeeinformal']))
	  {
	  $messages = $this->ValidateData(
                array(
				array($_POST['Employeeinformal']['informalname'],'emptyinformalname','emptystring'),
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Employeeinformal']['employeeinformalid'] > 0)
		{
		  $model=Employeeaddress::model()->findbyPK($_POST['Employeeinformal']['employeeinformalid']);
		  $model->employeeid = $_POST['Employeeinformal']['employeeid'];
		  $model->informalname = $_POST['Employeeinformal']['informalname'];
		  $model->organizer = $_POST['Employeeinformal']['organizer'];
		  $model->period = $_POST['Employeeinformal']['period'];
		  $model->isdiploma = $_POST['Employeeinformal']['isdiploma'];
		  $model->sponsoredby = $_POST['Employeeinformal']['sponsoredby'];
		  $model->recordstatus = $_POST['Employeeinformal']['recordstatus'];
		}
		else
		{
		  $model = new Employeeinformal();
		  $model->iswo = 0;
		  $model->attributes=$_POST['Employeeinformal'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Employeeinformal']['employeeinformalid']);
              $this->GetSMessage('ppinsertsuccess');
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

	public function actionCancelWritewo()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Employeeinformal'], $_POST['Employeeinformal']['employeeinformalid']);
    }

	public function actionWritewo()
	{
	  if(isset($_POST['Employeewo']))
	  {
	  $messages = $this->ValidateData(
                array(
				array($_POST['Employeewo']['informalname'],'emptyinformalname','emptystring'),
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Employeewo']['employeeinformalid'] > 0)
		{
		  $model=Employeewo::model()->findbyPK($_POST['Employeewo']['employeeinformalid']);
		  $model->employeeid = $_POST['Employeewo']['employeeid'];
		  $model->informalname = $_POST['Employeewo']['informalname'];
		  $model->organizer = $_POST['Employeewo']['organizer'];
		  $model->period = $_POST['Employeewo']['period'];
		  $model->isdiploma = $_POST['Employeewo']['isdiploma'];
		  $model->sponsoredby = $_POST['Employeewo']['sponsoredby'];
		  $model->recordstatus = $_POST['Employeewo']['recordstatus'];
		}
		else
		{
		  $model = new Employeewo();
		  $model->iswo = 1;
		  $model->attributes=$_POST['Employeewo'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Employeewo']['employeeinformalid']);
              $this->GetSMessage('ppinsertsuccess');
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
	
	public function actionCancelWritefamily()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Employeefamily'], $_POST['Employeefamily']['employeefamilyid']);
    }

	public function actionWritefamily()
	{
	  if(isset($_POST['Employeefamily']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Employeefamily']['employeefamilyid'] > 0)
		{
		  $model=Employeefamily::model()->findbyPK($_POST['Employeefamily']['employeefamilyid']);
		  $model->employeeid = $_POST['Employeefamily']['employeeid'];
		  $model->familyrelationid = $_POST['Employeefamily']['familyrelationid'];
		  $model->familyname = $_POST['Employeefamily']['familyname'];
		  $model->sexid = $_POST['Employeefamily']['sexid'];
		  $model->cityid = $_POST['Employeefamily']['cityid'];
		  $model->birthdate = $_POST['Employeefamily']['birthdate'];
		  $model->educationid = $_POST['Employeefamily']['educationid'];
		  $model->occupationid = $_POST['Employeefamily']['occupationid'];
		  $model->recordstatus = $_POST['Employeefamily']['recordstatus'];
		}
		else
		{
		  $model = new Employeefamily();
		  $model->attributes=$_POST['Employeefamily'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Employeefamily']['employeefamilyid']);
              $this->GetSMessage('ppinsertsuccess');
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
	
	public function actionApprove()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
			//$model=$this->loadModel($ids);
                    $a = Yii::app()->user->name;
			$connection=Yii::app()->db;
			  $transaction=$connection->beginTransaction();
			  try
			  {
				$sql = 'call ApproveEmployee(:vid, :vlastupdateby)';
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
        Yii::app()->end();
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteservice()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Employeeservice::model()->findbyPK($ids);
		  $model->recordstatus=0;
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}
	
	public function actionDeleteeducation()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Employeeeducation::model()->findbyPK($ids);
		  $model->recordstatus=0;
		  $model->save();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}

		public function actionDeleteinformal()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Employeeinformal::model()->findbyPK($ids);
		  $model->recordstatus=0;
		  $model->save();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}
	
	public function actionDeletewo()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Employeewo::model()->findbyPK($ids);
		  $model->recordstatus=0;
		  $model->save();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}
	
	public function actionDeletefamily()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Employeefamily::model()->findbyPK($ids);
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
		$model=new Employee('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employee']))
			$model->attributes=$_GET['Employee'];
		if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}

		$this->render('index',array(
			'model'=>$model,
			'employeeaddress'=>$this->employeeaddress,
				  'employeeeducation'=>$this->employeeeducation,
				  'employeeinformal'=>$this->employeeinformal,
				  'employeewo'=>$this->employeewo,
				  'employeefamily'=>$this->employeefamily
		));
	}

	public function actionIndexaddress()
	{
		$this->lookupdata();
	  $this->renderPartial('indexaddress',
		array('employeeaddress'=>$this->employeeaddress));
	  Yii::app()->end();
	}
	
	public function actionIndexeducation()
	{
		$this->lookupdata();
	  $this->renderPartial('indexeducation',
		array('employeeeducation'=>$this->employeeeducation));
	  Yii::app()->end();
	}
	
	public function actionIndexwo()
	{
		$this->lookupdata();
	  $this->renderPartial('indexwo',
		array('employeewo'=>$this->employeewo));
	  Yii::app()->end();
	}
	
	public function actionIndexfamily()
	{
		$this->lookupdata();
	  $this->renderPartial('indexwo',
		array('employeewo'=>$this->employeewo));
	  Yii::app()->end();
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
						$model=Company::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Company();
						}
						$model->companyid = (int)$data[0];
						$model->companyname = $data[1];
						$model->address = $data[2];
						$city = City::model()->findbyattributes(array('cityname'=>$data[3]));
						if ($city !== null)
						{
							$model->cityid = $city->cityid;
						}
						$model->zipcode = $data[4];
						$model->taxno = $data[5];
						$currency = Currency::model()->findbyattributes(array('currencyname'=>$data[6]));
						if ($currency !== null)
						{
							$model->currencyid = $currency->currencyid;
						}
						$model->recordstatus = (int)$data[7];
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
	   $sql = "select a.employeeid,a.fullname, a.oldnik, b.levelorgname, c.structurename,d.positionname,e.employeetypename,
        f.sexname,joindate,email,phoneno,alternateemail,hpno,a.addressbookid,a.accountno,a.taxno,g.maritalstatusname,
        h.religionname,a.birthdate,i.cityname
      from employee a
      left join levelorg b on b.levelorgid = a.levelorgid
      left join orgstructure c on c.orgstructureid = a.orgstructureid
      left join position d on d.positionid = a.positionid
      left join employeetype e on e.employeetypeid = a.employeetypeid
      left join sex f on f.sexid = a.sexid
      left join maritalstatus g on g.maritalstatusid = a.maritalstatusid
      left join religion h on h.religionid = a.religionid
      left join city i on i.cityid = a.birthcityid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.employeeid = ".$_GET['id'];
		}
		$sql = $sql . " order by employeeid";
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Employee List';
	  $this->pdf->AddPage('P');
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
      $this->pdf->text(50,35,'Posisi: '.$row['positionname']);
      $this->pdf->text(50,40,'Struktur: '.$row['structurename']);
      $this->pdf->text(50,45,'Golongan: '.$row['levelorgname']);
      $this->pdf->text(50,50,'Tempat Tanggal Lahir: '.$row['cityname'].', '.date(Yii::app()->params['dateviewfromdb'], strtotime($row['birthdate'])));
      $this->pdf->text(50,55,'Jenis Kelamin: '.$row['sexname']);
      $this->pdf->text(50,60,'Marital Status: '.$row['maritalstatusname']);
      $this->pdf->text(50,65,'Agama: '.$row['religionname']);
      $this->pdf->text(50,70,'Telp: '.$row['phoneno']);
      $this->pdf->text(50,75,'No HP: '.$row['hpno']);
      $this->pdf->text(50,80,'Email Utama: '.$row['email']);
      $this->pdf->text(50,85,'Email ke-2: '.$row['alternateemail']);
      $this->pdf->text(50,90,'No Rekening: '.$row['accountno']);
      $this->pdf->text(50,95,'NPWP: '.$row['taxno']);

      $sql1 = "select b.addresstypename, a.addressname, c.cityname, a.phoneno
        from address a
        left join addresstype b on b.addresstypeid = a.addresstypeid
        left join city c on c.cityid = a.cityid
        where addressbookid = ".$row['addressbookid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,100,'Address List');
      $this->pdf->SetY(105);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(50,50,50,30));
      $this->pdf->Row(array('Address Type','Address','City','Phone No'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['addresstypename'],$row1['addressname'],$row1['cityname'],$row1['phoneno']));
      }

      $sql1 = "select b.educationname, a.schoolname, a.schooldegree, c.cityname, a.yeargraduate
        from employeeeducation a
        left join education b on b.educationid = a.educationid
        left join city c on c.cityid = a.cityid
        where employeeid = ".$row['employeeid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Education List');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C','C'));
      $this->pdf->setwidths(array(50,50,30,30,30));
      $this->pdf->Row(array('Degree','School/Institut','Education Major','City','Year Graduate'));
      $this->pdf->setaligns(array('L','L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['educationname'],$row1['schoolname'],$row1['schooldegree'],$row1['cityname'],$row1['yeargraduate']));
      }
      
      $sql1 = "select a.informalname,a.organizer,a.period
        from employeeinformal a
        where employeeid = ".$row['employeeid']." and iswo=0";
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Informal List');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(60,40,50));
      $this->pdf->Row(array('Course / Training / Skill', 'Organizer', 'Period'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['informalname'],$row1['organizer'],$row1['period']));
      }
      
      $sql1 = "select a.informalname,a.organizer,a.period,a.sponsoredby
        from employeeinformal a
        where employeeid = ".$row['employeeid']." and iswo=1";
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Working Experience List');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(80,30,30,50));
      $this->pdf->Row(array('Company', 'Golongan','Position', 'Period'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['informalname'],$row1['sponsoredby'],$row1['organizer'],$row1['period']));
      }
      
      $sql1 = "select b.familyrelationname, a.familyname, c.cityname,
        d.sexname, a.birthdate, e.educationname, f.occupationname
        from employeefamily a
        left join familyrelation b on b.familyrelationid = a.familyrelationid
        left join city c on c.cityid = a.cityid
        left join sex d on d.sexid = a.sexid
        left join education e on e.educationid = a.educationid
        left join occupation f on f.occupationid = a.occupationid
        where employeeid = ".$row['employeeid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Family Member');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(50,40,30,40,30,30,30));
      $this->pdf->Row(array('Family Relation', 'Family Name', 'Sex', 'Occupation'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['familyrelationname'],$row1['familyname'],$row1['sexname'],$row1['occupationname']));
      }
      
      $sql1 = "select b.identitytypename, a.identityname
        from employeeidentity a
        left join identitytype b on b.identitytypeid = a.identitytypeid
        where a.employeeid = ".$row['employeeid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Identity List');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(60,50));
      $this->pdf->Row(array('Identity Type', 'Identity Name'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['identitytypename'],$row1['identityname']));
      }
      
      $sql1 = "select b.languagename,c.languagevaluename
        from employeeforeignlanguage a
        left join language b on b.languageid = a.languageid
        left join languagevalue c on c.languagevalueid = a.languagevalueid
        where a.employeeid = ".$row['employeeid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Language Skill');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(60,50));
      $this->pdf->Row(array('Language', 'Language Value'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['languagename'],$row1['languagevaluename']));
      }
      $this->pdf->AddPage('P');
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
		$model=Employee::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeldetail($id)
	{
		$model=Employeeaddress::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModeleducation($id)
	{
		$model=Employeeeducation::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelinformal($id)
	{
		$model=Employeeinformal::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='employee-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='employeeservice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
