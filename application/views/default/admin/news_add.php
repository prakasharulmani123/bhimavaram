<h1>Submit News</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open_multipart('admin/news/add',array('class'=>'form-horizontal password-form','data-validate'=>'parsley','style'=>'margin-left:-70px'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">News Category*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','category-required',News_Category(),array('class'=>'span6 offset1 city-select','data-required'=>"true",'id'=>'category'));
?>    
</div>
  </div> 
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
    <label class="control-label" for="inputName">News Title*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required','',array('placeholder'=>'','class'=>'span6','data-required'=>"true"));?>
   
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputBio">Content*</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','content','',array('placeholder'=>'','class'=>'span8 wysiwyg','rows'=>"9",'data-required'=>'true'));?>
    </div>
  </div>  
    <div class="control-group">
    <label class="control-label" for="inputPicture">Photo</label>
    <div class="controls">    
         <div class="fields">
            <input type="file" name="userfile[]" class="offset1" >
            </div>
            <a href="javascript:void(0)" class="add-fields">Add Field</a>
		<div class="clear">&nbsp;</div>
    </div>
         <div id="progress" class="progress progress-success progress-striped span4 offset4">
            <div class="bar"></div>
        </div>
	  </div>
 
<div class="span6" style="margin-left:250px;">
 <button type="submit" class="btn btn-danger  span6 abovePadding10">Submit News</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>
        <div class="span15 pull-left scrolller">
        <ul>
    	<li>&nbsp;</li>     
        </ul>
        </div>
