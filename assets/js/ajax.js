$(document).ready(function(){
  
  
    
    
    
    
    
    addLink();       
    getFeedsList();
    latestFeeds();
    
    
    // when click Add Feed apear modal window to create new Rss source
    $(document).on("click", "a#addFeed", function(){ getCreateForm(this);});
    
    
    $(document).on("click", "a.anchor", function(){readFeeds(this);});
    
    
    $(document).on("submit", "#infoFeed", function(event){ 
        event.preventDefault();
        addFeed(this);
    });
    
    $(document).on("click", "a.delete_confirm", function(){ deleteConfirmation(this); });
    $(document).on("click", "button.delete", function(){ delFeed(this); });
    
    $(document).on("click", "a.edit_confirm", function(){ editForm(this); });
    $(document).on("submit", "#editableInfo", function(event){ 
        event.preventDefault();
        editFeed(this);
    });
    
    
    
 }); //end DOM  
   
        
        

        function readFeeds(el){
             event.preventDefault();
             var href = $(el).attr('href');
            renderFeedsModal(href);
            
            
            
        }
        
            function renderFeedsModal(href){
                    $("#read_modal").modal("show");
                    $("#postName").html(href);
                    $("#postName").html(href);
                
                 $('.Feedsposts').rssfeed(''+href+'', {
                                            limit: 100,
                                            linktarget: '_blank',
                                            header : false

                                        },function(){
                 
                  $(window).load(function(){
                    $(".Feedsposts").mCustomScrollbar();
                });
            });

            }


             



    
            function delFeed(){
                $.post( "/index.php/user/del_feed",
                      { id: $('#delete_confirm_modal input#feed_id').val() },
                      function (){
                getFeedsList();
                $("#delete_confirm_modal").modal("hide");
                      });
                
            }
        
        function latestFeeds(){
        $.post('/index.php/user/latest_aded_feeds',{},
                function(data) {
                     renderLatestNews(data)
                        
                    }
                
                );
        }

        function renderLatestNews(jsonData){
            
                     var feed = jQuery.parseJSON(jsonData);
                        
                        
                          $('#latest').rssfeed(''+feed.first.link+'', {
                                limit: 100,
                                linktarget: '_blank',
                                header : false

                            }, function(e) {
                                $(e).find('div.rssBody').vTicker('init',{
                                showItems: 10,
                                padding:1
                                });
                            });

        }


        function editForm(el){
            
            var id = $(el).attr('feed_id');             
             $.post('/index.php/user/get_one_feed/',{
                id : id
                },
                function(data) {
                renderEditForm(data);
                }
            );
            
        }    
        
        function renderEditForm(jsonData){
            
          
            var feeds = jQuery.parseJSON(jsonData);
            
            
            
            var modal ='<div class="modal fade" id="edit_form"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal += '<div class="modal-dialog">';
            modal += '<div class="modal-content">';
            modal += '<div class="modal-header">';
            modal += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
            modal += '<h3>Edit current Feed source</h3>';
            modal += '</div>';
            
            modal += '<div class="modal-body">';
            modal +='<form id="editableInfo">';
        
           
            
            modal += '<div class="form-group">';
            modal += '<label for="Title"  class="control-label col-xs-3">Title</label>';
            modal += '<div class="col-xs-9">';
            modal += '<input name="Title" type="text" id="title" placeholder="Name" class="form-control" value="'+feeds.title+'" required pattern="[a-zA-Z]+" autocomplete="off">';
            modal += '</div>';
            modal += '</div>';
            
            modal += '<div class="form-group">';
            modal += '<label for="link" class="control-label col-xs-3">Link</label>';
            modal += '<div class="col-xs-9">';
            modal += '<input name="link" id="link" placeholder="valid rss url" class="form-control"  type="url" value="'+feeds.link+'" required pattern="https?://.+" autocomplete="off">';
            modal += '</div>';
            modal += '</div>';
            
            
            
            modal += '<div class="form-group">';
            modal += '<label for="favourite" class="control-label col-xs-3">Favourite</label>';
            modal += '<div class="col-xs-9">';
            modal += '<input name="favourite" id="favourite" value="'+feeds.favourite+'" type="radio">';
            modal += '</div>';
            modal += '</div>';
            
            
            
          
            
           
            modal += '<div class="modal-footer">';
            
            modal += '<button  id="edit_feed" class="btn btn-primary">Save changes</button>';
            modal += '<button class="btn pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>';
            modal += '</div>';
            
            
            
            modal+='</form>';
            
            modal += ' <input type="hidden" id="feed_id" value="'+feeds.id+'" />';
            modal += ' </div>';
            
            
            modal += ' </div><!-- /.modal-content -->';
            modal += '</div><!-- /.modal-dialog -->';
            modal += ' </div><!-- /.modal -->';
             
           $('div#modal').html(modal);
          
           $("#edit_form").modal("show");
           ValidForm('#editableInfo');
        }
        
        function editFeed(){
            
            $.post('/index.php/user/edit_feed',
            {        id         :  $('input#feed_id').val(),
                     title      :  $('input#title').val(),
                     link       :  $('input#link').val(),
                     favourite  :  $('input#favourite').val(),
            },function(data){                
                $("#edit_form").modal("hide");
                    getFeedsList();
            });
            
            
        }
        
        
          function addFeed(){
            $.post('/index.php/user/add_feed',
            {        title    :  $('input#title').val(),
                     link       :  $('input#link').val()
            },function(data){
                $("#add_modal").modal("hide");
                    getFeedsList();
            });
            
        }
    
            
    /* Feeds List to edit */
        function getFeedsList() {
            $.post('/index.php/user/my_feeds',{},
                function(data) {
                     renderFeedsList(data);
                        
                    }
                
            );
        }

        function renderFeedsList(jsonData) {
         
            var table = '<div class="table-responsive"><table width="800" cellpadding="5" class="table table-hover table-bordered"><thead><tr><th scope="col">Link</th><th scope="col">Title</th><th scope="col">Favourite</th><th scope="col">Actions</th></tr></thead><tbody>';
            var feeds = jQuery.parseJSON(jsonData);           
            
            $.each(feeds, function(index, feed){
            table += '<tr>';
            table += '<td field="link" >'+feed.link+'</td>';
            table += '<td field="title" >'+feed.title+'</td>';
            table += '<td field="favourite" >'+feed.favourite+'</td>';            
            table += '<td><a href="javascript:void(0);" feed_id="'+feed.id+'" class="delete_confirm"><i class="glyphicon glyphicon-trash"></i></a> <a href="javascript:void(0);" feed_id="'+feed.id+'" class="edit_confirm"><span class="glyphicon glyphicon-edit"></span></a></td>';
            table += '</tr>';
            });
         
            table += '</tbody></table></div>';            
            $('div#response').html(table);
        }




        
        function getCreateForm() {
          
        var form ='<div class="modal fade" id="add_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            form += '<div class="modal-dialog">';
            form += '<div class="modal-content">';
            form += '<div class="modal-header">';
            form += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
            form += '<h3>Add new Feed source</h3><p>Please insert valid rss url</p>';
            form += '</div>';            
            form += '<div class="modal-body">';
            
            form +='<form id="infoFeed" class="form-horizontal">';        
            form += '<div  class="">'; 
           
            
           
            form += '<div class="form-group">';            
            form += '<label for="Title"  class="control-label col-xs-3">Title</label>';
            form += '<div class="col-xs-8">';
            form += '<input name="title" type="text" id="title" placeholder="Title" class="form-control" required pattern="[a-zA-Z]+" autocomplete="off">';
            form += '</div>';
            form += '</div>';
            
            
            
            
            form += '<div class="form-group">';
            form += '<label for="link" type="text" class="control-label col-xs-3">Link</label>';
            form += '<div class="col-xs-8">';
            form += '<input name="link" id="link" placeholder="valid rss url" class="form-control"  type="url" required pattern="https?://.+" autocomplete="off">';
            form += '</div>';
            form += '</div>';
            
            
            
            
           
            form += '</div>';
            form += '<div class="modal-footer">';            
            form += '<div class="">';
            form += '<button  id="okButton" class="btn btn-primary">Add this Feed</button>';
            form += '</div>';
            form += '</div>';
            
            form+='</form>';
           
            form += ' </div>';
            form += ' </div><!-- /.modal-content -->';
            form += '</div><!-- /.modal-dialog -->';
            form += ' </div><!-- /.modal -->'; 
        
            $('div#modal').html(form);            
            $("#add_modal").modal("show");
            
            ValidForm('#infoFeed');
            
        }
         
    
        
            
        function deleteConfirmation(el) {
            
        var modal ='<div class="modal fade" id="delete_confirm_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal += '<div class="modal-dialog">';
            modal += '<div class="modal-content">';
            modal += '<div class="modal-header">';
            modal += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
          
            modal += '<h3 id="myModalLabel">Delete Feed</h3>';
            modal += '</div>';
            modal += '<div class="modal-body">';
            modal += '<p>Are you sure to delete this Feed source ?</p>';
            modal += '</div>';
            modal += '<div class="modal-footer">';
            
            
            modal += ' <input type="hidden" id="feed_id" value="" />';
            modal += '<button class="btn" data-dismiss="modal" aria-hidden="true">No</button>';
            modal += ' <button class="btn btn-primary delete">Yes</button> ';
            modal += ' </div>';
            modal += ' </div><!-- /.modal-content -->';
            modal += '</div><!-- /.modal-dialog -->';
            modal += ' </div><!-- /.modal -->';
       
           $('div#modal').html(modal);
           
           $("#delete_confirm_modal").modal("show");          
           $("#delete_confirm_modal input#feed_id").val($(el).attr('feed_id'));
       }
        
      
      function addLink(){
        
        var link ='<p><span class="glyphicon glyphicon-plus-sign"></span> <a href="javascript:void(0);" id="addFeed" >Add Feed</a></p>';
        $('div.addLink').html(link);
      }
        


      function ValidForm(elem){
            
            $(elem).validate({
           
            "rules" : {
                "title" :{
              "minlength":1,
                 "maxlength":100,
                   "required" : true
                 },
                 "link" :{
                    "minlength":8,
                    "maxlength":100,
                    "required" : true
                }
            }
                    });
        
        } 
    
