function product_pay(mode) {
    if (mode == "end") {
        var alert_obj = {
            title: "판매 종료",
            html_url: "<?=$sub_path?>assets/html/alert.html",
            message: "판매 종료된 상품입니다.",
            buttons: [
                {
                    btn_text: "확인",
                    callback: "close",
                },
            ],
        };
        layer_alert(alert_obj);
        return false;
    }

    var login_token = getCookie("jwttoken");

    if (show_login()) {
        // if(mode == "pick"){
        // 	// send_flag = true;

        // 			var pick_list = $('#pick_pd li');

        // 			var buying_list = new Array();

        // 			var send_flag = false;

        // 			pick_list.each( function (idx, elm) {

        // 				var opt = $(elm);
        // 				var option = make_option_data(opt)

        // 				buying_list.push(option);
        // 				send_flag = true;
        // 			});
        // }else{

        var option_list = $("#opt_box_wrap li");
        var buying_list = new Array();
        var send_flag = false;

        option_list.each(function (idx, elm) {
            var opt = $(elm);

            var option = make_option_data(opt);

            buying_list.push(option);

            send_flag = true;
        });

        var api_url = mode == "buy" || mode == "support" ? "/user/pOrder_insert" : "/user/cart/insert";

        var order_data = {
            mode: mode,
            product_data: buying_list,
        };

        var choice_data = JSON.stringify(order_data);

        if (send_flag) {
            async_ajax(api_url, choice_data, pay_process);
        } else {
            var alert_obj = {
                title: "옵션 선택",
                html_url: "../assets/html/alert.html",
                message: "구매할 품목을 선택해주세요.",
                buttons: [
                    {
                        btn_text: "확인",
                        callback: "close",
                    },
                ],
            };

            layer_alert(alert_obj);
            return false;
        }
    } else {
        layer_popup("/new_pc/assets/html/login.php");
        return false;
    }
}

function insertCart(e) {
    var eee = $(e.target);
    var pick_list = $("#pick_pd li");
    var buying_list = new Array();
    var send_flag = false;

    pick_list.each(function (idx, elm) {
        var opt = $(elm);
        var option = make_option_data(opt);

        buying_list.push(option);
        send_flag = true;
    });

    var order_data = {
        mode: "pick",
        product_data: buying_list,
    };

    var choice_data = JSON.stringify(order_data);

    async_ajax("/user/cart/insert", choice_data, insertCart);
}

function pay_process(result) {
    var mode = result.mode;

    if (mode == "cart") {
        // 장바구니 담기 성공
        // var config = {
        // 	"title": "장바구니 넣기 완료",
        // 	"message" : "선택한 상품이 장바구니에 담겼습니다.",
        // 	"str_yes" : "장바구니로 이동",
        // 	"link_yes" : "../utility/cart.php",
        // 	"str_cancel" : "쇼핑 계속하기",
        // 	"link_cancel" : "",
        // }

        // show_alert(config);
        if (result.result == "success") {
            $("#divCart").removeClass("is-visible");
        } else {
            alert(result.message);
        }
        return false;
    } else {
        if (result.result == "success") {
            var form = document.createElement("form");
            form.setAttribute("charset", "UTF-8");
            form.setAttribute("method", "Post"); //Post 방식
            form.setAttribute("action", "../product/buy.php"); //요청 보낼 주소

            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "orregcode");
            hiddenField.setAttribute("value", result.orregcode);
            form.appendChild(hiddenField);

            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "division");
            hiddenField.setAttribute("value", result.division);
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            form.submit();
        }
    }
}

function make_order_data(terget, product_data, opt) {
    terget.attr("data-goodswriterid", product_data["WriterID"]);
    terget.attr("data-goodsid", product_data["rowid"]);
    terget.attr("data-regcode", product_data["RegCode"]);
    terget.attr("data-scodeone", product_data["ScodeOne"]);
    terget.attr("data-goodsname", product_data["GoodsName"]);
    terget.attr("data-optionid", opt["rowid"]);
    terget.attr("data-saleprice", opt["SalePrice"]);
    terget.attr("data-priceid", opt["priRowid"]);
    terget.attr("data-catcode", opt["CatCode"]);
    terget.attr("data-optiondes", opt["OptionDes"]);
    terget.attr("data-optioncode", opt["OptionCode"]);
    terget.attr("data-ordernum", 1);
}

function make_option_data(opt) {
    var GoodsWriterID = opt.attr("data-goodswriterid");
    var GoodsID = opt.attr("data-goodsid");
    var RegCode = opt.attr("data-regcode");
    var ScodeOne = opt.attr("data-scodeone");
    var GoodsName = opt.attr("data-goodsname");
    var OptionID = opt.attr("data-optionid");
    var PriceID = opt.attr("data-priceid");
    var CatCode = opt.attr("data-catcode");
    var OptionDes = opt.attr("data-optiondes");
    var OptionCode = opt.attr("data-optioncode");
    var OrderNum = opt.attr("data-ordernum");

    var option = new Object();

    option["GoodsWriterID"] = GoodsWriterID;
    option["GoodsID"] = GoodsID;
    option["RegCode"] = RegCode;
    option["ScodeOne"] = ScodeOne;
    option["GoodsName"] = GoodsName;
    option["OptionID"] = OptionID;
    option["PriceID"] = PriceID;
    option["CatCode"] = CatCode;
    option["OptionDes"] = OptionDes;
    option["OptionCode"] = OptionCode;
    option["OrderNum"] = OrderNum;

    return option;
}

function convert(value) {
    if (value >= 1000000) {
        value = (value / 1000000).toFixed(1) + "M";
    } else if (value >= 1000) {
        // value= Math.round(value/1000).toFixed(1)+"K";
        value = (value / 1000).toFixed(1) + "K";
        // value= Math.round(value/1000)+"K";
    }

    return value;
}

