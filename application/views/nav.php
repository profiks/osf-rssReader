<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url();?>"><img src="<?=base_url()?>assets/images/logo.png" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse"  style="padding-bottom: 40px;">
               

               
                <ul class="nav navbar-nav navbar-right">
                    
                      
                        
           
                     
           <li <?php if ($this->uri->segment(2) == '') {echo"class='active'";}?>>
        <a href="<?=base_url();?>"> Home <span class="glyphicon glyphicon-home"></span></a>
             </li> 
           
            <li <?php if ($this->uri->segment(2) == 'all_feeds') {echo"class='active'";}?>>
       
        <a href="<?=base_url();?>index.php/user/all_feeds/">
        All feeds <span class="glyphicon glyphicon-bullhorn"></span></a>
        </li>
           
          <li <?php if ($this->uri->segment(2) == 'manage_feeds') {echo"class='active'";}?>>
       
        <a href="<?=base_url();?>index.php/user/manage_feeds/">
        Manage feeds <span class="glyphicon glyphicon-cog"></span></a>
        </li> 
           
       
             
             
            
            
        
            
           
        
                 
                            
                </ul>                     
                            
                            
                                         
               
            </div>
        </div>
        
       
    </header><!--/header-->
     <img src="<?=base_url()?>assets/images/up-arrow-icon.png" class="scrollToTop">  