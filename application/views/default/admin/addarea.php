<h1>Add New Area</h1>        <?php if(validation_errors()){?>
        	<div class="validation-errors center-align span7"><?php echo validation_errors();?></div>
        <?php }
		echo form_open_multipart('admin/areas/addarea',array('class'=>'form-horizontal center','data-validate'=>'parsley'));?>
             <div class="control-group">
<label class="control-label" for="inputName">City</label>
<div class="controls">
<?php 
echo $this->html->formField('dropdown','cityid-required',cityArray(),array('id'=>'city','class'=>'span7 offset1 city-select','data-required'=>"true"),'');
?>
</div></div>
     <div class="control-group">
<label class="control-label" for="inputName">Name</label>
<div class="controls"><?php  echo $this->html->formField('input','name-required','',array('placeholder'=>'Area Name','class'=>'span7','data-required'=>"true"));?>
</div></div>
     <div class="control-group">
<label class="control-label" for="inputName">PinCode</label>
<div class="controls">
<?php  echo $this->html->formField('input','pincode-required','',array('placeholder'=>'PinCode','class'=>'span7','data-required'=>"true",'data-type'=>"digits"));?>
</div></div>
     <div class="control-group">
<label class="control-label" for="inputName">Description</label>
<div class="controls">
<?php  echo $this->html->formField('textarea','description-required','',array('placeholder'=>'Area Information','class'=>'span8 wysiwyg','rows'=>"6"));?>
</div></div>
     <div class="control-group">
<label class="control-label" for="inputName">Area Pictures</label>
<div class="controls">
<div class="fields">
	<input type="file" name="userfile[]" class="offset1" >
    
</div>
<a href="javascript:void(0)" class="add-fields block">Add another picture</a>
</div></div>
            
<div class="clearbig">&nbsp;</div>
      <button type="submit" class="btn btn-danger center-align span7 submit-btn">Submit</button>  

</form>
	<?php //echo anchor('start/signin','Already have an account? Sign in here',array('class'=>'block center'));?>