function make_search_tag(elem_id, category_data) {
    var tag_html = '<li><span class="tag"></span></li>';

    var tag_list = $("#" + elem_id);

    category_data.forEach(function (value) {
        if (value !== "") {
            var tag = $(tag_html);

            var str_tag = typeof value == "string" ? value : value["SearchWord"];

            tag.find(".tag").text(str_tag);

            tag.appendTo(tag_list);

            tag.on("click", function (event) {
                var tag = $(event.target);

                var search_text = tag.text();

                document.location.href = "/new_pc/utility/search.php?GetSearch=" + search_text;
                // document.location.href = '../utility/search.php?GetSearch='+search_text;

                // if (typeof make_search == 'function')
                // {
                //     async_ajax('/api-auth/find/'+search_text, '', make_search);
                // } else {
                //     document.location.href = '../utility/search.php?GetSearch='+search_text;
                // }
            });
        }
    });
}

function delete_select(gubun, arr_id) {
    var flag = "delete";

    if (gubun == "pick") {
        flag = "off";
    }

    if (arr_id == "선택") {
        // TODO :
        var arr_id = ""; // 1,2,3,4,5

        var li_list = $('.app-section .list-report ul input[name="chk"]:checked');

        li_list.each(function (idx, elem) {
            var $elem = $(elem);

            if (arr_id != "") arr_id += ",";

            arr_id += $elem.attr("data-rowid");
        });
    } else if (arr_id == "전체") {
        // 전체삭제

        if (gubun == "cart") {
            async_ajax("/user/" + gubun + "/delete/DeleteAll", "", process);
        } else if (gubun == "pick") {
            async_ajax("/user/" + gubun + "/off/DeleteAll", "", process);
            location.reload();
        }

        return;
    }

    async_ajax("/user/" + gubun + "/" + flag + "/" + arr_id, "", process);
}

function empty_cart() {
    var $empty = $(
        '<div style="height: 100%; width: 100%; position: absolute; top: 90%; left: 50%; transform: translate(-50%, -50%); text-align:center;"><img src="<?=$sub_path?>assets/images/nj02.png" alt="noSearch" style="width:35%; margin:20px 0 ;"><span style="display:block; text-align:center; font-size:1.4rem;">장바구니 상품을 담아보세요.</span></div>'
    );
    $(".list-report ul").css("height", "10vh");
    $empty.appendTo($(".list-report ul"));
}

function process_data(result) {
    if (typeof result.address == "object") {
        $("#email").attr("value", result.address.useremail); //email
    }

    if (result.data[0].product_data.RegGoodsType === "2") {
        //펀딩유형일때
        $(".sort_modeF").removeAttr("style");
        $(".sort_modeM").attr("style", "display:none;");
    } else {
        $(".sort_modeF").attr("style", "display:none;");
        $(".sort_modeM").removeAttr("style");
    }

    result.data.forEach(function (list) {
        var $ordInfo_pd = $(ordInfo_pd_html); //상품정보

        $ordInfo_pd.find("#ordPd_img").attr("src", list.product_data.photo_url); //이미지
        $ordInfo_pd.find("#tit").text(list.product_data.GoodsName); //상품명
        $ordInfo_pd.find("#desc").text(list.product_data.GoosInfor); //설명

        $ordInfo_pd.find("#option").text(list.list_data.catcode); //옵션명

        if (list.product_data.RegGoodsType === "2") {
            $ordInfo_pd.find("#sort_mode").text("펀딩");
        } else {
            $ordInfo_pd.find("#sort_mode").text("마켓");
        }

        $ordInfo_pd.find("#price").text(price_format(list.price_data.saleprice)); //가격
        $ordInfo_pd.attr("data-price", list.price_data.saleprice);

        $ordInfo_pd.appendTo($("#ordInfo_pd ul"));
    });

    var $ordInfo_price = $(ordInfo_price_html);
    $ordInfo_price.find(".positive").text(result.total); //총개수

    $ordInfo_price.find(".num").text(price_format(result.order_data.orderprice)); //가격

    $("#total_price").val(result.order_data.orderprice);

    var product_name = result.data[0].product_data.GoodsName;

    if (String.h_len(product_name) > 20) {
        product_name = product_name.cut(20);
    }

    if (result.data.length > 1) {
        product_name += " 외 " + String(result.data.length - 1) + "종";
    }

    $("#product_name").val(product_name);

    if (result.order_data.orderprice === 0) {
        check_type = true;
        $("#price_free").text("무료").attr("style", "background:none;");

        $("#freeType").attr("style", "display:none;");

        $("#SettleType").val("free");
    }

    $ordInfo_price.appendTo($("#ordInfo_price"));
}

