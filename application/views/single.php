 
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
               <h1>News posts <a href="<?=$parent_link['link']?>" target="_blank"><?=$parent_link['link']?></a></h1>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->
    
 
 <div class="container" style="padding-top: 100px;">
           
           <p>To refresh posts, please click here   <a href="<?=base_url();?>index.php/user/refresh_posts/<?=$page?>"><span class="glyphicon glyphicon-refresh"></span></a></p>
           
           <?php if(!isset($rss) || empty($rss)) { ?>
           <center><h3> Here is no posts !!!</h3>
           </center>
          <?php } ?>
                      
                      
           <p><?php if (isset($message) && !empty($message))
{ echo "<div class='col-md-12 alert alert-warning' role='alert'>{$message}</div>";}?> </p>           
                      
                      
         
 <?php foreach ($rss as $item){ ?>
  
            <div class="thumbnail col-md-6 col-sm-6">
                
    <div class="caption">
            <h4><a href='<?=$item['link'];?>' target='_blank'><?=$item['title'];?></a></h4>
            <p><?=$item['description'];?></p>
    </div>  
            
            </div> <!-- thumbnail-->
   <?php } ?>
                      
                      
</div>
 
           <div class="container">
            <div class="row">
           <center><?php echo $links; ?></center>
                      </div></div>