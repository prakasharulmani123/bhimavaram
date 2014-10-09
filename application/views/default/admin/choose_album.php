<h1>Choose Album</h1>
        <?php if(validation_errors()){?>
        	<div class="validation-errors center-align span7"><?php echo validation_errors();?></div>
        <?php }
		echo form_open('admin/photos/add_photos',array('class'=>'form-horizontal center','data-validate'=>'parsley'));?>
 <div class="control-group">
    <label class="control-label" for="inputName">City</label>
    <div class="controls">
	<?php 
echo $this->html->formField('dropdown','city',cityArray(),array('id'=>'city','class'=>'span7 offset1 city-select'),'');
?>
</div></div>
 <div class="control-group">
    <label class="control-label" for="inputName">Choose Theatre</label>
    <div class="controls">
<select name="albumid" class="span7" date-required="true" id="theatre">
<?php foreach($content['theatres'] as $theatre)
	{
?>
<option value="<?php echo $theatre['id'];?>" class="<?php $cities=explode(',',$theatre['cities']); foreach($cities as $city){echo ' '.$city.' ';}?>"><?php echo $theatre['name'];?></option>
<?php }?>
</select>
</div></div>
      <button type="submit" class="btn btn-danger center-align span7 submit-btn" style="margin-left:230px;">Submit</button>  

</form>
	<?php //echo anchor('start/signin','Already have an account? Sign in here',array('class'=>'block center'));?>
