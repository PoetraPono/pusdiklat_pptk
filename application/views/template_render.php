<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <title><?php echo $this->config->config['app_company']; ?> | <?php echo $this->config->config['app_name']; ?></title>

    <link href="<?php echo base_url(); ?>assets/images/favicon.ico" rel="shortcut icon" type="image/png">
    <link href="<?php echo base_url(); ?>assets/images/favicon.ico" rel="apple-touch-icon">
    <link href="<?php echo base_url(); ?>assets/images/favicon.ico" rel="apple-touch-icon" sizes="72x72">
    <link href="<?php echo base_url(); ?>assets/images/favicon.ico" rel="apple-touch-icon" sizes="114x114">
    <link href="<?php echo base_url(); ?>assets/images/favicon.ico" rel="apple-touch-icon" sizes="144x144">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/londinium-theme.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/charts/sparkline.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/uniform.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputmask.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/autosize.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputlimit.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/listbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/multiselect.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/tags.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/switch.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/uploader/plupload.full.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/uploader/plupload.queue.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/wysihtml5/toolbar.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/interface/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/interface/fancybox.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/interface/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/interface/jgrowl.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/interface/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/interface/colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/interface/fullcalendar.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/interface/timepicker.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/application.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/ckeditor/ckeditor.js"></script>
    
    <script type='text/javascript'>
        var baseurl = '<?php echo base_url(); ?>';
        var assetPath = "<?php echo base_url(); ?>assets";

    </script>
<!-- LIVE CHAT -->
    <link href="<?php echo base_url();?>assets/css/chatbox.css" rel="stylesheet"/>
    <style type="text/css">
        .scrollToTop{
            bottom: 85px;
        }
        a.cusserlist:hover, a.cusserlist:active, a.cusserlist:focus{
            color: rgba(255,255,255,0.8);
        }
        .cusserlist {
            background: #3D9AE4;
            color: white;
            bottom: 25px;
            /*padding: 2px;*/
            position: fixed;
            right: 15px;
            /*border: 1px solid #dedede;*/
            text-align: center;
            text-decoration: none;

            width: 50px;
            height: 50px;
            border-radius: 50%;
            -webkit-box-shadow: 1px 3px 5px rgba(50, 50, 50, 0.3);
            box-shadow: 1px 3px 5px rgba(50, 50, 50, 0.3);
            /*border:1px solid rgba(50, 50, 50, 0.5);*/

            z-index: 999;
        }
        .listcusser {
            background: white;
            bottom: 80px;
            /*padding: 2px;*/
            position: fixed;
            right: 15px;
            text-align: center;
            text-decoration: none;

            width: 230px;
            border-radius: 4px;
            -webkit-box-shadow: 1px 3px 7px rgba(50, 50, 50, 0.3);
            box-shadow: 1px 3px 7px rgba(50, 50, 50, 0.3);
            z-index: 9999;
        }
        .custominfo{
            height: 200px;
            margin-bottom: 0px;
            overflow-y: auto;
        }
        .custominfo .list-group-item:hover{
            background-color: rgba(240,240,240,0.2);
        }
        .custominfo .list-group-item:click{
            background-color: rgba(230,230,230,0.2);
        }
        .labelnotif1{
            padding: 0 6px;
            border-radius: 50%;
            background-color: rgba(250,120,120,1);
            color: white;
            font-size: 11px;
            margin-right: 5px;
        }

        .labelnotif{
        /*width: 20px;*/
        /*height: 20px;*/
        padding: 1px 5px;
        border-radius: 50%;
        border: 2px solid white;
        background-color: rgba(240,50,50,1);
        color: white;
        position: absolute;
        font-size: 10px;
        top:0;
        right:0;
        -webkit-box-shadow: 1px 2px 4px rgba(50, 50, 50, 0.3);
        box-shadow: 1px 2px 4px rgba(50, 50, 50, 0.3);
      }
    </style>
    <!-- LIVE CHAT -->


