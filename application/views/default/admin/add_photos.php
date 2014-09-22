<h2 class="split-title"><span>Add photos to <?php echo $content['album']['name'];?></span></h2>
<div id="user-account" class="span18 center-align">
	<div class="span12 ">
    	 <?php echo form_open_multipart('admin/photos/upload_photos',array('class'=>'form-horizontal center','data-validate'=>'parsley'));?>
         <div class="fields">
			<input name="title[]" data-required="true" type="text" class="span4 pull-left" placeholder="Photo Title" />
            <input type="file" name="userfile[]" class="offset1" >
            </div>
            <a href="javascript:void(0)" class="add-fields">Add Field</a>
            <div class="clear">&nbsp;</div>
            <input type="hidden" name="albumid" value="<?php echo $content['albumid']; ?>" />
             <button type="submit" class="btn btn-danger center-align span7 submit-btn">Submit</button>  
         </form>
         
    </div>
</div>
   
<?php //echo anchor('admin/photos/addalbum/','Create new album',array('class'=>'align-center center span9 pull-right'));?>