  
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
               <h1>All feeds </h1>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->
 
 <div class="container" style="padding-top: 100px;">
           
          <div class="modal fade" id="read_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close refreshScroll" data-dismiss="modal" aria-hidden="true">x</button>
          <h3 id="postName"></h3>
          </div>         
          <!-- Feedsposts-->
           
          <div  class="modal-body mCustomScrollbar" data-mcs-theme="dark" style="height:600px;">
              
              <div id="resul"></div>
          </div>
                
             
                
            </div>
           </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
           
          <?php if(!isset($categories) || empty($categories)) { ?>
           <p> Here is not feeds !!! </p>
          <?php }
          
          ?>
          
         <div class="col-md-12">
          <div class="col-md-4">       
         <div class="nav-side-menu">  
            <div class="menu-list">  
                    <ul id="menu-content" class="menu-content collapse out">
                       
                         <?php                  
                $count = explode(";", $count);
                array_unshift($count, ""); ?> 
                        
                        <?php
				foreach ($categories as $cat){ ?>
                   
                  
                    
                        <a href="<?=$cat['id']?>"><li <?php if ($this->uri->segment(3) == $cat['id']) {echo"class='active'";}?>>
                          
                          <i></i> <?=$cat['name']?> <span class="badge"><?=$count[$cat['id']]?></span>
                          
                    </li></a>
                         
                                <?php } ?> 
                         
                    </ul>
             </div>
        </div>
         </div>                    
			                
             <div class="col-md-8">
                 <?php
				foreach ($feeds as $value){ ?>
                                 <div class="col-md-10">
                                 
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
				    <a class="anchor" href="<?=$value['link']?>"><?=$value['link']?></a>
                                
                
                        </div>
                            </div>
				             </div>
                            </div> 
                               
                                      </div>       
                                <?php } ?> 
             </div>
       
          
         
                             
                      
                 </div> 
</div>
 
         