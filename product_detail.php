<div class="container">
	<section class="app-section view-product">
		<div class="app-inner">
			<div class="row">
				<div class="column product-preview">
					<div class="grid-div">
						<div class="left">
							<div class="gui">
								<span class="view">조회수</span>
								<span class="count" id="view_count"></span>
							</div>
						</div>
					</div>
					<div class="slider-product-view slider">
						<div class="slider-container" id="slider-container">
							
						</div>
					</div>
					<ul id="thumb_img">

                    </ul>
				</div>
<style type="text/css">
/* #slider-container {
	box-shadow: 0 3px 8px rgb(0 0 0 / 5%), 0 3px 8px rgb(0 0 0 / 6%);
	height: 570px;
} */
	#slider-container img {
		-moz-animation: fadeout  0.4s; /* Firefox */
		-webkit-animation: fadeout  0.4s; /* Safari and Chrome */
		-o-animation: fadeout  0.4s; /* Opera */		
		animation: fadeout 0.4s;
		border:1px solid #ececec;
		
	}

	.img_fadeout {
	  visibility: hidden;
	  opacity: 0;
	  transition: visibility 0s 0.4s, opacity 0.4s linear;
	}

	#thumb_img {
	    overflow: hidden;
	    width: 570px;
	    margin: 10px 0px;
	    float: left;
	    padding: 0px;
	    text-align: center;
	}
	#thumb_img li {
		font-size: 0;
		line-height: 0;
		margin: 0.8px 0.8px;
		border: solid 0px #e6e6e6;
		width: 106px;
		height: 106px;
		overflow: hidden;
		display: inline-block;
		border:1px solid #ececec;
	}
	#thumb_img img {
		width: 100%;
		cursor: pointer;
	}
</style>
				<div class="column product-detail"  id="fundingBtn">
					<div class="grid-div" id="sort_base">
						<div class="left" style="margin-top:0px;">
							<span class="shop-name" id="shop-name"></span>
						</div>
					</div>
					<div class="app-article headline">
							<!-- 색상 상태 변경 success deadline new close-->
						<div class="products-body"  >
							<div class="product-info" id="pd_info">
								<div class="tit" id="tit"></div>
								<div class="desc" id="desc"></div>
							</div>


							<div class="product-util" id="pd_util">
								<div class="gui like-btn">
									
									<!-- <a href="#" class="share">공유하기</a> -->
								</div>
								<div class="gui like-btn">
									<a href="#" class="like" id="like">좋아요</a>
								</div>
							</div>
						</div>
					</div>


<script type="text/javascript">
	function callFaceBook() {
		var pWidth = 600;
		var pHeight = 600;
		var pLeft = 600;
		var pTop = 600;

		var app_id = $('meta[property="fb:app_id"]').attr("content");
		var shareURL = encodeURIComponent($('meta[property="og:url"]').attr("content"));
		var popOption = "width=" + pWidth + ",height=" + pHeight + ",left=" + pLeft + ",top=" + pTop +
		",location=no,menubar=no,status=no,scrollbars=no,resizable=no,titlebar=no,toolbar=no";
		var url = "https://www.facebook.com/dialog/share?" +
		"app_id=" + app_id +
		"&display=popup" +
		"&href=" + shareURL;

		window.open(url, "Share to facebook", popOption);
	}

	// function callTwitter() {
	// 	// var shareURL = encodeURIComponent($('meta[property="og:url"]').attr("content"));

	// 	var shareURL = String(document.location.href).replace(/&/gi,"%26"); ;

	// 	var title = encodeURIComponent($('meta[property="og:title"]').attr("content"));

	// 	// https://twitter.com/intent/tweet?text=&amp;url=http://doip.kr%2FDisplayFunding.php%3FCCode%3D50%26RgdCode%3D77671

	// 	var url = "//twitter.com/intent/tweet?text="+title+"&amp;url=" + shareURL;

	// 	window.open(url, "Share to twitter");
	// }
function shareTwitter(){
	var pWidth = 600;
	var pHeight = 600;
	var pLeft = 600;
	var pTop = 600;

	// var shareURL = encodeURIComponent(document.location.href);
	var link = get_shareUrl();

	var seller_info = $("#shop-name").text() + "_doip";
		
	var title = encodeURIComponent(document.title + " #" + seller_info);

	window.open("//twitter.com/intent/tweet?text=" + title + "&url=" + link, '', 'width='+ pWidth +', height='+ pHeight +', left=' + pLeft + ', top='+ pTop);

}

function sharenaver(){
	var link = get_shareUrl();
	// var url = encodeURI(encodeURIComponent(document.location.href));
	var title = encodeURI(document.querySelector("meta[property='og:title']").getAttribute('content'));
	var shareURL = "https://share.naver.com/web/shareView?url=" + link + "&title=" + title;
	window.open(shareURL, "_share_naver");

}

Kakao.init("38cb026e25ca8178acbef8dc79e4ccd4");