</head>

<body class="navbar-fixed">

    <!-- Navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <!-- <img class="navbar-brand" src="<?php //echo base_url()?><!--assets/images/logo_lama.png" style="width: 60px">--> -->
            <a class="navbar-brand" href="#" style="font-size:16px;">PUSDIKLAT APU-PPT</a>
            <a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
                <span class="sr-only">Toggle navbar</span>
                <i class="icon-grid3"></i>
            </button>
            <button type="button" class="navbar-toggle offcanvas">
                <span class="sr-only">Toggle navigation</span>
                <i class="icon-paragraph-justify2"></i>
            </button>
        </div>

        <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">

           <!--  <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-notification"></i>
                    <span class="label label-default">6</span>
                </a>
                <div class="popup dropdown-menu dropdown-menu-right">
                    <div class="popup-header">
                        <a href="#" class="pull-left"><i class="icon-bubble-notification"></i></a>
                        <span>Notifikasi</span>
                        <a href="#" class="pull-right"><i class="icon-new-tab"></i></a>
                    </div>
                    <ul class="popup-messages">
                        
                    </ul>
                </div>
            </li>
 -->
            

            <li class="user dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src='<?php echo base_url();?>assets/images/user/<?php echo $photo;?>'>
                    <span><?php echo $this->session->userdata('user_fullname');?></span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right icons-right">
                    <li><a href='<?php echo base_url();?>home/profile/index'><i class="icon-user"></i>Profile</a></li>
                    <li><a href='<?php echo base_url();?>home/auth/logout'><i class="icon-exit"></i>Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /navbar -->


    <!-- Page container -->
    <div class="page-container">


        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-content">

                <!-- User dropdown -->
                <div class="user-menu dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src='<?php echo base_url();?>assets/images/user/<?php echo $photo;?>'>
                        <div class="user-info">
                            <?php echo $this->session->userdata('user_fullname');?> <span><?php echo $this->session->userdata('user_access_name');?></span>
                        </div>
                    </a>
                    <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="thumbnail">
                            <div class="thumb">
                                <img src='<?php echo base_url();?>assets/images/user/<?php echo $photo;?>'>
                                <div class="thumb-options">
                                    <span>
                                        <a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a>
                                        <a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a>
                                    </span>
                                </div>
                            </div>

                            <div class="caption text-center">
                                <h6><?php echo $this->session->userdata('user_fullname');?> <small><?php echo $this->session->userdata('user_access_name');?></small></h6>
                            </div>
                        </div>

                        <ul class="list-group">
                            <li class="list-group-item">Last Ip Address <span class="label label-danger"><?php echo $this->session->userdata('user_ip_address');?></span></li>
                            <li class="list-group-item">Last Login <span class="label label-danger"><?php echo $this->session->userdata('user_last_login');?></span></li>
                            <li class="list-group-item icons-right"><a href='<?php echo base_url();?>home/profile/index'><i class="icon-user"></i>Profile</a></li>
                            <li class="list-group-item icons-right"><a href='<?php echo base_url();?>home/auth/logout'><i class="icon-exit"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /user dropdown -->


                <!-- Main navigation -->
                <?php echo $menu;?>

                <!-- /main navigation -->

            </div>
        </div>
        <!-- /sidebar -->


        <!-- Page content -->
        <div class="page-content">
          <?php echo $_content; ?>
          <!-- Small modal -->
          <div id="konfirmasipenyimpanan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header btn-info">
                        <h4 class="modal-title"><i class="icon-warning"></i> Konfirmasi</h4>
                    </div>

                    <div class="modal-body with-padding">
                        <p id="text_alert">Anda yakin menyimpan data ini ?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-success" id="setujukonfirmasibutton"> Yakin</button>
                        <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

          <div id="konfirmasihapus" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header btn-info">
                        <h4 class="modal-title"><i class="icon-warning"></i> Konfirmasi</h4>
                    </div>

                    <div class="modal-body with-padding">
                        <p class="text_alert">Anda yakin data ini ?</p>
                    </div>

                    <div class="modal-footer">
                        <a type="button" class="btn btn-xs btn-primary" id="setujukonfirmasi"> Yakin</a>
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="footer clearfix">
            <div class="pull-center">Hak Cipta &copy; 2017 Pusat Pelaporan dan Analisis Transaksi Keuangan. All Right Reserved.</div>
        </div>
        <!-- /footer -->
    </div>
    <!-- /page content -->
    <?php 
    $notify = $this->session->flashdata('notify');
    ?>
