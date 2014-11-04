<?php
echo $this->session->flashdata('message') ? $this->session->flashdata('message') : '';
?>
<div id="signin-with-facebook" class="span10 center-align">	
	<div class="span10 fb-login center-align">
    	<?php echo anchor('facebook/connect','Create new account with facebook',array('class'=>'btn btn-primary btn-icon span6 center-align fb-login-link '));?>
    </div>
</div>
<div class="span10 center-align center abovePadding10">or</div>
<div id="user-account" class="span10 center-align">
	<div class="span10 ">
    	<h2 class="split-title"><span>Sign in with <?php echo $this->settings->siteName();?></span></h2>
        <?php if(validation_errors()){?>
        	<div class="validation-errors center-align span7"><?php echo validation_errors();?></div>
        <?php }
		echo form_open('start/signin',array('class'=>'form-horizontal center big-form','data-parsley-validate'=>'true'));?>
        
        <?php
		 echo $this->html->formField('input','email-required-valid_email','',array('placeholder'=>'Email Address','class'=>'span7','data-parsley-required'=>"true",'data-parsley-type'=>'email'));
		  echo $this->html->formField('password','password-required-min_length:8-max_length:30','',array('placeholder'=>'Password (8-30 Characters)','class'=>'span7','data-parsley-required'=>"true"));
		  echo anchor('site/forgot','Forgot password? click here',array('class'=>'block'));
		   //echo $this->html->formField('input','email-required-valid_email','',array('placeholder'=>'Email Address','class'=>'span7'));		   
		   ?>
  <div class="clear">&nbsp;</div>
      <button type="submit" class="btn btn-danger center-align span7 submit-btn">Sign in</button>  

</form>
	<?php echo anchor('start/register','New to '.$this->settings->siteName().'? Create an account here',array('class'=>'block center'));?>
    </div>
</div>