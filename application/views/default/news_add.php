<h1>Submit News</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open('news/add',array('class'=>'form-horizontal password-form','data-parsley-validate'=>'true'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">News Category*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','category-required',News_Category(),array('class'=>'span6 offset1 city-select','data-parsley-required'=>"true",'id'=>'category'));
?>    
</div>
  </div>  

  <div class="control-group">
    <label class="control-label" for="inputName">News Title*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required','',array('placeholder'=>'','class'=>'span6','data-parsley-required'=>"true"));?>
   
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputBio">Content*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','content','',array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"12",'data-parsley-required'=>'true'));?>
    </div>
  </div>  
    <div class="control-group">
    <label class="control-label" for="inputPicture">Photo</label>
    <div class="controls">    
    <?php //echo showavatar($content['user']['picture'],$content['user']['name'],array('class'=>'avatar'));?>
    <img src="<?php echo $this->settings->imgPath().'business.png';?>" class="avatar" />
      <?php  //echo $this->html->formField('upload','picture','',array('placeholder'=>'Change Picture','class'=>'span5'));?>
      <input id="fileupload" type="file" name="files[]" data-url="<?php echo base_url();?>uploader/" multiple>
      <input type="hidden" name="picture" value="" />
    </div>
         <div id="progress" class="progress progress-success progress-striped span4 offset4">
            <div class="bar"></div>
        </div>
	  </div>
 
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Submit News</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>