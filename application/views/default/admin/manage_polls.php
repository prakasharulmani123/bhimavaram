<h1>Manage Polls</h1><table class="table table-striped">
  <thead>
    <tr>   
      <th>Question</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['polls'] as $poll){?>
    <tr>
      <td><?php echo $poll['question'];?></td>
      <td><?php echo anchor('admin/polls/editpoll/'.$poll['id'],'Edit').' | '.anchor('admin/polls/delete/'.$poll['id'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
