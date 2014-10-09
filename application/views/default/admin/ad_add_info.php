<div class="left">
<h1 class="split-title"><span>Add Additional Information to <?php echo $content['ad']['title'];?></span></h1>
    	 <?php echo form_open_multipart('admin/ads/update_add_info',array('class'=>'form-horizontal','data-validate'=>'parsley'));?>

     <div class="control-group">
<label class="control-label" for="inputName">Description</label>
<div class="controls">
<?php  echo $this->html->formField('textarea','description-required',$content['ad']['description'],array('placeholder'=>'Area Information','class'=>'span8 wysiwyg','rows'=>"6"));?>
</div></div>
     <div class="control-group">
<label class="control-label" for="inputName">Description</label>
<div class="controls">
<?php  echo $this->html->formField('textarea','address-required',$content['ad']['address'],array('placeholder'=>'Address','class'=>'span8','rows'=>"3"));?>
</div></div>         
   <div class="control-group">
   <label class="control-label" for="inputName">Photos</label>
   <div class="controls">            
         <div class="fields">
            <input type="file" name="userfile[]" class="offset1" >
            </div>
            <a href="javascript:void(0)" class="add-fields">Add Field</a>
   	 </div>
    </div>

<input type="hidden" name="adid" value="<?php echo $content['ad']['id']; ?>" />
             <button type="submit" class="btn btn-danger center-align span7 submit-btn" style="margin-left:230px;">Submit</button>  
         </form>
            
<?php //echo anchor('admin/photos/addalbum/','Create new album',array('class'=>'align-center center span9 pull-right'));?>
</div>