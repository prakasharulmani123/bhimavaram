<div id="signin-with-facebook" class="span10 center-align">	
	<div class="span10 fb-login center-align">
    	<?php echo anchor('facebook/connect','Create new account with facebook',array('class'=>'btn btn-primary btn-icon span6 center-align fb-login-link '));?>
    </div>
</div>
<div class="span10 center-align center abovePadding10">or</div>
<div id="user-account" class="span10 center-align">
	<div class="span10 ">
    	<h2 class="split-title"><span>Create your account to explore.</span></h2>
        <?php if(validation_errors()){?>
        	<div class="validation-errors center-align span7"><?php echo validation_errors();?></div>
        <?php }
		echo form_open('start/register',array('class'=>'form-horizontal center big-form','data-validate'=>'parsley'));?>
        
        <?php echo $this->html->formField('input','name-required','',array('placeholder'=>'Full Name','class'=>'span7','data-required'=>"true"));
		 echo $this->html->formField('input','email-required-valid_email-is_unique:users_email','',array('placeholder'=>'Email Address','class'=>'span7','data-required'=>"true",'data-type'=>'email'));
		  echo $this->html->formField('password','password-required-min_length:8-max_length:30','',array('placeholder'=>'Password (8-30 Characters)','class'=>'span7','data-required'=>"true"));
		   //echo $this->html->formField('input','email-required-valid_email','',array('placeholder'=>'Email Address','class'=>'span7'));		   
		   ?>
           <div class="span7 clearfix">
           <label class="radio inline inline-label">
  Choose Gender
</label>         <label class="radio inline">
  <?php echo $this->html->formField('radio','gender','male',array('data-required'=>"true"),true);?> Male
</label>
           <label class="radio inline">
   <?php echo $this->html->formField('radio','gender','female',array('data-required'=>"true"),false);?> Female
</label>
<div class="clear">&nbsp;</div>
</div>
           <div class="span7 center-align clearfix birthday-holder">
           <label>Birthday</label>
<?php 
echo $this->html->formField('dropdown','birthday_month-required',monthArray(),array('class'=>'span2 pull-right date-dropdown','data-required'=>"true"));
echo $this->html->formField('dropdown','birthday_date-required',dateArray(),array('class'=>'span1 pull-right date-dropdown','data-required'=>"true"));
echo $this->html->formField('dropdown','birthday_year-required',yearArray(),array('class'=>'span2 pull-right date-dropdown','data-required'=>"true"));
?>
  </div>           

<?php 
echo $this->html->formField('dropdown','city-required',cityArray(),array('class'=>'span7 offset1 city-select','data-required'=>"true"),userdata('cityid'));
?>

      <button type="submit" class="btn btn-danger center-align span7 submit-btn">Create Account</button>  

</form>
	<?php echo anchor('start/signin','Already have an account? Sign in here',array('class'=>'block center'));?>
    </div>
</div>