</div>
<!-- /page container -->

<!-- LIVE CHAT -->
  <div class="listcusser" style="display: none">
    <div class="panel panel-info" style="margin-bottom: 0px;">
      <a class="panel-info" href="javascript:void(0);" onclick="openlistcusser()">
      <div class="panel-heading">
        <h6 class="panel-title text-left"><i class="icon-bubbles4"></i>  List Chat Aktif</h6>
      </div>
      </a>
      <div class="list-group text-left custominfo" id='chatlistappend'>
        <?php if(isset($chats_lists) && count($chats_lists)>0){
          foreach ($chats_lists as $key => $value) {
            $notif = $value['NOTIF_CHAT']!=0?'<span class="labelnotif1 pull-right">'.$value['NOTIF_CHAT'].'</span>':'';
            echo '<div class="list-group-item" style="border-bottom:1px solid #efefef"><a data-friend="'.$value['CHAT_MEMBER_ID'].'">'.$value['MEMBER_NAME'].'</a><a class="close" data-dismiss="alert">×</a>'.$notif.'</div>';
          }
        }
        ?>
      </div>
    </div>
  </div>
    <a class="cusserlist" onclick="openlistcusser()" href="javascript:void(0);" style="padding: 8px 5px;">
        <span class="labelnotif" style="display: none">0</span>
        <i style="font-size: 30px;" class="icon-bubbles4"></i>
    </a>
  <script type="text/javascript">
    function openlistcusser(){
      $('.listcusser').toggle(200);
      getlistcust();
    }
  </script>

  <!-- TEMPLATE -->
    <div id="chat-template" style="display: none">
      <div class="chatbox chatbox--tray">
        <div class="chatbox__title">
            <h5><a href="javascript:;" class="name"></a></h5>
            <button class="chatbox__title__close">
                <span>
                    <svg viewBox="0 0 12 12" width="12px" height="12px">
                        <line stroke="#FFFFFF" x1="11.75" y1="0.25" x2="0.25" y2="11.75"></line>
                        <line stroke="#FFFFFF" x1="11.75" y1="11.75" x2="0.25" y2="0.25"></line>
                    </svg>
                </span>
            </button>
        </div>
        <div class="chatbox__body">
        </div>
        <textarea name="message" class="chatbox__message" placeholder="Jawab pertanyaan.."></textarea>
      </div>
    </div>
    <script type="text/javascript">
      function getlistcust(){
        $.ajax({
          url : "<?php echo base_url()."home/dashboard/getlist_members" ?>",
          type: "GET",
          dataType: "JSON",
          success: function(data){
            var listcust = '';
            $.each(data, function(index) {
              var notif = data[index].NOTIF_CHAT!=0?'<span class="labelnotif1 pull-right">'+data[index].NOTIF_CHAT+'</span>':'';
              listcust += '<a class="list-group-item" href="javascript:void(0);" data-friend="'+data[index].CHAT_MEMBER_ID+'">'+data[index].MEMBER_NAME+notif+'</a>';
            });
            $('#chatlistappend').html(listcust);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              //alert('Mohon untuk refresh halaman kembali');
          }
        });
      }
      $(document).ready(function(){
        // getlistcust();
        checkchat();
      });
      function checkchat(){
        $.ajax({
          url : "<?php echo base_url()."home/dashboard/getnotifchats" ?>",
          type: "GET",
          dataType: "JSON",
          success: function(data){
            if(data!=0){              
              $('.labelnotif').html(data);
              $('.labelnotif').fadeIn(100);
            }else{
              $('.labelnotif').fadeOut(100);              
            }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              //alert('Mohon untuk refresh halaman kembali');
          }
      });

        setTimeout(checkchat, 10000)
      }
      jQuery(document).ready(function($) {
        var chatPosition = [
          false, // 1
          false, // 2
          false, // 3
          false, // 4
        ];

        // New chat
        $(document).on('click', 'a[data-friend]', function(e) {
          var $data = $(this).data();
          openlistcusser();
          if ($data.friend !== undefined && chatPosition.indexOf($data.friend) < 0) {
            var posRight = 0;
            var position = $('.chatbox').length;
            posRight = ((position-1) * 310) + 75;
            /*alert($('.chatbox').length);*/
              for(var i in chatPosition) {
                if (chatPosition[i] == false) {
                  // posRight = (i * 310) + 75;
                  chatPosition[i] = $data.friend;
                  position = i;
                  break;
                }
              }
            var tpl = $('#chat-template').html();
            var tplBody = $('<div/>').append(tpl);
            tplBody.find('.chatbox').addClass('msg-wgt-active');
            tplBody.find('.chatbox').css('right', posRight + 'px');
            tplBody.find('.chatbox').attr('id', 'chat_'+$data.friend);
            tplBody.find('.chatbox').attr('data-chat-position', position);
            tplBody.find('.chatbox').attr('data-chat-with', $data.friend);
            $('body').append(tplBody.html());
            if($('#chat_'+$data.friend).hasClass('chatbox--tray')){
              $('#chat_'+$data.friend).toggleClass('chatbox--tray');
            }
            $.ajax({
                url : "<?php echo base_url()."home/dashboard/readchat" ?>",
                type: "POST",
                dataType: "JSON",
                data: { datafriend: $data.friend },
                success: function(data){
                  if(data!=0){
                    $('.labelnotif').html(data);
                    $('.labelnotif').fadeIn(100);
                  }else{
                    $('.labelnotif').fadeOut(100);              
                  }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //alert('Mohon untuk refresh halaman kembali');
                }
            });
            initializeChat();
          }
        });
        // Minimize Maximize
        $(document).on('click', '.chatbox__title', function() {
          var parent = $(this).parent();
          parent.toggleClass('chatbox--tray');
        });

        // Close
        $(document).on('click', '.chatbox__title__close', function() {
          var parent = $(this).parent().parent();
          var $data = parent.data();
          console.log($data);
          parent.addClass('chatbox--closed');
          parent.on('transitionend', function() {
            if (parent.hasClass('chatbox--closed')){
              parent.remove();  
              chatStacking();
            } 
          });
          chatPosition[$data.chatPosition] = false;
          setTimeout(function() {
            initializeChat();
          }, 1000)
        });

        var chatInterval = [];


        var initializeChat = function() {
          $.each(chatInterval, function(index, val) {
            clearInterval(chatInterval[index]);   
          });
          $('.msg-wgt-active').each(function(index, el) {
            var $data = $(this).data();
            var $that = $(this);
            var $container = $that.find('.chatbox__body');
            // var $container = $that.find('.msg-wgt-message-container');

            chatInterval.push(setInterval(function() {
              var oldscrollHeight = $container[0].scrollHeight;
              var oldLength = $that.find('.chatbox__body__message').length;
              // alert();
              $.post('<?php echo base_url()."home/dashboard/getchats" ?>', {chatWith: $data.chatWith}, function(data, textStatus, xhr) {
                $that.find('a.name').text(data.user_name);
                // from last
                var chatLength = data.chats.length;
                var newIndex = data.chats.length;
                  // alert('old: '+oldLength+' | new: '+chatLength);
                var ishtml = "";
                $.each(data.chats, function(index, el) {
                  newIndex--;
                  if(oldLength<chatLength){
                    var val = data.chats[newIndex];
                    if(val.CHAT_SENDER==1){
                      ishtml += 
                      '<div class="chatbox__body__message chatbox__body__message--right">'+
                        '<img src="<?php echo base_url()?>assets/icons/user2.png" alt="Picture">'+
                        '<p><span style="font-weight: 600;color:#bbb">'+val.MEMBER_NAME+'</span><br>'+val.CHAT_MESSAGE+'</p>'+
                      '</div>';                    
                    }else{
                      ishtml +=
                      '<div class="chatbox__body__message chatbox__body__message--left">'+
                        '<img src="<?php echo base_url()?>assets/icons/oprl.png" alt="Picture">'+
                        '<p><span style="font-weight: 600;color:#ccc">'+val.USER_NAME+'</span><br>'+val.CHAT_MESSAGE+'</p>'+
                      '</div>';
                    }
                  }
                });
                if(ishtml!=""){
                  $container.html(ishtml);
                  var newscrollHeight = $container[0].scrollHeight - 20;
                  $container.animate({ scrollTop: newscrollHeight }, 'normal');
                }
              });
             
            }, 1000));
            $that.find('textarea').on('click', function() {
                //alert($data.chatWith);
                $.ajax({
                    url : "<?php echo base_url()."home/dashboard/readchat" ?>",
                    type: "POST",
                    dataType: "JSON",
                    data: { datafriend: $data.chatWith },
                    success: function(data){
                      if(data!=0){
                        $('.labelnotif').html(data);
                        $('.labelnotif').fadeIn(100);
                      }else{
                        $('.labelnotif').fadeOut(100);              
                      }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //alert('Mohon untuk refresh halaman kembali');
                    }
                });
              });
            $that.find('textarea').on('keydown', function(e) {
              var $textArea = $(this);
              if (e.keyCode === 13 && e.shiftKey === false) {
                $.post('<?php echo base_url()."home/dashboard/sendmessage" ?>', {message: $textArea.val(), chatWith: $data.chatWith}, function(data, textStatus, xhr) {
                });
                $textArea.val('');
                initializeChat();
                e.preventDefault();
                return false;
              }
            });
          });
        }
        var nl2br = function(str, is_xhtml) {
          var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>';
          return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }
        // on load
        initializeChat();
        function chatStacking(){
          var posRight = 75;
          var no = 0;
          $('.chatbox').each(function () {
            posRight = ((no-1) * 310) + 75;
            $(this).css('right', posRight + 'px');
            no++;
          });
        }
      });
    </script>
