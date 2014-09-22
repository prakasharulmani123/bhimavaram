<h1>Edit Movie
</h1>
<div class="clearbig">&nbsp;</div>
       <?php echo form_open('admin/movies/editmovie/'.uridata(4),array('class'=>'form-horizontal password-form','data-validate'=>'parsley','style'=>'margin-left:-60px;'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','name-required',$content['movie']['name'],array('placeholder'=>'','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>     
  <div class="control-group">
    <label class="control-label" for="inputName">Category*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','category-required',movies_categories(),array('class'=>'span5 offset1','data-required'=>"true"),$content['movie']['category']);
?>    
</div>

  </div>  <div class="control-group">
    <label class="control-label" for="inputName">Language*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','language-required',Movie_Languages(),array('class'=>'span5 offset1','data-required'=>"true"),$content['movie']['language']);
?>    
</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Movie Certificate*</label>
    <div class="controls">
<?php 
echo $this->html->formField('dropdown','certificate-required',movie_certificate(),array('class'=>'span5 offset1','data-required'=>"true"),$content['movie']['certificate']);
?>    
</div> 
</div>  
  <div class="control-group">
    <label class="control-label" for="inputName">Cast*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','cast-required',$content['movie']['cast'],array('placeholder'=>'','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="inputName">Director*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','director-required',$content['movie']['director'],array('placeholder'=>'','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Producer*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','camera-required',$content['movie']['camera'],array('placeholder'=>'','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Music Director*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','music-required',$content['movie']['music'],array('placeholder'=>'','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="inputName">Release Date*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','release_date-required',$content['movie']['release_date'],array('placeholder'=>'','class'=>'span5 datepicker','data-required'=>"true","data-type"=>"dateIso"));?>
    </div>
  </div>
     <div class="control-group">
    <label class="control-label" for="inputPicture">Picture*</label>
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
      <?php  echo $this->html->formField('textarea','description',$content['movie']['description'],array('placeholder'=>'','class'=>'span7 wysiwyg','rows'=>"6"));?>
    </div>
  </div> 
<div class="span5" style="margin-left:230px;">
 <button type="submit" class="btn btn-danger  span5 abovePadding10">Update Movie</button>
</div>
</form> 
<div class="clearbig">&nbsp;</div>