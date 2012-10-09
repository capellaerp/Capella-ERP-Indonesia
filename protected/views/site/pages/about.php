<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>
<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
		'History' => '',
		'Known Bug' => '',
		'Todo' => 'Translock,userinbox,friends online',
		'File' => 'Change Profile (on progress)<br>Logout (done)',
		'System' => 'User Access (done)<br>Object Authentication (done)<br>Transaction Log (done)<br>
        Specific Number Range Object (done)<br>Detail of Specific Number Range Object (done)',
		'Common' => 'Parameter (done)<br>Language (done)<br>Country (done)<br>Province (done)<br>
        City (done)<br>Subdistrict (done)<br>Sub Subdistrict (done)<br>Currency (done)<br>
        Address Type (done)<br>Contact Type (done)<br>Identity Type (done)<br>Rome Type (done)<br>
        Industry (done)<br>Insurance (done)<br>Bank (done)',
    'Accounting'=>'Payment Method (done)<br>
	  Chart of Account (done)<br>
	  General Journal (done)<br>
	  General Ledger (done)',
    'Material Management'=>'Purchasing Organization (done)<br>
	  Purchasing Group (done) <br>
	  Material Master (done)<br>
	  <ul><li>Material Group (done)</li>
	  <li>Material Type (done)</li>
	  <li>Material Master</li>
	  <ul><li>Main Data (done)</li>
	  <li>Basic Data (done)</li>
	  <li>Purchasing Data (done)</li>
	  <li>Plant/Storage Data (done)</li>
	  <li>Conversion Data (done)</li></ul></ul>
	  Supplier (done)<br>
	  Purchasing Info Record (done)<br>
	  Purchase Order (on progress)<br>',
	'Warehouse Management'=>'Storage Location (done)<br>
	  Unit of Measure (done)<br>
	  Requested By (on progress)<br>
	  Stock Overview (on progress)<br>
	  Purchase Requisition (on progress)<br>
	  Reservation (on progress)<br>',
	'Sales Distribution'=>'Customer (done)',
    'Human Resource'=>'Organization
      <br><ul><li>Position (done)</li>
      <li>Organization Structure (done)</li></ul>
      Personnel Management
      <br><ul><li>Master Personnel</li>
      <ul><li>Family Relation (done)</li>
      <li>Occupation (done)</li>
      <li>Sex (done)</li>
      <li>Social (done)</li>
      <li>Tribe (done)</li>
      <li>Religion (done)</li>
      <li>Education (done)</li>
      <li>Education Major (done)</li>
      <li>Blood Type (done)</li>
      <li>Marital Status (done)</li>
      <li>Concerning (done)</li>
      <li>Employee Status (done)</li>
      <li>Capability Value (done)</li>
      <li>Reading Often (done)</li>
      <li>Employee Type (done)</li>
      <li>Language Value (done)</li>
      </ul>
      </ul>
      <ul><li>Applicant Management</li>
      <ul><li>Applicant</li>
      <li>Applicant Address</li>
      <li>Applicant Education</li>
      <li>Applicant Family</li>
      <li>Applicant Identity</li>
      <li>Applicant Informal</li>
      <li>Applicant Foreign Language</li>
      <li>Applicant Insurance</li>
      <li>Applicant Jamsostek</li>
      </ul>
      </ul>
      <ul><li>Employee Management</li>
      <ul><li>Employee</li>
      <li>Employee Address</li>
      <li>Employee Education</li>
      <li>Employee Family</li>
      <li>Employee Identity</li>
      <li>Employee Informal</li>
      <li>Employee Foreign Language</li>
      <li>Employee Insurance</li>
      <li>Employee Jamsostek</li>
      </ul>
      </ul>
      Time Management
      <br><ul><li>Absence Status (done)</li>
      <li>Schedule Master (done)</li>
      <li>Absence Rule (done)</li>
      <li>Judge Rule (done)</li>
      <li>Employee Schedule (done)</li>
      <li>Report</li>
      <ul><li>Report Absence In (done)</li>
      <li>Report Absence Out (done)</li>
      <li>Report Jamsostek (done)</li>
      <li>Report Perday (done)</li>
      <li>Absence Transaction & Completion Force</li>
      </ul>
      </ul>
      Present Attendance
      <br><ul><li>Sickness</li>
      <ul><li>Hospital (done)</li>
      <ul><li>Hospital (done)</li>
      <li>Hospital Address (done)</li>
      <li>Hospital Contact (done)</li>
      </ul>
      <li>Sickness Transaction</li>
      </ul>
      </ul>
      <ul><li>Onleave</li>
      <ul><li>Onleave Reason</li>
      <li>Onleave Transaction</li>
      </ul>
      </ul>
      <ul><li>Permit Exit</li>
      <ul><li>Permit Exit Reason</li>
      <li>Permit Exit Transaction</li>
      </ul>
      </ul>
      <ul><li>Permit In</li>
      <ul><li>Permit In Reason</li>
      <li>Permit In Transaction</li>
      </ul>
      </ul>
      Facility
      <ul><li>Locker Facility</li>
      <ul><li>Locker Key (done)</li>
      <li>Locker Box (done)</li>
      <li>Locker Staff (done)</li>
      <li>Employee Key (done)</li>
      </ul>
      </ul>
      Payroll
      <ul><li>Wage Type (done)</li>
      <li>Employee Wage</li>
      <li>Employee Slip</li>
      </ul>
      <br>',
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));
?>

