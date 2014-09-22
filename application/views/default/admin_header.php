<body id="admin-body">

<div class="container">
    	<div class="span20 header">
        	<?php //echo anchor(base_url(),$this->settings->siteName(),array('id'=>'plain_logo','class'=>'center-align'));
				echo anchor('admin/news/managenews',$this->html->themeImg('plain_logo.png'),array('class'=>'pull-left'));
			?>
            <?php echo anchor('admin/auth/logout','Logout',array('class'=>'pull-right','style'=>'padding:20px;'));?>
        </div><!--logo-container Ends-->
<div class="center-align clearfix"><?php echo show_message();?></div><!--Flash-Message Ends-->        
<div class="margin20 span15 center-align pull-right">
