<h1>Edit City Info
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open('admin/cities/editcity/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Name</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','city-required',$content['city']['city'],array('placeholder'=>'','class'=>'span4','data-required'=>"true"));?>
    </div>
  </div>     
 
 
  <div class="control-group">
    <label class="control-label" for="inputName">Domain</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','domain-required',$content['city']['domain'],array('placeholder'=>'','class'=>'span4','data-required'=>'true', 'data-type' => 'url'));?>
    </div>
  </div>
 
     <div class="control-group">
    <label class="control-label" for="inputPicture">Logo (235px X 60px)</label>
    <div class="controls">    
    <?php //echo showavatar($content['user']['picture'],$content['user']['name'],array('class'=>'avatar'));?>
    <img src="<?php echo $this->settings->imgPath().'business.png';?>" class="avatar" />
      <?php  //echo $this->html->formField('upload','picture','',array('placeholder'=>'Change Picture','class'=>'span5'));?>
      <input id="fileupload" type="file" name="" data-url="<?php echo base_url();?>uploader/">
      <input type="hidden" name="picture" value="" />
    </div>
         <div id="progress" class="progress progress-success progress-striped span4 offset4">
            <div class="bar"></div>
        </div>
	  </div>
 
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span4 abovePadding10">Update</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>