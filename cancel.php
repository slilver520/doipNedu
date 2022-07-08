<?php

    $arr = explode("/", $_SERVER['SCRIPT_FILENAME']);

    $file = str_replace("/".$arr[count($arr) - 1], "", $_SERVER['SCRIPT_FILENAME']);

    $real_path = $file."/../";

    $sub_path = "../";

    $HTML_CLASS = "userIndex cancel";

    $User_Only = true;

    // include header.php file
    include ($real_path.'include/front_inc.php');

?>

<div class="app-inner">

<?
    include ($real_path.'/include/my_left.php');
?>
    <div class="container">
        <div class="app-cont">
            <div class="title">
                <h3 class="tit-lv2">
                    취소/검수관리
                    <a href="#" class="tooltip" style="position:relative; top:13px; right:0;">
                        <span>?</span>
                        <p class="tooltip-info" style="">
                            <!-- <em class="nagetive"> -->
                                취소관리 &nbsp;:&nbsp; 환불·승인취소 내역을 보여줍니다.<br/>
                                검수관리 &nbsp;:&nbsp; 다운받은 파일에 문제가 있을 경우 검토 요청
                            <!-- </em><br> -->
                        </p>
                    </a>
                </h3>
            </div>
            <ul class="title-tab row  inner-tab">
                <li class="column tab on">
                    <a href="javascript:" id="cancelTab" onclick="CCmode(this.id, 'cancel')">취소관리</a>
                </li>
                <li class="column tab ">
                    <a href="javascript:" id="confirmTab" onclick="CCmode(this.id, 'confirm')">검수관리</a>
                </li>
            </ul>
            <ol class="list-report" id="CC_acc">
           
            </ol>
        </div>
    </div>
</div>
<?
    include ($real_path.'include/footer.php');
?>

<style>

.title-tab li{
    background: aliceblue;
}

