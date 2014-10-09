<h1>Add a Video</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open_multipart('admin/photos/addvideo',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
 <div class="control-group">
    <label class="control-label" for="inputName">Title</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required','',array('placeholder'=>'Album Title','class'=>'span8','data-required'=>"true"));?>
    </div></div>
 <div class="control-group">
    <label class="control-label" for="inputName">Cities</label>
    <div class="controls">    
      <select name="cities[]" data-required="true" class="span8" multiple="multiple">
      <option value="0" selected="selected">All Cities</option>
      <?php foreach($content['cities'] as $city){
		  echo '<option value="'.$city['id'].'">'.$city['city'].'</option>';
		}?>
      </select>
</div></div>
 <div class="control-group">
    <label class="control-label" for="inputName">Youtube URL</label>
    <div class="controls">
      <?php // echo $this->html->formField('textarea','description','',array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6"));?>
      <?php  echo $this->html->formField('input','url-required','',array('placeholder'=>'Video URL','class'=>'span8','data-required'=>"true"));?>
</div></div>
 <button type="submit" class="btn btn-danger  span8 abovePadding10" style="margin-left:230px;">Add Video</button>
</form> 
<div class="clearbig">&nbsp;</div>