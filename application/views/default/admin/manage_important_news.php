<h1>Manage Important News</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>Title</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['news'] as $news){?>
    <tr>
      <td><?php echo $news['title'];?></td>
      <td><?php echo anchor('admin/importantnews/editnews/'.$news['id'],'Edit News').' | '.anchor('admin/importantnews/deletenews/'.$news['id'],'Delete News',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
