<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'product';

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

	public $productacc, $productbasic, $productplant, $productpurchase, $productconversion;

	public function lookupdata()
	{
		$this->productacc=new Productacc('search');
		$this->productacc->unsetAttributes();  
		if(isset($_GET['Productacc']))
		$this->productacc->attributes=$_GET['Productacc'];
		
		$this->productbasic=new Productbasic('search');
		$this->productbasic->unsetAttributes();  
		if(isset($_GET['Productbasic']))
		$this->productbasic->attributes=$_GET['Productbasic'];
		
		$this->productplant=new Productplant('search');
		$this->productplant->unsetAttributes();  
		if(isset($_GET['Productplant']))
		$this->productplant->attributes=$_GET['Productplant'];		
		
		$this->productpurchase=new Productpurchase('search');
		$this->productpurchase->unsetAttributes();  
		if(isset($_GET['Productpurchase']))
		$this->productpurchase->attributes=$_GET['Productpurchase'];		
		
		$this->productconversion=new Productconversion('search');
		$this->productconversion->unsetAttributes();  
		if(isset($_GET['Productconversion']))
		$this->productconversion->attributes=$_GET['Productconversion'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
	  $this->lookupdata();
		$model=new Product;
		$model->productname = 'productname';
		$model->recordstatus = 1;  
		if (Yii::app()->request->isAjaxRequest)
        {
			if ($model->save()) {
			  echo CJSON::encode(array(
				  'status'=>'success',
				  'productid'=>$model->productid,
				  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'productacc'=>$this->productacc,
				  'productbasic'=>$this->productbasic,
				  'productconversion'=>$this->productconversion,
				  'productplant'=>$this->productplant,
				  'productpurchase'=>$this->productpurchase), true)
				  ));
			  Yii::app()->end();
			}
        }
	}

	public function actionCreatebasic()
	{
		parent::actionCreate();
		$productbasic=new Productbasic;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formbasic',
				  array('model'=>$productbasic), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionCreateplant()
	{
		parent::actionCreate();
		$productplant=new Productplant;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formplant',
				  array('model'=>$productplant), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionCreatepurchase()
	{
		parent::actionCreate();
		$productpurchase=new Productpurchase;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formpurchase',
				  array('model'=>$productpurchase), true)
				));
            Yii::app()->end();
        }
	}

	public function actionCreateacc()
	{
		parent::actionCreate();
		$productacc=new Productacc;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formacc',
				  array('model'=>$productacc), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionCreateconversion()
	{
		parent::actionCreate();
		$productconversion=new Productconversion;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formconversion',
				  array('model'=>$productconversion), true)
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
				'productid'=>$model->productid,
			  'productname'=>$model->productname,
			  'isstock'=>$model->isstock,
			  'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
				  'productacc'=>$this->productacc,
				  'productbasic'=>$this->productbasic,
				  'productconversion'=>$this->productconversion,
				  'productplant'=>$this->productplant,
				  'productpurchase'=>$this->productpurchase), true)
				));
            Yii::app()->end();
        }
	}

	public function actionUpdatebasic()
	{
		$id=$_POST['id'];
	  $productbasic=$this->loadModelbasic($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'productbasicid'=>$productbasic->productbasicid,
                'baseuom'=>$productbasic->baseuom,  
				'baseuomcode'=>($productbasic->baseuom0!==null)?$productbasic->baseuom0->uomcode:"",
                'materialgroupid'=>$productbasic->materialgroupid,  
				'materialgroupcode'=>($productbasic->materialgroup!==null)?$productbasic->materialgroup->description:"",
                'oldmatno'=>$productbasic->oldmatno,  
                'grossweight'=>$productbasic->grossweight,  
                'weightunit'=>$productbasic->weightunit,  
				'weightunitcode'=>($productbasic->baseuom1!==null)?$productbasic->baseuom1->uomcode:"",
                'netweight'=>$productbasic->netweight,  
                'volume'=>$productbasic->volume,  
                'volumeunit'=>$productbasic->volumeunit,  
				'volumeunitcode'=>($productbasic->baseuom2!==null)?$productbasic->baseuom2->uomcode:"",
                'sizedimension'=>$productbasic->sizedimension,  
                'materialpackage'=>$productbasic->materialpackage,  
				'materialpackagename'=>($productbasic->materialpackage0!==null)?$productbasic->materialpackage0->productname:"",
                'div'=>$this->renderPartial('_formbasic',
				  array('model'=>$productbasic), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionUpdateplant()
	{
		$id=$_POST['id'];
	  $productplant=$this->loadModelplant($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'productplantid'=>$productplant->productplantid,
				'slocid'=>$productplant->slocid,
				'sloccode'=>($productplant->sloc!==null)?$productplant->sloc->sloccode:"",
				'unitofissue'=>$productplant->unitofissue,
				'unitofissuecode'=>($productplant->unitofissue0!==null)?$productplant->unitofissue0->uomcode:"",
				'isautolot'=>$productplant->isautolot,
				'storagebin'=>$productplant->storagebin,
				'pickingarea'=>$productplant->pickingarea,
				'sled'=>$productplant->sled,
				'snroid'=>$productplant->snroid,
				'description'=>($productplant->snro!==null)?$productplant->snro->description:"",
                'div'=>$this->renderPartial('_formplant',
				  array('model'=>$productplant), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionUpdatepurchase()
	{
		$id=$_POST['id'];
	  $productpurchase=$this->loadModelpurchase($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'productpurchaseid'=>$productpurchase->productpurchaseid,
				'plantid'=>$productpurchase->plantid,
				'plantcode'=>($productpurchase->plant!==null)?$productpurchase->plant->plantcode:"",
				'orderunit'=>$productpurchase->orderunit,
				'orderunitcode'=>($productpurchase->orderunit0!==null)?$productpurchase->orderunit0->uomcode:"",
				'purchasinggroupid'=>$productpurchase->purchasinggroupid,
				'purchasinggroupcode'=>($productpurchase->purchasinggroup!==null)?$productpurchase->purchasinggroup->purchasinggroupcode:"",
				'validfrom'=>date(Yii::app()->params['dateviewfromdb'], strtotime($productpurchase->validfrom)),
				'validto'=>date(Yii::app()->params['dateviewfromdb'], strtotime($productpurchase->validto)),
				'isautoPO'=>$productpurchase->isautoPO,
                'div'=>$this->renderPartial('_formpurchase',
				  array('model'=>$productpurchase), true)
				));
            Yii::app()->end();
        }
	}

	public function actionUpdateacc()
	{
		$id=$_POST['id'];
	  $productacc=$this->loadModelacc($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'productaccid'=>$productacc->productaccid,
				'inventoryaccid'=>$productacc->inventoryaccid,
				'inventoryacccode'=>($productacc->inventoryacc!==null)?$productacc->inventoryacc->accountcode:"",
				'salesaccid'=>$productacc->salesaccid,
				'salesacccode'=>($productacc->salesacc!==null)?$productacc->salesacc->accountcode:"",
				'salesretaccid'=>$productacc->salesretaccid,
				'salesretcode'=>($productacc->salesretacc!==null)?$productacc->salesretacc->accountcode:"",
				'itemdiscaccid'=>$productacc->itemdiscaccid,
				'itemdisccode'=>($productacc->itemdiscacc!==null)?$productacc->itemdiscacc->accountcode:"",
				'cogsaccid'=>$productacc->cogsaccid,
				'cogsacccode'=>($productacc->cogsacc!==null)?$productacc->cogsacc->accountcode:"",
				'purchaseretaccid'=>$productacc->purchaseretaccid,
				'purchaseretacccode'=>($productacc->purchaseretacc!==null)?$productacc->purchaseretacc->accountcode:"",
				'expenseaccid'=>$productacc->expenseaccid,
				'expenseacccode'=>($productacc->expenseacc!==null)?$productacc->expenseacc->accountcode:"",
				'unbilledgoodsaccid'=>$productacc->unbilledgoodsaccid,
				'unbilledgoodsacccode'=>($productacc->unbilledgoodsacc!==null)?$productacc->unbilledgoodsacc->accountcode:"",
                'div'=>$this->renderPartial('_formwo',
				  array('model'=>$productacc), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionUpdateconversion()
	{
		$id=$_POST['id'];
	  $productconversion=$this->loadModelconversion($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'productconversionid'=>$productconversion->productinformalid,
				'fromuom'=>$productconversion->fromuom,
				'fromuomcode'=>($productconversion->fromuom0!==null)?$productconversion->fromuom0->uomcode:"",
				'fromvalue'=>$productconversion->conversionname,
				'touom'=>$productconversion->touom,
				'touomcode'=>($productconversion->touom0!==null)?$productconversion->touom0->uomcode:"",
                'div'=>$this->renderPartial('_formconversion',
				  array('model'=>$productconversion), true)
				));
            Yii::app()->end();
        }
	}
	
    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Product'], $_POST['Product']['productid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Product']))
	  {
         $messages = $this->ValidateData(
                array(array($_POST['Product']['productname'],'emptyproductname','emptystring'),
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Product']['productid'] > 0)
		{
		  $model=Product::model()->findbyPK($_POST['Product']['productid']);
		  $model->productname = $_POST['Product']['productname'];
		  $model->isstock= $_POST['Product']['isstock'];
		  $model->recordstatus= $_POST['Product']['recordstatus'];
		}
		else
		{
		  $model = new Product();
		  $model->attributes=$_POST['Product'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Product']['productname']);
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
	
	public function actionCancelWritebasic()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Productbasic'], $_POST['Productbasic']['productbasicid']);
    }
	
	public function actionWritebasic()
	{
	  if(isset($_POST['Productbasic']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Productbasic']['productbasicid'] > 0)
		{
		  $model=Productbasic::model()->findbyPK($_POST['Productbasic']['productbasicid']);
		  $model->baseuom = $_POST['Productbasic']['baseuom'];
		  $model->productid = $_POST['Productbasic']['productid'];
		  $model->materialgroupid = $_POST['Productbasic']['materialgroupid'];
		  $model->oldmatno = $_POST['Productbasic']['oldmatno'];
		  $model->grossweight = $_POST['Productbasic']['grossweight'];
		  $model->weightunit = $_POST['Productbasic']['weightunit'];
		  $model->netweight = $_POST['Productbasic']['netweight'];
		  $model->volume = $_POST['Productbasic']['volume'];
		  $model->volumeunit = $_POST['Productbasic']['volumeunit'];
		  $model->sizedimension = $_POST['Productbasic']['sizedimension'];
		  $model->materialpackage = $_POST['Productbasic']['materialpackage'];
		}
		else
		{
		  $model = new Productbasic();
		  $model->attributes=$_POST['Productbasic'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Productbasic']['productbasicid']);
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

	public function actionCancelWriteplant()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Productplant'], $_POST['Productplant']['productplantid']);
    }
	
	public function actionWriteplant()
	{
	  if(isset($_POST['Productplant']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Productplant']['productplantid'] > 0)
		{
		  $model=Productplant::model()->findbyPK($_POST['Productplant']['productplantid']);
		  $model->productid = $_POST['Productplant']['productid'];
		  $model->slocid = $_POST['Productplant']['slocid'];
		  $model->unitofissue = $_POST['Productplant']['unitofissue'];
		  $model->isautolot = $_POST['Productplant']['isautolot'];
		  $model->storagebin = $_POST['Productplant']['storagebin'];
		  $model->pickingarea = $_POST['Productplant']['pickingarea'];
		  $model->sled = $_POST['Productplant']['sled'];
		  $model->snroid = $_POST['Productplant']['snroid'];
		}
		else
		{
		  $model = new Productplant();
		  $model->attributes=$_POST['Productplant'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Productplant']['productplantid']);
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
	
	public function actionCancelWritepurchase()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Productpurchase'], $_POST['Productpurchase']['productpurchaseid']);
    }

	public function actionWritepurchase()
	{
	  if(isset($_POST['Productpurchase']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Productpurchase']['productpurchaseid'] > 0)
		{
		  $model=Productpurchase::model()->findbyPK($_POST['Productpurchase']['productpurchaseid']);
		  $model->productid = $_POST['Productpurchase']['productid'];
		  $model->plantid = $_POST['Productpurchase']['plantid'];
		  $model->orderunit = $_POST['Productpurchase']['orderunit'];
		  $model->purchasinggroupid = $_POST['Productpurchase']['purchasinggroupid'];
		  $model->validfrom = $_POST['Productpurchase']['validfrom'];
		  $model->validto = $_POST['Productpurchase']['validto'];
		  $model->isautoPO = $_POST['Productpurchase']['isautoPO'];
		}
		else
		{
		  $model = new Productpurchase();
		  $model->attributes=$_POST['Productpurchase'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Productpurchase']['productpurchaseid']);
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

	public function actionCancelWriteacc()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Productacc'], $_POST['Productacc']['productaccid']);
    }

	public function actionWriteacc()
	{
	  if(isset($_POST['Productacc']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Productacc']['productaccid'] > 0)
		{
		  $model=Productacc::model()->findbyPK($_POST['Productacc']['productaccid']);
		  $model->productid = $_POST['Productacc']['productid'];
		  $model->inventoryaccid = $_POST['Productacc']['inventoryaccid'];
		  $model->salesaccid = $_POST['Productacc']['salesaccid'];
		  $model->salesretaccid = $_POST['Productacc']['salesretaccid'];
		  $model->itemdiscaccid = $_POST['Productacc']['itemdiscaccid'];
		  $model->cogsaccid = $_POST['Productacc']['cogsaccid'];
		  $model->purchaseretaccid = $_POST['Productacc']['purchaseretaccid'];
		  $model->expenseaccid = $_POST['Productacc']['expenseaccid'];
		  $model->unbilledgoodsaccid = $_POST['Productacc']['unbilledgoodsaccid'];
		}
		else
		{
		  $model = new Productacc();
		  $model->attributes=$_POST['Productacc'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Productacc']['productaccid']);
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
	
	public function actionCancelWriteconversion()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Productconversion'], $_POST['Productconversion']['productconversionid']);
    }

	public function actionWriteconversion()
	{
	  if(isset($_POST['Productconversion']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Productconversion']['productconversionid'] > 0)
		{
		  $model=Productconversion::model()->findbyPK($_POST['Productconversion']['productconversionid']);
		  $model->productid = $_POST['Productconversion']['productid'];
		  $model->fromuom = $_POST['Productconversion']['fromuom'];
		  $model->fromvalue = $_POST['Productconversion']['fromvalue'];
		  $model->touom = $_POST['Productconversion']['touom'];
		  $model->tovalue = $_POST['Productconversion']['tovalue'];
		}
		else
		{
		  $model = new Productconversion();
		  $model->attributes=$_POST['Productconversion'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Productconversion']['productconversionid']);
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
	public function actionDeletebasic()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Productservice::model()->findbyPK($ids);
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}
	
	public function actionDeleteplant()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Productplant::model()->findbyPK($ids);
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}

		public function actionDeletepurchase()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Productpurchase::model()->findbyPK($ids);
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}
	
	public function actionDeleteacc()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Productacc::model()->findbyPK($ids);
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}
	
	public function actionDeleteconversion()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Productconversion::model()->findbyPK($ids);
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
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];
		if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}

		$this->render('index',array(
			'model'=>$model,
				  'productacc'=>$this->productacc,
				  'productbasic'=>$this->productbasic,
				  'productconversion'=>$this->productconversion,
				  'productplant'=>$this->productplant,
				  'productpurchase'=>$this->productpurchase
		));
	}

	public function actionIndexbasic()
	{
		$this->lookupdata();
	  $this->renderPartial('indexbasic',
		array('productbasic'=>$this->productbasic));
	  Yii::app()->end();
	}
	
	public function actionIndexplant()
	{
		$this->lookupdata();
	  $this->renderPartial('indexplant',
		array('productplant'=>$this->productplant));
	  Yii::app()->end();
	}
	
	public function actionIndexpurchase()
	{
		$this->lookupdata();
	  $this->renderPartial('indexpurchase',
		array('productpurchase'=>$this->productpurchase));
	  Yii::app()->end();
	}
	
	public function actionIndexacc()
	{
		$this->lookupdata();
	  $this->renderPartial('indexacc',
		array('productacc'=>$this->productacc));
	  Yii::app()->end();
	}
	
	public function actionDownload()
	{
	  parent::actionDownload();
	   $sql = "select a.productid, a.productname, a.productpic
      from product a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.productid = ".$_GET['id'];
		}
		$sql = $sql . " order by productid";
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Material Master List';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    foreach($dataReader as $row)
    {
      if (file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/product/'.$row['productname'].'.jpg'))
      {
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/product/'. $row['productname'] .'.jpg',10,30,30);
      }
      $this->pdf->setFont('Arial','B',10);
      $this->pdf->text(50,30,'Material: '.$row['productname']);

      $sql1 = "select b.uomcode as baseuomcode, c.materialgroupcode, a.oldmatno, a.grossweight, 
			d.uomcode as weightuomcode
		from productbasic a
		left join unitofmeasure b on b.unitofmesureid = a.baseuom
		left join materialgroup c on c.materialgroupid = a.materialgroupid
		left join unitofmeasure d on d.unitofmesureid = a.baseuom
        where productid = ".$row['productid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,100,'Material Basic List');
      $this->pdf->SetY(105);
      $this->pdf->setaligns(array('C','C','C','C','C'));
      $this->pdf->setwidths(array(50,50,50,30,30));
      $this->pdf->Row(array('Base UOM','Material Group Code','Old Material No','Gross Weight','Weight Unit'));
      $this->pdf->setaligns(array('L','L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['baseuomcode'],$row1['materialgroupcode'],$row1['oldmatno'],$row1['grossweight'],$row1['weightuomcode']));
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
		$model=Product::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelbasic($id)
	{
		$model=Productbasic::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelplant($id)
	{
		$model=Productplant::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelpurchase($id)
	{
		$model=Productpurchase::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelacc($id)
	{
		$model=Productacc::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelconversion($id)
	{
		$model=Productconversion::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='productservice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
