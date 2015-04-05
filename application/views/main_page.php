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
            <div class="chat-body mCustomScrollbar" id="scrolling" data-mcs-theme="dark" style="height:200px;">  
				 
                                                                      
                                       <?php
				foreach ($favourite as $value){ ?>
				<p> 
                     
                                  <h4><?=$value['title']?></h4>        
                                   
				   <a href="<?=base_url();?>index.php/user/single_feed/<?=$value['id']?>"><?=$value['link']?></a> </p>
				<?php }
				?>
                                   
                                   
               
                                      </div>
                                </div>
				
				
                                
                           
                        </div>

                        <div class="panel-footer">                           
			  
			   
			   
			
                       <p><span class="glyphicon glyphicon-cog"></span>    <?php

echo anchor('user/manage_feeds/', 'Manage feeds');
			   ?></p>
                       
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
            <div class="chat-body mCustomScrollbar" id="scrolling" data-mcs-theme="dark" style="height:260px;">  
				 
                                                                      
                                       <?php
				foreach ($latest as $item){ ?>
				<p> 
                     <h4><a href='<?=$item['link'];?>' target='_blank'><?=$item['title'];?></a></h4>
            <p><?=$item['description'];?></p>
                                   
                               <? } ?>    
               
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
	
	
	