function append_qna_list(target_ul, data, gubun = "") {
    var qna_li_html = `
	<li class="qnaList_li">
		<a href="#" class="question-item">
		<div class="tit">
			<span class="status" id="mark">미답</span>
			<div class="subject" id="q_subject"></div>
			<div class="info">
				<span class="name" id="q_name"></span>
				<span class="date" id="q_date"></span>
			</div>
		</div>
		</a>
	</li>
	`;

    let regAnswer_html = `

        <form>
            <input type="hidden" id="rowid">
			<div class="answer-item">
				<div class="input-item">
					<div class="input-item-inner">
						<textarea id="ancontext" onkeydown="resize(this)" onkeyup="resize(this)" rows="8" cols="80"></textarea>
					</div>
				</div>
				<div class="row right col-1">
					<div class="column">
						<button class="btn-crud natural" id="submitAnswer">답변등록</button>
					</div>
				</div>
			</div>
		</form>
	`;

    $qna_li = $(qna_li_html);

    if (data["docsate"] == 0 || data.ancontext == "") {
        $qna_li.addClass("on");
        $qna_li.find("#mark").text("미답");

        if (gubun == "QnaBoard") {
            let $regAnswer = $(regAnswer_html);
            $regAnswer.appendTo($qna_li);
            $regAnswer.find(".answer-item").css("padding", "35px");

            // let answertxt = $form.val();

            $regAnswer.find("#rowid").val(data.rowid);
            // $regAnswer.find('#ancontext').val(answertxt);

            $regAnswer.find("#submitAnswer").on("click", function () {
                if ($regAnswer.find("#ancontext").val() !== "") {
                    $regAnswer.submit();
                }

                return false;
            });

            $regAnswer.on("submit", function () {
                var json_data = Make_JSON_Data($regAnswer);

                async_ajax("/vender/qna_write", json_data, change_result);

                return false;
            });
        }
    } else {
        $qna_li.find("#mark").text("답변");
        $qna_li.find("#mark").addClass("check");

        var answer_html = `
		<div class="answer-item">
			<div class="info">
				<span class="name" id="ans_name">관리자</span>
				<span class="date" id="ans_date">2020.12.21</span>
			</div>
			<p class="desc" id="ans_cont">
				해당 상품의 문의에 대한 내용 
			</p>
		</div>
		`;

        var $answer = $(answer_html);
        $answer.appendTo($qna_li);

        var write_date = getFormatDate(new Date(data["anregdate"]));

        $answer.find("#ans_date").text(write_date);

        var ancontext_txt = data["ancontext"];
        var ancontext = ancontext_txt.replace(/\n/g, "<br>");

        $answer.find("#ans_date").text(write_date);
        // $answer.find('#ans_name').text(data['anname']);
        $answer.find("#ans_cont").html(ancontext);
    }

    var write_date = getFormatDate(new Date(data["regdate"]));

    $qna_li.find("#q_date").text(write_date);

    var context_txt = data["context"];
    var context = context_txt.replace(/\n/g, "<br>");

    if (gubun == "creatorQna") {
        let $creatorQna = $('<div id="contextBox"></div>');

        $qna_li.find("#q_subject").after($creatorQna);

        $creatorQna.html(context);
        $creatorQna.css({
            display: "none",
        });

        $qna_li.find("#q_subject").text("[" + data.doctypetxt + "] " + data.doctitle);
    } else {
        $qna_li.find("#q_subject").html(context);
        $qna_li.find("#q_name").text(decodeURIComponent(data["writename"]));
    }

    if (gubun == "QnaBoard" || gubun == "creatorQna") {
        target_ul.find("ul").append($qna_li);
    } else {
        target_ul.find("ul").prepend($qna_li);
    }

    if (gubun == "QnaBoard" || gubun == "myQna") {
        goodsphoto = data.photo_url;
        goodsrow = data.goodsrow;
        goodsname = data.goodsname;

        var $thumb = $('<img src="" alt="" id="thumb">');

        $thumb.attr({
            title: data.goodsname,
            rowid: data.goodsrow,
            src: goodsphoto,
            title: goodsname,
        });

        let Trowid = $thumb.attr("rowid");
        $qna_li.find("#mark").before($thumb);

        $qna_li.find("#thumb").click(function () {
            window.location.href = "../product/?mode=detail&pgCode=" + Trowid;
        });

        if (gubun == "myQna") {
            $qna_li.find("#q_name").empty();
        }
    }
}

function change_result(result) {
    if (result.result == "success") {
        alert("답변완료");
        location.reload();
    } else {
        alert(result.message);
    }
}

