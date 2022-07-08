<?php

    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);

    $arr = explode("/", $_SERVER['SCRIPT_FILENAME']);

    $file = str_replace("/".$arr[count($arr) - 1], "", $_SERVER['SCRIPT_FILENAME']);

    $real_path = $file."/../";

    $sub_path = "../";

    $HTML_CLASS = "detail";

    $Page_Title = "주문 번호 : " . $_GET['order_code'];

    $User_Only = true;
    
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
                            <li class="column credit complite">
                                <span class="count">02</span>
                                <div class="tit">주문/결제</div>
                            </li>
                            <li class="column check">
                                <span class="count">03</span>
                                <div class="tit">주문완료</div>
                            </li>
                        </ol>
                    </div>
                    <div class="box-message flip">
                        <p>
                            <img src="<?=$sub_path?>assets/images/img-check.png" alt="">
                            <span id="ordNum"></span><br />
                            <b>총 결제금액 
                                <span class="ordPrice" style="font-size:3rem;"></span>
                            </b>
                            <br />
                            결제가 정상적으로 완료되었습니다.
                            <br />
                            이용해주셔서 감사합니다.
                        </p>
                    </div>
                    <div class="list-report">
                        <div class="list-report-item" id="ordInfo_pd">
                            <ul>
                
                            </ul>
                        </div>
                    </div>

                    <div class="view-product">
                        <div class="option-result">
                            <div class="grid-div" id="ordInfo_price">

                                
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <section class="app-section">
                <div class="app-inner">

                    <div class="app-cont">
                        <div class="title">
                            <h3 class="tit-lv2 grid-div">
                                주문 고객정보
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
                                            주문자명
                                        </th>
                                        <td id="ordName">
                                            
                                        </td>
                                        <th scope="row" class="left">
                                            휴대폰번호
                                        </th>
                                        <td id="ordPHnum">
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="left">
                                            이메일
                                        </th>
                                        <td id="ordEmail">
                                            
                                        </td>
                                        <th scope="row" class="left">
                                            전화번호
                                        </th>
                                        <td id="ordTelnum">

                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="left">
                                            주소
                                        </th>
                                        <td colspan="3" id="ordAdress">
                                           
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="left">
                                            주문메세지
                                        </th>
                                        <td colspan="3" id="ordMess">
                                            
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
                                            결제방법
                                        </th>
                                        <td id="ordPaytype">
                                            
                                        </td>
                                        <th scope="row" class="left">
                                            주문일시
                                        </th>
                                        <td id="ordTime">
                                           
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row center submit-btn-set">
                        <a href="#" class="btn line lg" id="btn_continue">쇼핑 계속하기</a>
                        <a href="#" class="btn positive lg" id="go_detail" onclick="location.href='/new_pc/mypage/ordList.php'">주문내역 확인</a>
                    </div>
                </div>
            </section>
        </div>

<script type="text/javascript">
    let order_code = getParameterByName('order_code');

    let ordInfo_pd_html = `
    <li>
      <div class="report-item">
        <div class="grid-div">
          <div class="left80">
            <div class="report-detail">
              <div class="products-head">
                <img src="" alt="" id="ordPd_img">
              </div>
              <div class="products-body">
                <a href="#" class="product-info">
                  <div class="tit" id="tit">상품이름 </div>
                  <div class="desc" id="desc">상품설명</div>
                  <span class="txt-info" id="option">옵션 : 옵션내용</span>
                </a>
                <span class="txt-info" id="sort_mode">마켓</span>
                <span class="num price" id="price">20,000</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </li>
    `;

    let ordInfo_price_html = `
    <div class="right">
      <dl>
        <dt>총 <em class="positive"></em>개의 상품 합계</dt>
        <dd class="num">30,000</dd>
      </dl>
    </div>
    `;

    function prcess(result)
    {

      result.data.forEach(function(list){

        let data = list.list_data;
          let $ordInfo_pd = $(ordInfo_pd_html); //상품정보

          $ordInfo_pd.find('#ordPd_img').attr('src',list.product_data.photo_url);//이미지

          $ordInfo_pd.find('#tit').text(data.goodsname);//상품명

          $ordInfo_pd.find('#desc').text(list.product_data.GoosInfor);//설명

          if(data.sheet_name !== undefined){//옵션명


            $ordInfo_pd.find('#option').text(data.sheet_name);
            let $keyS = $('<span class="txt-info" id="key" style="margin:0 7px;"></span>');
            $keyS.text(data.sheet_key);
            $ordInfo_pd.find('.product-info').append($keyS);

            let $pageS = $('<span class="txt-info" id="page" style="margin:0 7px;"></span>');
            $pageS.text(data.sheet_page);
            $ordInfo_pd.find('.product-info').append($pageS);
          }else{
            $ordInfo_pd.find('#option').text(data.goodsoptioncode);
          }


          if(list.product_data.RegGoodsType === "2"){

            $ordInfo_pd.find('#sort_mode').text('펀딩');

        }else{

            $ordInfo_pd.find('#sort_mode').text('마켓');
        }

          $ordInfo_pd.find('#price').text(price_format(list.list_data.price));//가격

          $ordInfo_pd.attr('data-price',list.list_data.price);

          $ordInfo_pd.appendTo($('#ordInfo_pd ul'));

      });

        //쇼핑계속하기

        let pd_data = result.data[0];

        $('#btn_continue').attr("href", "/new_pc/product?mode=detail&pgCode="+pd_data.product_data["rowid"]);


           let $ordInfo_price = $(ordInfo_price_html);
          $ordInfo_price.find('.positive').text(result.total);//총개수

          let ordprice = result.data[0].order_data.orderprice;

          $ordInfo_price.find('.num').text(price_format(ordprice));//가격
          $ordInfo_price.appendTo($('#ordInfo_price'));

          $("#total_price").val(ordprice);

          let order_data = result.data[0].order_data;
          let address_data = result.data[0].address_data;

          $('#ordNum').text('주문번호 : '+order_code);
          $('.ordPrice').text(price_format(ordprice));
          
          $('#ordName').text(address_data.ordername);
          $('#ordPHnum').text(address_data.handpnum);
          $('#ordEmail').text(address_data.useremail);
          $('#ordTelnum').text(address_data.telnum);
          $('#ordAdress').text(address_data.address +' '+ address_data.addressadd);
          $('#ordMess').text(order_data.memo);

          $('#ordMess').text();

          $('#ordPaytype').attr('data-type', order_data.settletype);

          if(order_data.settletype == "creditcard"){

            $('#ordPaytype').text('신용카드');

        }else if(order_data.settletype == "banktransfer"){

           $('#ordPaytype').text('무통장');

       }else if(order_data.settletype == "kakaopay"){

           $('#ordPaytype').text('카카오페이');

       }else if(order_data.settletype == "payco"){

           $('#ordPaytype').text('페이코');
       }else if(order_data.settletype == "free"){

           $('#ordPaytype').text('무료상품');
       };


        // $('#ordPaytype').text(order_data.settletype);

          // $('#ordPaytype').text(order_data.settletype);
          $('#ordTime').text(order_data.orderdate);

      }
      async_ajax('/user/detail/' + order_code, '', prcess);



  </script>   


