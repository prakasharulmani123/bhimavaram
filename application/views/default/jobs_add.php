<h1>Post a New Job Free!
<div class="current-city">
	City : <?php echo userdata('city');?><a href="#change-city" role="button" data-toggle="modal"> (Change)</a>
</div>
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open('jobs/add',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group choose-business">
    <label class="control-label" for="inputName">Business/Organisation*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','business-required',Business_Listings(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'));
?>    
<div class="field-hint">Can't find your busines here? <?php echo anchor('yellowpages/add','Add your business here');?></div>
</div>
		<div class="span6 offset4 center" style="margin-top:-10px;padding-left: 30px;">
    	<h5>or</h5>
    	<h5><a href="javascript:void(0)" class="add-contact-info">Add Business Information</a></h5>
        </div>  
  </div>
  <div>
		<div class="add-business-info">
              <div class="control-group">
                <label class="control-label" for="inputName">Business/Organisation Name*</label>
                <div class="controls">
                  <?php  echo $this->html->formField('input','business_name-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputName">Address*</label>
                <div class="controls">
                  <?php  echo $this->html->formField('input','address-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label" for="inputName">Phone*</label>
                <div class="controls">
                  <?php  echo $this->html->formField('input','phone-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
                </div>
              </div>                            
        </div>
  	</div>         
  <div class="control-group">
    <label class="control-label" for="inputName">Job Title*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>       
  <div class="control-group">
    <label class="control-label" for="inputName">Job Industry*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','category-required',Job_Category(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'));
?>    
</div>
  </div>
  
    <div class="control-group">
    <label class="control-label" for="inputName">Job Type*</label>
    <div class="controls">
    
    <?php foreach($content['types'] as $type){ 
		if($type['name']=='Full Time')
		{
	?>
      <label class="radio inline">
  <input type="radio" name="jobtype"  value="<?php echo $type['id'];?>" checked="checked">
  <?php echo $type['name'];?>
</label>
	<?php 	
		}
		else
		{
		?>
      <label class="radio inline">
  <input type="radio" name="jobtype"  value="<?php echo $type['id'];?>">
  <?php echo $type['name'];?>
</label>        
		<?php			
		}
	}?>
</div>
</div>
  <div class="control-group">
    <label class="control-label" for="inputName">Qualification*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','qualification-required',Job_Qualifications(),array('class'=>'span6 offset1','data-required'=>"true"));
?>    
</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Job Location*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','location-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputName">Salary*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','salary_from-required','',array('placeholder'=>'Min (Lakhs/Annum)','class'=>'span3','data-required'=>"true",'data-type'=>"number"));?>
      <?php  echo $this->html->formField('input','salary_to-required','',array('placeholder'=>'Max (Lakhs/Annum)','class'=>'span3','data-required'=>"true",'data-type'=>"number"));?>
    </div>
  </div>         
  <div class="control-group">
    <label class="control-label" for="inputName">Experience*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','exp_from_year-required','',array('placeholder'=>'Min(Years)','class'=>'span1 pull-left','data-required'=>"true",'data-type'=>"number",'style'=>'width:64px'));?>
      <?php  echo $this->html->formField('input','exp_from_month-required','',array('placeholder'=>'Min(Months)','class'=>'span1 pull-left','data-required'=>"true",'style'=>'width:64px','data-type'=>"number"));?>      
      <?php  echo $this->html->formField('input','exp_to_year-required','',array('placeholder'=>'Max(Years)','class'=>'span1 pull-left','data-required'=>"true",'style'=>'width:64px','data-type'=>"number"));?>
      <?php  echo $this->html->formField('input','exp_to_month-required','',array('placeholder'=>'Max(Months)','class'=>'span1 pull-left','data-required'=>"true",'style'=>'width:64px','data-type'=>"number"));?>
    </div>
  </div>         
  <div class="control-group">
    <label class="control-label" for="inputName">Last date to apply*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','last_date-required','',array('placeholder'=>'','class'=>'span6 datepicker','data-required'=>"true","data-type"=>"dateIso"));?>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label" for="inputBio">Description*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description','',array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6"));?>
    </div>
  </div>  
 
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Submit Job</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>