function sharekakao(e){
    Kakao.Link.sendDefault({
      objectType: 'feed',
      content: {
        title: document.querySelector("meta[property='og:title']").getAttribute('content'),
        description: document.querySelector("meta[property='og:description']").getAttribute('content'),
        imageUrl:
          document.querySelector("meta[property='og:image']").getAttribute('content'),
        link: {
          mobileWebUrl: get_shareUrl(),
          webUrl: get_shareUrl(),
        },
      },
     
      buttons: [
        {
          title: '도입에서 확인',
          link: {
            mobileWebUrl: get_shareUrl(),
            webUrl: get_shareUrl(),
          },
        },
      ],
    })

}
</script>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
					
					<div class="app-article" id="sort_main">

						<div class="list-tag" id="tag_info">
							<ul>

							</ul>
						</div>

					</div>

					<div class="app-article" id="order_sort">

						<div class="option-info">
							<!-- 상품을 선택합니다. -->
							<div class="option-list">
								<div class="like-select exclusive multi">
									<a href="#" class="change-status" id="selc">옵션내용/가격</a>
									<ul id="selc_opt">


									</ul>
								</div>
							</div>

							<!-- 초기에는 이 요소는 없고 상품이선택되면 해당 상품 옵션이 나열되며 총함계를 계산해주세요 -->
							<ul class="option-select-list" id="opt_box_wrap">
								<!-- <li>
									<div class="grid-div">
										<div class="left">
											해적정신_QHD_배경화면 / 30,000
										</div>
										<div class="right">
											<a href="#" class="btn-text">삭제</a>
										</div>
									</div>
								</li> -->
	
							</ul>
							<div class="option-result">
								<dl>
									<dt>총합계</dt>
									<dd class="num" id="optTot_price">0</dd>
								</dl>
							</div>
						</div>
					</div>
					<div id="share_box_wrap">

						<div class="modal-body">
							<div class="share_box">
								<a href="#" class="share_link kakao" id="kakao" onclick="sharekakao();">
									<span>카카오</span>
								</a>
								<a href="#" class="share_link facebook"  onclick="callFaceBook(); return false;">
									<span>페이스북</span>
								</a>     
								<a href="#" class="share_link twitter" onclick="shareTwitter(); return false;">
									<span>트위터</span>
								</a>
								<a href="#" class="share_link naver" onclick="sharenaver(); return false;">
									<span>네이버</span>
								</a>
								<a href="#" class="share_link copy" onclick="javascript:CopyUrl();return false;">
									<span>주소복사</span>
								</a>
							</div>  
						</div>
					</div>  
				</div>
			</div>
			<div class="app-cont" id="WriterInforBox" style="margin-top: 60px;">

				<div class="title">
					<h3 class="tit-lv2">
						창작자 소개
					</h3>
				</div>
				<div class="box-text" id="WriterInfor">
					<p></p>
				</div>
			</div>
		</div>
	</section>


	<section class="app-section">
		<div class="app-inner secInner">
			<div class="view-detail info_img_patch">
				<div class="cont-preview" id="info_img">
					
				</div>
				
			</div>

			<div class="app-cont " id="outDetail">
				<div class="title">
					<h3 class="tit-lv2">
						주의사항
					</h3>
				</div>
				<div class="box-text" id="notice">
					<p></p>
				</div>
			</div>

			<div class="app-cont ">
				<div class="title">
					<h3 class="tit-lv2">
						필수표기정보
					</h3>
				</div>
				<div class="tbl">
					<table>
						<colgroup>
							<col style="width:30%;">
							<col style="width:auto;">
						</colgroup>
						<tbody>
							<tr>
								<th scope="row" class="left"><b>제작자 또는 공급자</b></th>
								<td class="left" id="seller"></td>
							</tr>
							<tr>
								<th scope="row" class="left"><b>상품 제공 방식</b></th>
								<td class="left">본문내용 참조</td>
							</tr>
							<tr>
								<th scope="row" class="left"><b>청약철회 또는 계약의 해제 및 해지에 따른 효과</b></th>
								<td class="left">도입 이용약관 제21조 및 제30조 참조</td>
							</tr>
							<tr>
								<th scope="row" class="left"><b>이용조건, 이용기간</b></th>
								<td class="left">본문내용 참조</td>
							</tr>
							<tr>
								<th scope="row" class="left"><b>최소 시스템 사양, 필수 소프트웨어</b></th>
								<td class="left" id="regtype">본문내용 참조</td>
							</tr>
							<tr>
								<th scope="row" class="left"><b>소비자상담 관련 전화번호</b></th>
								<td class="left">본문내용 참조</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="app-cont  goodstype">
				<div class="title">
					<h3 class="tit-lv2">
						파일정보
					</h3>
				</div>
				<div class="tbl">
					<table>
						<colgroup>
							<col style="width:30%;">
							<col style="width:auto;">
						</colgroup>
						<tbody id="fileInfo">

							<!-- forEach!!!!!!!!!! -->
<!-- 							<tr>
								<th scope="row" class="left" id="fileName"><b>fileName.jpg</b></th>
								<td class="left" id="fileSize">파일크기 1 Mb</td>
							</tr>
 -->
							
						</tbody>
					</table>
				</div>
			</div>

			<div class="app-cont  goodstype">
				<div class="title">
					<h3 class="tit-lv2">
						개발/사용환경
					</h3>
				</div>
				<div class="box-text" id="DevCon_box">
			
				</div>
			</div>
			<div class="app-cont" id="goToQna">
				<div class="grid-div">
					<div class="left">
						<div class="title">
							<h3 class="tit-lv2">
								Q&A
								<span class="result-count" id="qnd_count" ><em></em></span>
							</h3>
						</div>
					</div>
					<div class="right">
						<a href="#" class="btn-text" id="qna_write">Q&A쓰기</a>
					</div>
				</div>
				<div class="list-acc" id="list_acc">
					<ul>
			

					</ul>
				</div>

		
			</div>

<div class="modal alert is-visible" id="divCart" style="background: transparent;">
    <div class="modal-inner">
        <div class="modal-header">
            <div class="inner">
                <p><img src="<?=$sub_path?>assets/images/ico-cart.png" alt=""></p>
                <div class="modal-controller">
                    <a href="#" class="ico close" onclick="close_cart(); return false;" >닫기</a>
                </div>
            </div>
        </div>
        <div class="modal-body">
			<p class="desc">
				선택한 상품이 장바구니에 담겼습니다.
			</p>
        </div>
		<div class="modal-footer">
			<div class="row col-2">
				<div class="column">
					<a href="#" class="btn-modal"  onclick="close_cart(); return false;">쇼핑 계속하기</a>
				</div>
				<div class="column">
					<a href="<?=$sub_path?>utility/cart.php" class="btn-modal natural">장바구니 확인하기</a>
				</div>
			</div>
		</div>
    </div>



	<div class="modal-dim" onclick="close_cart(); return false;" ></div>
</div>

<script type="text/javascript">

	function get_shareUrl()
	{
		var link = 'https://doip.kr/G' +  getParameterByName('pgCode');

		return link;		
	}

	function CopyUrl()
	{
		// var link = document.location.href;
		var link = get_shareUrl();


		var tempInput = document.createElement("input");
		tempInput.style = "position: absolute; left: -1000px; top: -1000px";
		tempInput.value = link;
		
		document.body.appendChild(tempInput);
		tempInput.select();
		document.execCommand("copy");
		document.body.removeChild(tempInput);
		// alert("URL이 복사되었습니다");

		var alert_obj = {
			"title": "URL 복사하기",
			"html_url": '<?=$sub_path?>assets/html/alert.html',
			"message": "URL이 복사되었습니다.",
			"buttons": [
				{
					"btn_text": "확인",
					"callback": "close",
				},
			]
		}

		layer_alert(alert_obj);
		return false;
		
	}

	function close_cart()
	{
		$('#divCart').addClass('is-visible');
		
	}

  //   function naver_share() {
  //   	var link = get_shareUrl();
		// var url = encodeURI(encodeURIComponent(document.location.href));
		// var title = encodeURI(document.title);
		// var shareURL = "https://share.naver.com/web/shareView?url=" + url + "&title=" + title;
		// window.open(shareURL, "_share_naver");
  //   }

</script>

