<h1>Edit Listing Details
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open('admin/yellowpages/editlisting/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley','style'=>'margin-left:-60px'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Business Name</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required',$content['event']['title'],array('placeholder'=>'Business Name','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Category</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','parentcategory-required',YpCategory(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'),$this->df->get_field_value('yp_categories',array('id'=>$content['event']['category']),'parentid'));
?>    
</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Sub Category</label>
    <div class="controls">
	<?php 
    echo $this->html->formField('dropdown','subcategory-required',YpSubCategory($this->df->get_field_value('yp_categories',array('id'=>$content['event']['category']),'parentid')),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'),$content['event']['category']);
    ?>
<?php 
//echo $this->html->formField('dropdown','category-required',array(''=>'Select Sub Category'),array('class'=>'span6 offset1 city-select','data-required'=>"true",'disabled'=>'disabled'));
?>    </div>
  </div>  
    <div class="control-group">
    <label class="control-label" for="inputPicture">Business Photo</label>
    <div class="controls">    
    <?php //echo showavatar($content['user']['picture'],$content['user']['name'],array('class'=>'avatar'));?>
   <?php echo showBigAvatar($content['event']['picture'],$content['listing']['title'],array('class'=>'avatar'));?>
      <?php  //echo $this->html->formField('upload','picture','',array('placeholder'=>'Change Picture','class'=>'span5'));?>
      <input id="fileupload" type="file" name="files[]" data-url="<?php echo base_url();?>uploader/" multiple>
      <input type="hidden" name="picture" value="" />
    </div>
         <div id="progress" class="progress progress-success progress-striped span4 offset4">
            <div class="bar"></div>
        </div>
	  </div> 
<div class="form-title">Contact Information</div>  
  <div class="control-group">
    <label class="control-label" for="inputName">Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','address-required',$content['event']['address'],array('placeholder'=>'Address Line 1','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Area Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','areaname-required',$content['event']['areaname'],array('placeholder'=>'Area/Town Name','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputName">PinCode*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','pincode-required',$content['event']['pincode'],array('placeholder'=>'PinCode','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>  
   
  <div class="control-group">
    <label class="control-label" for="inputName">Contact Numbers*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','phone',$content['event']['phone'],array('placeholder'=>'Phone Number','class'=>'span3'));?>
      <?php  echo $this->html->formField('input','mobile',$content['event']['mobile'],array('placeholder'=>'Mobile Number','class'=>'span3'));?>
    </div>
  </div>    
  <div class="control-group">
    <label class="control-label" for="inputName">Fax</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','fax',$content['event']['fax'],array('placeholder'=>'Fax Number','class'=>'span6'));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputName">Email Address</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','emailaddress-valid_email',$content['event']['emailaddress'],array('placeholder'=>'Email Address','class'=>'span6'));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputName">Website</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','website',$content['event']['website'],array('placeholder'=>'http://example.com','class'=>'span6'));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputName">Twitter Profile</label>
    <div class="controls">
      <?php 
	  $social=$this->settings->getSocialData();
	   echo $this->html->formField('input','twitter',$content['event']['twitter'],array('placeholder'=>'Eg: http://twitter.com/'.$social['twitter'],'class'=>'span6'));?>
    </div>
  </div>   
  <div class="control-group">
    <label class="control-label" for="inputName">Facebook Profile</label>
    <div class="controls">
      <?php 
	   echo $this->html->formField('input','facebook',$content['event']['facebook'],array('placeholder'=>'Eg: http://facebook.com/'.$social['facebook'],'class'=>'span6'));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Google+ Profile</label>
    <div class="controls">
      <?php 
	   echo $this->html->formField('input','googleplus',$content['event']['googleplus'],array('placeholder'=>'Eg: https://plus.google.com/'.$social['googleplus'],'class'=>'span6'));?>
    </div>
  </div>     
  
  <div class="control-group" style="margin-left: -50px;">
    <label class="control-label" for="inputBio">Description</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description',$content['event']['description'],array('placeholder'=>'More information','class'=>'span7 wysiwyg','rows'=>"6"));?>
    </div>
  </div>
 <div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Update Listing</button>
</div>  
</form> 
<div class="clearbig">&nbsp;</div>