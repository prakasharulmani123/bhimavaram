<h1>Manage Photos</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>Photo Image</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['photos'] as $photo){?>
    <tr>
    <td><?php echo img($this->settings->baseUrl().'uploads/thumb/'.$photo['photo'],array('style'=>'width:60px;height:60px'));?></td>
      <td><?php echo anchor('admin/photos/deletephoto/'.$photo['id'].'/'.$photo['albumid'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
//echo $content['navigation'];
?>
