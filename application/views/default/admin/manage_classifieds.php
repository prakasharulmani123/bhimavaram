  <h1>Manage Classifieds</h1>

<table class="table table-striped">
  <thead>
    <tr>
     <th>Listing Image</th>
      <th>Title</th>
      <th>Approved</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['ads'] as $ad){?>
    <tr>
      <td><?php echo showAvatar($ad['picture'],'',array('style'=>'width:90px;height:90px'));?></td>
      <td><?php echo $ad['title'];?></td>
      
      <td>
	  	<?php 
			if($ad['approved']=='1')
			{
		?>
			<input type="radio" checked="checked" name="approve_wish_<?php echo $ad['id'];?>" class="approve-wish" value="<?php echo $ad['id'].':1';?>" /> Yes
			<input type="radio" name="approve_wish_<?php echo $ad['id'];?>" class="approve-wish" value="<?php echo $ad['id'].':0';?>" /> No            
		<?php
			}
			else
			{
		?>
			<input type="radio"  name="approve_wish_<?php echo $ad['id'];?>" class="approve-wish" value="<?php echo $ad['id'].':1';?>" /> Yes
			<input type="radio" checked="checked" name="approve_wish_<?php echo $ad['id'];?>" class="approve-wish" value="<?php echo $ad['id'].':0';?>" /> No            

        <?php 
			}
		?>
      </td>
      
      <td><?php echo anchor('admin/classifieds/editit/'.$ad['id'],'Edit').' | '.anchor('admin/classifieds/delete/'.$ad['id'],'Delete this',array('class'=>'delete-wish'));?></td>
      </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