var myDoip_pd = function (result, gubun = "", target_id = "") {
    let orregcode_wrap_html = `
	<li class="list-report-item">
		<div class="list-report-head">
			<span class="status"></span>
			<span class="info">
				<a href="javascript:" class="btn-text">주문상세보기
				</a>
			</span>
		</div>
		<ul id="myDoipList">

		</ul>
	</li>
	`;

    let pdList_html = `
	<li>
		<div class="report-item" style="position:relative;">
			<div class="grid-div cardWrap">
				<div class="left80">
					<div class="report-detail">
						<div class="products-head">
							<img class="thumb" src="" alt="">
						</div>
						<div class="products-body">
							<a href="#" class="product-info">
								<div class="tit">상품이름</div>
								<div class="desc"></div>
								<span class="txt-info optName">옵션 : 옵션내용</span>
							</a>
							<em class="nagetive sortType">9% </em>
							<span class="num price">20,000</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</li>
	`;

    let regiSatis_html = `

	<div class="right20"  style="position:absolute; right:3%; top:50%; transform:translateY(-50%);">
		<div class="list-btn">
			<div>
				<a href="javascript:" class="btn-crud positive">만족도평가</a>
			</div>
		</div>
	</div>
	`;

    let regiStar_html = `
	<div class="star-rating">
		<div class="star-rating-inner">
			<a href="#" class="star" value="1"></a>
			<a href="#" class="star" value="2"></a>
			<a href="#" class="star" value="3"></a>
			<a href="#" class="star" value="4"></a>
			<a href="#" class="star" value="5"></a>
		</div>
	</div>
	`;

    let layerCancel_html = `

	<div class="list-btn row col-1">
		<div class="column">
			<a href="javascript:" class="btn-crud" id="ordCancelBtn">주문취소 요청</a>
		</div>
	</div>
	`;

    // 구매내역버튼
    let ord_cancel_html = `	
	<div class="list-btn row col-1">
		<div class="column">
			<a href="javascript:" class="btn-crud close">주문취소 요청</a>
		</div>
	</div>
	`;

    let payStatus_html = `
		<div class="grid-div">
			<div class="left" style="margin-bottom:15px;">
			<span class="use-status"><em class="positive"> </em><em class="normal statusTxt">/ 사용권동의완료</em>
			</div>
		</div>
	`;
    // 사용권동의완료, 리워드 공개일, 다운로드기한

    let ordDetail_html = `
	<div class="right20">
		<div class="list-btn">
			<div><a href="javascript:" class="btn-crud positive first">파일받기 (<span id="now_count"></span>/<span id="total_count">2</span>)</a>
				<div class="progress"></div>
			</div>
			<div><a href="javascript:" class="btn-crud nagetive second disabled" style="display: block;">사용권 동의</a></div>
			
		</div>
	</div>
	`;
    // <div><a href="javascript:" class="btn-crud third">거래내역확인서</a></div>
    let save_ordregcode = "";
    let $orregcode_wrap = null;

    result.data.forEach(function (data, idx) {
        list = data.list_data;
        order = data.order_data;
        product = data.product_data;

        let $pdList = $(pdList_html);
        let $regiSatis = $(regiSatis_html);
        let $addSatis = $pdList.find(".cardWrap");

        if (gubun == "satis_pop") {
            //만족도등록 팝업
            $(target_id).append($pdList);

            let $regiStar = $(regiStar_html);
            $regiStar.css("margin-top", "13px");

            $pdList.find(".sortType").remove();
            $pdList.find(".price").remove();
            $pdList.find(".products-body").append($regiStar);

            $pdList.attr("data_rowid", list.rowid);
            $pdList.attr("data_orregcode", list.orregcode);
            $pdList.attr("data_goodsoptionnum", list.goodsoptionnum);
            $pdList.attr("data_ordrowid", list.rowid);
        } else {
            if (gubun == "ordDetail" || gubun == "saleHistory") {
                if (save_ordregcode != list.orderdate) {
                    $orregcode_wrap = $(orregcode_wrap_html);
                    // $('#list_acc').append($orregcode_wrap);
                    save_ordregcode = list.orderdate;
                }

                $orregcode_wrap.find(".info").remove();
                $orregcode_wrap.find(".status").text("주문번호 : " + list.orregcode);

                $pdList.css("margin", "0");
                $pdList.css("padding", "0");
                $pdList.find(".report-item").css("padding", "15px 10px");
                $pdList.find(".product-info").find("div").css("overflow", "unset");
            } else {
                $(".disabled").css("cursor", "default");
                if (save_ordregcode != list.orregcode) {
                    $orregcode_wrap = $(orregcode_wrap_html);
                    $("#list_acc").append($orregcode_wrap);
                    save_ordregcode = list.orregcode;

                    let timeLimit = new Date(order.orderdate);
                    let week = new Array("일", "월", "화", "수", "목", "금", "토");
                    let dayName = null;

                    dayName = week[timeLimit.getDay()];

                    $orregcode_wrap.find(".status").text(order.orderdate + " (" + dayName + ")");
                    $orregcode_wrap.find(".btn-text").attr("data_ordnum", list.orregcode);

                    $orregcode_wrap.find(".btn-text").on("click", function (e) {
                        show_stais(e, "ordDetail");
                    });
                }
            }

            let $myDoipList = $orregcode_wrap.find("#myDoipList");

            $myDoipList.append($pdList);
            $(target_id).append($orregcode_wrap);
        }

        $pdList.find(".thumb").attr("src", product.photo_url);
        $pdList.find(".tit").text(list.goodsname);
        
        $pdList.find(".desc").text(product.GoosInfor);
        $pdList.find(".optName").text(list.goodsoptioncode);
        $pdList.attr("data_rowid", list.rowid);
        $pdList.find(".price").text(price_format(list.price));
        $pdList.find(".left80").attr("data_gsid", list.gsid);

        $pdList.find(".left80").on("click", function (e) {
            let $thisE = $(this);
            // console.log($thisE)
            // let val = $thisE[0].attributes[1].value;
            let val = $thisE.attr("data_gsid");

            window.location.href = "../product/?mode=detail&pgCode=" + val;
        });


        let sortMode = null;

        if (list.scodeone == "50") {
            if(list.sucesstype == 1){
                sortMode = '참여 펀딩';
            }else{
                sortMode = '후원 펀딩';
            };
            $pdList.find(".sortType").css('color','var(--color-funding)');
        
        } else {
            sortMode = '마켓';
            $pdList.find(".sortType").css('color','var(--color-market)');
        }
        $pdList.find(".sortType").text(sortMode);

        if (gubun == "satis") {
            //만족도평가btn
            $addSatis.append($regiSatis);

            $pdList.attr("id", "satis_" + list.rowid);

            let $btnSatis = $regiSatis.find(".positive");

            $btnSatis.attr("id", "btnSetis_" + list.rowid);
            $btnSatis.attr("data-option-idx", idx);
            $btnSatis.attr("data_ordNum", list.orregcode);

            // console.log(result);

            if (list.postscriptwr == 1) {
                patchStar(data, "dp");
            }

            $btnSatis.on("click", function (e) {
                show_stais(e, "satis");
            });
        } else if (gubun == "ordList") {

            $pdList.find(".cardWrap").css("margin-bottom", "40px");
            $pdList.find(".left80").css({
                position: "absolute",
                top: "36%",
            });

            let $payStatus = $(payStatus_html);
            $pdList.find(".report-item").prepend($payStatus);

            let $ordDetail = $(ordDetail_html);
            $addSatis.append($ordDetail);

            $ordDetail.find(".btn-crud").css("padding", "5px 0");

            let ordState = list.orderstate;
            let stateTxt = null;

            switch (ordState) {
                case 1:
                    stateTxt = "결제완료 ";
                    break;
                case 10:
                    stateTxt = "구매취소 ";
                    $payStatus.find(".statusTxt").remove();
                    break;
                case 30:
                    stateTxt = "환불·승인취소 신청 ";
                    $payStatus.find(".statusTxt").remove();
                    break;
                case 31:
                    stateTxt = "환불·승인취소 접수 ";
                    $payStatus.find(".statusTxt").remove();
                    break;
                case 32:
                    stateTxt = "환불·승인취소 완료 ";
                    $payStatus.find(".statusTxt").remove();
                    break;
            }

            $payStatus.find(".positive").text(stateTxt);
            $payStatus.find(".positive").css('color','#000');

            let status = "";
            // let first = '';
            let second = "사용권 동의";
            // let third = null;

            let timeLimit = new Date(order.orderdate);
            let week = new Array("일", "월", "화", "수", "목", "금", "토");
            let dayName = null;

            if (product.RegGoodsType == "2") {
                //실물
                if (product.dateDiffNum < 0) {
                    $ordDetail.find(".first").text("펀딩 종료");
                    $ordDetail.find(".first").addClass("disabled");
                } else {
                    $ordDetail.find(".first").text("펀딩 진행중");
                    $ordDetail.find(".first").css('cursor','default');
                }

                timeLimit = new Date(list.download.timeofimplementation);
                dayName = week[timeLimit.getDay()];

                $ordDetail.find(".second").remove();
                $pdList.find(".cardWrap").css("margin-bottom", "67px");

                if (list.download.timeofimplementation !== undefined) {
                    status = "리워드 발송 예정일 " + timeLimit.toLocaleDateString() + "(" + dayName + ")";
                }
            } else {
                if (list.scodeone == "50") {
                    //무형

                    if (product.dateDiffNum < 0) {
                        if (list.download.filename == "") {
                            $ordDetail.find(".first").text("파일 미등록");
                        }
                    } else {
                        $ordDetail.find(".first").text("펀딩 진행중");
                        $ordDetail.find(".first").css('cursor','default');
                    }

                    //timeofimplementation : 예상 시행시기(다운로드 횟수 있을때만 유효함)
                    if (list.download.timeofimplementation !== undefined) {
                        timeLimit = new Date(list.download.timeofimplementation);
                        timeLimit.setDate(timeLimit.getDate() + 7);
                        dayName = week[timeLimit.getDay()];

                        status = "다운로드 기한 " + timeLimit.toLocaleDateString() + "(" + dayName + ") 까지";
                    } else {
                        status = "다운로드 완료";
                    }
                } else {
                    // 마켓

                    timeLimit.setDate(timeLimit.getDate() + 2);
                    dayName = week[timeLimit.getDay()];

                    let hours = timeLimit.getHours();
                    let minutes = timeLimit.getMinutes();
                    status = "다운로드 기한 : " + timeLimit.toLocaleDateString() + "(" + dayName + ") " + hours + "시 " + minutes + "분 " + "까지";
                }

                $payStatus.find(".use-status").css("cursor", "default");

                let today = getFormatDate(new Date());
                // let today = new Date().toLocaleDateString();
                // let limit = timeLimit.toLocaleDateString();
                let limit = getFormatDate(timeLimit);

                if (limit < today) {
                    $ordDetail.find(".first").addClass("disabled");
                    $ordDetail.find(".first").text("기한만료");
                }

                let downCount = list["download"]["count"];
                $ordDetail.find("#now_count").text(downCount);

                let $firstBtn = $ordDetail.find(".first");
                let ori_filename = list["download"]["filename"];

                if (downCount < 2) {
                    $ordDetail.find(".progress").attr({
                        id: "prog_" + list.rowid,
                        "data-rsGsID": list.gsid,
                        "data-rsOrRegCode": list.orregcode,
                    });

                    $firstBtn.attr({
                        id: "down_" + list.rowid,
                        "data-orregcode": list.orregcode,
                        "data-goodsoptionnum": list.goodsoptionnum,
                        "data-fixstate": list.fixstate,
                        "data-rowid": list.rowid,
                        "data-index": idx,
                        "data-fileName": ori_filename,
                    });

                    $firstBtn.on("click", function (e) {
                        e.preventDefault();
                        let btn = $(this);

                        if (btn.hasClass("disabled")) return false;

                        btn.addClass("disabled");

                        let orregcode = btn.attr("data-orregcode"); //
                        let optionnum = btn.attr("data-goodsoptionnum"); //
                        let fixstate = btn.attr("data-fixstate"); //
                        let rowid = btn.attr("data-rowid"); //
                        let index = btn.attr("data-index"); //
                        let fileName = btn.attr("data-fileName");

                        DownFile(optionnum, rowid, fixstate, orregcode);
                        return false;
                    });
                } else if (downCount >= 2) {
                    $ordDetail.find(".first").addClass("disabled");
                    status = "다운로드 완료";
                }

                $ordDetail.find(".second").attr({
                    id: "agree_" + list.rowid,
                    "data-filepath": list.download.certificate,
                });

                if (list.fixstate == 1) {
                    $ordDetail.find(".second").removeClass("disabled");
                }

                $ordDetail.find(".second").on("click", function (e) {
                    if (!$ordDetail.find(".second").hasClass("disabled")) {
                        var btn = $(e.target);
                        var file_path = btn.attr("data-filepath");

                        window.open("https://" + location.host + "/file_room/certificate/" + file_path, "certificate", "width=1000,height=720,top=0,left=0");

                        return false;
                    }
                });
            }

            if (status !== "") {
                $payStatus.find(".statusTxt").text(" / " + status);
            } else {
                $payStatus.find(".statusTxt").empty();
            }

            $ordDetail.find(".second").text(second);
            // $ordDetail.find('.third').text(third);
        }
    });

    if (gubun == "ordDetail") {
        let cancel_flag = true;
        // let now = getFormatDate(new Date());	//필요한것인지
        let limitDate = new Date(list.orderdate);
        limitDate.setDate(limitDate.getDate() + 2);

        if (product.ScodeOne == "50" && product.dateDiffNum < 0) {
            cancel_flag = false;
        }

        if (list.fixstate !== "0" || list.orderstate !== 1 || limitDate < new Date()) {
            //사용권동의 & 결제완료 & 주문 후 2일 경과
            cancel_flag = false;
        }

        if (cancel_flag) {
            let $layerCancel = $(layerCancel_html);
            $("#canclePoint").append($layerCancel);
            $layerCancel.find("#ordCancelBtn").attr("data_ordnum", list.orregcode);

            $layerCancel.find("#ordCancelBtn").on("click", function (e, result) {
                // ordCancel(e, result);
                show_stais(e, "cancel");
            });
        }
    }
};

