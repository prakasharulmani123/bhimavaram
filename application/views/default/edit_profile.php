<style>
.inner-left{
	width:1000px !important;
}
</style>

<?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : ''; ?>
<ul class="nav nav-tabs" id="profileTabs">
  <li class="active"><a href="#edit_profile">Edit Profile</a></li>
  <li><a href="#email_settings">Email Settings</a></li>
  <li><a href="#change_password">Change Password</a></li>
</ul>
 
<div class="tab-content">
	
  <div class="tab-pane active" id="edit_profile">
  <h2><span>Edit Profile</span></h2>
  <?php echo form_open_multipart('profile/index',array('class'=>'form-horizontal profile-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">Full Name</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','name-required',$content['user']['name'],array('placeholder'=>'Full Name','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputBio">Bio</label>
    <div class="controls">
      <?php  echo $this->html->formField('textarea','bio-required',$content['user']['bio'],array('placeholder'=>'Tell us about yourself','class'=>'span5','data-required'=>"true",'rows'=>"3"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Your City</label>
    <div class="controls">
    <?php //print_r(cityArray());?>
    <?php  echo $this->html->formField('input','cityname-required',$content['user']['cityname'],array('placeholder'=>'City Name','class'=>'span5','data-required'=>"true"));?>
      <?php //echo $this->html->formField('dropdown','cityid-required',cityArray(),array('class'=>'span5 offset1 city-select','data-required'=>"true"),$content['user']['cityid']);?>
    </div>
  </div>
  
    <div class="control-group">
    <label class="control-label" for="inputPicture">Change Picture</label>
    <div class="controls">    
    <?php echo showavatar($content['user']['picture'],$content['user']['name'],array('class'=>'avatar'));?>
      <?php  //echo $this->html->formField('upload','picture','',array('placeholder'=>'Change Picture','class'=>'span5'));?>
      <input id="fileupload" type="file" name="" data-url="<?php echo base_url();?>uploader/" multiple>
    </div>
         <div id="progress" class="progress progress-success progress-striped span4 offset4">
            <div class="bar"></div>
        </div>
	  </div>
<div class="span5 offset3" style="margin-left:180px;">
 <button type="submit" class="btn btn-danger  span5 abovePadding10">Update Profile</button>
</div>
  <input type="hidden" name="picture" value="" />
</form></div><!--Edit_Profile Ends-->
  <div class="tab-pane" id="email_settings">
   <h2><span>Email Notifications</span></h2>
    <?php echo form_open('profile/notifications',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  	<label class="checkbox">
  <?php echo $this->html->formField('checkbox','newsletter','1',false,true);?> I would like to receive newsletters
</label>
  	<label class="checkbox">
  <?php echo $this->html->formField('checkbox','messaging','1',false,true);?> Allow people to send messages regarding my posts
</label>
<div class="clear">&nbsp;</div>
<div class="span5 ">
 <button type="submit" class="btn btn-danger  span5 abovePadding10">Update Notification Settings</button>
</div>
</form>
  </div><!--Email_Settings Ends-->
  <div class="tab-pane" id="change_password">
     <h2><span>Change Password</span></h2>
       <?php echo form_open('profile/password',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
  <div class="control-group">
    <label class="control-label" for="inputName">New Password</label>
    <div class="controls">
      <?php  echo $this->html->formField('password','password-required','',array('placeholder'=>'New Password (8-30 Characters)','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Retype New Password</label>
    <div class="controls">
      <?php  echo $this->html->formField('password','confirmpassword-required','',array('placeholder'=>'Retype Password','class'=>'span5','data-required'=>"true"));?>
    </div>
  </div>  

<div class="span5 offset3" style="margin-left:180px;">
 <button type="submit" class="btn btn-danger  span5 abovePadding10">Change Password</button>
</div>
</form> 
  </div><!--Change_Password Ends-->
</div>