</style>
<script>

    let cancelTxt_html = `
        <div class="right20" style="position:absolute; right:3%; top:50%; transform:translateY(-50%);">
            <div class="list-btn">
                <div>
                    <a href="javascript:" class="use-status"><em class="nagetive">결제취소</em></a>
                </div>
            </div>
        </div>
    `;

    let confirmBtn_html = `
        <div class="right20" style="position:absolute; right:3%; top:50%; transform:translateY(-50%);">
            <div class="list-btn">
                <div>
                    <a href="javascript:" class="btn-crud positive" id="confirmBtn" onclick="confirmWr(this);">검수 요청</a>
                </div>
            </div>
        </div>
    `;

    let order_data = null;
    let work_mode = null;
    // let $btn = null;
    // $('#confirmBtn').on('click', function(e){
                
    //     show_stais(e, 'confirm'); 
    // });
   function send_data(result)
    {
        if(result.total == 0)
        {
            $('#CC_acc').empty();

            var $noneBox = $('<div>')
            $('#CC_acc').append($noneBox);
            $('#CC_acc').css('min-height','440px');
            $noneBox.css({
                height : "440px",
                position : "relative"
            }); 

            var $noneTxt = $('<p>');
            $noneBox.append($noneTxt);
            $noneTxt.text('구매 내역이 없습니다.');
            $noneTxt.css({
                position:"absolute",
                top : "50%",
                left:"50%",
                transform : "translate(-50%,-50%)"
            }); 

        }else{

            let listData = null;
            let ordState = null;
            order_data = result;

            result.data.forEach(function(list){
                 ordState = list.list_data.orderstate;
                 listData = null;
            });

            let addCC = $('#CC_acc');
            myDoip_pd(order_data, "CC_acc", addCC);

            if(work_mode == "cancel")
            {
                let $cancelTxt = $(cancelTxt_html);
                let stateTxt = null;

                switch(ordState){
                    case 1 :
                    stateTxt = '결제완료 '
                    break;
                    case 10 :
                    stateTxt = '구매취소 '
                    break;
                    case 30 :
                    stateTxt = '환불·승인취소 신청 '
                    break;                  
                    case 31 :
                    stateTxt = '환불·승인취소 접수 '
                    break;                  
                    case 32 :
                    stateTxt = '환불·승인취소 완료 '
                    break;
                };

               $cancelTxt.find('.nagetive').text(stateTxt);
               $cancelTxt.find('.nagetive').parent().css('cursor','default');

                $('.cardWrap').append($cancelTxt);
                $('.right20').css('right','0');
                $('.list-btn').css({
                    'text-align' : 'center',
                    'margin-right' : '25px'
                });  

            }else{

                $('.cardWrap').each((idx, elm) => {
                    let card = $(elm);

                    let rowid = $(elm).parent().parent().attr("data_rowid");

                    let $confirmBtn = $(confirmBtn_html);

                    $confirmBtn.find("a").attr({
                        "ordrowid" : rowid,
                    });

                    card.append($confirmBtn);
                })

                // $pdList.attr('data_rowid', list.rowid);

                // $confirmBtn.find('.positive').attr('data_rowid','');
                // console.log(list);

            };
        };
    };


    function CCmode(id, mode){

        $('#CC_acc').empty();

        var getId = id;
        if(getId == "cancelTab")
        {
            mode = "cancel";
            $('#confirmTab').parent().removeClass('on');
            $('#cancelTab').parent().addClass('on');

        }else{

            mode = "confirm";
            $('#cancelTab').parent().removeClass('on');
            $('#confirmTab').parent().addClass('on');
        };

        work_mode = mode;

        async_ajax('/user/history/'+mode, '', send_data);

    };

    $("#cancelTab").trigger("click");

    function confirmWr(elm){

        let ordrowid = $(elm).attr("ordrowid");
        let ordData = null;

        order_data.data.forEach(function(result) {

            if (result.list_data.rowid = ordrowid)
            {
                ordData = result;
            }
        });

        let orregcode = ordData.list_data.orregcode;
        let gsname = ordData.product_data.GoodsName;
        let goodsoptionnum = ordData.list_data.goodsoptionnum;
        let orgrowid = ordData.product_data.RegCode;
        let gsid = ordData.list_data.gsid;
        let gsoptid = ordData.product_data.RegCode;

        let alert_obj = {

            "html_url": '/new_pc/assets/html/write_confirm.html',
            "param":
            {
                "mode": 'user',
                // "mode": 'vender',<-판매자
                "ordrowid": ordrowid,
                "orregcode": orregcode,
                "gsname": gsname,
                "orgrowid": 0,
                "gsid": gsid,
                "goodsoptionnum": goodsoptionnum,
                "last_rowid" : 0,
                //마지막에 등록한것 0 default
            },
        };

        layer_alert(alert_obj);

        // complaint_story/<str:com_rowid>


        let url = "/user/complaint_story/" + ordrowid;

        async_ajax(url, '', process_history);

        let $form = $('#ComplainWr');

        $('#confirmReg').on('click', function(){

            formSubmit();
        });

         $('#textBox').keydown(function(event){

            if(event.keyCode == 13){
               formSubmit(); 
            }
        });

        function formSubmit(){

            if( $("#textBox").val() == "" || $("#textBox").val() == "\n" ){

                $('#confirmReg').addClass('disabled');

                var config = {
                    // "title": "만족도 등록 완료",
                    "html_url": "/new_mobile/assets/html/alert.html",
                    "message" : '입력된 내용이 없습니다.',
                    "buttons": [
                    {
                        "btn_text" : "확인",
                        "callback": "close",
                    },
                    
                    ]
                }
                $('.modal-inner').attr('style','max-width:350px;');
                layer_alert(config);
                return false;
            }else{

                $('#confirmReg').removeClass('disabled');
                $form.find("#context").val($("#textBox").val());
                $form.submit();

                $("#textBox").val('');
                return false;
            }
        };

        $form.on("submit", function(){

            let json_data = Make_JSON_Data($form);

            async_ajax($form.attr('action'), json_data, process_history);

            return false;
        });
    };

    function process_history(result)
    {
        let typeCom = result.ordcomplaint;
        append_chat(result.data);
    }

    function append_chat(story)
    {
        let who = null;

        let mode = "user";

        story.forEach(function(data) {

            if (mode == "user"){
                switch (true) {
                    case (data.writeid != ""):
                        who = "self";
                        break;
                    case (data.gswriteid != ""):
                        who = "판매자";
                        break;
                    default:
                    // case (data.siteadmid != ""):
                        who = "관리자";
                        break;
                }
            }else if(mode == 'vender')
            {
                switch (true) {
                    case (data.writeid != ""):
                        who = "구매자?";
                        break;
                    case (data.gswriteid != ""):
                        who = "self";
                        break;
                    default:
                    // case (data.siteadmid != ""):
                        who = "관리자";
                        break;
                }
            }
            append_message(who, data.rowid, data.context, data.regdate);
        });

        $('#scrPoint').scrollTop($('#scrPoint')[0].scrollHeight);

    }

    // append_message('self', $chat_input.val(), getTimeStamp());
    function append_message(who, last_rowid, message, datetime)
    {
    // var $main_box = $("main");

        let chatBox_html = `
            <li>
            <div class="chat-box">
                <span class="user-id">Student</span>
                    <span class="time"></span>
                <p class="user-talk">
                    
                </p>
            </div>
            </li>
        `;

        if (who == 'self') {

            // who = "나";
            chatBox_html = `
                <li class="user">
                    <div class="chat-box">
                        <span class="time"></span>
                        <p class="user-talk">
                            
                        </p>
                    </div>
                </li>
            `;
        }

        let $chatBox = $(chatBox_html);

        if (who !== 'self') {
            let $userId = $chatBox.find('.user-id');
            $userId.text(who);
        };

        let $datatime = $chatBox.find('.time');
        let $message = $chatBox.find('.user-talk');

        // $name.text(who);
        $message.html(message);
        $datatime.text(datetime);

        $chatBox.appendTo($('#chatWrap'));

        let $form = $('#ComplainWr');

        $form.find("#last_rowid").val(last_rowid);
    }

    let $textBox = $("#textBox");
    let process_input = function(result) {

      append_message('self', $textBox.val(), getTimeStamp());
      $textBox.val("").focus();
      
    };

    function getTimeStamp() {
      var d = new Date();
      var s =
        leadingZeros(d.getFullYear(), 4) + '-' +
        leadingZeros(d.getMonth() + 1, 2) + '-' +
        leadingZeros(d.getDate(), 2) + ' ' +

        leadingZeros(d.getHours(), 2) + ':' +
        leadingZeros(d.getMinutes(), 2) + ':' +
        leadingZeros(d.getSeconds(), 2);

      return s;
    }

    function leadingZeros(n, digits) {
      var zero = '';
      n = n.toString();

      if (n.length < digits) {
        for (i = 0; i < digits - n.length; i++)
          zero += '0';
      }
      return zero + n;
    }


</script>