<h1>Add New Business</h1>
<div class="wizard">
 <ul class="steps">
      <li data-target="#step1"><span class="badge">1</span>Business Information<span class="chevron"></span></li>
      <li data-target="#step2" class="active"><span class="badge badge-info">2</span>Contact Information<span class="chevron"></span></li>
</ul>
</div>  
       <?php echo form_open('yellowpages/complete',array('class'=>'form-horizontal password-form','data-parsley-validate'=>'true'));?>  
<div class="form-title">Contact Information</div>  
  <div class="control-group">
    <label class="control-label" for="inputName">Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','address-required','',array('placeholder'=>'Address Line 1','class'=>'span6','data-parsley-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">&nbsp;</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','address2-required','',array('placeholder'=>'Address Line 2','class'=>'span6','data-parsley-required'=>"true"));?>
    </div>
  </div>  
  <div class="control-group">
    <label class="control-label" for="inputName">Area Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','area-required','',array('placeholder'=>'Area/Town Name','class'=>'span6','data-parsley-required'=>"true"));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputName">PinCode*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','pincode-required','',array('placeholder'=>'PinCode','class'=>'span6','data-parsley-required'=>"true"));?>
    </div>
  </div>  
   
  <div class="control-group">
    <label class="control-label" for="inputName">Contact Numbers*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','phone-required','',array('placeholder'=>'Phone Number','class'=>'span3','data-parsley-required'=>"true"));?>
      <?php  echo $this->html->formField('input','mobile','',array('placeholder'=>'Mobile Number','class'=>'span3'));?>
    </div>
  </div>    
  <div class="control-group">
    <label class="control-label" for="inputName">Fax</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','fax','',array('placeholder'=>'Fax Number','class'=>'span6'));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputName">Email Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','email-valid_email','',array('placeholder'=>'Email Address','class'=>'span6','data-parsley-required'=>"true"));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputName">Website</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','website','',array('placeholder'=>'http://example.com','class'=>'span6'));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputName">Twitter Profile</label>
    <div class="controls">
      <?php 
	  $social=$this->settings->getSocialData();
	   echo $this->html->formField('input','twitter','',array('placeholder'=>'Eg: http://twitter.com/'.$social['twitter'],'class'=>'span6'));?>
    </div>
  </div>   
  <div class="control-group">
    <label class="control-label" for="inputName">Facebook Profile</label>
    <div class="controls">
      <?php 
	   echo $this->html->formField('input','facebook','',array('placeholder'=>'Eg: http://facebook.com/'.$social['facebook'],'class'=>'span6'));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Google+ Profile</label>
    <div class="controls">
      <?php 
	   echo $this->html->formField('input','googleplus','',array('placeholder'=>'Eg: https://plus.google.com/'.$social['googleplus'],'class'=>'span6'));?>
    </div>
  </div>     
  
  <div class="control-group">
    <label class="control-label" for="inputBio">Description</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description','',array('placeholder'=>'More information','class'=>'span8 wysiwyg','rows'=>"6"));?>
    </div>
  </div>
  <input type="hidden" name="prevdata" value='<?php echo $content['prevdata'];?>' />
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Submit Details</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>