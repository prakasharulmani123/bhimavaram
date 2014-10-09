<h1>Manage Yellow Pages</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>Title</th>
      <th>City</th>
      <th>Picture</th>      
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['listings'] as $listing){?>
    <tr>
      <td><?php echo $listing['title'];?></td>
      <td><?php echo $this->df->get_field_value('cities',array('id'=>$listing['cityid']),'city');?></td>
      <td><?php echo showAvatar($listing['picture'],$listing['title'],array('style'=>'width:60px;height:60px'));?></td> 
      <td><?php echo anchor('admin/yellowpages/editlisting/'.$listing['id'],'Edit').' | '.anchor('admin/yellowpages/deletelisting/'.$listing['id'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>