<!------ Include the above in your HEAD tag ---------->
{{-- https://bootsnipp.com/snippets/nNg98 --}}
<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
    </script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('custom_css/style.css') }}">
</head>
<!--Coded With Love By Mutiullah Samim-->

<body>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." name="" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <ui class="contacts">
                            <li class="active">
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img src="{{asset('images/gpt1.png')}}"
                                            class="rounded-circle user_img">
                                        <span class="online_icon"></span>
                                    </div>
                                    <div class="user_info">
                                        <span>Gpt-3.5-Turbo</span>
                                        <p>Gpt-3.5-turbo is online</p>
                                    </div>
                                </div>
                            </li>
                        </ui>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-8 col-xl-6 chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="{{asset('images/gpt1.png')}}"
                                    class="rounded-circle user_img">
                                <span class="online_icon"></span>
                            </div>
                            <div class="user_info">
                                <span>Chat with Gpt-3.5-turbo</span>
                                <p>1767 Messages</p>
                            </div>
                            <div class="video_cam">
                                <span><i class="fas fa-video"></i></span>
                                <span><i class="fas fa-phone"></i></span>
                            </div>
                        </div>
                        <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                        <div class="action_menu">
                            <ul>
                                <li><i class="fas fa-user-circle"></i> View profile</li>
                                <li><i class="fas fa-users"></i> Add to close friends</li>
                                <li><i class="fas fa-plus"></i> Add to group</li>
                                <li><i class="fas fa-ban"></i> Block</li>
                            </ul>
                        </div>
                    </div>
                    <div id="msg_cotainer_send" class="card-body msg_card_body">
                        
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            {{-- <div class="input-group-append">
                                <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                            </div> --}}
                            <form class="input-group" action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <textarea id="chat-box" name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                <div class="input-group-append">
                                    <button id="chat-button" type="submit" class="input-group-text send_btn"><i
                                            class="fas fa-location-arrow"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#action_menu_btn').click(function() {
            $('.action_menu').toggle();
        });

        // get input value
        $('#chat-button').click(function(e) {
            e.preventDefault();
            const inputValue = $('#chat-box').val();
            let date = new Date();
            var time = date.toLocaleString([], { hour: '2-digit', minute: '2-digit' });
            // append user message to inbox
            $('#msg_cotainer_send').append(`<div  class="d-flex justify-content-end mb-4"><div class="msg_cotainer_send">${inputValue}
                                <span class="msg_time_send">${time}, Today</span>
                            </div>
                            <div class="img_cont_msg">
                                <img src="{{asset('images/arif.jpg')}}"
                                    class="rounded-circle user_img_msg">
                            </div>
                        </div>`);
                        $('#chat-box').val("");
            $.ajax({
                url: "{{ route('chatbot') }}",
                method: "POST",
                dataType: "html",
                data: {
                    'inputValue': inputValue,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    let res = JSON.parse(data);
                    console.log('res', (res));
                    if(res?.error){
                       
                       alert(res?.error?.message);
                    }
                    else{
                        let botReply = res?.choices[0].message.content;
                        $('#msg_cotainer_send').append(`<div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="{{asset('images/gpt1.png')}}"
                                    class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer">
                                ${botReply}
                                <span class="msg_time">${time}, Today</span>
                            </div>
                        </div>`);
                    
                    }
                   
                },

            });


            
            // console.log("result = ", inputValue);
        });

    });
</script>

</html>
