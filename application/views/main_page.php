 <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
               <div class="clearfix"></div>
                    <h2 class="section-heading">Age RSS News Feeds</h2>
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
                <div class="col-lg-6 col-sm-6">
		    
                    <hr class="section-heading-spacer">
			
			 <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-star"></i>
                            Favourites Feeds
                            <div class="btn-group pull-right">
                                
                            </div>
                        </div>

                        <div class="panel-body">
                           
                                <div class="left clearfix">
            <div class="chat-body" style="height: 200px; overflow: scroll;">  
				    
                                                                      
                                       <?php
				foreach ($favourite as $value){ ?>
				<p> 
                                <img src="<?=base_url();?>img/rss.png" width="45" height="30" class="img-circle" />
                                   
				   <a href="<?=base_url();?>user/single_feed/<?=$value['id']?>"><?=$value['link']?></a> </p>
				<?php }
				?>
                                    </div>
                                </div>
				
				
                                
                           
                        </div>

                        <div class="panel-footer">                           
			  
			   <p><span class="glyphicon glyphicon-plus-sign"></span> <?php echo anchor('user/add_feed/',"Add Feed"); ?></p>
			   
			<p><span class="glyphicon glyphicon-cog"></span>    <?php
			   $atts = array(
              'width'      => '1200',
              'height'     => '800',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

echo anchor_popup('user/edit_feeds/', 'Manage feeds', $atts);
			   ?></p>
                        </div>

                    </div>
<!--/#title-->
                   
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="<?=base_url();?>img/rss-reader.png" alt="">
                </div>
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
	
	
	