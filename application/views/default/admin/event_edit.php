<h1>Edit Event Details
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open('admin/events/editevent/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley','style'=>'margin-left'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Event Type*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','category-required',Event_Category(),array('class'=>'span5 offset1 city-select','data-required'=>"true",'id'=>'category'),$content['event']['category']);
?>    
</div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputName">Event Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','name-required',$content['event']['name'],array('placeholder'=>'','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>
    
    <div class="control-group">
    <label class="control-label" for="inputName">Event Date &amp; Time*</label>
    <div class="controls events-holder">
      <?php  echo $this->html->formField('input','start_date-required',$content['event']['start_date'],array('placeholder'=>'Start Date','class'=>'span2 datepicker','id'=>'fromdate','data-required'=>"true","data-type"=>"dateIso"));?>		
      <span class="bootstrap-timepicker"><?php  echo $this->html->formField('input','start_time-required',$content['event']['start_time'],array('placeholder'=>'Time','class'=>'span1 timepicker fromtime','data-required'=>"true"));?></span>
            <span class="divide-label">to</span>
      <?php  echo $this->html->formField('input','end_date-required',$content['event']['end_date'],array('placeholder'=>'End Date','class'=>'span2 datepicker','data-required'=>"true","data-type"=>"dateIso","data-afterdate"=>"#fromdate"));?>		
      <span class="bootstrap-timepicker"><?php  echo $this->html->formField('input','end_time-required',$content['event']['end_time'],array('placeholder'=>'Time','class'=>'span1 timepicker totime','data-required'=>"true"));?>		</span>
    </div>
    </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Event Website</label>    
    <div class="controls">
      <?php  echo $this->html->formField('input','url',$content['event']['url'],array('placeholder'=>'Example:http://myevent.com','class'=>'span5','data-type'=>"url"));?>
    </div>
  </div>     
<div class="control-group">
    <label class="control-label" for="inputName">Organiser Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','organiser_name-required',$content['event']['organiser_name'],array('placeholder'=>'','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>  
<div class="control-group">
    <label class="control-label" for="inputName">Contact Information*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','phone-required',$content['event']['phone'],array('placeholder'=>'Phone Number','class'=>'span3','data-required'=>"true",'data-type'=>"digits"));?>
      <?php  echo $this->html->formField('input','email',$content['event']['email'],array('placeholder'=>'Email Address','class'=>'span3','data-type'=>"email"));?>
    </div>
  </div>  
  <div class="control-group">
    <label class="control-label" for="inputBio">Description*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description',$content['event']['description'],array('placeholder'=>'','class'=>'span6 wysiwyg','rows'=>"6",'data-required'=>'true'));?>
    </div>
  </div>      
<h3 class="form-header">Venue &amp; Ticket Information</h3>
  <div class="control-group">
    <label class="control-label" for="inputName">Venue Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','venue_name-required',$content['event']['venue_name'],array('placeholder'=>'','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputBio">Venue Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','venue_address',$content['event']['venue_address'],array('placeholder'=>'','class'=>'span5','rows'=>"3",'data-required'=>'true'));?>
    </div>
  </div>  
   <div class="control-group">
    <label class="control-label" for="inputName">Ticket Price* (Rupees)</label>
      <div class="controls">
      <?php  echo $this->html->formField('input','price',$content['event']['price'],array('placeholder'=>'','class'=>'span2 from','data-required'=>"true",'data-type'=>'number'));?>
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="free" class="free-box"> Free
		</label>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="inputName">Online Ticket</label>    
    <div class="controls">
      <?php  echo $this->html->formField('input','ticket_url',$content['event']['ticket_url'],array('placeholder'=>'URL','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>  
<div class="span5" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span5 abovePadding10">Update Event</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>