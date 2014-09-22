<h1>Add a New Advertisement!
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open_multipart('admin/ads/createad',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Title</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required','',array('placeholder'=>'','class'=>'span4','data-required'=>"true"));?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="inputName">Type*</label>
    <div class="controls">
    	<select name="adtype">
        	<option value="image">Image</option>
            <option value="text">Text</option>
        </select>
    </div>
  </div> 
       
   <div class="control-group">
    <label class="control-label" for="inputName">Sizes*</label>
    <div class="controls">
      <?php  //echo $this->html->formField('input','width-required','',array('placeholder'=>'Width','class'=>'span2','data-required'=>"true"));?>
      <?php // echo $this->html->formField('input','height-required','',array('placeholder'=>'Height','class'=>'span2','data-required'=>"true"));?>
      <select name="sizes" data-required="true" class="span4">
      	<option value="">Choose</option>
        <option value="300_300">300px * 300px</option>
        <option value="300_60">300px * 60px</option>
        <option value="468_60">468px * 60px</option>
        <option value="300_150">300px * 150px</option>
        <option value="750_24">750px * 24px</option>
        <option value="175_60">175px * 60px</option>
         <option value="600_90">600px * 90px (Category Special)</option>        
      </select>
    </div>
  </div>    
 
  <div class="control-group">
    <label class="control-label" for="inputName">Ad Link*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','adlink-required','',array('placeholder'=>'','class'=>'span4','data-required'=>"true"));?>
    </div>
  </div>
   <div class="control-group">
   <label class="control-label" for="inputName">Link Type*</label>
   <div class="controls">        
        <label class="radio inline">
          <input type="radio" name="linktype" value="1" checked>
          External Link
        </label>
        <label class="radio inline">
          <input type="radio" name="linktype" value="0">
          Internal Link
        </label>
        </div>
  </div>    
     <div class="control-group">
    <label class="control-label" for="inputPicture">Ad Image</label>
    <div class="controls">    
    <?php //echo showavatar($content['user']['picture'],$content['user']['name'],array('class'=>'avatar'));?>
      <?php  //echo $this->html->formField('upload','picture','',array('placeholder'=>'Change Picture','class'=>'span5'));?>
		<input type="file" name="userfile" class="offset1" >
    </div>
	  </div>
 
<div class="span6" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span4 abovePadding10">Add Advertisement</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>