<!-- LIVE CHAT -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script type="text/javascript">

    function show_notif(){
        var wew = "<?php echo $this->session->flashdata('message_name');?>";
        var title = "<?php echo $notify['title'];?>";
        var message = "<?php echo $notify['message'];?>";
        var status = "<?php echo $notify['status'];?>";
        var theme = "";
        var header = "";
        if(status == "error"){
            theme = 'growl-error';
            header = title;
            $.jGrowl(message, {
              theme: theme,
              header: header
          });
        }else if(status=="success"){
            header = title;
            $.jGrowl(message, {
              theme: theme,
              header: header
          });
        }

    }
    function set_default_datatable() {
        $('.tooltips,.tip').tooltip();
        $(".dataTables_length select").select2({
            minimumResultsForSearch: "-1"
        });
    }

    $(document).ready(function() {
        show_notif();
        $('body').on('click','.show_confirm', function(){
            if($(this).attr('data-status') != 1){
                $('.text_alert').html("Anda yakin menonaktifkan data ini ?");
            }else{
                $('.text_alert').html("Anda yakin mengaktifkan kembali data ini ?");
            }
            $('#setujukonfirmasi').attr('href',baseurl+$(this).attr('data-link'));
            $('#konfirmasihapus').modal('show');
        });
    });
</script>

</body>
</html>