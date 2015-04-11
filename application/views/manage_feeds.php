  
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
               <h1>Manage feeds</h1>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->
 
 <div class="container" style="padding-top: 100px;">
 
          <!-- loader image-->
<noscript>
<div id="indicator" style="display:block;text-align: center;" class="loading_img">
    <img src="<?=base_url(); ?>/assets/images/ajax-loader.gif"/>
    <h1>This application require javascripts enabled. Please turn on javascripts in your browser.</h1>
</div>				
<!-- end loader image-->
</noscript>
        
         <div class="col-md-7">
              
         
                         <div id="modal"></div>
<div class="addLink pull-left"></div>

<div class="exportLink pull-right"></div>

<div id="response"></div>	
    
    		
    						
		<div class="clearfix"></div>	
                      
                    <?php echo form_open_multipart('user/do_upload', 'calss="form_import"');?>

                    
                    <input id="input-42" type="file" name="userfile" multiple=false>
                    
                    
                    

                    </form>  

                      
                      
                 </div> 
</div>
 
  
        