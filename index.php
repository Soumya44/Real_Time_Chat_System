<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System</title>

    <!--    Bootstrap 4 CSS  -->
    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">


    <!--    My CSS  -->
    <link rel="stylesheet" href="css/style.css">
    <!--    jQuery  -->
    <script src="jQuery/jquery-3.2.1.min.js"></script>
    <!--    Tooltip  -->
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

    </script>
    <!--    -->

</head>

<body>

    <?php 
        session_start();
    $_SESSION['username']= "Soumya";
    
    ?>

    <div id="wrapper" class="container-fluid">

        <div class="container-fluid chat_wrapper">
            <div class="brand">
                <h1 align=center><a href="#info" class="info" data-toggle="tooltip" data-placement="bottom" title="Real Time Chat System Designed by &copy; Soumya">Chat Buddy</a></h1>
            </div>
            <div id="chat" class="chatdisplay">

            </div>
            <form method="post" id="ChatForm">
                <div class="form-group">
                    <textarea name="message" id="" cols="20" rows="5" class="textarea" placeholder="Type a Message ..."></textarea>
                    <button class="btn btn-primary float-right sendbtn btn-md" type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <!--    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js"></script>

    <script>
        setInterval(function() {
            LoadChat();
        }, 1000);

        function LoadChat() {
            $.post('handlers/messages.php?action=getMessage', function(response) {


                var scrollpos_before = $('#chat').prop('scrollHeight');
                //                console.log("scrollpos " + scrollpos_before);
                $('#chat').html(response);
                var scrollHeight = $('#chat').prop('scrollHeight');
                //                console.log("scrollHeight "+ scrollHeight);
                if (scrollpos_before == scrollHeight) {

                } else {
                    $('#chat').scrollTop($('#chat').prop('scrollHeight'));
                }
            });
        }
        $('.textarea').keyup(function(e) {
            if (e.which == 13) {
                $('form').submit();
            }

        });
        $('form').submit(function() {
            var message = $('.textarea').val();
            //            alert('yes');
            $.post('handlers/messages.php?action=sendMessage&message=' + message, function(response) {
                if (response == true) {
                    LoadChat();
                    document.getElementById('ChatForm').reset();

                }
            });


            return false;
        });

    </script>
</body>

</html>
