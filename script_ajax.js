
  $(document).ready(function(){
    var userTo = document.getElementById("hide2").value;
    var userFrom = document.getElementById("hide1").value;
    $('#myForm').submit(function(e){
      e.preventDefault();
      var msg = document.getElementById("myMsg").value;

      var data = $('#myForm :input').serializeArray();
      $.post("ajax_msg.php",data, function(response){
        if(response === 'ok'){
         var content = '<div class="d-flex justify-content-start mb-4">' +
            '<div class="img_cont_msg">' +
              '<img src="' + $("#from_image").attr("src") + '" class="rounded-circle user_img_msg">'+
            '</div>'+
            '<div class="msg_cotainer">'+
              msg
              +
            '</div>'+
          '</div>';
          $("#scroll_messages").append(content);
          $('#myMsg').val('');
        }
      });
    });
    var url = 'ajax_get_msg.php?user1=' + userTo + '&user2=' + userFrom;
    setInterval(function() {
      $.get(url, function(response){
        response = JSON.parse(response);
        var content = '';
        for(var i=response.length - 1; i >= 0 ; i--){
          if(response[i]['user_to'] == userTo && response[i]['user_from'] == userFrom){
            content += '<div class="d-flex justify-content-start mb-4">' +
                            '<div class="img_cont_msg">' +
                              '<img src="'+ $("#from_image").attr("src") +'" class="rounded-circle user_img_msg">' +
                            '</div>' +
                            '<div class="msg_cotainer">' +
                                response[i]['msg_body']
                                +
                            '</div>' +
                          '</div>';
          }
          else if(response[i]['user_from'] == userTo && response[i]['user_to'] == userFrom){
            content += '<div class="d-flex justify-content-end mb-4">' +
                    '<div class="msg_cotainer_send">' +
                      response[i]['msg_body']
                        +
                    '</div>' +
                    '<div class="img_cont_msg">' +
                      '<img src="' + $("#to-image").attr("src") +'" class="rounded-circle user_img_msg">' +
                   '</div>' +
                  '</div>';
          }
        }
        document.getElementById("scroll_messages").innerHTML = content;
      });
    },5000);

  });
