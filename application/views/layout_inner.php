<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo $meta; ?>
</head>

<body>
<div class="bhinew-container">
  <div class="bhinew-inner-conatiner">
  	<div class="bhinew-header">
    <?php echo $header; ?>
    </div>
    </div>
    <div class="content-inner">
    <?php echo $body; ?>
    </div>
    <div class="content-sidebar">
    <?php echo $sidebar; ?>
    </div>
  </div>
<?php
	echo $footer;
	echo $footerData;
?>
<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
</div>

</body>
</html>