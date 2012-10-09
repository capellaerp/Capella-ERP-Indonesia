<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/menu/menu_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/extend.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.autoNumeric.js"></script>
<!--[if lt IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/menu/includes/ie6.css" media="screen"/>
<![endif]-->
<link rel="icon" href="images/icon.jpg" />
</head>

<body>
  <div id="container">
    <div id="header">
      <img src="images/header.jpg"></img>
    </div>
      <div class="wrapper1">
	<div class="wrapper">
		<div class="nav-wrapper">
			<div class="nav-left"></div>
			<div class="nav">
				<ul id="navigation">
					<li class="#">
						<a href="index.php" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Home</span>
							<span class="menu-right"></span>
						</a>
					</li>
                    <li class="#">
						<a href="index.php?r=site/profile" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Profil</span>
							<span class="menu-right"></span>
						</a>
	            	   	<div class="sub">
			   				<ul>
         			   			<li>
									<a href="index.php?r=site/visimisi" target="_self">Visi dan Misi</a>
								</li>
         			   			<li>
									<a href="index.php?r=site/sejarahsingkat" target="_self">Sejarah Singkat</a>
								</li>
			   				</ul>
                        </div>
					</li>
										<li class="#">
						<a href="index.php?r=site/product" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Product</span>
							<span class="menu-right"></span>
						</a>
					</li>
				  <?php 
				  if (!Yii::app()->user->isGuest)
				  {?>
					<li class="#">
						<a href="index.php?r=site/indexadmin" target="_self">
						<span class="menu-left"></span>
						<span class="menu-mid">Internal Application</span>
						<span class="menu-right"></span>
						</a>
					</li>
					<?php
					}
					?>
			   	</ul>
			</div>
			<div class="nav-right"></div>
		<br><br>
	 </div>
	</div>
	<div id="content">
      <div id="contentleft">
       <?php 
	   if(Yii::app()->user->isGuest) 
	   {
			$this->widget('Userlogin'); 
		}
	   $this->widget('Agenda'); 	   
	   ?>
	  <a href="ymsgr:sendIM?director_pda@yahoo.com">
<img border="0" src="http://opi.yahoo.com/online?u=director_pda&m=g&t=14"/> </a>
	  <a href="ymsgr:sendIM?audi_sulistya@yahoo.com">
<img border="0" src="http://opi.yahoo.com/online?u=audi_sulistya&m=g&t=14"/> </a>
	  <a href="ymsgr:sendIM?marketing_pda@yahoo.com">
<img border="0" src="http://opi.yahoo.com/online?u=marketing_pda&m=g&t=14"/> </a>
      </div>
      <div id="contentright">
	  <div id="messages"></div>
        <?php echo $content; ?>
      </div>
	</div>
</div>
  </div>
</body>
</html>
