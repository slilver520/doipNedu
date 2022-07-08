<?php

    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);

    $arr = explode("/", $_SERVER['SCRIPT_FILENAME']);

    $file = str_replace("/".$arr[count($arr) - 1], "", $_SERVER['SCRIPT_FILENAME']);

    $real_path = $file."/../";

    $sub_path = "../";

    $HTML_CLASS = "userIndex";

    // $Page_Title = "찜한상품";

    $Select_Flag = true;

	$User_Only = true;

    // include header.php file
    include ($real_path.'include/front_inc.php');

?>
            <div class="app-inner">

<? 
    include ($real_path.'include/my_left.php'); 
?>        

<?
    $microtime = "?".round(microtime(true) * 1000);
?><?//=$microtime?>
<script src="/new_pc/assets/js/def_check.js"></script>

<!-- <div id="viewport"> -->
    <form id="frm_settle" action="/vender/account_write" autocomplete="off">
    <div class="container" id="MyInfo">
        <h3 class="tit-lv1">
            정산정보관리
            <a href="#" class="tooltip">
                <span>?</span>
                <p class="tooltip-info">
                    <em class="nagetive">*입력한 당일만 수정가능합니다.</em><br />
                    정보 변경시 팩스 혹은 이메일 <em class="positive">cs@doip.kr</em>으로 보내주시고 요청하셔야 변경됩니다.
                </p>
            </a>
        </h3>
        <div class="app-cont">
            <div class="title">
                

            </div>
            <div class="tbl crud">
                <table>
                    <colgroup>
                        <col style="width:160px;">
                        <col style="width:300px;">
                        <col style="width:160px;">
                        <col style="width:auto;">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th scope="row" class="left">
                                <label for="#" class="like-label">닉네임</label>
                            </th>
                            <td>
                                <div class="input-item">
                                    <div class="input-item-inner">
                                        <input type="text" id="nickName" readonly value="Nicname"/>
                                    </div>
                                </div>
                            </td>
                            <th scope="row" class="left">
                                <label for="#" class="like-label">이메일</label>
                            </th>
                            <td>
                                <div class="input-item">
                                    <div class="input-item-inner">
                                        <input type="text" id="email" readonly placeholder="email@email.com"/>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="app-cont">
            <div class="title">
                <h3 class="tit-lv2">
                    가입자 유형
                    <a href="#" class="tooltip">
                        <span>?</span>
                        <p class="tooltip-info">
                            <em class="nagetive">*유형에 따라 입력 정보가 바뀝니다.</em>
                        </p>
                    </a>
                </h3>
            </div>
            <div class="tbl crud">
                <table>
                    <tbody>
                        <tr>
                            <th scope="row" class="left" style="width:160px;">
                                <label for="#" class="like-label">회원 유형<em class="nagetive">*</em></label>
                            </th>
                            <td>
                                <div class="input-item">
                                    <div class="input-item-inner toggle attrType">
                                        <label class="radio">
                                            <input type="radio" name="user_type" value="individual" class="individual" checked>
                                            <span>개인</span>
                                        </label>
                                        <label class="radio ">
                                            <input type="radio" name="user_type" value="corporate"  class="corporate">
                                            <span>기업</span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="app-cont">
            <div class="title">
                <h3 class="tit-lv2">
                    입금계좌
                    <a href="#" class="tooltip">
                        <span>?</span>
                        <p class="tooltip-info">
                            <em class="nagetive">*정산받을 은행 계좌를 등록해주세요.</em>
                        </p>
                    </a>

                </h3>
            </div>

            <div class="tbl crud" id="hover">
            <!-- <div class="tbl crud" id="hover" style="display: none;">     -->
                <table>
                    <colgroup>
                        <col style="width:160px;">
                        <col style="width:300px;">
                        <col style="width:160px;">
                        <col style="width:auto;">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th scope="row" class="left">
                                <label for="#" class="like-label">예금주<em class="nagetive">*</em></label>
                            </th>
                            <td>
                                <div class="input-item">
                                    <div class="input-item-inner">
                                        <input type="text" id="bankHolder" placeholder=""/>
                                         <!--  -->
                                    </div>
                                </div>
                            </td>
                            <th scope="row" class="left">
                                <label for="#" class="like-label">은행명<em class="nagetive">*</em></label>
                            </th>
                            <td>
                                <div class="input-item">
                                    <div class="input-item-inner area_bankName">
                                        <input type="text" id="bankName" placeholder=""/>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="left">
                                <label for="#" class="like-label">계좌번호<em class="nagetive">*</em></label>
                            </th>
                            <td>
                                <div class="input-item">
                                    <div class="input-item-inner">
                                        <input type="text" id="bankNum" placeholder="숫자로만 입력해주세요."  autocomplete='new-password' />
                                    </div>
                                </div>
                            </td>
                            <th scope="row" class="left">
                                <label for="#" class="like-label">통장사본<em class="nagetive">*</em></label>
                                <a href="#" class="tooltip">
                                    <span>?</span>
                                    <p class="tooltip-info">
                                        <em class="nagetive">*반드시 위 이름/상호(법인명)과 동일.</em>
                                        JPG파일만 가능 - 등록 당일만 수정가능, 판매자 정산시 사용됩니다.
                                    </p>
                                </a>
                            </th>
                            <td>
                                <div class="input-item">
                                    <div class="input-item-inner preview-image area_account">
                                        <img id="bankimg" style="max-height: 100px;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="app-cont">
            <div class="title">
                <h3 class="tit-lv2">
                    세금계산서
                    <a href="#" class="tooltip">
                        <span>?</span>
                        <p class="tooltip-info">
                            <em class="nagetive">*입력하신 정보로 수수료에 대한 전자세금계산서를 발행해 드립니다.</em><br />
                            <!-- 정보 변경시 팩스 혹은 이메일 <em class="positive">cs@doip.kr</em>으로 보내주시고 요청하셔야 변경됩니다. -->
                            크리에이터의 판매액에 관한 자료와 크리에이터 정보는 국세청으로 전달됩니다.
                        </p>
                    </a>
                </h3>
            </div>
            <div class="tbl crud">
                <div class="tbl crud type_A" style="border:none;">
                    <table>
                        <colgroup>
                            <col style="width:160px;">
                            <col style="width:300px;">
                            <col style="width:160px;">
                            <col style="width:auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">이름<em class="nagetive">*</em></label>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="username" placeholder=""/>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">휴대폰번호<em class="nagetive">*</em></label>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="phoneNum" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">주민등록번호<em class="nagetive">*</em></label>
                                    <a href="#" class="tooltip">
                                        <span>?</span>
                                        <p class="tooltip-info">
                                            <em class="nagetive">입력하신 주민등록번호는 세금계산서(영수증)를 발행하기 위해서만 사용됩니다.<br/>
                                            중요 개인 정보이므로 신중하게 기입해 주세요.</em> 
                                        </p>
                                    </a>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner" id="verifyNum">
                                                <INPUT TYPE="text" id="jumin1" class="verifyNum" MAXLENGTH="6" SIZE="6">
                                                -
                                                <INPUT TYPE="password" id="jumin2" class="verifyNum" id="verifyNum" MAXLENGTH="7" SIZE="7">
                                            <p class="frm-error" id="verifyNum_error"></p>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">신분증 사본<em class="nagetive">*</em></label>
                                    <a href="#" class="tooltip">
                                        <span>?</span>
                                        <p class="tooltip-info">
                                            <em class="nagetive">*반드시 위 이름과 동일</em><br/>
                                            JPG파일만 가능 - 등록 당일만 수정가능, 판매자 정산시 사용됩니다.
                                        </p>
                                    </a>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner preview-image area_id">
                                        <img id="idimg" style="max-height: 100px;">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tbl crud type_B" style="display:none;">
                    <table>
                        <colgroup>
                            <col style="width:160px;">
                            <col style="width:300px;">
                            <col style="width:160px;">
                            <col style="width:auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">상호(법인명)<em class="nagetive">*</em></label>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="corname"/>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">대표자명<em class="nagetive">*</em></label>
                                    
                                </th>
                                <td colspan="2">
                                     <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="corHeader"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <th scope="row" class="left">
                                    <label for="#" class="like-label">사업자번호<em class="nagetive">*</em></label>
                                    <a href="#" class="tooltip">
                                        <span>?</span>
                                        <p class="tooltip-info">
                                            <em class="nagetive">정산시에만 사용</em><br/> 입력 후 수정은 별도요청, 중복불가
                                        </p>
                                    </a>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" placeholder="'-'없이" id="corNum"/>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">담당자<em class="nagetive">*</em></label>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="corcharge"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">연락처<em class="nagetive">*</em></label>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text"  placeholder="'-'없이" id="corTel"/>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">이메일<em class="nagetive">*</em></label>
                                    
                                </th>
                                <td colspan="2">
                                     <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="corEmail"/>
                                             <!-- id="cor_telnum" -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">업태<em class="nagetive">*</em></label>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="conditions"/>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">업종<em class="nagetive">*</em></label>
                                    
                                </th>
                                <td colspan="2">
                                     <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="cortype"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">사업자등록 사본<em class="nagetive">*</em></label>
                                    <a href="#" class="tooltip">
                                        <span>?</span>
                                        <p class="tooltip-info">
                                            <em class="nagetive">*반드시 위 이름과 동일</em><br />
                                            JPG파일만 가능 - 등록 당일만 수정가능, 판매자 정산시 사용됩니다.
                                        </p>
                                    </a>
                                </th>
                                <td colspan="3">
                                    <div class="input-item" style="width:38%;">
                                        <div class="input-item-inner preview-image area_cor">
                                        <img id="cor_file" style="max-height: 100px;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">우편번호<em class="nagetive">*</em></label>
                                </th>
                                <td>
                                  <div class="input-item">
                                    <div class="input-item-inner area_zipcode">
                                      <input type="text" id="corZipcode" name="corZipcode" class="min" readonly />
                                    </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">주소<em class="nagetive">*</em></label>
                                </th>
                                <td colspan="3">
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" id="corAddress" readonly="true" />
                                             <!-- id="corReg_num" -->
                                        </div>
                                    </div>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="text" placeholder="상세 주소를 입력해 주세요." id="corAddressSub"/>
                                             <!-- id="corReg_num" -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <div class="app-cont only_input" style="margin-bottom: 50px; width:50%;">
                <div class="title">
                    <h3 class="tit-lv2">
                        비밀번호 확인
                        <a href="#" class="tooltip">
                            <span>?</span>
                            <p class="tooltip-info">
                                <em class="nagetive">*회원정보에 기록된 비밀번호를 입력해주세요.</em><br />
                                
                            </p>
                        </a>
                    </h3>
                </div>
                <div class="tbl crud">
                    <table>
                        <tbody>
                            <tr>
                                <th scope="row" class="left">
                                    <label for="#" class="like-label">도입 계정 비밀번호<em class="nagetive">*</em></label>
                                </th>
                                <td>
                                    <div class="input-item">
                                        <div class="input-item-inner">
                                            <input type="password" id="pwd" placeholder="" autocomplete='new-password' />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="row right only_input">
                <div class="column">
                    <div class="grid-div">
                        <div class="left">
                            <label class="checkbox">
                                <input class="checkItem" type="checkbox" id="agree"><span>위 내용은 입력한 당일만 수정 가능합니다. 이후 수정은 고객센터로 요청해주세요.<em class="nagetive">*</em></span>
                            </label>
                        </div>
                        <div class="right">
                            <!-- <a href="#" class="btn natural sm">취소</a> -->
                            <button class="btn positive sm disabled" id="btn_input">입력완료</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
    </div>
