<?php echo form_open('admin/auth/index',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Username</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','username-required','',array('placeholder'=>'','class'=>'span4','data-required'=>"true"));?>
    </div>
  </div>
    <label class="control-label" for="inputName">Password</label>
    <div class="controls">
      <?php  echo $this->html->formField('password','password-required','',array('placeholder'=>'','class'=>'span4','data-required'=>"true"));?>
    </div>
  </div>
  <div class="clearbig">&nbsp;</div>
  <button type="submit" class="btn btn-danger center-align span4 submit-btn" style="margin-left:480px;">Submit</button> 
</form>