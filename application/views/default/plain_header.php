<body id="plain-body">
<div class="margin20 span10 center-align well clearfix">
    	<div class="span10 center" id="plain_logo_holder">
        	<?php //echo anchor(base_url(),$this->settings->siteName(),array('id'=>'plain_logo','class'=>'center-align'));
				echo anchor(base_url(),getLogo());
			?>
        </div><!--logo-container Ends-->
<div class="span10 center-align clearfix"><?php echo show_message();?></div><!--Flash-Message Ends-->