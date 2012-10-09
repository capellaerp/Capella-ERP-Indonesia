<?php
/**
 * ERememberFiltersBehavior class file.
 *
 * @author Marton Kodok http://www.yiiframework.com/forum/index.php?/user/8824-pentium10/
 * @link http://www.yiiframework.com/
 * @version 1.1
 */

/* The ERememberFiltersBehavior extension adds up some functionality to the default
* possibilites of CActiveRecord/Model implementation.
*
* It will detect the search scenario and it will save the filters from the GridView.
* This comes handy when you need to store them for later use. For heavy navigation and
* heavy filtering this function can be activated by just a couple of lines.
*
* To use this extension, just copy this file to your components/ directory,
* add 'import' => 'application.components.ERememberFiltersBehavior', [...] to your
* config/main.php and paste the following code to your behaviors() method of your model
*
* public function behaviors() {
*        return array(
*            'ERememberFiltersBehavior' => array(
*                'class' => 'application.components.ERememberFiltersBehavior',
*                'defaults'=>array(),
*                'defaultStickOnClear'=>false 
*            ),
*        );
* }
* 
* 'defaults' is a key value pair array, that will hold the defaults for your filters. 
* For example when you initially want to display `active products`, you set to array('status'=>'active'). 
* You can of course put multiple default values.
*
* 'defaultStickOnClear'=>true can be used, if you want the default values to be put back when the user clears the filters
* The default set is 'false' so if the user clears the filters, also the defaults are cleared out.
*
* CHANGELOG
*
* 2011-03-06
* v1.1 
* Added support for 'defaults' and 'defaultStickOnClear'. 
* You can now tell your model to set default filters for your form using this extension.
*
* 2011-01-31
* v1.0 
* Initial release
*
* This extension has also a pair Clear Filters Gridview
* http://www.yiiframework.com/extension/clear-filters-gridview
*
* Please VOTE this extension if helps you at:
* http://www.yiiframework.com/extension/remember-filters-gridview
*/

class ERememberFiltersBehavior extends CActiveRecordBehavior {

    /**
     * Array that holds any default filter value like array('active'=>'1')
     *
     * @var array
     */
    public $defaults=array();
    /**
     * When this flag is true, the default values will be used also when the user clears the filters
     *
     * @var boolean
     */
    public $defaultStickOnClear=false;

    private function readSearchValues() {
        $modelName = get_class($this->owner);
        $attributes = $this->owner->getSafeAttributeNames();

        // set any default value

        if (is_array($this->defaults) && (null==Yii::app()->user->getState($modelName . __CLASS__. 'defaultsSet', null))) {
            foreach ($this->defaults as $attribute => $value) {
                if (null == (Yii::app()->user->getState($modelName . $attribute, null))) {
                    Yii::app()->user->setState($modelName . $attribute, $value);
                }
            }
            Yii::app()->user->setState($modelName . __CLASS__. 'defaultsSet', 1);
        }
        
        // set values from session

        foreach ($attributes as $attribute) {
            if (null != ($value = Yii::app()->user->getState($modelName . $attribute, null))) {
                try
                {
                    $this->owner->$attribute = $value;
                }
                catch (Exception $e) {
                }
            }
        }
    }

    private function saveSearchValues() {

        $modelName = get_class($this->owner);
        $attributes = $this->owner->getSafeAttributeNames();
        foreach ($attributes as $attribute) {
            if (isset($this->owner->$attribute)) {
                Yii::app()->user->setState($modelName . $attribute, $this->owner->$attribute);
            }
        }
    }

    public function afterConstruct($event) {
        if ($this->owner->scenario == 'search') {
            $this->owner->unsetAttributes();
            if (isset($_GET[get_class($this->owner)])) {
                $this->owner->attributes = $_GET[get_class($this->owner)];
                $this->saveSearchValues();
            } else {
                $this->readSearchValues();
            }
        }
    }

    public function unsetFilters() {
        $modelName = get_class($this->owner);
        $attributes = $this->owner->getSafeAttributeNames();

        foreach ($attributes as $attribute) {
            if (null != ($value = Yii::app()->user->getState($modelName . $attribute, null))) {
                Yii::app()->user->setState($modelName . $attribute, 1, 1);
            }
        }
        if ($this->defaultStickOnClear) {
            Yii::app()->user->setState($modelName . __CLASS__. 'defaultsSet', 1,1);
        }
    }

}




?>