</div>


<script>
    let User_Info = null;
    let error_msg;
    let com_value = false;
    let arr_check = make_default(com_value);

    function make_default(p_value)
    {
        return {
            bankHolder: {
                necessary: true,
                regexp: "not-spec",
            },
            bankName: {
                necessary: true,
            },
            account_file: {
                necessary: true,
            },
            bankNum: {
                necessary: true,
                regexp : "number",
            },

            username: {                     //이름
                necessary: !p_value,
            },
            jumin1: {                    //주민번호1
                necessary: !p_value,
                regexp : "number",
            },
            jumin2: {                    //주민번호2
                necessary: !p_value,
                regexp : "number",
            },
            phoneNum: {                     //폰번호
                necessary: !p_value,
                regexp : "hp",
            },
            id_file: {                      //신분증 사본
                necessary: !p_value,
            },

            corname: {                      //상호
                necessary: p_value,
            },
            corHeader: {                    //대표자명
                necessary: p_value,
            },
            corNum: {                       //사업자번호
                necessary: p_value,
                regexp : "coreg",
            },
            corcharge: {                       //담당자
                necessary: p_value,
            },
            corTel: {                       //연락처
                necessary: p_value,
                regexp : "tel",
            },

            corEmail: {                     //이메일
                necessary: p_value,
                regexp : "email",
                // regexp: {
                //     regexp : /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i,
                //     reg_error : "이메일 주소가 부정확 합니다.",
                // }
            },
            conditions: {                   //업태
                necessary: p_value,
            },
            cortype: {                       //업종
                necessary: p_value,
            },
            cor_file: {                     //사업자등록 사본
                necessary: p_value,
            },
            corZipcode: {                   //우편번호
                necessary: false,
            },
            corAddressSub: {                //상세주소
                necessary: p_value,
            },

            pwd: {
                necessary: true,
            },
            agree: {
                necessary: true,
            },
        }
    }

    let def_config = {
        err_class: '',
        arr_check: arr_check,
        reload: true,               // result = "success" 일때 페이지 새로고침
        callback: null,        // json Data 를 callbank 함수로 전달함
    }

    let frm_settle = null;

    function userInfo(data){
        User_Info = data.data;

        let nickName = User_Info.user_name;
        let email = User_Info.user_email;

        $('input[id="nickName"]').val(nickName);
        $('input[id="email"]').val(email)

        if (User_Info.user_type == undefined)
        {
            let bank_select = `
                <select class="" id="bankName">
                    <option value="">은행을 선택하세요.</option>
                    <option value="신한은행">신한은행</option>
                    <option value="국민은행">국민은행</option>
                    <option value="우리은행">우리은행</option>
                </select>`;

            $(".area_bankName").empty().append($(bank_select));

            let arr_id = ["account", "id", "cor"];

            arr_id.forEach( function (file_id)
            {
                let file_upload = $(`
                    <input type="text" class="upload-name" value="선택된 파일이 없음" disabled="disabled">

                    <label class="upload">업로드</label> 
                    <input type="file" class="upload-hidden">`);

                let area = $(".area_"+file_id);

                area.empty().append(file_upload);
            
                area.find('.upload').attr('for', file_id + "_file")
                area.find('input[type="file"]').attr('id',  file_id + "_file")
                area.find('input[type="text"]').attr('id',  file_id + "_name")
            })

            let zipcode = `<a href="#" class="btn natural sm" onclick="postcode();   return false;">우편번호찾기</a>`

            $(".area_zipcode").append($(zipcode))

            frm_settle = $("#frm_settle").def_check(def_config);

            frm_settle.on('Def_Check.change', function(event, target) {
                // console.log(target);
                }
            ).on('Def_Check.invalid_value',
                function(event, key, obj, msg) {
                    console.log(key, msg);
                }
            ).on('Def_Check.all_true',
                function(event) {
                    // 입력값이 모두 정상적이면...
                    // active_buy();
                }
            ).on('Def_Check.api_result',
                function(event, result, json) {
                    // ajax 결과값 리턴
                    // active_buy();
                    // console.log(result);
                }
            )

            // 외부에서 plugin의 public funtion 호출시...
            // $("#frm_settle").def_check("setDefault");
            // $("#frm_settle").def_check("send_data");

            $('.attrType input').click(function(e){

                let $elm = $(e.target);
                // let com_value = false;

                frm_settle[0].reset();

                if($elm.hasClass('individual'))
                {
                    $('.type_A')    //개인
                    .attr("style","display:block;")
                    .attr("style","border:none;");

                    $('.type_B').attr('style','display:none;');

                    com_value = false;
                }else if($elm.hasClass('corporate')){
                    $('.type_A').attr('style','display:none;');

                    $('.type_B')    //기업
                    .attr("style","display:block;")
                    .attr("style","border:none;");

                    com_value = true;
                }

                $elm.prop("checked", true);

                let nickName = User_Info.user_name;
                let email = User_Info.user_email;

                $('input[id="nickName"]').val(nickName);
                $('input[id="email"]').val(email);

                let tmp_check = make_default(com_value);

                frm_settle.def_check('setValue', tmp_check);
            });
        } else {
            // $('input[name="user_type"]').prop("checked",false);

            if (User_Info.user_type == 1) // 개인회원
            {
                $('input[id="username"]').val(User_Info.bi_charge);
                $('input[id="phoneNum"]').val(User_Info.user_hp);
                $('input[id="jumin1"]').val(User_Info.user_jumin1);
                $('input[id="jumin2"]').val(User_Info.user_jumin2);
            } else if (User_Info.user_type == 2) // 기업회원
            {
                $('.type_A').attr('style','display:none;');

                $('.type_B')    //기업
                .attr("style","display:block;")
                .attr("style","border:none;");
                                
                $('input[name="user_type"][value="corporate"]').prop("checked", true).trigger("click")

                $('input[id="corname"]').val(User_Info.bi_comname);
                $('input[id="corHeader"]').val(User_Info.bi_ceoname);
                $('input[id="corcharge"]').val(User_Info.bi_charge);
                $('input[id="corNum"]').val(User_Info.bi_companynum);

                $('input[id="corTel"]').val(User_Info.bi_offtel);
                $('input[id="corEmail"]').val(User_Info.bi_email);
                $('input[id="conditions"]').val(User_Info.bi_conditions);
                $('input[id="cortype"]').val(User_Info.bi_category);

                $('input[id="corZipcode"]').val(User_Info.bi_zipcode);
                $('input[id="corAddress"]').val(User_Info.bi_address);
                $('input[id="corAddressSub"]').val(User_Info.bi_addresssub);

            }

            $('.attrType input').off("click").on("click", function() {
        		var previousSelected =  $('input[name="user_type"]:checked');

                previousSelected.checked = true;
                return false;
            });

            $('input[type="file"]').remove();
            $('.only_input').remove();
            $('.tooltip').remove();
            $('em.nagetive').remove();

            $('input[id="bankHolder"]').val(User_Info.bi_bankacc);
            $('#bankName').val(User_Info.bi_bankname).off("click")
            // $('.upload-name').val(User_Info.bi_bankimg);
            $('input[id="bankNum"]').val(User_Info.bi_banknum);
            $('img[id="bankimg"]').attr("src", User_Info.bi_bankimg);

            $('img[id="idimg"]').attr("src", User_Info.bi_file);

            $("#frm_settle").find("input").attr("readonly", true)

        }
    }
    
    // async_ajax('/user/userinfo', '', userInfo);
    async_ajax('/vender/account_info', '', userInfo);

</script>

<script>

    function postcode(){
        new daum.Postcode(
        {
            oncomplete: function(data) {

                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                  if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;

                  } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                  }

                  if(data.userSelectedType === 'R'){
                    if(data.bname !== ''){
                      extraAddr += data.bname;
                    }
                    if(data.buildingName !== ''){
                      extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                  }

                  document.getElementById('corZipcode').value = data.zonecode; //5자리 새우편번호 사용
                  document.getElementById('corAddress').value = fullAddr;

                //   document.getElementById('corAddressSub').focus().setSelectionRange(0, this.value.length);
            }
        },
        {
            onclose: function(state) {
                console.log("close");
            }
        }).open();
    }

</script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
