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
            <div class="title" style="margin-bottom:28px;">
                <h3 class="tit-lv2 grid-div">
                    <div class="left">
                        판매상품목록
                    </div>
                    <!-- <div class="right">
                           
                        <div class="input-item" style="width:220px;">
                            <div class="input-item-inner">
                                <input type="text">
                            </div>
                        </div>
                        <a href="javascript:" class="btn normal sm">검색</a>
                    </div> -->
                </h3>
            </div>
            <div class="tbl crud" id="itemState">
                <table>
                    <tr class="RegRegView">
                        <th>승인상태</th>
                        <td id>
                            <input id="RegRegView" name="RegRegView" type="hidden" value="">
                            <li data_state="0">
                                <a href="javascript:" onclick="OptSearch('1','0')" role="button">임시저장</a>
                            </li>
                            <li data_state="1">
                                <a href="javascript:" onclick="OptSearch('1','1')" role="button">승인요청</a>
                            </li>
                            <li data_state="2">
                                <a href="javascript:" onclick="OptSearch('1','2')" role="button">승인완료</a>
                            </li>
                            <li data_state="3">
                                <a href="javascript:" onclick="OptSearch('1','3')" role="button">취소</a>
                            </li>
                            <li data_state="4">
                                <a href="javascript:" onclick="OptSearch('1','4')" role="button">반려</a>
                            </li>
                            <li data_state="5">
                                <a href="javascript:" onclick="OptSearch('1','5')" role="button">승인불가</a>
                            </li>
                        </td>
                    </tr>
                    <tr class="GsSaleState">
                        <th>전시상태</th>
                        <td>
                            <input id="GsSaleState" name="GsSaleState" type="hidden" value="">
                            <li data_state="0">
                                <a href="javascript:" onclick="OptSearch('2','0')" role="button">전시대기</a>
                            </li>
                            <li data_state="1">
                                <a href="javascript:" onclick="OptSearch('2','1')" role="button">판매중</a>
                            </li>
                            <li data_state="3">
                                <a href="javascript:" onclick="OptSearch('2','3')" role="button">임시보류</a>
                            </li>
                            <li data_state="31">
                                <a href="javascript:" onclick="OptSearch('2','31')" role="button">임시품절</a>
                            </li>
                            <li data_state="32">
                                <a href="javascript:" onclick="OptSearch('2','32')" role="button">영구품절</a>
                            </li>
                            <li data_state="33">
                                <a href="javascript:" onclick="OptSearch('2','33')" role="button">정보오류</a>
                            </li>
                        </td>
                    </tr>
                    <tr class="GsSaleType">
                        <th>상품타입</th>
                        <td>
                            <input id="GsSaleType" name="GsSaleType" type="hidden" value="">
                            <li data_state="1">
                                <a href="javascript:" onclick="OptSearch('3','1')" role="button">마켓</a>
                            </li>
                            <li data_state="2">
                                <a href="javascript:" onclick="OptSearch('3','2')" role="button">펀딩</a>
                            </li>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="listTot">
                <!-- 총개수 -->
            </div>
            <div class="tbl crud emptyPoint">
                <table>
                    <colgroup>
                        <col style="width:30px;">
                        <col style="width:345px;">
                        <col style="width:auto;">
                        <col style="width:auto;">
                        <col style="width:auto;">
                        <col style="width:auto;">
                        <col style="width: 38px;">
                        <col style="width: 38px;">
                        <col style="width: 38px;">
                    </colgroup>
                    <thead>
                        <tr class="headTitle">
                            <th scope="col" class="center">No</th>
                            <th scope="col" class="left">상품명</th>
                            <th scope="col" class="center">미리보기</th>
                            <!-- <th scope="col" class="center">상품코드</th> -->
                            <!-- <th scope="col" class="center">분류</th> -->
                            <th scope="col" class="center">승인상태</th>
                            <th scope="col" class="center">전시상태</th>
                            <th scope="col" class="center">수정상태</th>
                            <th scope="col" colspan="3" class="center">상품관리
                                <a href="#" class="tooltip pdAdm" style="position:relative; top:13px; right:0;">
                                    <span>?</span>
                                    <div class="tooltip-info">
                                        <p>
                                            <img src="../assets/images/ico-edit.png" border="0" style="width:27px;">
                                             &nbsp;상품 수정
                                        </p>
                                        <p style="margin-left: 3px;">
                                            <img src="../assets/images/ico-withdrawal_dark.png" border="0" style="width:23px;">
                                             &nbsp;쿠폰 등록
                                        </p>
                                        <p style="margin-left: 3px;">
                                            <img src="../assets/images/ico-settings.png" border="0" style="width:23px;">
                                             &nbsp;품절 설정
                                        </p>
                                    </div>
                                </a>
                            </th>
                            <!-- <th scope="col" class="center">보기</th> -->
                            <!-- <th scope="col" class="center">삭제</th> -->
                        </tr>
                    </thead>
                    <tbody id="table_acc">

                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <ol class="pagination-inner">

                </ol>
            </div>
        </div>
    </div>
