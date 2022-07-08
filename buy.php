<?php

    if (!isset($_POST['division']))
    {
      header('Location: ../');
      exit;
    }

    if (!isset($_POST['orregcode']))
    {
echo '
      <script type="text/javascript">
        alert("주문정보를 찾을수 없습니다.");
        document.location.href = "../";
      </script>
';

      exit;      
    }

    $division=$_POST['division'];
    $orregcode=$_POST['orregcode'];

    // echo $division . " : " .$orregcode;

    // error_reporting(E_ALL | E_STRICT);
    // ini_set('display_errors', 1);

    $arr = explode("/", $_SERVER['SCRIPT_FILENAME']);

    $file = str_replace("/".$arr[count($arr) - 1], "", $_SERVER['SCRIPT_FILENAME']);

    $real_path = $file."/../";

    $sub_path = "../";

    $HTML_CLASS = "buy";

    $User_Only = true;

    $Page_Title = "결제하기";

    // include header.php file
    include ($real_path.'include/front_inc.php');

?>
    
    <div class="container">

      <section class="app-section">
        <div class="app-inner">
          <div class="box-step title">
            <ol class="row">
              <li class="column cart complite">
                <span class="count">01</span>
                <div class="tit">장바구니</div>
              </li>
              <li class="column credit">
                <span class="count">02</span>
                <div class="tit">주문/결제</div>
              </li>
              <li class="column check yet">
                <span class="count">03</span>
                <div class="tit">주문완료</div>
              </li>
            </ol>
          </div>


          <div class="list-report">

            <div class="list-report-item" id="ordInfo_pd">
              <ul>

              </ul>
            </div>
          </div>
            <div id="cart_pd_price">
                <div class="view-product">
                    <div class="option-result">
                        <div class="grid-div">
                            <div class="right">
                                <dl>
                                    <dt>총 <em class="positive" id="totSum">0</em>개의 상품 합계</dt>
                                    <dd class="num" id="totPrice">0</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>

      <form method="post" action="/user/payment" id="request_pay">
          <input type="hidden" id="orregcode" value="<?=$orregcode?>">
          <input type="hidden" id="Parameter" value="desktop">
          <input type="hidden" id="SettleType" value="">
          <input type="hidden" id="product_name" value="">
          <input type="hidden" id="total_price" value="">
      <section class="app-section">
        <div class="app-inner">

          <div class="app-cont">
            <div class="title">
              <h3 class="tit-lv2 grid-div">
                주문자정보 <p class="frm-error" id="" style="display: inline-block; font-size: 1.7rem; color: #f32424;"></p>
              </h3>
            </div>

            <div class="tbl">
              <table>
                <colgroup>
                  <col style="width:160px;">
                  <col style="width:400px;">
                  <col style="width:160px;">
                  <col style="width:auto;">
                </colgroup>
                <tbody>
                  <tr>
                    <th scope="row" class="left">
                      <label for="#" class="like-label">주문자명<em class="nagetive">*</em></label>
                    </th>
                    <td>
                      <div class="input-item">
                        <div class="input-item-inner">
                          <input type="text" id="name" class="name" />
                        </div>
                      </div>
                    </td>
                    <th scope="row" class="left">
                      <label for="#" class="like-label">이메일</label>
                    </th>
                    <td>
                      <div class="input-item">
                        <div class="input-item-inner">
                          <input type="text" id="email" readonly="" />
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <th scope="row" class="left">
                      <label for="#" class="like-label">휴대폰<em class="nagetive">*</em></label>
                    </th>
                    <td>
                      <div class="input-item">
                        <div class="input-item-inner">
                          <input type="text" id="phoneNum" placeholder="-없이" />
                        </div>
                      </div>
                    </td>
                    <th scope="row" class="left">
                      <label for="#" class="like-label">전화번호</label>
                    </th>
                    <td>
                      <div class="input-item">
                        <div class="input-item-inner">
                          <input type="text" id="telNum" placeholder="-없이" />
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr class="sort_modeF">
                    <th scope="row" class="left">
                      <label for="#" class="like-label">우편번호<em class="nagetive">*</em></label>
                    </th>
                    <td>
                      <div class="input-item">
                        <div class="input-item-inner">
                          <input type="text" id="zip_code"  name="zip_code" class="min" readonly/>
                          <a href="#" class="btn natural sm" onclick="postcode();   return false;">우편번호찾기</a>
                        </div>
                      </div>
                    </td>
                    <th scope="row" class="left">
                      <label for="#" class="like-label">주소</label>
                    </th>
                    <td>
                      <div class="input-item-inner">
                        <input type="text" id="address" name="address" readonly>
                        <input type="text" id="add_detail"  name="add_detail" placeholder="상세주소를 입력해주세요."/>
                      </div>
                    </td>
                  </tr> 

                  <tr class="sort_modeF">
                    <th scope="row" class="left">
                      <label for="#" class="like-label">주문메세지</label>
                    </th>
                    <td colspan="3">
                      <div class="input-item">
                        <div class="input-item-inner">
                          <textarea rows="8" cols="80" id="add_msg" name="add_msg"></textarea>
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
              <h3 class="tit-lv2 grid-div">
                결제정보
              </h3>
            </div>
