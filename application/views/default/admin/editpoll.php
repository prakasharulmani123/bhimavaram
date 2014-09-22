<h1>Update Poll Info
</h1><div id="user-account" class="span18 center-align">
	<div class="span12 ">
    	 <?php echo form_open_multipart('admin/polls/editpoll/'.uridata(4),array('class'=>'form-horizontal center poll-edit-form','data-validate'=>'parsley'));?>
         <div class="fields">
			<input name="question" data-required="true" type="text" value="<?php echo $content['poll']['question'];?>" class="span7 pull-left" placeholder="Question" />            
            <div class="clear">&nbsp;</div>
            <?php
            	foreach($content['answers'] as $answer)
				{
			?>
            <input name="answer_<?php echo $answer['id'];?>" data-required="true" type="text" value="<?php echo $answer['answer'];?>"  class="span7 pull-left answer-box" placeholder="Answer Option" />
            <div class="clear">&nbsp;</div>
            <?php
				}
			?>
            </div>
             <button type="submit" class="btn btn-danger center-align span7 submit-btn">Update</button>  
         </form>
         
    </div>
</div>
   
<?php //echo anchor('admin/photos/addalbum/','Create new album',array('class'=>'align-center center span9 pull-right'));?>