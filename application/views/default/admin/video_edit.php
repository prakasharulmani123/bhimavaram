<h1>Update Video Info</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open_multipart('admin/photos/editvideo/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
 <div class="control-group">
    <label class="control-label" for="inputName">Title</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required',$content['video']['title'],array('placeholder'=>'Album Title','class'=>'span8','data-required'=>"true"));?>
    </div></div>

 <div class="control-group">
    <label class="control-label" for="inputName">Youtube URL</label>
    <div class="controls">
      <?php // echo $this->html->formField('textarea','description','',array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6"));?>
      <?php  echo $this->html->formField('input','url-required',$content['video']['url'],array('placeholder'=>'Video URL','class'=>'span8','data-required'=>"true"));?>
</div></div>
 <button type="submit" class="btn btn-danger  span8 abovePadding10" style="margin-left:230px;">Update</button>
</form> 
<div class="clearbig">&nbsp;</div>