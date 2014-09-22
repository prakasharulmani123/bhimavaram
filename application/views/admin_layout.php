<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
.header{
margin-bottom: 10px;
border-bottom: #EEE 1px solid;
padding: 10px 0;
}
#admin-body h1{ margin-bottom:30px;}
#sidebar .nav-list .nav-header{font-size: 14px;
font-weight: normal;
border-bottom: #DDD 1px dashed;
line-height: 30px;}
#sidebar .nav-list .nav-header a{ color:#C00;}
#sidebar .nav-list li a{ font-size:15px; font-weight:normal; color:#555;}
#admin-body #sidebar{ border-right:#DDD 1px dashed;}
#sidebar .nav-list ul{ padding:0; margin:0;}
#sidebar .nav-list ul li{ line-height:200%;border-bottom: #DDD 1px dashed;}
</style>

<?php 
	echo $meta;
	echo $header;
	echo $body;
?>
</div><!--#content-box Ends-->
<?php
	echo $sidebar;
	echo $footer;
	echo $footerData;
?>
<script type="application/javascript">
	jQuery(function(){
		jQuery('#sidebar .nav-list ul').slideUp();
		jQuery('#sidebar .nav-list .nav-header a').click(function(){
			var ele=jQuery(this);
			jQuery('#sidebar .nav-list ul').slideUp();
			ele.parent().next('ul').slideDown();
		});//click Ends
	});//jQuery ends
</script>
</body>
</html>