<style type="text/css">
	.div_basket {
	    text-align: center;
	    position: fixed;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%);
	    overflow: hidden;
	    z-index: 999;
	}	
	.div_basket div.basket {
	    border: 1px solid #A39494;
	    overflow: hidden;
	    width: 295px;
	    height: 189px;
	    background: #fff;
	    margin: 0 auto;
	}	
	div.basket p {
	    margin-top: 20px;
	    padding: 78px 0 20px;
	    background: url(/images/exhibit/bg_basket.gif) no-repeat 50% top;
	    text-align: center;
	}	
	#opt_box_wrap .grid-div{
		padding:4px 0;
	}
	#opt_box_wrap .grid-div:hover{
		background: aliceblue;
	}
	
</style>

<script type="text/javascript">

	// function Start_Up() {
	// 	sync_ajax('/api-auth/detail/' + getParameterByName('pgCode'), '', make_detail);
	// }

	var make_detail = function(data){

		$('#view_count').text(data['ViewCount']);	

		var pd_img_html = `
			<div class="slider-item">
				<img  src="" alt="" id="img_preview">
			</div>
		`;
		var base_m_html = `

			<div class="left" style="margin-top:12px;">
				<div class="star-rating-view">
					<div class="star-rating-inner">
						<img src="<?=$sub_path?>assets/images/ico-star-null.png" alt="">
						<img src="<?=$sub_path?>assets/images/ico-star-null.png" alt="">
						<img src="<?=$sub_path?>assets/images/ico-star-null.png" alt="">
						<img src="<?=$sub_path?>assets/images/ico-star-null.png" alt="">
						<img src="<?=$sub_path?>assets/images/ico-star-null.png" alt="">
					</div>
				</div>
			</div>
		`;

		var base_f_html  = `
			<em class="nagetive">D-4</em>
		`;

		var pd_price_html = `
			<span class="right num price">20,000</span>
		`;

		var f_join_html = `
			
			<div class="gui">
				<span class="member">참여자</span>
				<span class="count" id="mem_count"></span>
				<span class="num" id="totPrice"></span>
			</div>
				
		`;
		var f_progress_html = `
			<div class="progress">
			    <span class="progress-bar" data-val="">
			        <span class="progress-val" id="percent"></span>
			    </span>
			    <span class="progress-val-max" data-val-max="100"></span>
			</div>
		`;

		var m_main_html = `
			<div class="list-dl">
				<dl>
					<dt>상품번호</dt>
					<dd id="rowid">00000</dd>
				</dl>
				<dl>
					<dt>판매자명</dt>
					<dd id="shop_name">WEBTOONSHOP</dd>
				</dl>
				<dl>
					<dt>사용기간</dt>
					<dd id="Hours_of_use">제한없음</dd>
				</dl>
				<dl>
					<dt>사용범위</dt>
					<dd id="Range_of_use"><em class="positive"></em></dd>
				</dl>
				<dl>
					<dt>사용처</dt>
					<dd id="Usage_neutral">제한없음</dd>
				</dl>
			</div>

		`;


		var f_main_html = `
			<div class="list-dl">
				<dl>
					<dt class="sortType">목표금액</dt>
					<dd><dd><em class="nagetive" id="goal"></em></dd></dd>
				</dl>
				<dl>
					<dt>목표기간</dt>
					<dd><dd><em class="nagetive" id="fin"></em></dd></dd>
				</dl>
				<p class="txt-guide">
					이 프로젝트는 펀딩 마감일까지 목표금액이 100% 이상 모이지 않으면 결제금액이 환불됩니다.
				</p>
			</div>	

		`;
		var m_select_html = `
			<li>
				<a href="#" class="like-select-item">
					<span class="D_optleft"></span> 
					<span class="D_optright"></span>
				</a>
			</li>
		`;

		let music_opt_html = `
			<span class="D_optcode" style="padding-right: 10px;">Em</span>
			<span class="D_optpage" style="padding-right: 30px;">2p</span>
			<span class="D_optprice" style="">가격</span>
		`;

		var f_select_html = `
			<li>
				<a href="javascript: " class="like-select-item">
					<div class="select-tit">(클튜브러쉬)산호 브러쉬 세트</div>
					<div class="desc" style="font-size:1.3rem; line-height:0;"></div>
					<div class="grid-div">
						<div class="left">
							<div class="gui">
								<span class="member">참여자</span>
								<span class="count" id="mem_count">532명</span>
							</div>
						</div>
						<div class="right">
							<span class="num" id="price" >
								
							</span>
						</div>
					</div>
				</a>
			</li>
		`;

		var opt_box_html = `
			<li class="opt_box">
				<div class="grid-div">
					<div class="left">
						<span class="D_optname"></span> /
						<span class="D_optprice"></span>
					</div>
					<div class="right">
						<a href="#" class="btn-text" id="remove">삭제</a>
					</div>
				</div>
			</li>
		`;


		var m_order_html = `
			<div class="product-submit col-2" id="pd_detail_btn">
				<ul>
					<li class="share"><a href="javascript:" class="btn line" id="btnshare"  onclick="sharetoggle();">공유하기</a></li>
					<li class="cart"><a href="javascript:" class="btn line" id="btnCart">장바구니 담기</a></li>
					<li class="buy"><a href="javascript:" class="btn positive" id="buyBtn">구매하기</a></li>
				</ul>
			</div>
		`;
		var f_order_html = `
							
			<div class="product-submit col-2" id="pd_detail_btn">
				<ul>
					<li class="share"><a href="javascript:" class="btn line" id="btnshare"  onclick="sharetoggle();">공유하기</a></li>
					<li class="funding"><a href="javascript:" class="btn nagetive">후원하기</a></li>
				</ul>
			</div>
		`;

		var fileInfo_html = `
			<tr>
				<th scope="row" class="left" id="fileName"><b>fileName.jpg</b></th>
				<td class="left" id="fileSize">파일크기 1 Mb</td>
			</tr>
		`;
		let akTable_head_html = `
			<div class="ak-table">
				<div class="ak-header">
					<div class="col-row">
						<div class="ak-td">옵션내용</div>
						<div class="ak-td">Key(조성)</div>
						<div class="ak-td">페이지</div>
						<div class="ak-td">가격</div>
					</div>
				</div>
				
			</div>

		`;
		// 1. 구매하신 악보는 배송되지 않고 pc에서 파일을 다운로드 후 인쇄하여 사용하시면 됩니다.</br>
		// 2. 다운로드 후 환불이 불가하니 구매 전 key(조성), 가격 등을 반드시 확인하시기 바랍니다.</br>
		// 3. 상품을 구매한 후 "마이페이지 -> 구매 내역 -> 다운로드" 받아서 사용하시면 됩니다.
		let akTable_html = `
			<div class="ak-item">
				<div class="col-row">
					<input type="hidden" name="" value="">
					<div class="ak-td part"><b>사랑은 창밖에 빗물같아요<span class=""></span></b></div>
					<div class="ak-td key"><b>key</b></div>
					<div class="ak-td page"><b>페이지</b>p</div>
					<div class="ak-td price">
						<input type="hidden" name="" value=""><b>770원</b>
					</div>
				</div>
			</div>
			
		`;

		var thumb_ul = $('#thumb_img');

		for (var i=1; i < 10; i++){

			if(data['photo'+i] != ""){

				var thumb_li = $("<li></li>");
				var thumb_img = $("<img></img>");
				thumb_img
					.on("mouseover", (e)=> {
						var img_src = $(e.target).attr("src");

						// $("#img_preview").attr("src", img_src);

						$('#slider-container').css({
							"background-image": 'url("'+img_src+'")',
							"background-size": 'contain',
							"height": "570px",
							"margin-top" :"6px",
						});
						$("#img_preview")
							.data("next-img", img_src)
							.addClass("img_fadeout");

					})
					.attr("src", data['photo'+i]);

				thumb_img.appendTo(thumb_li);
				thumb_li.appendTo(thumb_ul);

			}
		}

		var f_img = thumb_ul.find("img:first-child").attr("src");

		var $pd_img = $(pd_img_html);
		
		$pd_img.find('img')
			.attr('src', f_img)
			.css('width', '570px')
			.css('height', '570px')
			// .css('border', '1px solid #eaeaea')
			.appendTo($('#slider-container'));

		function preview_fadeend() {
			var preview = $("#img_preview");

			var next_src = preview.data("next-img");

			preview.attr("src", next_src).removeClass("img_fadeout");
		}

		document.getElementById("img_preview").addEventListener("transitionend", preview_fadeend);

		if(data.InterestFlag){
			$('#like').addClass('active');

		}else{

			$('#like').removeClass('active');
		}


		$('#like').on("click", function (e) {

			e.preventDefault();
	        e.stopPropagation();
	        
			var $like = $(e.target);

			$like.toggleClass("active");

			var flag = ($like.hasClass("active")) ? "on" : "off";

			var pgCode = $like.attr("data-pgCode");

			async_ajax('/user/pick/'+ flag +"/"+ pgCode);

			return false;
		}).attr("data-pgCode", data.rowid);

		$('#shop-name').text(data['WriterName']);	
		$('#shop-name').css('cursor', 'pointer');
		$('#shop-name').on("click", function(event){
			var tag = $(event.target);
			var search_text = tag.text();

			document.location.href = '/SearchGoods.php?GetSearch='+search_text+'&SelectSearchKey=1';
		});

		$('#tit').text(data['GoodsName']);
		$('#desc').text(data['GoosInfor']);

		var Mark_Detail = "mode=market&catCode=";
		var Mark_Pos = document.referrer.indexOf(Mark_Detail);

		// url 에서 parameter 추출
		function getParam(sname) {

		    var params = document.referrer.substr(document.referrer.indexOf("?") + 1);

		    var sval = "";

		    params = params.split("&");

		    for (var i = 0; i < params.length; i++) {

		        temp = params[i].split("=");

		        if ([temp[0]] == sname) { sval = temp[1]; }

		    }
		    return sval;
		}
		if ( Mark_Pos == -1)
		{
			now_category = data['ScodeOne'];
		} else {
			now_category = getParam("catCode");
		}

		now_mode = (data['ScodeOne'] == "50") ? "funding" : "market";

		if(now_mode == "funding"){
			$('header .global-tab ul li a.preoder').css('background', ' var(--color-funding)');
		}else {
			$('header .global-tab ul li a.market').css('background', ' var(--color-market)');
		}

		function compute_total()
		{
			//총합계
			var total_price = 0;

			$('#opt_box_wrap li').each( function(idx, elm){

				var $opt_price = $(elm).attr('data-saleprice');
				var ordPrice = parseInt($opt_price);
				// var li = $(elm);
				total_price += (ordPrice == NaN) ? 0 : ordPrice;
			});
			
			$('#optTot_price').text(price_format(total_price));

			if($('#opt_box_wrap li').length == 0 ){	

				$('#optTot_price').text('0');
			}
		}


		//select_opt
		function make_selectopt(elm){

			var select_elm = $(elm);

			var GoodsWriterID = select_elm.attr("data-goodswriterid");
			var GoodsID = select_elm.attr("data-goodsid");
			var RegCode = select_elm.attr("data-regcode");
			var ScodeOne = select_elm.attr("data-scodeone");
			var GoodsName = select_elm.attr("data-goodsname");
			var OptionID = select_elm.attr("data-optionid");
			var SalePrice = select_elm.attr("data-saleprice");
			var PriceID = select_elm.attr("data-priceid");
			var CatCode = select_elm.attr("data-catcode");
			var OptionDes = select_elm.attr("data-optiondes");
			var OptionCode = select_elm.attr("data-optioncode");
			var OrderNum = select_elm.attr("data-ordernum");

			// 2021/03/25
			// TODO : 여기서 왜 focusout???
			// select_elm.focusout(function(event) {
				// var elm = $(e.target);
				// var CatCode = elm.attr("data-catcode");
				// var opt_rowid = elm.attr("data-optionid");
				// var SalePrice = elm.attr("data-saleprice");
				// var OptionDes = elm.attr("data-optiondes");
				var append_flag = true;


				$('#opt_box_wrap li').each( function(idx, wrap_elm){
					var wrap_rowid = $(wrap_elm).attr("data-optionid");
					
					if (OptionID == wrap_rowid)
					{
						append_flag = false;
						return;
					}
				});

				if (append_flag) {
					// append option
					var $opt_box = $(opt_box_html);

					$opt_box.attr("data-goodswriterid", GoodsWriterID);
					$opt_box.attr("data-goodsid", GoodsID);
					$opt_box.attr("data-regcode", RegCode);
					$opt_box.attr("data-scodeone", ScodeOne);
					$opt_box.attr("data-goodsname", GoodsName);
					$opt_box.attr("data-optionid", OptionID);
					$opt_box.attr("data-saleprice", SalePrice);
					$opt_box.attr("data-priceid", PriceID);
					$opt_box.attr("data-catcode", CatCode);
					$opt_box.attr("data-optiondes", OptionDes);
					$opt_box.attr("data-optioncode", OptionCode);
					$opt_box.attr("data-ordernum",1);


						$opt_box.find('.D_optname').text("["+CatCode+"] " +OptionDes);
						$opt_box.find('.D_optprice').text(price_format(SalePrice));

					$opt_box.appendTo($('#opt_box_wrap'));

					compute_total();

					var removeBtn = $opt_box.find('#remove');

					// removeBtn.attr("data-optionid", GoodsID);

					removeBtn.on("click", function() {
					
						var btn = $(this);

						btn.parents('li.opt_box').remove();

						compute_total();

						return false;
						
					});		
				}
			// });
		}


		var info_img = $('#info_img');

		info_img.html(data['GoodsContents']);	//상세정보

		$('#notice').html(data['AttentionItem'].replace(/(\n|\r\n)/g, "<br>"));	//주의사항

		$('#DevCon_box').html(data['DevCon'].replace(/(\n|\r\n)/g, "<br>"));	//개발/사용환경

		$('#seller').text(data['WriterName']);

		var tag_split = data['SearchKey'].split(',');	//검색어 

		make_search_tag('tag_info ul', tag_split);


		var cont_qna = data['qna']['data'].length;
		$('#qnd_count').text(cont_qna)	//qna

		if (data['qna']['data'].length > 0)
		{
			make_qna_list(data);
		}else{
			$('#allQna').empty();
		}

		likeSelectClose();
		likeSelectUi();

		$('#qna_write')
		.attr('data-GoodsName', data.GoodsName)
		.attr('data-GoosInfor', data.GoosInfor)
		.attr('data-rowid', data.rowid)

		.attr('data-goodswriteid', data.WriterName)
		.attr('data-goodsregcode', data.RegCode)
		.attr('data-goodsviewcode', data.ScodeOne)

		.attr('data-photo', data.photo1);

		if(data.WriterInfor !== ""){	//창작자소개
			$('#WriterInfor').text(data.WriterInfor);
		}else{
			$('#WriterInforBox').remove();
		}
		


		if(data['ScodeOne'] == "50")	//실물펀딩
		{

			$('#divCart').remove();
			var $base_f = $(base_f_html);//

			$base_f.text('D-'+data['dateDiffNum']);

			$base_f.appendTo($('#sort_base'));


			var $f_join = $(f_join_html);

			//총 참여인원!!!

			var totMem = 0;
			data.option.forEach(function(num){

				var totMem_count = parseInt(num.OrderCnt);
				totMem += totMem_count;

			});


			if(data.SucessType == 0 ){
				$f_join.find('#mem_count').text(commaCheck(totMem));//참여인원

			}else if(data.SucessType == 1){

				$f_join.find('.member').remove();
				$f_join.find('#mem_count').remove();
			}

			// $('#shop-name').css('vertical-align','sub');
			$('#shop-name').css('display','inline');
			// $('#shop-name').css('line-height','1.2rem');
			// $('#shop-name').css('height','58px');
			
			$('#pd_info').after($f_join);

			var $f_progress = $(f_progress_html);

			var percent = null;
			if(data.SucessType == 0 ){
				percent = parseInt(data['TotOrderPrice'] / data["SalePrice"] * 100);

			}else if(data.SucessType == 1){

				percent = parseInt(data['TotOrderCnt'] / data["SalePrice"] * 100);

			}

			var $funding_now = $f_progress.find('.progress-bar');    
			$funding_now.attr("data-val", percent);

			if (percent > 100) {
			    var $funding_target = $f_progress.find('.progress-val-max');      
			    $funding_target.attr("data-val-max", percent);
			}

			var $funding_percent = $f_progress.find('#percent');   //달성율
			$funding_percent.text(commaCheck(percent) + "%");

			var $funding_price = $f_join.find('#totPrice');   //총가격

			//후원하기 btn
			var $f_order = $(f_order_html);	

			$f_order.appendTo($('#order_sort'));
			
			var btn_a = $f_order.find('.funding a');

			let buy_string = "후원하기";

			if(data.SucessType == 0 ){

				if (data['TotOrderPrice'] > 0)
				{
				    $funding_price.text( price_format(data['TotOrderPrice']));

				} else {
				    $funding_price.text( "0" );
				}
				

			}else if(data.SucessType == 1){

				$f_join.find('#totPrice').text(commaCheck(totMem)+'/'+data.SalePrice +'명 참여');//참여인원

				buy_string = "참여하기"

				$("#agree_title").text(buy_string);

			}

			if (data['dateDifStart'] <= 0)           //시작 후
			{
			    if (data['dateDiffNum'] < 0)         // 마감
			    {
			        var result_text = " 종료";

			         if (percent >= 100)  // 펀딩성공
			        {
			            $('.products-body').addClass("success");
			            result_text += ".성공";

			        } else {                         // 펀딩 실패

			            $('.products-body').addClass("close");
			            result_text += ".무산";
			        }

			        $base_f.text(result_text);
			        $base_f.attr('style', 'color:#465dd4;');

			    } else {

			        if (data['dateDiffNum'] === 0)  // 오늘 마감
			        {
			            $('.products-body').addClass("deadline");
			            $base_f.text("오늘마감");

			        } else {    // 남은 일수
			            $('.products-body').addClass("new");
			            $base_f.text("  " +(parseInt(data['dateDiffNum']) + 1) + "일 남음");

			        }
			    }
			}	

		    $base_f.countdown({
		        ServerTime: data.ServerTime,
		        SelStartDay: data.SelStartDay,
		        SelEndDay: data.SelEndDay,
		        inter_value: 1000,
		        mode: "all", // all, days, hour, min, sec
		        ontime_reload: false,
		        class: "detail_count",
		        percent: percent,
				buy_button: btn_a,
				buy_text: buy_string,
		    });

			$('#pd_util').before($f_progress);

			progressUi();

			var $f_main = $(f_main_html);

			if(data.SucessType == 0){	//목표 금액

				$f_main.find('#goal').text(price_format(data['SalePrice']));	//목표금액
				
			}else if(data.SucessType == 1){	//목표 건수
				$f_main.find('.sortType').text('목표 인원');
				$f_main.find('#goal').text((data['SalePrice']) + '명');	//목표금액
				$f_main.find('.txt-guide').text('이 프로젝트는 펀딩 마감일까지 목표 인원이 100% 이상 모이지 않으면 취소됩니다.');
			}		

			$f_main.find('#fin').text(data['SelEndDay']+' (자정)');	//마감일

			$f_main.prependTo($('#sort_main'));


			if(data['ScodeOne'] == "50" && data['RegGoodsType'] == "1"){

				var $m_main = $(m_main_html);

				$m_main.css("border-bottom", "1px solid #ececec")
						.css("padding-bottom", "7px")
						.css("margin-bottom", "9px")
							
					;

				$m_main.find('#rowid').text(data['rowid']);//상품번호

				$m_main.find('#shop_name').text(data['WriterName']);//판매자명

				$m_main.find('#Hours_of_use').text(data['TIME_OF_USE']);//사용기간

				$m_main.prependTo($('#sort_main'));

							var useRange = data.Use_Range;

				$m_main.find('#Range_of_use').empty();
					if(useRange !== ""){
						var tooltipTxt = "";

						switch(useRange)
						{
							case "상업적":
								tooltipTxt = "최초 구매자 1인 한정 사용 가능 | 웹툰, 광고 및 마케팅, 프로모션 등 사용처 범주 내에서 상업적 목적으로 사용 가능 | 재배포불가 | 원본 및 2차상품화 불가";
								break;
							case "비상업적":
								tooltipTxt = "구매자 1인 한정 사용권 | 비 상업적/개인적 목적으로만 사용 가능. 이를 위반시 법적 책임 발생 | 재배포불가 | 원본 및 2차상품화 불가";
								break;
						}

						var tip_html = `<span class="tooltip_str">`+useRange+` 사용가능</span>
							<a href="javascript:" class="tooltip">
								<span></span>
								<p class="tooltip-info">
								`+tooltipTxt+`
								</p>
							</a>`;

						$m_main.find('#Range_of_use').append($(tip_html));

					}
			//사용처	
				var arr_usage = data['Usage_neutral'].split(',');	

				if (arr_usage[0] == "제한없음"){
					arr_usage = String('온라인,인쇄,미디어,출판').split(',');
				}

				$m_main.find('#Usage_neutral').empty();

				arr_usage.forEach( function(str){
					str = str.trim();
					if (str != ""){
						var str_tooltip = "";

						switch (str)
						{
							case "온라인":
								str_tooltip = "웹사이트, 블로그, 웹배너, 팝업, 뉴스레터, 쇼핑몰, SNS, 애플리케이션, 모바일홈페이지 등을 포함하여 온라인 범주에 속하는 사용권 일체";
								break;
							case "인쇄":
								str_tooltip = "전자문서, 각종 보고서, 각종 인쇄물(명함, 편지지, 봉투, 달력,엽서 및 기타), 각종 유상상품(머그컵, 티셔츠, 퍼즐, 벽지 등)를 포함하여 인쇄 범주에 속하는 사용권 일체";
								break;
							case "미디어":
								str_tooltip = "영상디자인, 기업 홍보 및 광고 영상(TV), 방송 및 영화의 디자인구성요소(공중파, 케이블 방송 및 영화 제작 콘텐츠 등)를 포함하여 미디어 범주에 속하는 사용권 일체";
								break;
							case "출판":
								str_tooltip = "잡지, 기사, 보도자료, 신문, 각종 교재 및 교육용 콘텐츠, 서적 및 인쇄물의 표지, 배포용 서적 및 각종 출판물(eBook포함)을 포함하여 출판 범주에 속하는 사용권 일체";
								break;
						}

						var tip_html = `<span class="tooltip_str">`+str+`</span>
							<a href="javascript:" class="tooltip">
								<span></span>
								<p class="tooltip-info">
								`+str_tooltip+`
								</p>
							</a>`;

						$m_main.find('#Usage_neutral').append($(tip_html));
					}
				});

			}

			$('#selc').text('세트선택');

			data.option.forEach(function(opt){	//select

				var $f_select = $(f_select_html);

				$f_select.find('#mem_count').text(opt.OrderCnt +' 명 참여');
					
				if(opt.RegView == 0 ){	//품절
					var p_html = `
					<font style="color:#159a2b; margin-right:5px;">[품절]</font>
					`;

					var $p = $(p_html);

					$f_select.find('.select-tit')
					.css('text-decoration','line-through')
					.css('display','inline-block')
					.css('text-decoration-color','#159a2b')
					;
					$f_select.find('#price')
					.css('text-decoration','line-through')
					.css('text-decoration-color','#159a2b');

					$f_select.find('.select-tit').before($p);
					
					$f_select.find('.like-select-item').on('click',function(){
						// alert('해당 옵션은 품절입니다.')

						var alert_obj = {
							"title": "품절",
							"html_url": '<?=$sub_path?>assets/html/alert.html',
							"message": "해당 옵션은 품절입니다.",
							"buttons": [
							{
								"btn_text": "확인",
								"callback": "close",
							},

							]
						}

						layer_alert(alert_obj);
						return false;


					});				

				} else if (data['dateDiffNum'] < 0){	// 마감

					var p_html = `
						<font style="color: var( --color-funding); margin-right:5px;">[마감]</font>
					`;

					var $p = $(p_html);

					$f_select.find('.select-tit')
						.css('text-decoration','line-through')
						.css('display','inline-block')
						.css('text-decoration-color','var( --color-funding)')
						;
					$f_select.find('#price')
						.css('text-decoration','line-through')
						.css('text-decoration-color','var( --color-funding)');

					$f_select.find('.select-tit').before($p);

					$f_select.find('.like-select-item').on('click',function(){
						// alert('해당 옵션은 품절입니다.')

						var alert_obj = {
							"title": "마감",
							"html_url": '<?=$sub_path?>assets/html/alert.html',
							"message": "마감된 옵션입니다.",
							"buttons": [
							{
								"btn_text": "확인",
								"callback": "close",
							},
							
							]
						}

						layer_alert(alert_obj);
						return false;

					});		


				} else {

					$f_select.find('.select-tit').text(opt.CatCode);
					$f_select.find('.desc').text(opt.OptionDes);
					
					$f_select.find('#mem_count').text(opt.OrderCnt +' 명 참여');
					$f_select.find('#price').text(price_format(opt.SalePrice));

					$f_select.find("a").on("click", function () {	//select opt
						make_selectopt(this);
					});
				}

				$f_select.find('.select-tit').text(opt.CatCode);
				$f_select.find('.desc').text(opt.OptionDes);
				$f_select.find('#price').text(price_format(opt.SalePrice));

				$f_select.appendTo($('#selc_opt'));

				make_order_data($f_select.find("a"), data, opt);

				if(data['RegGoodsType'] == "1"){

					var $fileInfo = $(fileInfo_html);
					var now_date = getFormatDate(new Date());	//2021-04-16 11:13


					if(opt.TimeOfImplementation > now_date){

						// console.log(opt.TimeOfImplementation+'이 더 큼');
						$fileInfo.find('#fileSize').text(opt.TimeOfImplementation+'일 공개 예정');

					}else{
						if(opt.FileSize == "unknow"){
							$fileInfo.find('#fileSize').text('파일이 등록되지 않았습니다.');
						}else{
							$fileInfo.find('#fileSize').text(getfileSize(opt.FileSize));
						}

					};	

					if(opt.OptFileOrgName == ""){
						$fileInfo.find('#fileName').text('-');
					}else{
						$fileInfo.find('#fileName').text(opt.OptFileOrgName);
					}

					$fileInfo.appendTo($('#fileInfo'));



				};

			});

			if(data['RegGoodsType'] == "2"){	//펀딩 유형

				$('.goodstype').attr('style','display:none;');	//파일정보
				$('#regtype').text('해당없음');	// 시스템 사양

				get_html('/new_pc/assets/html/agree_funding_real.html');
				return false;

			}else{ //디지털 펀딩

				if(data.SucessType == 1){

					get_html('/new_pc/assets/html/agree_funding_count.html');
				return false;

				}else{

					get_html('/new_pc/assets/html/agree_funding_amount.html');
				return false;
				}

				$('.goodstype').attr('style','display:block;');	

			}


		}else{	//마켓

			var $base_m = $(base_m_html);	//만족도

			var star_point = Math.round(data['CalPoint']);

			star_point = (star_point > 0) ? star_point : 0;

			var iconStar = $base_m.find('img');

			iconStar.each( function (idx, icon) {
				if(star_point - 1 >= idx)
				{
					$(icon).attr('src','<?=$sub_path?>assets/images/ico-star.png');
				}
			});

			let $akTable_head = $(akTable_head_html);
			if(data.ScodeOne == "14-01"){
				$('.secInner').prepend($akTable_head);
			};

			$base_m.appendTo($('#sort_base'));	
			//TODO : 만족도 data['AddPoint']

			var $pd_price = $(pd_price_html);	//가격

			$pd_price.text(price_format(data['SalePrice']));

			$('#pd_info').after($pd_price);


			var $m_main = $(m_main_html);

			$m_main.find('#rowid').text(data['rowid']);//상품번호

			$m_main.find('#shop_name').text(data['WriterName']);//판매자명

			$m_main.find('#Hours_of_use').text(data['TIME_OF_USE']);//사용기간

			$m_main.prependTo($('#sort_main'));


			data.option.forEach(function(opt){	//select
				var $m_select = $(m_select_html);
				make_order_data($m_select.find("a"), data, opt);
				
				$m_select.find("a").on("click", function () {
					let $this = $(this);
					make_selectopt($this);
				});

				// $m_select.find('.like-select-item').text(opt.CatCode +' / '+ price_format(opt.SalePrice));
				$m_select.find('.D_optleft').text(opt.CatCode);

				if(opt.sheet_code || opt.sheet_page ){	//악보

					let $music_opt = $(music_opt_html);
					$m_select.find('.D_optright').append($music_opt);


				}else{
					$m_select.find('.D_optright').text(price_format(opt.SalePrice));
				}
				
				$m_select.find('.D_optright').css('float','right');
				
				$m_select.appendTo($('#selc_opt'));


				if(data['RegGoodsType'] !== "2"){

					var $fileInfo = $(fileInfo_html);

					$fileInfo.find('#fileSize').text(getfileSize(opt.FileSize));
					$fileInfo.find('#fileName').text(opt.OptFileOrgName);

					$fileInfo.appendTo($('#fileInfo'));

				}

				if(data.ScodeOne == "14-01"){
					let $akTable = $(akTable_html);
					$akTable.find('.part').text(opt.CatCode);
					$akTable.find('.price').text(price_format(opt.rsSalePrice));
					$akTable_head.append($akTable);
				};

			});

			var $m_order = $(m_order_html);
			$m_order.find('#buyBtn').on('click', function(){
				product_pay("buy");
			});
			$m_order.find('#btnCart').on('click', function(){
				product_pay("cart");
			});
		
			$m_order.appendTo($('#order_sort'));

						var useRange = data.Use_Range;

				$m_main.find('#Range_of_use').empty();
					if(useRange !== ""){
						var tooltipTxt = "";

						switch(useRange)
						{
							case "상업적":
								tooltipTxt = "최초 구매자 1인 한정 사용 가능 | 웹툰, 광고 및 마케팅, 프로모션 등 사용처 범주 내에서 상업적 목적으로 사용 가능 | 재배포불가 | 원본 및 2차상품화 불가";
								break;
							case "비상업적":
								tooltipTxt = "구매자 1인 한정 사용권 | 비 상업적/개인적 목적으로만 사용 가능. 이를 위반시 법적 책임 발생 | 재배포불가 | 원본 및 2차상품화 불가";
								break;
						}

						var tip_html = `<span class="tooltip_str">`+useRange+` 사용가능</span>
							<a href="javascript:" class="tooltip">
								<span></span>
								<p class="tooltip-info">
								`+tooltipTxt+`
								</p>
							</a>`;

						$m_main.find('#Range_of_use').append($(tip_html));

					}


			//사용처	
				var arr_usage = data['Usage_neutral'].split(',');	

				if (arr_usage[0] == "제한없음"){
					arr_usage = String('온라인,인쇄,미디어,출판').split(',');
				}

				$m_main.find('#Usage_neutral').empty();

				arr_usage.forEach( function(str){
					str = str.trim();
					if (str != ""){
						var str_tooltip = "";

						switch (str)
						{
							case "온라인":
								str_tooltip = "웹사이트, 블로그, 웹배너, 팝업, 뉴스레터, 쇼핑몰, SNS, 애플리케이션, 모바일홈페이지 등을 포함하여 온라인 범주에 속하는 사용권 일체";
								break;
							case "인쇄":
								str_tooltip = "전자문서, 각종 보고서, 각종 인쇄물(명함, 편지지, 봉투, 달력,엽서 및 기타), 각종 유상상품(머그컵, 티셔츠, 퍼즐, 벽지 등)를 포함하여 인쇄 범주에 속하는 사용권 일체";
								break;
							case "미디어":
								str_tooltip = "영상디자인, 기업 홍보 및 광고 영상(TV), 방송 및 영화의 디자인구성요소(공중파, 케이블 방송 및 영화 제작 콘텐츠 등)를 포함하여 미디어 범주에 속하는 사용권 일체";
								break;
							case "출판":
								str_tooltip = "잡지, 기사, 보도자료, 신문, 각종 교재 및 교육용 콘텐츠, 서적 및 인쇄물의 표지, 배포용 서적 및 각종 출판물(eBook포함)을 포함하여 출판 범주에 속하는 사용권 일체";
								break;
						}

						var tip_html = `<span class="tooltip_str">`+str+`</span>
							<a href="javascript:" class="tooltip">
								<span></span>
								<p class="tooltip-info">
								`+str_tooltip+`
								</p>
							</a>`;

						$m_main.find('#Usage_neutral').append($(tip_html));
					}
				});
		}
	};

	function funding_agree() {

		if (show_login()) // 로그인 상태 체크
		{
			var option_list = $('#opt_box_wrap li');

			var buying_list = new Array();

			var send_flag = false;

			option_list.each( function (idx, elm) {
				var opt = $(elm);

				// if (opt.hasClass("on"))
				// {
					var option = make_option_data(opt)

					buying_list.push(option);

					// if (opt_data != '') opt_data += ', ';

					// opt_data += JSON.stringify(option);

					send_flag = true;
				// }
			});

			if (send_flag) {
				$('#modal_agree').toggleClass('is-visible');
				// $("#modal_agree").css("display", "block");
				// $("#modal_agree").removeAttr("style");
				// product_pay("support");
			} else {
				// alert("구매할 품목을 선택해주세요.");
			
	    var alert_obj = {
	      "title": "옵션 선택",
	      "html_url": '<?=$sub_path?>assets/html/alert.html',
	      "message": "구매할 품목을 선택해주세요.",
	      "buttons": [
	        {
	          "btn_text": "확인",
	          "callback": "close",
	        },
	        
	      ]
	    }

	    layer_alert(alert_obj);
	    return false;
	    
			}

		}

	}

	function make_qna_list(data){

		append_qna(data['qna']);

		$('.list-acc').each(function(){

			$(this).find('.question-item').on('click', function(e){
				e.preventDefault();
				$(this).parent('li').toggleClass('on').siblings().removeClass('on');

			})
		});
	};

	function append_qna(qna_data){

		qna_data.data.reverse().forEach(function(data){

			append_qna_list( $('#list_acc'), data, 'pdDetail');

		});
	}

	function likeSelectUi(){
	    // select design

	    var selectItemTarget = $('.like-select');
	    selectItemTarget.each(function(){
	        $(this).on('click', function(e){
	            $(this).toggleClass('on');
	            selectItemTarget.not($(this)).removeClass('on'); // this 'not' elements
	        });

	        $(this).find('.like-select-item').on('click',function(e){
	            e.preventDefault();
	            var clickText = $(this).text();
	            $(this).parents('.like-select').find('.change-status').text(clickText);
	            $(this).toggleClass('selected').parent('.single').siblings().find('.like-select-item').removeClass('selected');
	        });

	        $(this).find('.change-status').on('click', function(e){
	            e.preventDefault();
	            $(this).addClass('on');
	            $('.change-status').not($(this)).removeClass('on'); // this 'not' elements
	        });
	    });

	    // area event reset
	    $('.exclusive').on('click', function(e){
	        e.preventDefault();
	        e.stopPropagation();
	    });

	    // area click fixed
	    $('body').on('click', function(e){
	        var targetPoint = $(e.target);
	        var targetPointItem = targetPoint.hasClass('exclusive');
	        var excludeArea = targetPoint.hasClass('on');

	        if ( !targetPointItem && !excludeArea ) {
	            $('.like-select').removeClass('on');
	        }
	    });
	}

	function likeSelectClose(){
	    $('.like-select').removeClass('on');
	}	

	function getfileSize(x) {
	  var s = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB'];
	  var e = Math.floor(Math.log(x) / Math.log(1024));
	  return (x / Math.pow(1024, e)).toFixed(2) + " " + s[e];
	};

