  <h1>Manage Wishes</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>City</th>
      <th>Wish</th>
      <th>Approve Staus</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['listings'] as $wish){?>
    <tr>
      <td><?php echo $this->df->get_field_value('cities',array('id'=>$wish['cityid']),'city');?></td>
      <td><?php echo $wish['message'];?></td>
      
      <td>
	  	<?php 
			if($wish['approved']=='1')
			{
		?>
			<input type="radio" checked="checked" name="approve_wish_<?php echo $wish['id'];?>" class="approve-wish" value="<?php echo $wish['id'].':1';?>" /> Yes
			<input type="radio" name="approve_wish_<?php echo $wish['id'];?>" class="approve-wish" value="<?php echo $wish['id'].':0';?>" /> No            
		<?php
			}
			else
			{
		?>
			<input type="radio"  name="approve_wish_<?php echo $wish['id'];?>" class="approve-wish" value="<?php echo $wish['id'].':1';?>" /> Yes
			<input type="radio" checked="checked" name="approve_wish_<?php echo $wish['id'];?>" class="approve-wish" value="<?php echo $wish['id'].':0';?>" /> No            

        <?php 
			}
		?>
      </td>
      
      <td><?php echo anchor('admin/wishes/deletewish/'.$wish['id'],'Delete this',array('class'=>'delete-wish'));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
