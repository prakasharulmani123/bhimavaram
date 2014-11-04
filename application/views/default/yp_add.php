<h1>Add New Business 
<div class="current-city">
	City : <?php echo userdata('city');?><a href="#change-city" role="button" data-toggle="modal"> (Change)</a>
</div>
</h1>
<div class="wizard">
 <ul class="steps">
      <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Business Information<span class="chevron"></span></li>
      <li data-target="#step2"><span class="badge">2</span>Contact Information<span class="chevron"></span></li>
</ul>
</div>    
       <?php echo form_open('yellowpages/contactinfo',array('class'=>'form-horizontal password-form','data-parsley-validate'=>'true'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">City*</label>
    <div class="controls">
<?php 
//echo $this->html->formField('dropdown','business-required',Business_Listings(),array('class'=>'span6 offset1 city-select','data-parsley-required'=>"true",'id'=>'category'));
echo $this->html->formField('dropdown','cityid-required',cityArray(),array('class'=>'span6','data-parsley-required'=>"true"),'');
?>    
</div>
  </div>       
  
    <div class="control-group">
    <label class="control-label" for="inputName">Business Name</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required','',array('placeholder'=>'Business Name','class'=>'span6','data-parsley-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Category</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','parentcategory-required',YpCategory(),array('class'=>'span6 offset1 city-select','data-parsley-required'=>"true",'id'=>'category'));
?>    
</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Sub Category</label>
    <div class="controls">
    	<select name="category" id="subcategory" class="span6 offset1 city-select" data-parsley-required="true">
        <?php 
			foreach($content['subcategories'] as $sub)
			{
				echo '<option value="'.$sub['id'].'" class="'.$sub['parentid'].'">'.$sub['name'].'</option>';
			}
			?>
        </select>
<?php 
//echo $this->html->formField('dropdown','category-required',array(''=>'Select Sub Category'),array('class'=>'span6 offset1 city-select','data-parsley-required'=>"true",'disabled'=>'disabled'));
?>    </div>
  </div>  
    <div class="control-group">
    <label class="control-label" for="inputPicture">Business Photo</label>
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
  <div class="control-group working-hours">
    <label class="control-label" for="inputName">Working Hours</label>
        <div class="controls">
        <div class="day-label">Monday</div>
      <?php  echo $this->html->formField('input','monday_from','',array('placeholder'=>'09:00 AM','class'=>'span2 from','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#monday_error"));?>
      <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','monday_to','',array('placeholder'=>'06:00 PM','class'=>'span2 to','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#monday_error"));?>
      
      	<label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="closed[]" class="closed-box"> Closed
		</label>
        <span id="monday_error"></span>
    </div>
        <div class="controls">
        <div class="day-label">Tuesday</div>
      <?php  echo $this->html->formField('input','tuesday_from','',array('placeholder'=>'09:00 AM','class'=>'span2 from','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#tuesday_error"));?>
      <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','tuesday_to','',array('placeholder'=>'06:00 PM','class'=>'span2 to','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#tuesday_error"));?>
      
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="closed[]" class="closed-box"> Closed
		</label>
        <span id="tuesday_error"></span>
    </div>
        <div class="controls">
        <div class="day-label">Wednesday</div>
      <?php  echo $this->html->formField('input','wednesday_from','',array('placeholder'=>'09:00 AM','class'=>'span2 from','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#wednesday_error"));?>
      <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','wednesday_to','',array('placeholder'=>'06:00 PM','class'=>'span2 to','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#wednesday_error"));?>
      
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="closed[]" class="closed-box"> Closed
		</label>
        <span id="wednesday_error"></span>
    </div>
        <div class="controls">
        <div class="day-label">Thursday</div>
      <?php  echo $this->html->formField('input','thursday_from','',array('placeholder'=>'09:00 AM','class'=>'span2 from','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#thursday_error"));?>
      <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','thursday_to','',array('placeholder'=>'06:00 PM','class'=>'span2 to','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#thursday_error"));?>
      
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="closed[]" class="closed-box"> Closed
		</label>
        <span id="thursday_error"></span>
    </div>
        <div class="controls">
        <div class="day-label">Friday</div>
      <?php  echo $this->html->formField('input','friday_from','',array('placeholder'=>'09:00 AM','class'=>'span2 from','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#friday_error"));?>
      <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','friday_to','',array('placeholder'=>'06:00 PM','class'=>'span2 to','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#friday_error"));?>
      
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="closed[]" class="closed-box"> Closed
		</label>
        <span id="friday_error"></span>
    </div>
        <div class="controls">
        <div class="day-label">Saturday</div>
      <?php  echo $this->html->formField('input','saturday_from','',array('placeholder'=>'09:00 AM','class'=>'span2 from','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#saturday_error"));?>
      <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','saturday_to','',array('placeholder'=>'06:00 PM','class'=>'span2 to','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#saturday_error"));?>
      
      <label class="checkbox inline">
 		<input type="checkbox"  value="1" name="closed[]" class="closed-box"> Closed
		</label>
        <span id="saturday_error"></span>
    </div>
        <div class="controls">
        <div class="day-label">Sunday</div>
      <?php  echo $this->html->formField('input','sunday_from','',array('placeholder'=>'09:00 AM','class'=>'span2 from','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#sunday_error"));?>
      <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','sunday_to','',array('placeholder'=>'06:00 PM','class'=>'span2 to','data-parsley-required'=>"true", "data-parsley-errors-container"=>"#sunday_error"));?>
      
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="closed[]" class="closed-box"> Closed
		</label>
        <span id="sunday_error"></span>
    </div>                        
  </div> 
  <div class="control-group payment-options">
    <label class="control-label" for="inputName">Payment Options</label>
     <div class="controls">
<label class="checkbox inline">
  <input type="checkbox" value="Cash" name="payment_options[]" data-parsley-required="true" data-parsley-errors-container="#payment_options_error">Cash
</label>
     <label class="checkbox inline">
  <input type="checkbox" value="VISA" name="payment_options[]">VISA Card
</label>
<div class="clear">&nbsp;</div>
<label class="checkbox inline">
  <input type="checkbox" value="Master Card" name="payment_options[]"> Master Card
</label>
<label class="checkbox inline">
  <input type="checkbox" value="American Express" name="payment_options[]"> American Express
</label>
<div class="clear">&nbsp;</div>
<label class="checkbox inline">
  <input type="checkbox" value="Bank Transfer" name="payment_options[]"> Bank Transfer
</label>
<label class="checkbox inline">
  <input type="checkbox" value="Traveler's Check" name="payment_options[]"> Traveler's Check
</label>
<div class="clear">&nbsp;</div>
<label class="checkbox inline">
  <input type="checkbox" value="Diner's Club" name="payment_options[]" > Diner's Club
</label><br />
     <span id="payment_options_error"></span>
    </div>  
   </div>
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Create Listing</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>