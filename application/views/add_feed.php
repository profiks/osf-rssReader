   
<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
              <h1>Insert RSS url</h1>
                </div>
                
            </div>
        </div>
    </section><!--/#title-->
 
 
 <div class="modal-dialog" style="padding-top:50px;">
   
  <div class="modal-content">
      
      <div class="modal-body">



<p><?php if (isset($message) && !empty($message))
{  echo "<div class='col-md-12 alert alert-warning' role='alert'>{$message}</div>";}?> </p>


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
   <p><a href="<?=base_url();?>" class='btn btn-primary btn-md btn-block'> <span class=' glyphicon glyphicon-remove'></span> Cancel</a> </p> 
<?php echo form_close();?>


  
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          
		  </div>	
      </div>
  </div>
  </div>