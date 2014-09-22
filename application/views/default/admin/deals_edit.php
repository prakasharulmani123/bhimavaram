<h1>Edit Deal Info</h1>

<div class="clearbig">&nbsp;</div>
       <?php echo form_open('admin/deals/editit/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Business/Organisation*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','business-required',Business_Listings(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'),$content['ad']['business']);
?>    
</div>
  </div>       
  <div class="control-group">
    <label class="control-label" for="inputName">Title*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required',$content['ad']['title'],array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>       
  <div class="control-group">
    <label class="control-label" for="inputBio">Description*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description',$content['ad']['description'],array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6"));?>
    </div>
  </div>  
       
  <div class="control-group">
    <label class="control-label" for="inputName">Deal Period*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','starts_on-required',$content['ad']['starts_on'],array('placeholder'=>'Starts on','class'=>'span3 datepicker','data-required'=>"true","data-type"=>"dateIso"));?>
      <?php  echo $this->html->formField('input','closes_on-required',$content['ad']['closes_on'],array('placeholder'=>'Closes on','class'=>'span3 datepicker','data-required'=>"true","data-type"=>"dateIso"));?>
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
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Update</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>