</div>
<?
    include ($real_path.'include/footer.php');
?>    

<style>
.listTot{
    text-align: right;
    padding: 0 5px 5px ;
}
#itemState li.selected a{
    background : #000;
    color: #fff;
    border-radius: 14px;
    position: relative;
} 
/* 
#itemState li.selected:hover a:before{
    position: absolute;
    top: -9px;
    right: -10px;
    background-image: url(../assets/images/ico-remove.png) ;
    background-size: 20px;
    width: 19px;
    height: 19px;
    display: block;
    content: "";
    border-radius: 50%;
    box-shadow: 1px 1px 3px 0px #515151;
} */

.headTitle th{
    border-right: 1px solid #ddd !important;
}
.headTitle th:last-child{
    border-right: 0 !important;
}
.pdAdm{
    top: 4px !important;
    left: 3px;
}

.tooltip span{
    width: 17px;
    height: 17px;
}

.tooltip span:before{
    width: 7px;
}
.tooltip-info{
    top: -97px;
    left: -105px;
    min-width: 173px;
}
.tooltip-info p{
    text-align: left;
        line-height: 3rem;
}


.tbl.crud{
    border: 1px solid #ddd;
}

.itemInfo_box >.soldOut{
    cursor:pointer;
}
.itemInfo_box .num{
    cursor: default;
}
.itemInfo_box td p{
    font-size: 1.4rem;
}

#itemState{
    margin: 30px 0 45px;
    
}
#itemState th{
    border:0;
    padding: 10px;
    background-color: #f1f1f1;
    color: #454545;
    font-size: 1.35rem;
    width: 130px;
    text-align: center;
}
#itemState td{
    border: 0;
    padding: 10px;
    font-size: 1.35rem;
}
#itemState td li{
       list-style: none;
    display: inline-block; 
}
#itemState td li a{
    color: #000;
    padding: 5px 10px;
}


.itemInfo_box:hover{
    background: #ddd;
}
#table_acc > tr > td{
    padding: 17px 10px;
}
.itemInfo_box{
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}
a.sortMode{
    border: 0;
}
.edit,
.coupon,
.soldOut,
.prevIcon a{
    color: #777 !important;
    border: 0 !important;
}
.prevIcon a{
    padding: 3px !important;
}
.prevIcon a:hover{
    color: #000 !important;
}
#table_acc > tr.soldOutHead td{
    display: none;
}
#table_acc > tr.soldOutHead.shown td{
    display: table-cell;
}

#itemName{
    display: inline;
    font-size: 1.4rem;
}
.sortMode{
    display: inline-table;
    margin-right: 8px;
}

.setSold {
    display: inline-block;
    margin-left: -12px;
    font-weight: 500 !important;
    font-size: 1.3rem;
}


/* switch */

input[type="checkbox"] { 
    position: absolute;
    opacity: 0;
}

/* Normal Track */
input[type="checkbox"].ios-switch + div {
    vertical-align: middle;
    width: 40px;    height: 20px;
    border: 1px solid rgba(0,0,0,.4);
    border-radius: 999px;
    background-color: rgba(0, 0, 0, 0.1);
    -webkit-transition-duration: .4s;
    -webkit-transition-property: background-color, box-shadow;
    box-shadow: inset 0 0 0 0px rgba(0,0,0,0.4);
    margin: 15px auto;
}

