$(document).ready(function(){

    getComments();

    //   get comments
    function getComments(){
        let sortBy = $("#sortBy").val(); 
        let sortDirection = $("#sortDirection").val(); 
        $.ajax({
            type:"GET",
            url:"http://localhost/getComments",
            data:{
                sortBy: sortBy,
                sortDirection: sortDirection
            } ,
            success:function(response){
                if (response.status == "OK") {
                    $("#commentSection").html('');
                    for(i=0; i < response.data.length; i++) {
                        document.getElementById("commentSection").innerHTML += 
                        '<div class="comment-body form-control my-1">\
                            <div class="d-flex">\
                                <div>\
                                    <strong>' + response.data[i].email + '</strong>'+
                                    '<small> - ' + response.data[i].created_at + ' </small> <br>\
                                    <span> ' + response.data[i].text + '  </span>\
                                </div>\
                            </div>\
                            <small style="margin-left:65px" class="text-primary"> \
                                <span id="replyComment" class="cursor-pointer" data-commentid= "' + response.data[i].id+ '"> Reply </span>\
                                <button type="submit" id="deleteComment" data-commentid= "' + response.data[i].id+ '">Delete</button>\
                            </small> \
                            <div class="my-1" id="replyComments' + response.data[i].id+ '"></div>\
                            <div style="margin-left:60px" class="d-flex justify-content-start visually-hidden" id="showReplyBox' + response.data[i].id+ '">\
                                <input type="email" id="email' + response.data[i].id+ '" class="form-control mx-2"> \
                                <textarea name="comment" id="comment ' + response.data[i].id+ '" cols="30" rows="10" placeholder="Write a comment" required></textarea> \
                                <input type="datetime-local" id="created_at ' + response.data[i].id+ '" name="created_at" required> \
                                <input type="button" id="submitReply" value="Add" data-commentid= "' + response.data[i].id+ '" class="btn btn-warning">\
                            </div>\
                        </div>';
                    }    
                } else {
                    document.getElementById("errorsSection").innerHTML += 
                    '<div>\
                        <ul>'
                        for(i=0; i < response.errors.length; i++) {
                            '<li>' + response.errors[i].error + '</li>'
                        }
                        '</ul>\
                    </div>'
                }
            }
        })  
      };

      $(document).change('#sortBy', function(){
        $("#commentSection").html('');
        getComments()
    });
      $(document).change('#sortDirection', function(){
        $("#commentSection").html('');
        getComments()
    });

    // delete comment
    $(document).on("click", '#deleteComment', function(){
        let id = $(this).attr('data-commentid');
        $.ajax({
            type:"GET",
            url:"http://localhost/deleteComment/"+id,
            success:function(response){
                if (response.status == "OK") {
                    $("#commentSection").html('');
                    getComments();  
                }else {
                    document.getElementById("errorsSection").innerHTML += 
                    '<div>\
                        <ul>'
                        for(i=0; i < response.errors.length; i++) {
                            '<li>' + response.errors[i].error + '</li>'
                        }
                        '</ul>\
                    </div>'
                }},
            errror:function(){
                console.warn("something wrong");        
            }
        });
    });

    /*
    // add comment
    $("#submit").on("click",function(){
        
        let comment = $("#commentPost").val();    
        let create_at = $("#created_atPost").val();    
        let email = $("#emailPost").val();
        if(comment==''||email==''||create_at==''){ 
            return false;
        }
        $.ajax({
            method:"post",
            url:"http://localhost/addComment",
            contentType:"application/x-www-form-urlencoded; charset=UTF-8",
            data: {"comment":  comment, "email": email, "create_at": create_at, "reply_id": null},
            success:function(response){
                if(response.status == "OK"){
                    $("#commentSection").html('');
                    getComments();
                    $("#commentPost").val('');        
                    $("#created_atPost").val('');        
                    $("#emailPost").val('');        
                }
            },
            errror:function(){
                  alert("Error: " + errors);
                console.warn("something wrong");        
            }
        });
      });

  //   get comments replies
    $(document).on("click", '#replyComment', function(evt){
          let id = $(this).attr('data-commentid');
          if($("#showReplyBox"+id).hasClass('visually-hidden')){
              $("#showReplyBox"+id).removeClass("visually-hidden");
              $.ajax({
              type:"GET",
              url:"http://localhost/getCommentsReply/"+id,
              success:function(response){
                  for(i=0; i < response.data.length; i++) {
                      document.getElementById('replyComments'+id).innerHTML += 
                      '<div class="d-flex my-1" style="margin-left:65px" id="singleReplyComment"'+id+'">\
                            <div>\
                                <strong>' + response.data[i].email + '</strong>'+
                                '<small> - ' + response.data[i].created_at + ' </small> <br>\
                                <span> ' + response.data[i].comment + '  </span>\
                            </div>\
                          </div>\
                      </div>';
                      }       
                      return true;
                  },
                  errror:function(){
                      console.warn("something wrong");
                  }
              })
          }else {
              $("#showReplyBox"+id).addClass("visually-hidden");
              $("#replyComments"+id).html('');
          }
            
    });

    // add Reply comment
    $(document).on("click", '#submitReply', function(){
        let replyid = $(this).attr('data-commentid');
        let comment = $("#comment"+ replyid).val();
        let email = $("#email"+ replyid).val();
        let create_at = $("#create_at"+ replyid).val();
      $("#replyComments"+replyid).html('');
      if(comment=='' || replyid=='' || email=='' || create_at==''){        
          return false;
      }
      $.ajax({
          type:"POST",
          url:"http://localhost/addComment",
          data:{"comment":comment, "email":email, "create_at":create_at, "reply_id":replyid},
          success:function(response){
              if(response.status == 'OK'){
                  $("#commentReply"+replyid).val('');
                  $.ajax({
                      type:"GET",
                      url:"http://localhost/getCommentReply/"+replyid,
                      success:function(response){
                          for(i=0; i < response.data.length; i++) {
                              document.getElementById('replyComments'+replyid).innerHTML += 
                              '<div class="d-flex my-1" style="margin-left:65px" id="singleReplyComment"'+replyid+'">\
                                  <div>\
                                      <strong> ' + response.data[i].email + ' </strong> \
                                      <small>- ' + response.data[i].created_at + ' </small> <br>\
                                      <span> ' + response.data[i].comment + ' </span>\
                                  </div>\
                                  </div>\
                              </div>';
                              }       
                              return true;
                          },
                          errror:function(){
                              console.warn("something wrong");
                          }
                      })       
              }
          },
          errror:function(){
              console.warn("something wrong");         
          }
      });
    });
    */
  })
