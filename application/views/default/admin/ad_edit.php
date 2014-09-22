<h1>Update Advertisement!
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open_multipart('admin/ads/editad/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Title</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','title-required',$content['ad']['title'],array('placeholder'=>'','class'=>'span4','data-required'=>"true"));?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="inputName">Type*</label>
    <div class="controls">
    	<select name="adtype">
        	<option value="image" <?php if($content['ad']['adtype']=='image'){ echo ' selected="selected" ';} ?>>Image</option>
            <option value="text" <?php if($content['ad']['adtype']=='text'){ echo ' selected="selected" ';} ?>>Text</option>
        </select>
    </div>
  </div> 
       
   <div class="control-group">
    <label class="control-label" for="inputName">Sizes*</label>
    <div class="controls">
      <?php  //echo $this->html->formField('input','width-required','',array('placeholder'=>'Width','class'=>'span2','data-required'=>"true"));?>
      <?php // echo $this->html->formField('input','height-required','',array('placeholder'=>'Height','class'=>'span2','data-required'=>"true"));?>
		<?php
        $adsize=$content['ad']['width'].'_'.$content['ad']['height'];
		?>      
      <select name="sizes" data-required="true" class="span4">
      	<option value="">Choose</option>
        <option value="300_300" <?php if($adsize=='300_300'){ echo ' selected="selected" ';} ?>>300px * 300px</option>
        <option value="300_60"<?php if($adsize=='300_60'){ echo ' selected="selected" ';} ?>>300px * 60px</option>
        <option value="468_60"<?php if($adsize=='468_60'){ echo ' selected="selected" ';} ?>>468px * 60px</option>
        <option value="300_150" <?php if($adsize=='300_150'){ echo ' selected="selected" ';} ?>>300px * 150px</option>
        <option value="750_24" <?php if($adsize=='750_24'){ echo ' selected="selected" ';} ?>>750px * 24px</option>
        <option value="175_60"<?php if($adsize=='175_60'){ echo ' selected="selected" ';} ?>>175px * 60px</option>
         <option value="600_90"<?php if($adsize=='600_90'){ echo ' selected="selected" ';} ?>>600px * 90px (Category Special)</option>        
      </select>
    </div>
  </div>    
 
  <div class="control-group">
    <label class="control-label" for="inputName">Ad Link*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','adlink-required',$content['ad']['adlink'],array('placeholder'=>'','class'=>'span4','data-required'=>"true"));?>
    </div>
  </div>
   <div class="control-group">
   <label class="control-label" for="inputName">Link Type*</label>
   <div class="controls">        
        <label class="radio inline">
          <input type="radio" name="linktype" value="1"  <?php if($content['ad']['linktype']=='1'){ echo ' checked="checked" ';} ?>>
          External Link
        </label>
        <label class="radio inline">
          <input type="radio" name="linktype" value="0" <?php if($content['ad']['linktype']=='0'){ echo ' checked="checked" ';} ?>>
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
 <button type="submit" class="btn btn-danger  span4 abovePadding10">Update Ad</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>