/* Big Track */
input[type="checkbox"].bigswitch.ios-switch + div {
    width: 71px;    height: 27px;
}

/* Green Track */
input[type="checkbox"].green.ios-switch:checked + div {
    background-color: #519eea;
    border: 1px solid rgba(81 158 234 1);
    box-shadow: inset 0 0 0 10px rgba(81 158 234 1);
}

/* Normal Knob */
input[type="checkbox"].ios-switch + div > div {
    float: left;
    width: 18px; height: 18px;
    border-radius: inherit;
    background: #ffffff;
    -webkit-transition-timing-function: cubic-bezier(.54,1.85,.5,1);
    -webkit-transition-duration: 0.4s;
    -webkit-transition-property: transform, background-color, box-shadow;
    -moz-transition-timing-function: cubic-bezier(.54,1.85,.5,1);
    -moz-transition-duration: 0.4s;
    -moz-transition-property: transform, background-color;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(0, 0, 0, 0.4);
    pointer-events: none;
    margin-top: 1px;
    margin-left: 1px;
}

/* Big Knob */
input[type="checkbox"].bigswitch.ios-switch + div > div {
    width: 23px; 
    height: 23px;
    margin-top: 1px;
}

/* Checked Big Knob  */
input[type="checkbox"].bigswitch.ios-switch:checked + div > div {
    -webkit-transform: translate3d(44px, 0, 0);
    -moz-transform: translate3d(33px, 0, 0);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172,1);
}

/* Green Knob */
input[type="checkbox"].green.ios-switch:checked + div > div {
    box-shadow: 0px 2px 5px rgb(0 0 0 / 30%), 0 0 0 1px rgb(81 158 234 1);
}
td.disabled img{
    opacity:.3;
}

