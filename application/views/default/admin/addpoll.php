<h1>Create New Poll
</h1><div id="user-account" class="span18 center-align">
	<div class="span12 ">
    	 <?php echo form_open_multipart('admin/polls/addpoll',array('class'=>'form-horizontal center','data-validate'=>'parsley'));?>
         <div class="fields">
			<input name="question" data-required="true" type="text" class="span7 pull-left" placeholder="Question" />
            <div class="clear">&nbsp;</div>
            <input name="answer[]" data-required="true" type="text" class="span7 pull-left" placeholder="Answer Option" />
            <div class="clear">&nbsp;</div>
            <input name="answer[]" data-required="true" type="text" class="span7 pull-left" placeholder="Answer Option" />
            </div>
            <a href="javascript:void(0)" class="add-fields">Add Field</a>
            <div class="clear">&nbsp;</div>
             <button type="submit" class="btn btn-danger center-align span7 submit-btn">Submit</button>  
         </form>
         
    </div>
</div>
   
<?php //echo anchor('admin/photos/addalbum/','Create new album',array('class'=>'align-center center span9 pull-right'));?>