<!-- 무료면 무료이용 -->
            <div class="tbl">
              <table>
                <colgroup>
                  <col style="width:160px;">
                  <col style="width:400px;">
                  <col style="width:160px;">
                  <col style="width:auto;">
                </colgroup>
                <tbody>
                  <tr>
                    <th scope="row" class="left">
                      <label for="#" class="like-label">결제방법<em class="nagetive">*</em></label>
                    </th>
                    <td>
                      <div class="input-item">
                        <div class="input-item-inner">
                          <div class="like-select exclusive">
                            <a href="#" class="change-status" id="price_free">결제수단을 선택하세요.</a>
                            <ul class="absolute" id="freeType">
                              <li class="single"><a href="#" class="like-select-item" onclick="select_type(this);return false;" data-paytype="creditcard">일반신용카드</a></li>

                              <li class="single"><a href="#" class="like-select-item" onclick="select_type(this);return false;" data-paytype="banktransfer">무통장</a></li>

                              <li class="single"><a href="#" class="like-select-item" onclick="select_type(this);return false;" data-paytype="kakaopay">카카오페이</a></li>

                              <li class="single"><a href="#" class="like-select-item" onclick="select_type(this);return false;" data-paytype="payco">페이코</a></li>
                            </ul>
                          </div>


                        </div>
                      </div>
                    </td>
                    <td colspan="3">
                      <em class="nagetive" id="pay_result" style="color:#131313;"></em>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>

          </div>

          <div class="app-cont sort_modeM" >
            <div class="title">
              <h3 class="tit-lv2 grid-div" id="license">
                라이센스 규정과 사용권 동의 <p class="frm-error" id="license_error" style="display:none;">라이센스 규정을 확인해주세요.</p>
              </h3>
            </div>
            <div class="tbl">
              <table>
                <colgroup>
                  <col style="width:160px;">
                  <col style="width:400px;">
                  <col style="width:160px;">
                  <col style="width:auto;">
                </colgroup>
                <tbody>
                  <tr>
                    <td colspan="3">
                      <label class="checkbox"  id="license_txt"style="padding:10px 0;">
                          <input type="checkbox" id="license_input" onclick="">
                          <span>라이센스 규정을 확인하였습니다.<em class="nagetive">*</em></span>
                      </label>
                      <p id="sortAgree">

                        콘텐츠마켓 상품은 결제 후 48시간 이내 최대 2회까지 다운로드가 가능하며, 다운로드 이후에는 구매취소가 불가함을 확인하였습니다. <br/>
                        
                        다운로드를 받지 않았더라도 결제 시점으로부터 48시간이 경과하면 해당 컨텐츠에 대한 사용권 동의를 한 것으로 간주하여 환불이 불가함을 확인하였습니다.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
             </div>
          </div>     
          <div class="row center submit-btn-set">
            <a href="#" class="btn natural lg" onclick="history.back(); return false;">취소하기</a>
            <a href="javascript: " class="btn positive lg disabled" id="btn_buy" onclick="check_Delivery()" >결제하기</a>
          </div>
        </div>

      </section>
    </form>

      <form name="payletter_fm"  method=POST action=""> <!--승인요청 및 결과수신페이지 지정 //-->
        <input  type="hidden" name="rsRegRDCtCode" value=""><!-- PSYS 가맹점ID  [필수] -->

        <input  type="hidden" name="allat_shop_id" value=""><!-- PSYS 가맹점ID  [필수] -->
        <input  type="hidden" name="allat_order_no" value=""> <!--  상품 주문번호-->
        <input  type="hidden" name="allat_amt" value="">  <!-- 결제금액 [필수]-->
        <input  type="hidden" name="allat_pmember_id" value="">  <!-- 결제금액 [필수]-->
        <input  type="hidden" name="allat_product_cd" value="">    <!--  상점상품코드-->
        <input  type="hidden" name="allat_product_nm" value="">    <!--  상점상품명-->
        <input  type="hidden" name="allat_buyer_nm" value=""> <!--  결제자성명  -->
        <input  type="hidden" name="allat_recp_nm" value=""> <!--  수취인성명  -->
        <input  type="hidden" name="allat_recp_addr" value="">  <!--  수신 주소 (한글시 인코딩처리) [필수]-->
        <input  type="hidden" name="allat_email_addr" value=""> <!--  결제 정보 수신 E-mail  에스크로 서비스 사용시에 필수 필드 -->
      </form>