</style>
<script>
    const pagination = null;
    let order_data = null;


    let formCoupon = null;

    let itemCard_html = `
        <tr class="itemInfo_box">
            <td class="center num"></td>
            <td class="left">
                <a href="javascript:" class="btn-crud sm sortMode">펀딩</a>
                <p id="itemName"></p>
            </td>
            <td class="center prevIcon">
                <a href="javascript:" class="btn-crud sm prevPc">
                    <i class="fas fa-desktop fa-lg"></i>
                </a>
                <a href="javascript:" class="btn-crud sm prevM">
                    <i class="fas fa-mobile-alt fa-lg"></i>
                </a>
            </td>
           
            <td class="center fontsize" id="regview">
            </td>
            <td class="center fontsize" id="gssalestate">
            </td>
            <td class="center fontsize" id="regafterview"> 수정상태
            </td>
            <td class="center" style="padding:17px 0;">
                <a href="javascript:" class="btn-crud sm edit" title="상품수정">
                    <img src="../assets/images/ico-edit.png" border="0" style="width:28px;">
                </a>
            </td>
            <td class="center" style="padding:17px 0;">
                <a href="javascript:" class="btn-crud sm coupon" title="쿠폰">
                    <img src="../assets/images/ico-withdrawal_dark.png" border="0" style="width:25px; ">
                </a>
            </td>
            <td class="center" style="padding:17px 0;">
                <a href="javascript:" class="btn-crud sm soldOut" title="품절설정">
                    <img src="../assets/images/ico-settings.png" border="0" style="width:20px; ">
                </a>
            </td>
            
        </tr>
    `;

    let soldOutHead_html = `
        <tr class="soldOutHead">
          <td colspan="10">
            <table>
                <col style="width:50px;  border-right:1px solid #ddd;">
                <col style="width:auto;">
                <col style="width:160px; border-left:1px solid #ddd;">
                <thead>
                    <tr>
                      <th scope="col" class="center">No</th>
                      <th scope="col" class="center">옵션정보</th>
                      <th scope="col" class="center">설정</th>
                    </tr>
                </thead>
                <tbody class="tbody">
               
                </tbody>
            </table>
          </td>
        </tr>
    `;

    let soldOut_html = `
        <tr class="itemInfo_box">
            <td class="center num" style="font-size:1.2rem; color:#777;">1</td>
            <td class="optInfo_box">
                <p id="optName"></p>
                <p id="optDes"></p>
                
            </td>
            <td>
            <form>
                <input type="hidden" id="regcode">
                <input type="hidden" id="regview">
                <input type="hidden" id="gsregstate">
                <input type="hidden" id="gsinvid">
                <input type="hidden" id="gspriid">
                <input type="hidden" id="sbinvid">
                <input type="hidden" id="sbpriid">
                <label>
                    <input type="checkbox" class="ios-switch green  bigswitch" />
                    <div class="soldTxt">
                        <div></div>
                    </div>
                </label>
            </form>
            </td>
        </tr>
    `;

    function send_data(result){


        $('#table_acc').empty();
        $('.noSearch').remove();
        // emptyPoint

        make_pagination(result);

        if(result.total == 0){

            let $noneBox = $('<div>')
            $noneBox.addClass('noSearch');
            $('.emptyPoint').append($noneBox);

            $noneBox.css({
                height : "440px",
                position : "relative",
                width: "100%",
            }); 

            let $noneTxt = $('<p>');
            $noneBox.append($noneTxt);
            $noneTxt.text('등록된 상품이 없습니다.');

            $noneTxt.css({
                position:"absolute",
                top : "50%",
                left:"50%",
                transform : "translate(-50%,-50%)"
            }); 

        }else{

            order_data = result;
            
            let table_acc = $('#table_acc');
            // $('.listTot').text('총 '+ result.total+'개');
            
            result.data.forEach(function(list, idx)
            {
                let $itemCard = $(itemCard_html);

                $itemCard.find('.coupon img').attr({
                    'data_idx': idx,
                    // 'data_rowid': list.rowid,
                });
                // console.log(list);

                if (list.option[0] != undefined && list.option[0].gspriid != undefined)
                {
                    $itemCard.find('.coupon').on('click',function(e){

                        let $target = $(e.target);
                        // let thisRowid = $target.attr('data_rowid');

                        // if(!$(this).parent().hasClass('disabled')){

                            var alert_obj = {
                                "html_url": '/new_pc/assets/html/couponList.html',
                                // attr: thisRowid,
                                param: {
                                    idx: idx,
                                    gs_id: list.gsrowid,
                                },  // 여기는 됬으니...#popup_modal 에 hidden input id='idx' 만들고...
                            }
                            layer_alert(alert_obj);
                            return false;
                        // };
                        
                        // show_stais(e, "coupon");
                        // let $target = $(e.target);
                        // $target.attr('data_rowid');

                        // console.log($target);
                        // // console.log(data);
                        // var alert_obj = {
                        //         "html_url": '/new_pc/assets/html/coupon.html',
                        // }
                        // layer_alert(alert_obj);
                    });
                } else {
                    $itemCard.find('.coupon').parent().addClass("disabled");
                }


                $('#table_acc').append($itemCard);

                $itemCard.find('.itemInfo_box').css({
                    'border-top':'1px solid #777',
                    'border-bottom':'1px solid #777',
                });

                let row_num = (result.page_now - 1) * result.page_max;

                $itemCard.find('.num').text(row_num + idx + 1);
                $itemCard.find('.edit').attr('href', '/CManager/MakeOne.php?RgrCode='+list.regcode+'&amp;edit_rowid='+list.rowid);

                $itemCard.find('.prevPc').on('click', function(){

                    let number = null;

                    if((list.regafterview == 0 || list.regafterview == 2) && list.regview == 2)
                    {
                        number = list.gsrowid;
                    }else{
                        number = list.regcode;
                    }
                    open_preview(number, "desktop");

                });

                $itemCard.find('.prevM').on('click', function(){

                    let number = null;

                    if((list.regafterview == 0 || list.regafterview == 2) && list.regview == 2)
                    {
                        number = list.gsrowid;
                    }else{
                        number = list.regcode;
                    }
                    open_preview(number, "mobile");

                });

                $itemCard.find('.soldOut').on('click', function(){

                    let $target = $(this).parent().parent().next();

                    if($target.hasClass('shown'))
                    {
                        $target.removeClass('shown');
                    }else{
                        $target.addClass('shown');
                    };

                });

                let $soldOutHead = $(soldOutHead_html);
                $itemCard.after($soldOutHead);

                $soldOutHead.find('table').css({
                    // 'width' : '90%',
                    'margin' : '0 auto',
                    "border-bottom" : "0",
                });

                $soldOutHead.find('thead').css({
                    'background' : '#c5dae4',
                    'border-bottom' : '0',
                });

                $itemCard.find('.fontsize').css('font-size','1.2rem');

                $itemCard.find('#itemName').text(list.goodsname);
                // $itemCard.find('#dpState').text(list.gsrowid);

                let sortMode = null;

                if(list.scodeone == "50")
                {
                    if(list.sucesstype == 1){
                        sortMode = '참여 펀딩';
                    }else{
                        sortMode = '후원 펀딩';
                    }
                    
                    $itemCard.find('.sortMode').addClass('nagetive');
                }else{
                    sortMode = '마켓';
                    $itemCard.find('.sortMode').addClass('positive');
                };

                $itemCard.find('.sortMode').text(sortMode);
                $itemCard.find('.sortMode').css('font-size','1.2rem');

                let regTxt = null;
                let afterTxt = null;

                switch(list.regview){

                    case 0 :
                        regTxt = '임시저장';
                        $itemCard.find('#dpState').empty();
                    break;
                    case 1 :
                        regTxt = '승인요청';
                    break;
                    case 2 :
                        regTxt = '승인완료';
                    break;
                    case 3 :
                        regTxt = '취소';
                    break;
                    case 4 :
                        regTxt = '반려';
                    break;
                    case 5 :
                        regTxt = '승인불가';
                    break;
                    default :
                        regTxt = list.regview;
                    break;                      
                };

                switch(list.regafterview){
                    case 0 :
                        afterTxt = '';
                    break;
                    case 1 :
                        afterTxt = '확인중';
                    break;
                    case 2 :
                        afterTxt = '승인';
                    break;
                    case 3 :
                        afterTxt = '취소';
                    break;
                    case 4 :
                        afterTxt = '반려';
                    break;
                    case 5 :
                        afterTxt = '불가';
                    break;
                    default :
                        afterTxt = list.regafterview;
                    break;                    
                };

                $itemCard.find('#regview').text(regTxt);
                $itemCard.find('#regafterview').text(afterTxt);
                
                if(regTxt !== '승인완료')
                {
                    $itemCard.find('#regview').css('color','red');
                };


                let stateTxt = null;

                if (list.regview == 2)
                {
                    switch(list.gssalestate){

                        case 0 :
                            stateTxt = '전시대기';
                        break;
                        case 1 :
                            stateTxt = '판매중';
                        break;
                        case 3 :
                            stateTxt = '임시보류';
                        break;
                        case 5 :
                            stateTxt = '숨김';
                        break;                    
                        case 31 :
                            stateTxt = '임시품절';
                        break;
                        case 32 :
                            stateTxt = '영구품절';
                        break;
                        case 33 :
                            stateTxt = '정보오류';
                        break;
                        case 34 :
                            stateTxt = '도용상품';
                        break;
                        case 35 :
                            stateTxt = '회원탈퇴시 품절';
                        break;                                        
                        default :
                            stateTxt = list.gssalestate;
                        break;

                    };
                } else {
                    stateTxt = "*";
                }

                $itemCard.find('#gssalestate').text(stateTxt);

                
                list.option.forEach(function(opt, idx){

                    let $soldOut = $(soldOut_html);
                    let $parent_form = $soldOut.find("form");
  
                    $parent_form.find("#regcode").val(list.regcode);
                    $parent_form.find("#regview").val(opt.regview);
                    $parent_form.find("#gsregstate").val(opt.gsregview); // 승인 이력이 있으면 2
                    $parent_form.find("#gsinvid").val(opt.gsinvid);
                    $parent_form.find("#gspriid").val(opt.gspriid);
                    $parent_form.find("#sbinvid").val(opt.sbinvid);
                    $parent_form.find("#sbpriid").val(opt.sbpriid);

                    $soldOut.find('.num').text(idx+1);
                    $soldOut.find('td').css('padding','4px 8px');
                    $soldOut.find('.optInfo_box p').css('display','inline-block');


                    let $switchBtn = $soldOut.find('.green');
                    let $soldOutTxt = $(`
                        <p class="setSold" style="font-size:1.3rem;"></p>
                    `);


                    if (opt.regview == "1")
                    {
                        $soldOutTxt.text("판매중"); //defalt!!!
                        $soldOutTxt.css({
                            'margin-left':'-18px',
                            'color' : '#fff',
                        });

                        $switchBtn.attr("checked", true);

                    } else {
                        $soldOutTxt.text("품절");
                            $soldOutTxt.css({
                                'margin-left':'7px',
                                'color' : '#5d5858',
                            });
                    }

                    $soldOut.find('.soldTxt').prepend($soldOutTxt);

                    $switchBtn.on('click', function(){

                        if( $switchBtn.is(":checked") == false )
                        {
                            $soldOutTxt.text("품절");
                            $soldOutTxt.css({
                                'margin-left':'7px',
                                'color' : '#5d5858',
                            });
                            $parent_form.find("#regview").val(1);

                        }else{
                            $soldOutTxt.text("판매중");
                            
                            $soldOutTxt.css({
                                'margin-left':'-18px',
                                'color' : '#fff',
                            });
                            $parent_form.find("#regview").val(0);
                        };

                        setSoldOut($parent_form);
                    });

                    $soldOut.find('#optName').text(opt.catcode);

                    if(opt.optiondes !== "")
                    {
                        $soldOut.find('#optDes').text('('+opt.optiondes+')');    
                    }else{
                        $soldOut.find('#optDes').empty();
                    }
                    $soldOutHead.find('.tbody').append($soldOut);

                    
          
                });
            
                // $itemCard.find('.coupon').on("click", function (e) {
                //         // show_stais(e, "coupon");
                //         //이거 쓸 지 아니면 layer_alert or layer_popup?

                //         let $target = $(e.target);
                //         console.log($target);
                //         var alert_obj = {
                //             // "title": "",
                //             "html_url": '/new_pc/assets/html/coupon.html',
                //             // "message": "",
                //         }

                //         layer_alert(alert_obj);

                //         return false;


                // });

            });
            
            // table_acc.empty();
            // myDoip_pd(result, "satis", table_acc);
        }
        return result;
    }
    //페이지,판매상태,전시상태,펀딩여부

    function setSoldOut($form){


        let post_data = Make_JSON_Data($form);

        async_ajax('/vender/change_sale', post_data, change_result);

    };

    function change_result(result){

    }

    function open_preview(RgrCode, mode) {
        if (mode == "desktop") {
            window.open("/new_pc/product/?mode=detail&pgCode="+RgrCode, 'desktop_'+RgrCode, "width=1300,height=800,top=0,left=0");
        } else {
            window.open("/new_mobile/product/?mode=detail&RegCode="+RgrCode, 'mobile_'+RgrCode, "width=320,height=568,top=0,left=0");
        }
    }

    function OptSearch(ScType, SelVal){

        let state_class = '';

        switch(ScType)
        {
            case "1" : 
                state_class = 'RegRegView';
            break;
            case "2" : 
                state_class = 'GsSaleState';
            break;
            case "3" : 
                state_class = 'GsSaleType';
            break;
        }

        if(SelVal == $("#"+state_class).val()){
            $("#"+state_class).val('');
        }else {
            $("#"+state_class).val(SelVal);
        }

        let $li = $("#itemState ."+state_class+" li");

        $li.each(function(idx, elm) {

            if ($("#"+state_class).val() == $(elm).attr("data_state"))
            {
                $(elm).addClass('selected');
                
            } else {

                $(elm).removeClass('selected');
            }

        });
        
        get_nextPage(1);
    }

    function get_nextPage(page)
    {
        let reg_val = ($('#RegRegView').val() == '') ? "all" : $('#RegRegView').val();
        let sale_val = ($('#GsSaleState').val() == '') ? "all" : $('#GsSaleState').val();
        let type_val = ($('#GsSaleType').val() == '') ? "all" : $('#GsSaleType').val();

        async_ajax('/vender/product_list/'+reg_val+'/'+sale_val+'/'+type_val+'/'+page, '', send_data);
    };

    get_nextPage(1);

</script>