function show_stais(e, gubun) {     //show_satis
    let regcode = $(e.target).attr("data_ordnum");
    let alert_obj = null;

    if (gubun == "satis") {
        alert_obj = {
            html_url: "/new_pc/assets/html/satisPop.html",
            buttons: [
                {
                    btn_text: "만족도 등록",
                    callback: send_setis,
                },
            ],
        };
    } else if (gubun == "cancel") {
        let order_code = $(e.target).attr("data_ordnum");

        alert_obj = {
            html_url: "/new_pc/assets/html/ordCancel.html?order_code=" + order_code,
            attr: regcode,
            param: {
                orregcode: order_code,
            },
        };
    } else if (gubun == "coupon") {
        // idx = $(e.target).attr("data_idx");
        idx = $("#popup_modal").find("#idx").val();
        gs_id = $("#popup_modal").find("#gs_id").val();

        alert_obj = {
            html_url: "/new_pc/assets/html/coupon.html",
            attr: idx,
            param: {
                idx: idx,
                gs_id: gs_id,
            },
        };
    } else {
        alert_obj = {
            html_url: "/new_pc/assets/html/ordDetail.html",
            attr: regcode,
        };
    }

    layer_alert(alert_obj);

    if (gubun == "satis") {
        $("#popup_modal").find(".close").addClass("disabled");
    };

    let tmp_data = {
        data: [],
    };

    order_data.data.forEach(function (data, idx) {

        if(gubun == "coupon") 
        {   
            if (data.regcode) 
            {
                tmp_data["data"].push(data);
            }
        }else{
            if (data.list_data.orregcode == regcode) 
            {
                tmp_data["data"].push(data);
            }
        };

        // if (data.list_data.orregcode == regcode) 
        // {
        //     tmp_data["data"].push(data);
        // }
        
    });

    if (tmp_data["data"].length > 0) {
        // tmp_data = order_data;

        if (gubun == "satis") {
            let addSatis = $("#addSatis");
            myDoip_pd(tmp_data, "satis_pop", addSatis);
        } else if (gubun == "cancel") {
            tmp_data["data"].forEach(function (result) {
                // console.log(list);
                address = result.address_data;
                list = result.list_data;
                order = result.order_data;
                product = result.product_data;

                $("#canOrdNum").text(list.orregcode);
                $("#orregcode").text(list.orregcode);

                let product_name = list.goodsname;

                if (tmp_data["data"].length > 1) {
                    product_name += " 외 " + (tmp_data["data"].length - 1) + "종";
                }

                $("#canInfo").text(product_name);
                $("#canPrice").text(price_format(list.price));
            });
        } else {
            //주문상세 & 판매내역관리

            let addSatis = $("#Detail_Ecc");

            if (gubun == "ordDetail") {
                myDoip_pd(tmp_data, "ordDetail", addSatis);
            }else if(gubun == "coupon") {

            }else {
                myDoip_pd(tmp_data, "saleHistory", addSatis);
            }
            tmp_data["data"].forEach(function (data) {
                if(gubun == "coupon") {
                    // console.log(data);
                    // $('.CP_ordName').text(data.goodsname);

                    let cpTit_html = `
                    <li>
                        <div class="CP_tit">
                            
                        </div>
                    </li>
                    `;
                    
                    // let option = data.option;
                    // option.forEach(function(opt){
                    //     // console.log(opt);
                        
                    //     let $cpTit = $(cpTit_html);
                    //     $('.CP_optBox').find('.CP_tit').text(opt.catcode)
                    //     $('.CP_optBox').append($cpTit);


                    // });

                }else{
                    let address = data.address_data;
                    let order = data.order_data;
                    let product = data.product_data;

                    let timeLimit = new Date(order.orderdate);
                    let week = new Array("일", "월", "화", "수", "목", "금", "토");
                    let dayName = null;

                    dayName = week[timeLimit.getDay()];

                    let ordName = null;

                    if (gubun == "saleHistory") {
                        if (address.ordername == "") {
                            ordName = order.nickname;
                        } else {
                            ordName = address.ordername + " (" + order.nickname + ")";
                        }
                        $(".tordName").text(ordName);
                    } else {
                        $(".tordName").text(address.ordername);
                    }

                    $(".tordPh").text(address.handpnum);
                    $(".tordEm").text(address.useremail);
                    $(".tordTel").text(address.telnum);

                    // $(".ordDate").text(order.orderdate);
                    $(".tordDate").text(order.orderdate + " (" + dayName + ")");
                    $(".totPrice").text(price_format(order.orderprice));

                    let ordState = list.orderstate;
                    let stateTxt = null;

                    switch (ordState) {
                        case 1:
                            stateTxt = "결제완료 ";
                            break;
                        case 10:
                            stateTxt = "구매취소 ";
                            break;
                        case 30:
                            stateTxt = "환불·승인취소 신청 ";
                            break;
                        case 31:
                            stateTxt = "환불·승인취소 접수 ";
                            break;
                        case 32:
                            stateTxt = "환불·승인취소 완료 ";
                            break;
                    }

                    $(".payState").text(stateTxt);

                    let settletype = "";

                    switch (order.settletype) {
                        case "free":
                            settletype = "무료상품";
                            break;
                        case "creditcard":
                            settletype = "신용카드";
                            break;
                        case "virtualaccount":
                            settletype = "가상계좌";
                            break;
                        case "banktransfer":
                            settletype = "무통장";
                            break;
                        case "kakaopay":
                            settletype = "카카오페이";
                            break;
                        case "payco":
                            settletype = "페이코";
                            break;
                    }

                    $(".payType").text(settletype);

                    if (list.scodeone == "50" && product.RegGoodsType == "2") {
                        $(".tordAdd").text("[" + address.zipcode + "] " + address.address + " " + address.addressadd);

                        let ordState = list.orderstate;

                        if (ordState == 1) {
                            $(".tordMsg").text(order.memo);
                        } else {
                            $(".tordMsg").parents("tr").remove();
                        }
                    } else {
                        $(".tordAdd").parent().remove();
                        $(".tordMsg").parent().remove();
                    }
                }
            });
        }

        modalUi();

        $(".star-rating .star").on("click", function (e) {
            e.preventDefault();
            $(this).addClass("on").prevAll(".star").addClass("on");
            $(this).addClass("on").nextAll(".star").removeClass("on");

            let flag = true;

            let li = $("#popup_modal .modal-body ul li");

            li.each(function (idx, elm) {
                opt = $(elm);

                let bright_star = opt.find(".star.on").length;

                if (bright_star == 0) {
                    flag = false;
                    return;
                }
            });

            if (flag) $("#popup_modal").find(".close").removeClass("disabled");

            return false;
        });
    }

    return false;
}

