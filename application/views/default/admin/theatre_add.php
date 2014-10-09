<h1>Add a New theatre!
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open('admin/movies/addtheatre',array('class'=>'form-horizontal password-form','data-validate'=>'parsley','style'=>'margin-left:-80px'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">City*</label>
    <div class="controls">
<?php 
//echo $this->html->formField('dropdown','business-required',Business_Listings(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'));
echo $this->html->formField('dropdown','cityid-required',cityArray(),array('class'=>'span6','data-required'=>"true"),'');
?>    
</div>
  </div>       
      

  <div class="control-group">
    <label class="control-label" for="inputName">Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','name-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>       
  <div class="control-group">
    <label class="control-label" for="inputName">Running Since*</label>
    <div class="controls">
<?php 
//echo $this->html->formField('dropdown','category-required',Job_Category(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'));
?>    
<select name="started_at" class="span6" data-required="true">
	<option value="">Choose</option>
    <?php
		$thisyear=date("Y");
    	for($i=$thisyear;$i>=1900;$i--)
		{
			echo "<option value='$i'>$i</option>";
		}
	?>
</select>
</div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputBio">Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','address','',array('placeholder'=>'','class'=>'span6','rows'=>"3"));?>
    </div>
  </div>    
 
  <div class="control-group">
    <label class="control-label" for="inputName">Landmark*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','landmark-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Timings*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','timings_from-required','',array('placeholder'=>'Eg: 11:00 AM','class'=>'span3','data-required'=>"true"));?>
      <?php  echo $this->html->formField('input','timings_to-required','',array('placeholder'=>'Eg: 11:00 PM','class'=>'span3','data-required'=>"true"));?>
    </div>
  </div>        
 <div class="control-group">
    <label class="control-label" for="inputName">Contact Person*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','contact_person-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>  
  <div class="control-group">
    <label class="control-label" for="inputName">Phone*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','phone-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true",'data-type'=>"digits"));?>
    </div>
  </div>  
  <div class="control-group">
    <label class="control-label" for="inputName">Website</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','website','',array('placeholder'=>'Example: www.google.com','class'=>'span6'));?>
    </div>
  </div>         
     <div class="control-group">
    <label class="control-label" for="inputPicture">Logo/Picture</label>
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
  <div class="control-group">
    <label class="control-label" for="inputBio">Description*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description','',array('placeholder'=>'','class'=>'span6 wysiwyg','rows'=>"6"));?>
    </div>
  </div>  
 
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Submit Job</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>