<h1>Manage Cities</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>City</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['cities'] as $city){?>
    <tr>
      <td><?php echo $city['city'];?></td>
      <td><?php echo anchor('admin/cities/editcity/'.$city['id'],'Edit').' | '.anchor('admin/cities/delete/'.$city['id'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
