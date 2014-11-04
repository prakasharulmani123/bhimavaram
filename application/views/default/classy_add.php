<h1>Post a New Ad Free!
<div class="current-city">
	City : <?php echo userdata('city');?><a href="#change-city" role="button" data-toggle="modal"> (Change)</a>
</div>
</h1>
<div class="">&nbsp;</div>
       <?php echo form_open('classifieds/add',array('class'=>'form-horizontal password-form','data-parsley-validate'=>'true'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Category*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','parentcategory-required',Classy_Category(),array('class'=>'span6 offset1 city-select','data-parsley-required'=>"true",'id'=>'category'));
?>    
</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Sub Category*</label>
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
    <label class="control-label" for="inputName">Ad Type*</label>
    <div class="controls">
  <label class="radio inline">
  <input type="radio" name="adtype"  value="Offered" checked="checked">
  Offered
</label>
<label class="radio inline">
  <input type="radio" name="adtype"  value="Wanted">
  Wanted
</label>
</div>
</div>
  <div class="control-group">
    <label class="control-label" for="inputName">Ad Title*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required','',array('placeholder'=>'','class'=>'span6','data-parsley-required'=>"true"));?>
      <div class="field-hint">A good title needs at least 60 characters.</div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputBio">Description*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description','',array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6",'data-parsley-required'=>'true'));?>
    </div>
  </div>  
    <div class="control-group">
    <label class="control-label" for="inputPicture">Photo</label>
    <div class="controls">    
    <?php //echo showavatar($content['user']['picture'],$content['user']['name'],array('class'=>'avatar'));?>
    <img src="<?php echo $this->settings->imgPath().'business.png';?>" class="avatar" />
      <?php  //echo $this->html->formField('upload','picture','',array('placeholder'=>'Change Picture','class'=>'span5'));?>
      <input id="fileupload" type="file" name="" data-url="<?php echo base_url();?>uploader/" multiple>
      <input type="hidden" name="picture" value="" />
    </div>
         <div id="progress" class="progress progress-success progress-striped span4 offset4">
            <div class="bar"></div>
        </div>
	  </div>
 <div class="control-group">
    <label class="control-label" for="inputName">Price* (Rupees)</label>
      <div class="controls">
      <?php  echo $this->html->formField('input','price','',array('placeholder'=>'','class'=>'span2 from','data-parsley-required'=>"true",'data-type'=>'number'));?>
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="free" class="free-box"> Free
		</label>
    </div>
  </div>
<h3 class="form-header">Seller Information</h3>  
  <div class="control-group">
    <label class="control-label" for="inputName">Contact Person*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','contact_person-required','',array('placeholder'=>'','class'=>'span6','data-parsley-required'=>"true"));?>
      
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Email Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','email-valid_email','',array('placeholder'=>'','class'=>'span6','data-parsley-required'=>"true",'data-parsley-type'=>"email"));?>
      <div class="field-hint">Your email address won't be shared</div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Phone</label>
    
    <div class="controls">
      <?php  echo $this->html->formField('input','phone-numeric','',array('placeholder'=>'','class'=>'span6','data-type'=>"digits"));?>
      <div class="field-hint">Only digits allowed</div>
    </div>
  </div>  
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Post Ad</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>