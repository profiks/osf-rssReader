<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Arkan Denys">

    <title>Edit Feeds</title>
    
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<link href="<?=base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/jquery.mCustomScrollbar.min.css" rel="stylesheet" >
    <link href="<?=base_url();?>assets/css/main.css" rel="stylesheet">
   
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-lg-12">                
             
	      <center><h4><a href="<?=base_url();?>">Click here to go to Home page</a></h4></center>

    
		<div class="container">
		    <?php echo $output; ?>
		    
		</div>

                
                </div>
	</div>
</div>