<div class="clearbig">&nbsp;</div>
<div class="span20" id="footer-ads">
     <?php 
/*	 	echo showAd('image','175','60');
		echo showAd('image','175','60');
		echo showAd('image','175','60');
		echo showAd('image','175','60');
		echo showAd('image','175','60');*/
	 ?>
     <?php echo showAds('image','175','60',5);?>
    </div>
</div><!--Main-content Ends-->
<div id="footer-container">
	<div class="container">
    <ul id="footer-site-links" class="span4 pull-left">
    	<li><?php //echo $this->html->themeImg('footer-logo.png');?>
        <?php echo getLogo();?></li>
        <div class="clearbig">&nbsp;</div>
		<li><?php echo anchor(base_url(),'Home');?></li>        
    	<li><a href="#about-us" role="button" data-toggle="modal">About us </a></li>
<!--        <li><a href="#privacy-policy" role="button" data-toggle="modal">Privacy Policy</a></li>
        <li><a href="#terms-use" role="button" data-toggle="modal">Terms of use</a></li>
-->    </ul>
    <ul class="footer-cities pull-left span13">
    	<h2 class="choose-city">Browse Cities</h2>
    	<?php
        $citieslist=$this->df->get_multi_row('cities');?>
		<?php
		foreach($citieslist as $cl)
		{
			//echo uri_string();
		?>
        <li><?php echo anchor('start/setcity/'.$cl['id'].'/'.str_replace('/','--',uri_string()),$cl['city']);?></li>
        
        <?php
		}
		?>                               
    </ul>
    <div class="copyright-container">
    <div class="span6 pull-left">&copy; 2014 All rights reserved. Jaithra Business Solutions.</div>
    <div class="span5 pull-right right">Designed &amp; Developed by <?php echo anchor('http://wowji.com','Wowji',array('rel'=>'dofollow','style'=>'color:#FFF;font-size:13px;margin-right:10px;','target'=>'_blank'));?></div>
    </div>
    </div>
    
</div><!--footer-container Ends-->
<input type="hidden" name="cityid" value="<?php echo userdata('cityid');?>" />
<!-- Modal -->
<div id="change-city" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Change City" aria-hidden="true">
  <div class="modal-header"> 
    <h3 id="twitterModal">Change City</h3>
  </div>
  <div class="modal-body">
   <?php
   		echo form_open('start/changecity',array('class'=>'bigform','data-validate'=>'parsley'));
		echo $this->html->formField('label','city','Please choose your city to continue',array('class'=>'email'));
		echo $this->html->formField('dropdown','city-required',cityArray(),array('class'=>'span10','data-required'=>"true"),userdata('cityid'));
   ?>
   	<input type="hidden" name="currenturl" value="<?php echo uri_string();?>" />
   		<button class="btn btn-primary submit-btn span10" style="padding:7px">Change City</button>
        </form>
   
  </div>
  <div class="modal-footer">
    
  </div>
</div>
<div id="post-wish" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Post Wishes" aria-hidden="true">
  <div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="twitterModal">Post Wishes</h3>
  </div>
  <div class="modal-body">
   <?php
   		echo form_open('start/postwish',array('class'=>'bigform','data-validate'=>'parsley'));
		echo $this->html->formField('label','wish','Posting as '.userdata('name'),array('class'=>'email'));
		//echo $this->html->formField('dropdown','city-required',cityArray(),array('class'=>'span10','data-required'=>"true"),userdata('cityid'));
   ?>
    <?php  echo $this->html->formField('textarea','message-required--max_length:150','',array('placeholder'=>'Write your wish message (Maximum 150 Charaters)','class'=>'span10','rows'=>"4",'data-required'=>'true','data-maxlength'=>"150"));?>
   	<input type="hidden" name="currenturl" value="<?php echo uri_string();?>" />
   		<button class="btn btn-primary submit-btn span10" style="padding:7px">Submit Message</button>
        </form>
   
  </div>
  <div class="modal-footer">
    
  </div>
</div>


<!--about model-->
<div id="about-us" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="About us" aria-hidden="true">
  <div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="twitterModal">About us</h3>
  </div>
  <div class="modal-body">
<p>
Serving the Bhimavaram areas. Bhimavaram.com is theBhimavaram information portal maintained by Jaithra Business Solutions. It provides Local news, links to various services in Bhimavaram as well as information on the business, Deals, Discounts, education, culture, etc. One of the key aims of the portal is to enable communications to get online and the web site provides free services including, Yellow pages, Classifieds, events, calendar, Education Bulletin boards, online sales wishes & image gallery, etc.
</p>
<p>If you have any questions or concerns. please contact  us at: contact@bhimavaram.com </p>
</div>
  <div class="modal-footer">
    
  </div>
</div>


<!--privacy model-->
<div id="privacy-policy" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="About us" aria-hidden="true">
  <div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="twitterModal">Privacy Policy</h3>
  </div>
  <div class="modal-body">
<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
  
  </div>
  <div class="modal-footer">
    
  </div>
</div>
<!--terms model-->
<div id="terms-use" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="About us" aria-hidden="true">
  <div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="twitterModal">Terms of use</h3>
  </div>
  <div class="modal-body">
<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>

  </div>
  <div class="modal-footer">
    
  </div>
</div>