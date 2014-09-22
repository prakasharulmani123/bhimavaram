<div id="user-account" class="span10 center-align">
	<div class="span10 ">
        <?php 
		echo form_open('admin/movies/theatre_add_movie/'.uridata('4'),array('class'=>'form-horizontal center','data-validate'=>'parsley'));?>
<div class="clearbig">&nbsp;</div>
<select name="movieid-required" class="span7" date-required="true" id="theatre">
<option value="">Choose Movie</option>
<?php foreach($content['movies'] as $movie)
	{
?>
<option value="<?php echo $movie['id'];?>"><?php echo $movie['name'];?></option>
<?php }?>
</select>
<div class="clearbig">&nbsp;</div>
      <input type="text" name="tags" value="" class="span7 tm-input" placeholder="Show Timings"  />	<div class="tags-holder span5">&nbsp;</div>
    <input type="hidden" name="tagsList" id="tagsList" data-required="true" />

      <button type="submit" class="btn btn-danger center-align span7 submit-btn">Submit</button>  

</form>
	<?php //echo anchor('start/signin','Already have an account? Sign in here',array('class'=>'block center'));?>
    </div>
</div>