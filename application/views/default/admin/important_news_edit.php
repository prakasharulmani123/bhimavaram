<h1>Edit Important News</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open_multipart('admin/importantnews/editnews/'.uridata('4'),array('class'=>'form-horizontal password-form','data-validate'=>'parsley','style'=>'margin-left:-100px;'));?>

  <div class="control-group" id="slug_div">
    <label class="control-label" for="inputName">Link</label>
    <div class="controls">
    <?php substr($content['news']['slug'],0,4) == 'http' ? $slug = $content['news']['slug'] : $slug = ''; ?>
<?php  echo $this->html->formField('input','slug',$slug,array('placeholder'=>'','class'=>'span6','data-type'=>"url", 'id' => 'slug'));?>  <br />
Leave empty for internal link
</div>
  </div>    

  <div class="control-group">
    <label class="control-label" for="inputName">News Title*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required',$content['news']['title'],array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
   
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputBio">Content*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','content',htmlspecialchars_decode($content['news']['content']),array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"12",'data-required'=>'true'));?>
    </div>
  </div>  
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Update News</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>