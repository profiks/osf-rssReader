 <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
               <div class="clearfix"></div>
                   <noscript>
<div id="indicator" style="display:block;text-align: center;" class="loading_img">
    <img src="<?=base_url(); ?>/assets/images/ajax-loader.gif"/>
    <h1>This application require javascripts enabled. Please turn on javascripts in your browser.</h1>
</div>				
<!-- end loader image-->
</noscript>
                   
                    <h2 class="section-heading">RSS News Feeds</h2>
                    <p class="lead">Really Simple Syndication (RSS) is an XML-based format for news
		    distribution that includes headlines, summaries and links back to a publisher website
		    for the full article. You load RSS news feeds into a reader or visit them on
		    a personalized web page. RSS keeps you up-to-the-moment on your favorite news sources,
		    providing an indicator when news breaks. You may use any of the popular RSS readers to
		    organize your own feeds.
		   
		    
		    </p>
                </div>
                
            </div>
        </div>
    </section> 
    <!-- /.intro-header -->

    <div class="content-section-a">

        <div class="container">
        
 <div class="modal fade" id="read_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close refreshScroll" data-dismiss="modal" aria-hidden="true">x</button>
          <h3 id="postName"></h3>
          </div>          
          <div class="modal-body Feedsposts"></div>
                
             
                
            </div>
           </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
           
           
    
	
            <div class="row">
               <hr class="section-heading-spacer">
                <div class="col-lg-6 col-sm-6">
		    
                    
			
			 <div class="chat-panel panel panel-default chat-boder chat-panel-head" id="customScrollbar">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-star"></i>
                            Favourites Feeds
                            <div class="btn-group pull-right">
                                
                            </div>
                        </div>

                        <div class="panel-body">
                           
                                <div class="left clearfix">
            <div class="chat-body mCustomScrollbar" id="scrolling" data-mcs-theme="dark" style="height:300px;">  
				 
                                                                      
                                       <?php
				foreach ($favourite as $value){ ?>
				<p> 
                     
                                  <h4><?=$value['title']?></h4>        
                                   
				   <a class="anchor" href="<?=$value['link']?>"><?=$value['link']?></a> </p>
				<?php }
				?>
                                   
                                   
               
                                      </div>
                                </div>
				
				
                                
                           
                        </div>

                        <div class="panel-footer">                           
			  
			   
			   
			
                      
                       
                        </div>

                    </div>
<!--/#title-->
                   
                </div>
                
                
                <!-- latest news-->
                
                <div class="col-lg-6 col-sm-6">
		    
                    
			
			 <div class="chat-panel panel panel-default chat-boder chat-panel-head" id="customScrollbar">
                        <div class="panel-heading">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        Latest news
                        </div>

                        <div class="panel-body">
                           
                                <div class="left clearfix">
            <div class="chat-body mCustomScrollbar" id="scrolling" data-mcs-theme="dark" style="height:300px;">  
				 
                                                                      
                                     <div  id="latest"></div>
                               
                              
               
                                      </div>
                                </div>
				
				
                                
                           
                        </div>

                        <div class="panel-footer">                           
			  
			   
                        </div>

                    </div>
<!--/#title-->
                   
                </div>
                <!-- end latest news-->
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->
  
<div class="content-section-b">

        <div class="container">	    
		    
		 <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                   
                   
                    
                </div>
		   
		 </div>
	</div>
	
	
	