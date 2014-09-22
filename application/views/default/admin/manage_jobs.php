  <h1>Manage Jobs</h1>

<table class="table table-striped">
  <thead>
    <tr>
     <th>City</th>
      <th>Title</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['ads'] as $ad){?>
    <tr>
      <td><?php echo $this->df->get_field_value('cities',array('id'=>$ad['cityid']),'city');?></td>
      <td><?php echo $ad['title'];?></td>      
      <td><?php echo anchor('admin/jobs/delete/'.$ad['id'],'Delete this',array('class'=>'delete-wish'));?></td>
      </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
