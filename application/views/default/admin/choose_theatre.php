<div id="user-account" class="span10 center-align">
	<div class="span10 ">
        <?php if(validation_errors()){?>
        	<div class="validation-errors center-align span7"><?php echo validation_errors();?></div>
        <?php }
		echo form_open('admin/movies/manage_shows',array('class'=>'form-horizontal center','data-validate'=>'parsley'));?>
<?php 
echo $this->html->formField('dropdown','city-required',cityArray(),array('id'=>'city','class'=>'span7 offset1 city-select','data-required'=>"true"),userdata('cityid'));
?>
<div class="clearbig">&nbsp;</div>
<select name="theatreid" class="span7" date-required="true" id="theatre">
<?php foreach($content['theatres'] as $theatre)
	{
?>
<option value="<?php echo $theatre['id'];?>" class="<?php echo $theatre['cityid'];?>"><?php echo $theatre['name'];?></option>
<?php }?>
</select>
      <button type="submit" class="btn btn-danger center-align span7 submit-btn">Submit</button>  

</form>
	<?php //echo anchor('start/signin','Already have an account? Sign in here',array('class'=>'block center'));?>
    </div>
</div>