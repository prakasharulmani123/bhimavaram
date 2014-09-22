<h1>Update phone number</h1>
<div class="">
        <?php if(validation_errors()){?>
        	<div class="validation-errors center-align span7"><?php echo validation_errors();?></div>
        <?php }
		echo form_open_multipart('admin/numbers/editnumber/'.uridata(4),array('class'=>'form-horizontal center','data-validate'=>'parsley'));?>
        <div class="control-group">
<label class="control-label" for="inputName">City</label>
<div class="controls">

<?php 
echo $this->html->formField('dropdown','cityid-required',cityArray(),array('id'=>'city','class'=>'span6 offset1 city-select','data-required'=>"true"),$content['number']['cityid']);
?></div>

</div>
<div class="control-group">
<label class="control-label" for="inputName">Title</label>
<div class="controls">
<?php  echo $this->html->formField('input','name-required',$content['number']['name'],array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
</div></div>
<div class="control-group">
<label class="control-label" for="inputName">Phone Number</label>
<div class="controls">

<?php  echo $this->html->formField('input','phone-required',$content['number']['phone'],array('placeholder'=>'','class'=>'span6','data-required'=>"true",'data-type'=>"digits"));?>
</div></div>
<div class="clearbig">&nbsp;</div>
      <button type="submit" class="btn btn-danger center-align span6 submit-btn" style="margin-left: 230px;">Update</button>  

</form>
	<?php //echo anchor('start/signin','Already have an account? Sign in here',array('class'=>'block center'));?>
    </div>