function ordCancel(e, result) {
    let cancel_flag = true;

    if (cancel_flag) {
        layer_popup("../assets/html/ordCancel.html");

        return false;
    }
}

function DownFile(InvRowid, OrdRowid, FixState, rsOrRegCode) {
    var con_text = false;
    if (FixState == "0") {
        con_text = confirm("다운로드 이후는 취소/환불이 불가합니다.");
    }
    if (con_text == true || FixState == "1") {
        var CouNum = $("#doCount1").val();
        $.ajax({
            type: "POST",
            url: "getDownFile.php",
            //cache:true,
            data: {DownFile: CouNum, InvRowid: InvRowid, rsOrRegCode: rsOrRegCode},
            dataType: "json",
            error: function (request, status, error) {
                $("#down_" + OrdRowid).removeClass("disabled");
                alert("에러가 발생했습니다., \n\r 상태코드:" + request.status + "\n\r 에러메세지 : \n\r" + request.responseText);
            },
            success: function (Result, status, error) {
                // $("#Download_btn_"+OrdRowid).css("display", "none");
                if (Result.rsFiDownCon == "0") {
                    DownFile2(Result.InvRowid, OrdRowid, FixState, rsOrRegCode);
                }
            },
        });
    }
}

function DownFile2(InvRowid, OrdRowid, FixState, rsOrRegCode) {
    var CouNum = $("#doCount2").val();
    var progress = $("#prog_" + OrdRowid).get(0);
    $.ajax({
        type: "POST",
        url: "getDownFile.php",
        //cache:true,
        data: {DownFile: CouNum, InvRowid: InvRowid, rsOrRegCode: rsOrRegCode},
        dataType: "json",
        error: function (request, status, error) {
            alert("에러가 발생했습니다.. \n\r 상태코드:" + request.status + "\n\r 에러메세지 : \n\r" + request.responseText);
        },
        success: function (Result, status, error) {
            // alert(Result);
            var rsFileDownURL = Result.FileDownURL;
            var rsFileDownLink = Result.FileDownLink;
            var rsFileDownName = Result.FileDownName;

            function show_progress(per) {
                progress.style.setProperty("--progressValue", per + "%");
            }

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    show_progress(100);
                    progress.style.setProperty("--progressColor", "#12de12");
                    //this.response is what you're looking for
                    // console.log(this.response, typeof this.response);
                    var url = window.URL || window.webkitURL;

                    if (navigator.msSaveBlob) {
                        return navigator.msSaveBlob(this.response, rsFileDownName);
                    } else {
                        var link = document.createElement("a");
                        link.href = window.URL.createObjectURL(this.response);
                        link.download = rsFileDownName;
                        link.click();
                    }

                    var rsGsID = $("#prog_" + OrdRowid).attr("data-rsGsID");
                    var rsOrRegCode = $("#prog_" + OrdRowid).attr("data-rsOrRegCode");

                    DownFile3(InvRowid, OrdRowid, FixState, rsOrRegCode, rsGsID, InvRowid);
                }
            };
            xhr.onprogress = function (e) {
                show_progress(Math.floor((e.loaded / e.total) * 100));
            };
            xhr.onerror = function (e) {
                progress.style.setProperty("--progressColor", "#e64764");
            };
            xhr.open("GET", rsFileDownLink);
            xhr.responseType = "blob";
            xhr.send();
        },
    });
}

