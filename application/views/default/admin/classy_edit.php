<h1>Edit Classified Ad</h1>

<div class="clearbig">&nbsp;</div>
       <?php echo form_open('admin/classifieds/editit/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Category*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','parentcategory-required',Classy_Category(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'),$this->df->get_field_value('classy_categories',array('id'=>$content['ad']['category']),'parentid'));
?>    
</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Sub Category*</label>
    <div class="controls">
    	<select name="category" id="subcategory" class="span6 offset1 city-select" data-required="true">
        <?php 
			foreach($content['subcategories'] as $sub)
			{
				if($sub['id']==$content['ad']['category'])
				{
				echo '<option value="'.$sub['id'].'" class="'.$sub['parentid'].'" selected="selected">'.$sub['name'].'</option>';
				}
				else
				{
					echo '<option value="'.$sub['id'].'" class="'.$sub['parentid'].'">'.$sub['name'].'</option>';
					
				}
			}
			?>
        </select>
<?php 
//echo $this->html->formField('dropdown','category-required',array(''=>'Select Sub Category'),array('class'=>'span6 offset1 city-select','data-required'=>"true",'disabled'=>'disabled'));
?>    </div>
  </div>  
    <div class="control-group">
    <label class="control-label" for="inputName">Ad Type*</label>
    <div class="controls">
  <label class="radio inline">
  <input type="radio" name="adtype"   value="Offered" <?php if($content['ad']['adtype']=='Offered'){ echo ' checked="checked" ';} ?>>
  Offered
</label>
<label class="radio inline">
  <input type="radio" name="adtype"  value="Wanted"<?php if($content['ad']['adtype']=='Wanted'){ echo ' checked="checked" ';} ?>>
  Wanted
</label>
</div>
</div>
  <div class="control-group">
    <label class="control-label" for="inputName">Ad Title*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required',$content['ad']['title'],array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
      <div class="field-hint">A good title needs at least 60 characters.</div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputBio">Description*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','description',$content['ad']['description'],array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"6",'data-required'=>'true'));?>
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
    <label class="control-label" for="inputName">Price* (Rupees)</label>
      <div class="controls">
      <?php  echo $this->html->formField('input','price',$content['ad']['price'],array('placeholder'=>'','class'=>'span2 from','data-required'=>"true",'data-type'=>'number'));?>
      <label class="checkbox inline">
 		 <input type="checkbox"  value="1" name="free" class="free-box"> Free
		</label>
    </div>
  </div>
<h3 class="form-header">Seller Information</h3>  
  <div class="control-group">
    <label class="control-label" for="inputName">Contact Person*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','contact_person-required',$content['ad']['contact_person'],array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
      
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Email Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','email-valid_email',$content['ad']['email'],array('placeholder'=>'','class'=>'span6','data-type'=>"email"));?>
      <div class="field-hint">Your email address won't be shared</div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Phone</label>
    
    <div class="controls">
      <?php  echo $this->html->formField('input','phone-numeric',$content['ad']['phone'],array('placeholder'=>'','class'=>'span6','data-type'=>"digits"));?>
      <div class="field-hint">Only digits allowed</div>
    </div>
  </div>  
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Update</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>