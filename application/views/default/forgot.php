<div id="user-account" class="span10 center-align">
	<div class="span10 ">
    	<h2 class="split-title"><span>Forgor your password?</span></h2>
        <?php if(validation_errors()){?>
        	<div class="validation-errors center-align span7"><?php echo validation_errors();?></div>
        <?php }
		echo form_open('site/forgot',array('class'=>'form-horizontal center big-form','data-validate'=>'parsley'));?>
        
        <?php
		 echo $this->html->formField('input','email-required-valid_email','',array('placeholder'=>'Email Address','class'=>'span7','data-required'=>"true",'data-type'=>'email'));
		   //echo $this->html->formField('input','email-required-valid_email','',array('placeholder'=>'Email Address','class'=>'span7'));		   
		   ?>
  <div class="clear">&nbsp;</div>
      <button type="submit" class="btn btn-danger center-align span7 submit-btn">Send Reset Link</button>  

</form>
<div class="center-align center">
	<?php echo anchor('start/register','Create new account',array('class'=>'center'));?> | <?php echo anchor('start/register','Sign in',array('class'=>'center'));?>
    </div>
    </div>
</div>