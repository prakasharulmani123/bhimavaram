<div id="user-account" class="span10 center-align">
	<div class="span10 ">
    <?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : ''; ?>
    	<h2 class="split-title"><span>Reset your password</span></h2>
        <?php if(validation_errors()){?>
        	<div class="validation-errors center-align span7"><?php echo validation_errors();?></div>
        <?php }
		echo form_open('site/change_password/'.uridata(3).'/'.uridata(4),array('class'=>'form-horizontal center big-form','data-parsley-validate'=>'true'));?>
        <div class="span10 clearfix">
        	<div class="clear">&nbsp;</div>
           <label>  Email Id : <?php echo $content['user']['email'];?></label>
			<div class="clear">&nbsp;</div>
		</div>

        <?php
		  echo $this->html->formField('password','password-required-min_length:8-max_length:30','',array('placeholder'=>'Password (8-30 Characters)','class'=>'span7','data-parsley-required'=>"true"));
		  echo '<div class="clear">&nbsp;</div>';
		   echo $this->html->formField('password','confirm_password-required-min_length:8-max_length:30','',array('placeholder'=>'Retype Password','class'=>'span7','data-parsley-required'=>"true"));
		   //echo $this->html->formField('input','email-required-valid_email','',array('placeholder'=>'Email Address','class'=>'span7'));		   
		   ?>
  <div class="clear">&nbsp;</div>
      <button type="submit" class="btn btn-danger center-align span7 submit-btn">Update Password</button>  

</form>
    </div>
</div>