function DownFile3(InvRowid, OrdRowid, FixState, rsOrRegCode, rsGsID, rsGsOptionNum) {
    var CouNum = $("#doCount3").val();
    var progress = $("#prog_" + OrdRowid).get(0);

    var agree = $("#agree_" + OrdRowid);

    $.ajax({
        type: "POST",
        url: "getDownFile.php",
        //cache:true,
        data: {
            DownFile: CouNum,
            InvRowid: InvRowid,
            OrdRowid: OrdRowid,
            FixState: FixState,
            rsOrRegCode: rsOrRegCode,
            rsGsID: rsGsID,
            rsGsOptionNum: rsGsOptionNum,
        },
        dataType: "json",
        error: function (request, status, error) {
            // progress.style.setProperty("--progressColor","#e64764");
            alert("에러가 발생했습니다. \n\r 상태코드:" + request.status + "\n\r 에러메세지 : \n\r" + request.responseText);
        },
        success: function (Result, status, error) {
            // progress.style.setProperty("--progressColor","#12de12");

            // $("#DowonBtn_"+OrdRowid).html("");
            var btn_down = $("#down_" + OrdRowid);

            btn_down.attr("data-fixstate", "1");

            let index = btn_down.attr("data-index");

            order_data.data[index].list_data.fixstate = "1";

            var now_count = btn_down.find("#now_count");

            now_count.text(Result.FiDownCon);

            if (Result.FiDownCon < 2) {
                btn_down.removeClass("disabled");
            }

            // if (Result.FixState == 0)	//동의 전
            // {
            //     // agree.removeAttr("style");

            //     // 인증서 이미지 경로
            //     agree.attr("certificate", Result.DownLoadRsPath);
            //     agree.removeClass('disabled');
            // }
            agree.removeClass("disabled");
            agree.on("click", function (e) {
                var btn = $(e.target);
                var file_path = btn.attr("data-filepath");

                window.open("https://" + location.host + "/file_room/certificate/" + file_path, "certificate");

                return false;
            });

            // $("#DowonFixSt_"+OrdRowid).html("<i class=\"fas fa-edit\" onClick=\"RayerPopupWin( 'CertificateFm', 'CertRayer', '"+ Result.DownLoadRsPath +"'); return false;\" ></i>");
        },
    });
}

