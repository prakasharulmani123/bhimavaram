<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo $meta; ?>
<!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/css/ie8.css" />
<![endif]-->
</head>

<body>
<div class="bhinew-container">
  <div class="bhinew-inner-conatiner">
    <div class="bhinew-header">
      <div class="bhinew-inncontainer2"><?php echo $header; ?></div> 
    </div>
    <div class="bhinew-inncontainer2">
      <div class="bhi-bodycont">
        <div class="inner-left"> <?php echo $body; ?> </div>
        <div class="inner-right"> <?php echo $sidebar; ?> </div>
      </div>
    </div>
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