</script>			


		</div>

	</section>
<div class="modal is-visible"  id="modal_agree" style="background: transparent;">
	    <div class="modal-inner " style="width:540px;">
	        <div class="modal-header">
	            <div class="inner">
	                <p id="agree_title">후원하기</p>
	                <div class="modal-controller">
	                    <a href="#" class="ico close modal-toggle">닫기</a>
	                </div>
	            </div>
	        </div>
	        <div class="modal-body">
	        	<div class="app-cont" id="RegGoodsType1">
	        		<!-- 펀딩 후원 동의 내용  -->
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="column">
						<a href="javascript:" class="btn-modal disabled" id="btn_fund">후원하기</a>
					</div>
					<div class="column">
						<a href="#" class="btn-modal natural modal-toggle">나중에하기</a>
					</div>
				</div>
			</div>
	    </div>
		<div class="modal-dim modal-toggle"></div>
	</div>	
</div>
<style>
#btn_fund.disabled{
	background: #ddd;
    border: none;
}

</style>
<script type="text/javascript">

	$('.modal-toggle').on('click', function(e) {
		modal_toggle(e);
	});

	function support_chk(){

		var total_chk = $("input[name='f_chk']").length;
		var chked_chk = $("input[name='f_chk']:checked").length;


		if(total_chk === chked_chk){
				$('#btn_fund').removeClass('disabled');
				$('#btn_fund').attr('onclick', 'product_pay("support");');
		}else{
			$('#btn_fund').addClass('disabled');
			$('#btn_fund').attr('onclick', '');
			 // $("input[name='f_chk']:checked").removeAttr('checked');
		}
	}


	$("#qna_write").click(function(e) { 

		if (show_login()) // 로그인 상태 체크
		{
			$.ajax({
				url:'pd_qna.html',
				context: document.body,
				success: function(response){
					html = response;
					// $('body').load(html);
					// $(".modal").load(html);
					var $qna = $(html);

					var btn_qna = $(e.target);
					$("#popup_modal").empty().append($qna).toggleClass('is-visible');


					$qna.find(".products-head img").attr("src", btn_qna.attr('data-photo'));
					$qna.find("#tit").text(btn_qna.attr('data-goodsname'));
					$qna.find("#desc").text(btn_qna.attr('data-goosinfor'));
					$qna.find("#num").text(btn_qna.attr('data-rowid'));

					$qna.find("#goodsregcode").val(btn_qna.attr('data-goodsregcode'));
					$qna.find("#goodswriteid").val(btn_qna.attr('data-goodswriteid'));
					$qna.find("#goodsviewcode").val(btn_qna.attr('data-goodsviewcode'));
					$qna.find("#goodsphoto").val(btn_qna.attr('data-photo'));
					$qna.find("#goodsname").val(btn_qna.attr('data-goodsname'));
					$qna.find("#goodsinfo").val(btn_qna.attr('data-goosinfor'));
					$qna.find("#goodsrow").val(btn_qna.attr('data-rowid'));

					// e.preventDefault();
					return false;
				}
			}); 
		}
		e.preventDefault();
	});
</script>
