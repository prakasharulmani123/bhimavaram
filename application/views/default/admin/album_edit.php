<h1>Edit Photo Album
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open_multipart('admin/photos/editalbum/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
 <div class="control-group">
    <label class="control-label" for="inputName">Name</label>
    <div class="controls">
    
      <?php  echo $this->html->formField('input','name-required',$content['album']['name'],array('placeholder'=>'Album Title','class'=>'span8','data-required'=>"true"));?>
      </div></div>
 <div class="control-group">
    <label class="control-label" for="inputName">Description</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description',$content['album']['description'],array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6"));?>
      </div></div>
 <button type="submit" class="btn btn-danger  span8 abovePadding10" style="margin-left:230px">Update Album</button>
</form> 
<div class="clearbig">&nbsp;</div>