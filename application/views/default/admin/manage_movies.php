<h1>Manage Movies</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>Title</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['movies'] as $movie){?>
    <tr>
      <td><?php echo $movie['name'];?></td>
      <td><?php echo anchor('admin/movies/editmovie/'.$movie['id'],'Edit Movie').' | '.anchor('admin/movies/deletemovies/'.$movie['id'],'Delete Movie',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>