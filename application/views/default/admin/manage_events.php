<h1>Manage Events</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>Title</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['events'] as $movie){?>
    <tr>
      <td><?php echo $movie['name'];?></td>
      <td><?php echo anchor('admin/events/editevent/'.$movie['id'],'Edit Event').' | '.anchor('admin/events/deleteevents/'.$movie['id'],'Delete Event',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>