<script type="text/javascript">

  let error_msg;

  let check_name = false;
  let check_num = false;
  let check_zipcode = false;
  let check_type = false;
  let check_agree = false;

  function  select_type(elm)
  {
    let $elm = $(elm);
    let pay_type = $elm.attr("data-paytype");
    let str_type = $elm.text();

    let str_result = $("#pay_result");

    let SettleType = $("#SettleType");

    $("#freeType li").focusout( function(e) {
      if (pay_type == "")
      {
        str_result.text("결제방식을 선택하세요.");
        check_type = false;
        active_buy();
      } else {
        str_result.text("결제방식 : " + str_type);
        check_type = true;
        SettleType.val(pay_type);
        active_buy();
      }

     }); 

    }

  function likeSelectUi(){

    let selectItemTarget = $('.like-select');
    selectItemTarget.each(function(){
        $(this).on('click', function(e){
            $(this).toggleClass('on');
            selectItemTarget.not($(this)).removeClass('on'); // this 'not' elements
        });

        $(this).find('.like-select-item').on('click',function(e){
            e.preventDefault();
            let clickText = $(this).text();
            $(this).parents('.like-select').find('.change-status').text(clickText);
            $(this).toggleClass('selected').parent('.single').siblings().find('.like-select-item').removeClass('selected');
        });

        $(this).find('.change-status').on('click', function(e){
            e.preventDefault();
            $(this).addClass('on');
            $('.change-status').not($(this)).removeClass('on'); // this 'not' elements
        });
    });

    $('.exclusive').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
    });

    $('body').on('click', function(e){
        let targetPoint = $(e.target);
        let targetPointItem = targetPoint.hasClass('exclusive');
        let excludeArea = targetPoint.hasClass('on');

        if ( !targetPointItem && !excludeArea ) {
            $('.like-select').removeClass('on');
        }
    });

  }

  likeSelectUi();

  function likeSelectClose(){
      $('.like-select').removeClass('on');
  }

  

$("#name").focusout( function(e) {
  let order_name = $(e.target);

  let empty = order_name.val() == "" ;
  let zero = order_name.val().length <= 1;

  if (empty|| zero) {

    error_msg = "주문자명을 입력해주세요."
    frm_error(e.target, true);
    check_name = false;
    active_buy();

    return false;
  }else{
    frm_error(e.target, false);
      check_name = true;
      active_buy();

  }
    // let match02 = /([^가-힣A-Za-z\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"\x20])/i;

    //   if (match02.test(order_name.val()))
    //   {
    //     error_msg = "한글과 영문을 사용하세요."
    //     frm_error(e.target, true);
    //     check_name = false;
    //     active_buy();

    //     return false;
    //   } else {
    //     frm_error(e.target, false);
    //   }
  // check_name = true;
       active_buy();

    
});


