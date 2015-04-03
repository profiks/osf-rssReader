  
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
               <h1>All my feeds</h1>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->
 
 <div class="container" style="padding-top: 100px;">
           
           
          <?php if(!isset($feeds) || empty($feeds)) { ?>
           <p> Here is not feeds !!! </p>
          <?php }
          
          ?>
          <ol>
                             <?php
				foreach ($feeds as $value){ ?>
                                   <li>  <p> 
                                <img src="<?=base_url();?>img/rss.png" width="45" height="30" class="img-circle" />
                                   
				   <a href="<?=base_url();?>user/single_feed/<?=$value['id']?>"><?=$value['link']?></a> </p>
				</p> <p><?=$value['description']?></p>
                                </li>
                                <?php }
				?> 
                      
          </ul>         
</div>
 
         