function send_setis() {
    // orredcode, goodsoptionnum, ordrowid, stat_val

    let li = $("#popup_modal .modal-body ul li");

    let liLength = $("#popup_modal .modal-body ul li").length;

    let write_list = new Array();

    let send_flag = true;
    let opt = null;

    li.each(function (idx, elm) {
        opt = $(elm);

        let rowid = opt.attr("data_rowid");
        let orregcode = opt.attr("data_orregcode");
        let goodsoptionnum = opt.attr("data_goodsoptionnum");
        let ordrowid = opt.attr("data_ordrowid");

        let option = new Object();

        option["orregcode"] = orregcode;
        option["goodsoptionnum"] = goodsoptionnum;
        option["ordrowid"] = ordrowid;

        write_list.push(option);

        let bright_star = opt.find(".star.on");

        option["star_val"] = bright_star.length;

        if (option["star_val"] == 0) {
            send_flag = false;
        }
    });

    if (send_flag) {
        let order_data = {
            mode: "satis_write",
            product_data: write_list,
        };

        let choice_data = JSON.stringify(order_data);

        async_ajax("/user/satis_write", choice_data, write_result);
        // alert('send_flag');
    } else {
        alert("만족도를 모두 표시해주세요.");
    }
}
function write_result(result) {
    if (result["result"] == "success") {
        var config = {
            title: "만족도 등록 완료",
            html_url: "/new_pc/assets/html/alert.html",
            message: "만족도가 등록 되었습니다.",
            buttons: [
                {
                    btn_text: "확인",
                    callback: "close",
                },
            ],
        };

        layer_alert(config);
        $("#popup_modal .modal-inner").css("width", "380px");
        createDim();

        // return false;
        result.data.forEach(function (data) {
            patchStar(data, "reg");
        });
    } else {
        var config = {
            title: "에러",
            html_url: "/new_pc/assets/html/alert.html",
            message: "서버 처리중 에러가 발생했습니다. \r\n 다시 시도해주세요.",
            buttons: [
                {
                    btn_text: "확인",
                    callback: "close",
                },
            ],
        };
        layer_alert(config);
        $("#popup_modal .modal-inner").css("width", "380px");
        createDim();

        return false;
    }
}

function patchStar(result, gubun = "") {
    let rowid = null;
    let point = null;

    if (gubun == "dp") {
        rowid = result.list_data.rowid;
        point = result.order_data.setis_val;

        // point = result.product_data.AddPoint;
    } else {
        rowid = result["rowid"];
        point = result["gspointval"];
    }

    let $btnSatis = $("#btnSetis_" + rowid);

    let star_html = `
		<div class="star-rating">
			<div class="star-rating-inner">
				<a href="javascript:" class="star"></a>
				<a href="javascript:" class="star"></a>
				<a href="javascript:" class="star"></a>
				<a href="javascript:" class="star"></a>
				<a href="javascript:" class="star"></a>
			</div>
		</div>
	`;
    let $dpStar = $(star_html);

    $btnSatis.parents(".list-btn").append($dpStar);
    $btnSatis.remove();

    if (point == "5") {
        $dpStar.find(".star").addClass("on");
    } else {
        $dpStar.find(".star").eq(point).prevAll().addClass("on");
    }

    $dpStar.find(".star").css("cursor", "default");

    $(".star-rating .star").on("click", function (e) {
        e.preventDefault();

        return false;
    });
}

function make_pagination(data) {
    $(".listTot").text("총 " + data.total + "개");
    $(".listTot").css({
        "text-align" : "right",
        "padding" : "0 5px 5px"
    });
    
    $(".pagination-inner").empty();

    if (data["page_now"] <= data["total_page"]) {
        let req_num_row = 5;
        let gap = Math.floor(req_num_row / 2);
        let now_page = data.page_now;
        // let start_page = product_list['page_now'] - gap;
        // let end_page = product_list['page_now'] + gap;

        let start_page = now_page - gap;
        let end_page = now_page + gap;
        let prev_page = now_page == 1 ? 1 : now_page - 1;
        let next_page = now_page == data["total_page"] ? data["total_page"] : now_page + 1;

        let $first =
            `
			<li class="gui first">
				<a href="javascript:" onclick="get_nextPage(1);return false;">처음</a>
			</li>
			<li class="gui prev">
				<a href="javascript:" onclick="get_nextPage('` +
            prev_page +
            `');return false;" class="prev">이전</a>
			</li>
		`;

        $(".pagination-inner").prepend($first);

        if (start_page < 1) {
            start_page = 1;
            end_page = req_num_row;
        }

        if (end_page > data["total_page"]) {
            // start_page = (start_page > 1) ? data['total_page'] - req_num_row : 1;
            end_page = data["total_page"];

            if (data["total_page"] - req_num_row < 1) {
                start_page = 1;
            } else {
                start_page = data["total_page"] - req_num_row + 1;
            }
        }

        for (let i = start_page; i <= end_page; i++) {
            let $pages = $('<li class="page_number"></li>');

            if (data["page_now"] == i) {
                $pages.addClass("on");
                let $a = $('<a href="javascript:" onclick="return false;" style="cursor: default">' + i + "</a>");

                $a.appendTo($pages);
            } else {
                let $a = $('<a href="javascript:" onclick="get_nextPage(' + i + ');return false;">' + i + "</a>");

                $a.appendTo($pages);
            }
            $pages.appendTo($(".pagination-inner"));
        }

        let $next = $(
            '<li class="gui next"><a href="#" onclick="get_nextPage(' +
                next_page +
                ');return false;">다음</a></li><li class="gui last"><a href="#" onclick="get_nextPage(' +
                data["total_page"] +
                ');return false;">끝</a></li>'
        );
        $next.appendTo($(".pagination-inner"));
    }
}
