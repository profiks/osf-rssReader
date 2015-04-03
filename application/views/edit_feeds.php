<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Arkan Denys">

    <title>Edit rss</title>
    
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

</head>
<body>

<div class="container"  style="padding-top:50px;">
	<div class="row">
		<div class="col-lg-12">                
             
	      
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
             <h2>Edit rssfeed</h2>
<p>Edit your feed sources</p>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->   
    
		<?php echo $output; ?>

                
                </div>
	</div>
</div>