$("#phoneNum").focusout( function(e) {

    let phoneNum = document.getElementById('phoneNum').value.length;
        if( phoneNum !== 13){
            error_msg = "올바른 형식이 아닙니다."
            frm_error(e.target, true);
            check_num = false;
        } else {
            frm_error(e.target, false);
            check_num = true;
        }

        active_buy();
  }).on(
    "keyup", function(e)
      {
        this.value = autoHypenPhone( this.value ) ;  
      }
    );

  $("#telNum").focusout( function(e) {

  let telNum = document.getElementById('telNum').value.length;
     
  }).on(
  "keyup", function(e)
    {
      this.value = autoHypenPhone( this.value ) ;  
    }
  );

  let $form = $('#request_pay');
  // 배송 정보 확인
  function check_Delivery()
  {
    if ($("#btn_buy").hasClass("disabled")) return false;

    if (!check_zipcode)
    {
      if ($("#add_detail").val() == "")
      {
        frm_error($("#add_detail"), true);
        check_zipcode = false;
        return;
      } else {
        frm_error($("#add_detail"));
        check_zipcode = true;
      }
      check_agree = true;
    }

    $form.submit();
  }

  function buying_result(result)
  {
    if (result["result"] == "success")
    {
      if (result["settletype"] == "free")
      {
        document.location.href = "../mypage/order_detail.php?mode=success&order_code=" + result["orregcode"];
      } else {

        let name = '페이레터 결제창';

        let options = 'width=500, height=600, resizable=no, scrollbars=no, location=no';

        win_pay= window.open(result["response"]["online_url"], name, options);

        // <button onclick="window.open('address','window_name','width=430,height=500,location=no,status=no,scrollbars=yes');">button</button>
      }
    }
  }

  $form.on("submit", function(){
      let json_data = Make_JSON_Data($form);

      async_ajax($form.attr('action'), json_data, buying_result);

      return false;
  });

  let win_pay = null;

 $("#license_txt").on("click", function(e) { 

    if( $("#license_input").is(":checked") == true){
      $('#license_error').attr('style', 'display:none;');
        check_agree = true;

    } else {
     $('#license_error').attr('style', 'display:block;');
        check_agree = false;
    }
    active_buy();
    check_zipcode = true;
  });


  function frm_error(elem, flag=true){

    let lavel_style = (flag) ? 'border:1px solid #f32424;' : '';

    $(elem).attr('style', lavel_style);

    let error_txt = (flag) ? error_msg : '';

    let elem_id = $(elem).attr("id");

    $('.frm-error').attr('id', elem_id + "_error");


    $("#" + elem_id + "_error").text(error_txt);

    if (flag)
    {
      $([document.documentElement, document.body]).animate({
          scrollTop: $("#" + elem_id + "_error").offset().top - 140
      }, 800);
    }
  }

  //폰번호 '-' 자동생성
    let autoHypenPhone = function(str){
      str = str.replace(/[^0-9]/g, '');
      let tmp = '';

      if( str.length < 4){
          return str;

      }else if(str.length < 7){
          tmp += str.substr(0, 3);
          tmp += '-';
          tmp += str.substr(3);
          return tmp;

      }else if(str.length < 11){
          tmp += str.substr(0, 3);
          tmp += '-';
          tmp += str.substr(3, 3);
          tmp += '-';
          tmp += str.substr(6);
          return tmp;

      }else{              
          tmp += str.substr(0, 3);
          tmp += '-';
          tmp += str.substr(3, 4);
          tmp += '-';
          tmp += str.substr(7);
          return tmp;
      }
  
      return str;
    }


  function postcode(){
    new daum.Postcode(
    {
      oncomplete: function(data) {

          let fullAddr = ''; // 최종 주소 변수
          let extraAddr = ''; // 조합형 주소 변수

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

          document.getElementById('zip_code').value = data.zonecode; //5자리 새우편번호 사용
          document.getElementById('address').value = fullAddr;

          check_zipcode = true;
          check_agree = true;
          active_buy();

          document.getElementById('add_detail').focus();
        }
      },
      {
        onclose: function(state) {
          console.log("close");
        }
      }).open();

  }

        function active_buy()
    {
          let isTrue = ( check_name && check_num && check_zipcode && check_type && check_agree) ? true : false;

          if (isTrue)
          {
            $("#btn_buy").removeClass("disabled");
          } else {
            $("#btn_buy").addClass("disabled");
          }
      }

  function process_data(result){
    make_utilCard(result, "ordInfo_pd", "buy");
        $('#name').val(result.address.ordername).trigger("focusout");    
    $('#phoneNum').val(result.address.handpnum).trigger("focusout"); 
  };

  async_ajax('/user/pOrder/<?=$orregcode?>', '', process_data);  


  function userinfo(user){

    $('#email').val(user.userinfo.user_email);

  }

  async_ajax('/user/userinfo', '', userinfo);  

</script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>