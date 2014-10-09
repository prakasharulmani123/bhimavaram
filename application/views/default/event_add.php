<h1>Create a New Event
<div class="current-city">
	City : <?php echo userdata('city');?><a href="#change-city" role="button" data-toggle="modal"> (Change)</a>
</div>
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open('events/add',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Event Type*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','category-required',Event_Category(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'));
?>    
</div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputName">Event Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','name-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>
    
    <div class="control-group">
    <label class="control-label" for="inputName">Event Date &amp; Time*</label>
    <div class="controls events-holder">
      <?php  echo $this->html->formField('input','start_date-required','',array('placeholder'=>'Start Date','class'=>'span2 datepicker','id'=>'fromdate','data-required'=>"true","data-type"=>"dateIso"));?>		
      <span class="bootstrap-timepicker"><?php  echo $this->html->formField('input','start_time-required','',array('placeholder'=>'Time','class'=>'span1 timepicker fromtime','data-required'=>"true"));?></span>
            <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','end_date-required','',array('placeholder'=>'End Date','class'=>'span2 datepicker','data-required'=>"true","data-type"=>"dateIso","data-afterdate"=>"#fromdate"));?>		
      <span class="bootstrap-timepicker"><?php  echo $this->html->formField('input','end_time-required','',array('placeholder'=>'Time','class'=>'span1 timepicker totime','data-required'=>"true"));?>		</span>
    </div>
    </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Event Website</label>    
    <div class="controls">
      <?php  echo $this->html->formField('input','url','',array('placeholder'=>'Example:http://myevent.com','class'=>'span6','data-type'=>"url"));?>
    </div>
  </div>     
<div class="control-group">
    <label class="control-label" for="inputName">Organiser Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','organiser_name-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>  
<div class="control-group">
    <label class="control-label" for="inputName">Contact Information*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','phone','',array('placeholder'=>'Phone Number','class'=>'span3','data-type'=>"digits"));?>
      <?php  echo $this->html->formField('input','email','',array('placeholder'=>'Email Address','class'=>'span3','data-type'=>"email"));?>
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
  <div class="control-group">
    <label class="control-label" for="inputBio">Description*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description','',array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6",'data-required'=>'true'));?>
    </div>
  </div>      
<h3 class="form-header">Venue &amp; Ticket Information</h3>
  <div class="control-group">
    <label class="control-label" for="inputName">Venue Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','venue_name-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputBio">Venue Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','venue_address','',array('placeholder'=>'','class'=>'span6','rows'=>"3",'data-required'=>'true'));?>
    </div>
  </div>  
   <div class="control-group">
    <label class="control-label" for="inputName">Ticket Price* (Rupees)</label>
      <div class="controls">
      <?php  echo $this->html->formField('input','price','',array('placeholder'=>'','class'=>'span2 from','data-required'=>"true",'data-type'=>'number'));?>
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="free" class="free-box"> Free
		</label>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="inputName">Online Ticket</label>    
    <div class="controls">
      <?php  echo $this->html->formField('input','ticket_url','',array('placeholder'=>'URL','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>  
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Create Event</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>