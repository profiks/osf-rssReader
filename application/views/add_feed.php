   
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
              <h1>Insert RSS url</h1>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->
 
 <div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        
         <div class="chat-panel panel panel-default chat-boder chat-panel-head" style="margin-top:50px;">
                        <div class="panel-heading">
                        <span class="glyphicon glyphicon-globe"></span>
                        Add new RSS source
                        </div>

                        <div class="panel-body">
                           
                                <div class="left clearfix">
            <div class="chat-body">  
				                            <? $flash_message = $this->session->flashdata('message');?>                 
                                  <p><?php if (isset($message) && !empty($message) || isset($flash_message) && !empty($flash_message)) 
    
{  echo "<div class='col-md-12 alert alert-warning' role='alert'>{$message}{$flash_message}</div>";}?> </p>

<?php echo form_open("user/add_feed/","class='form col-md-12 center-block'");?>
	 
       
	 <div class="form-group">   
      <p>
      	
        <?php
        $data_format = array(
            'name'          =>  'url',
            'placeholder'   =>  'valid rss url',
            'class'         =>  'form-control input-lg',
            'value'         =>  set_value('url')
            );
        echo form_input($data_format);
        ?>
        
      </p>
	 </div>
    <p><?php echo form_submit('submit', 'Insert',"class='btn btn-primary btn-md btn-block'");?></p>
   <p><a href="<?=base_url();?>" class='btn btn-danger btn-md btn-block'> <span class=' glyphicon glyphicon-remove'></span> Cancel</a> </p> 
<?php echo form_close();?>    
               
                                      </div>
                                </div>
				
				
                                
                           
                        </div>

                        <div class="panel-footer">                           
			  
			   
                        </div>

                    </div>
        
    </div>
    
</div>  <!-- end row-->
</div>




  