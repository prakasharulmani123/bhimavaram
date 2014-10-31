<div class="bhi-footer">
    <div class="bhi-footerrow1"> <?php echo getLogo(true);?>
      <div class="bhi-footerlinks"> <strong>Browse Cities </strong>
        <ul>
          <?php $citieslist=$this->df->get_multi_row('cities'); ?>
      	  <?php	foreach($citieslist as $cl)	{ ?>
      		<li><?php echo anchor('start/setcity/'.$cl['id'].'/'.str_replace('/','--',uri_string()),$cl['city']);?></li>
      	  <?php	} ?>
        </ul>
      </div>
      <div class="bhi-footerlinks"> <strong>Main Links </strong>
        <ul>
          <li><?php echo anchor(base_url(),'Home');?></li>
      	  <li><a href="#about-us" role="button" data-toggle="modal"> About us </a></li>
          <li><?php echo anchor('news/index', 'News'); ?></li>
          <li><?php echo anchor('yellowpages/index', 'Yellow Pages'); ?></li>
          <li><?php echo anchor('movies/index', 'Movies'); ?></li>
          <li><?php echo anchor('deals/index', 'Deals'); ?></li>
          <!--<li><?php echo anchor('classifieds/index', 'Classifieds'); ?></li>-->
          <li><?php echo anchor('events/index', 'Events'); ?></li>
          <li><?php echo anchor('jobs/index', 'Jobs'); ?></li>
        </ul>
      </div>
    </div>
    <div class="copyright">&copy; 2014 All rights reserved. Jaithra Business Solutions.</div>
  </div>
<div class="shadow"> 
  <img src="<?php echo $this->settings->baseUrl(); ?>themes/default/images/shadow.png" width="979" height="38" alt="">
</div>

<script type="text/javascript">
function citychange(){
	var name = $('#cityid').find("option:selected").text();
	$('#cityname').val(name);
}
</script>

<input type="hidden" name="cityid" value="<?php echo userdata('cityid');?>" />
<!-- Modal -->
<div id="change-city" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Change City" aria-hidden="true">
  <div class="modal-header">
    <h3 id="twitterModal">Change City</h3>
  </div>
  <div class="modal-body">
    <?php
		$hidden = array('changecity' => '1');
   		echo form_open('',array('class'=>'bigform','data-validate'=>'parsley'), $hidden);
//   		echo form_open('start/changecity',array('class'=>'bigform','data-validate'=>'parsley'));
		echo $this->html->formField('label','city','Please choose your city to continue',array('class'=>'email'));
		echo $this->html->formField('dropdown','city-required',cityArray(),array('class'=>'span10','data-required'=>"true", 'onchange'=>"citychange()", 'id' => 'cityid'),userdata('cityid'));
		echo $this->html->formField('input','cityname', '', array('style'=>'display:none', 'id' => 'cityname'));
   ?>
    <input type="hidden" name="currenturl" value="<?php echo uri_string();?>" />
    <button class="btn btn-primary submit-btn span10" style="padding:7px">Change City</button>
    </form>
  </div>
  <div class="modal-footer"> </div>
</div>
<div id="post-wish" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Post Wishes" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h3 id="twitterModal">Post Wishes</h3>
  </div>
  <div class="modal-body">
    <?php
   		echo form_open('start/postwish',array('class'=>'bigform','data-validate'=>'parsley'));
		
		echo $this->html->formField('label','wish','Posting as '.userdata('name'),array('class'=>'email'));
		
		echo $this->html->formField('input', 'name', '', array('placeholder'=>'Name', 'class'=>'span10', 'data-required'=>"true", 'data-error-container'=>"#name_error", 'data-error-message' => 'error'));
		echo '<span id="name_error"></span>';
		
		echo $this->html->formField('input', 'email', '', array('placeholder'=>'Email', 'class'=>'span10', 'data-required'=>"true", 'data-type'=>"email"));
		
		echo $this->html->formField('input', 'phone', '', array('placeholder'=>'Phone', 'class'=>'span10','data-type'=>"number"));
		
		echo $this->html->formField('textarea','message-required--max_length:150','',array('placeholder'=>'Write your wish message (Maximum 150 Charaters)','class'=>'span10','rows'=>"4",'data-required'=>'true','data-maxlength'=>"150"));
   		?>
    <input type="hidden" name="currenturl" value="<?php echo uri_string();?>" />
    <button class="btn btn-primary submit-btn span10" style="padding:7px">Submit Message</button>
    </form>
  </div>
  <div class="modal-footer"> </div>
</div>

<!--about model-->
<div id="about-us" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="About us" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—</button>
    <h3 id="twitterModal">About us</h3>
  </div>
  <div class="modal-body">
    <p> Serving the Bhimavaram areas. Bhimavaram.com is theBhimavaram information portal maintained by Jaithra Business Solutions. It provides Local news, links to various services in Bhimavaram as well as information on the business, Deals, Discounts, education, culture, etc. One of the key aims of the portal is to enable communications to get online and the web site provides free services including, Yellow pages, Classifieds, events, calendar, Education Bulletin boards, online sales wishes & image gallery, etc. </p>
    <p>If you have any questions or concerns. please contact  us at: contact@bhimavaram.com </p>
  </div>
  <div class="modal-footer"> </div>
</div>

<!--privacy model-->
<div id="privacy-policy" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="About us" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—</button>
    <h3 id="twitterModal">Privacy Policy</h3>
  </div>
  <div class="modal-body">
    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
  </div>
  <div class="modal-footer"> </div>
</div>
<!--terms model-->
<div id="terms-use" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="About us" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—</button>
    <h3 id="twitterModal">Terms of use</h3>
  </div>
  <div class="modal-body">
    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
  </div>
  <div class="modal-footer"> </div>
</div>