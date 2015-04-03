  
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
               <h1>All feeds</h1>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->
 
 <div class="container" style="padding-top: 100px;">
           
           
          <?php if(!isset($feeds) || empty($feeds)) { ?>
           <p> Here is not feeds !!! </p>
          <?php }
          
          ?>
          
         <div class="col-md-7">
              
         
                            
			                
             
       
          
         
                             <?php
				foreach ($feeds as $value){ ?>
                                  <div class="chat-panel panel panel-default chat-boder chat-panel-head">
                        <div class="panel-heading"> <i class="glyphicon glyphicon-flag"></i>
                           <? if(!empty($value['title'])){
                                    echo $value['title'];
                                }else{
                                    echo "No name";
                                }
                            ?>
                           </div>
                            <div class="panel-body">
                            <div class="left clearfix">
                            <div class="chat-body">  
                                   <span class="glyphicon glyphicon-link"></span>
				   <a href="<?=base_url();?>index.php/user/single_feed/<?=$value['id']?>"><?=$value['link']?></a> 
                                
                
                        </div>
                            </div>
				             </div>
                            </div>        
                                <?php }
				?> 
                      
                 </div> 
</div>
 
         