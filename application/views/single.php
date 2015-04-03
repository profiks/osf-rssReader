 
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
               <h1>Posts</h1>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->
    
 
 <div class="container" style="padding-top: 100px;">
           
           <?php if(!isset($rss) || empty($rss)) { ?>
           <p> Here is not feeds !!! </p>
          <?php }else {  ?>
          <p>To refresh posts, please click here   <a href="<?=base_url();?>user/refresh_posts/<?=$rss[0]['feeds_id']?>"><span class="glyphicon glyphicon-refresh"></span></a></p>
                      <?php } ?>
                      
                      
           <p><?php if (isset($message) && !empty($message))
{ echo "<div class='col-md-12 alert alert-warning' role='alert'>{$message}</div>";}?> </p>           
                      
                      
         
 <?php foreach ($rss as $item){ ?>
  
            <div class="thumbnail col-md-3 col-sm-4">
                
    <div class="caption">
            <h4><a href='<?=$item['link'];?>' target='_blank'><?=$item['title'];?></a></h4>
            <p><?=$item['description'];?></p>
    </div>  
            
            </div> <!-- thumbnail-->
   <?php } ?>
                      
                      
</div>
 
           <div class="container">
            <div class="row">
           <div><?php echo $links; ?></div>
                      </div></div>