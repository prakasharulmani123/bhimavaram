  <h1>Manage Ads</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Ad Image</th>
      <th>Title</th>
      <th>Impressions/Clicks</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['ads'] as $ad){?>
    <tr>
      <td><?php echo showAvatar($ad['picture'],'',array('style'=>'width:90px;height:90px'));?></td>
      <td><?php echo $ad['title'];?></td>
      <td><?php echo $ad['impressions'].'/'.$ad['clicks'];?></td>
      <td><?php echo anchor('admin/ads/editad/'.$ad['id'],'Edit').' | '.anchor('admin/ads/ad_add_info/'.$ad['id'],'Ad Page').' | '.anchor('admin/ads/deletead/'.$ad['id'],'Delete');?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
