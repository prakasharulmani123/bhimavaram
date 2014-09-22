<h1>Add a New Photo Album
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open_multipart('admin/photos/addalbum',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
 <div class="control-group">
    <label class="control-label" for="inputName">Name</label>
    <div class="controls">
    
      <?php  echo $this->html->formField('input','name-required','',array('placeholder'=>'Album Title','class'=>'span8','data-required'=>"true"));?>
      </div></div>
       <div class="control-group">
    <label class="control-label" for="inputName">City</label>
    <div class="controls">
      <select name="cities[]" data-required="true" class="span8" multiple="multiple">
      <option value="0" selected="selected">All Cities</option>
      <?php foreach($content['cities'] as $city){
		  echo '<option value="'.$city['id'].'">'.$city['city'].'</option>';
		}?>
      </select>
</div></div>
 <div class="control-group">
    <label class="control-label" for="inputName">Description</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description','',array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6"));?>
      </div></div>
 <button type="submit" class="btn btn-danger  span8 abovePadding10" style="margin-left:230px">Create Album</button>
</form> 
<div class="clearbig">&nbsp;</div>