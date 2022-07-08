<?
    include "../inc/top.php";
    include "../inc/left_menu.php";
?>
<style>
.table strong{
	margin-right:20px;
}
.search_form{
	display:grid;
	grid-template-areas: 
		'form_01 form_01 form_01 search'
		'form_02 form_02 form_02 search'
	;
	grid-gap:10px;
	padding:10px;
}
.search_form .search_form_01{
 	grid-area:form_01;
}
.search_form .search_form_02{
	grid-area:form_02;
}
.search_form .search_form_03{
	grid-area:search;
}
.search_form_03 #btn_search{
	width:90%;
}
.product_table table{
	width:100%;
}

.td_link.badge:hover{
	opacity:.7;
	
}
.modal_pay_table{
	height:41px;
	/*text-align: center;*/
}
</style>
<div class="container-fluid">
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Popup">
  Launch demo modal
</button> -->
<script>

	// $(document).ready(function() {

	// 	$('#Modal_Popup').on('show.bs.modal', function (e) {
	// 		var $modal = $(this);

	// 		var header = $modal.find(".modal-title");
	// 		var body = $modal.find(".modal-body");
	// 		var no = $modal.find(".btn-secondary");
	// 		var yes = $modal.find(".btn-primary");

	// 		header.text("주문상태 변경");

	// 		no.text("아니요");
	// 		yes.text("예");

	// 		yes.on("click", function () {
	// 			alert("삭제 진행합니다..")
	// 			var input_rowid = $modal.find("#sample");

	// 			alert(input_rowid.val());
	// 		});

	// 	

	// 		// body.text("정말 삭제할까요?");
	// 		var $input_rowid = $('<input type="text" id="sample">');
	// 		body.append($input_rowid);

	// 	})
	// 	$('#Modal_Popup').on('hide.bs.modal', function (e) {

	// 	})
	// });

	// $(document).ready(function() {

	// 	$('.btn-paystate').on('click', function () {
	// 		var $modal = $('#Modal_Popup').modal();
	// 		var $btn = $(this);
			
	// 		var result = $btn.attr("data-result");
	// 		var OrRegCode = $btn.attr("data-OrRegCode");

	// 		var header = $modal.find(".modal-title");
	// 		header.text(result);
	// 		var body = $modal.find(".modal-body");
	// 		body.text(OrRegCode);

	// 	})
	// });

</script>
    <!-- DataTales Example -->
     <div class="card shadow mb-4">
		<div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">주문관리</h5>
        </div>
        <div class="row p-3  search_form grid-container">
        	<div class="row ml-2  p-1 search_form_01" >
				<div class="input-group col-md-2 col-xs-2" id="div_salemark"></div>
				<div class="input-group col-md-2 col-xs-2" id="div_orderstate"></div>
				<div class="input-group col-md-2 col-xs-2" id="div_payType"></div>
				<div class="input-group col-md-2 col-xs-2">
					<input type="text" class="form-control small" id="OrRegCode" placeholder="주문번호">
				</div>
				<div class="input-group col-md-2 col-xs-2">
					<input type="text" class="form-control small" id="OrderID" placeholder="주문자 ID">
				</div>
				<div class="input-group px-1 col-md-1 col-xs-1" >
					<input type="text" class="form-control small" id="OrderName" placeholder="주문자명">
				</div>
				
			</div>
			<div class="row ml-2  p-1 search_form_02">
				<div class="input-group col-md-2 col-xs-2">
					<input type="text" class="form-control small" autocomplete="on"  placeholder="업체명">
				</div>
				<div class="input-group date  col-md-2 col-xs-2" >
					<input type="text" class="form-control small" value="<?=date("Y-m-01")?>" id="Start_Date">
					<div class="input-group-append">
						<div class="input-group-text">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
				</div>
				<div class="input-group date col-md-2 col-xs-2" >
					<input type="text" class="form-control small" value="<?=date("Y-m-d")?>" id="End_Date">
					<div class="input-group-append">
						<div class="input-group-text">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
				</div>

				<div class="input-group" style="width: 22%;">
					<button class="form-control mx-1 small rounded search_date" data-reange="today">오늘</button>
					<button class="form-control mx-1 small rounded search_date" data-reange="week">1주일</button>
					<button class="form-control mx-1 small rounded search_date" data-reange="month">이번달</button>
					<!-- <button class="form-control small search_date" data-reange="30">지난30일</button> -->
					<!-- <input type="text" class="form-control small"  placeholder="업체명"> -->
				</div>
			</div>
			<div class="row ml-2 px-3 search_form_03">
				<div class="input-group" >
					<button type="button" class="btn btn-primary small" id="btn_search">검색</button>
				</div>
			</div>
			
		</div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
	                <div class="row">
	                	<div class="col-sm-12">
	                		<table class="table table-bordered dataTable stripe display" id="dataTable">
			                    <thead>
									<tr role="row">
		
									</tr>
			                    </thead>
			                    <tbody class="tbody">

				                </tbody>
			                </table>
			            </div>
			        </div>

					<script type="text/Javascript">

						var Order_State = null;

						
						function product_list ( d ) {

						    var temp = '주문번호:  '+d.OrRegCode;

							var $table = $('<table>');

							var $thead = $('<thead>');

							var $tr = $('<tr>');

								var $th = $('<th>');

									$th.text('주문자');

									$th.appendTo($tr);

									var $td = $('<td>'+d.OrderName+'</td>');

									$td.appendTo($tr);


									$th = $('<th>');

									$th.text('이메일');

									$th.appendTo($tr);

									$td = $('<td>'+d.UserEmail+'</td>');

									$td.appendTo($tr.appendTo($thead.appendTo($table)));

								$tr = $('<tr>');

									$th = $('<th>');

									$th.text('결제수단');

									$th.appendTo($tr);

									$td = $('<td>'+d.SettleType+'</td>');

									$td.appendTo($tr);

									$th = $('<th>');

									$th.text('결제금액');

									$th.appendTo($tr);

									$td = $('<td>'+commaCheck(d.SettlePrice)+'원</td>');

									$td.appendTo($tr.appendTo($thead.appendTo($table)));

								var $tr = $('<tr>');

									$th = $('<th >');

									$th.text('주소');

									$th.appendTo($tr);

									$td = $('<td colspan="3">['+d.ZipCode+'] '+d.Address+' '+d.AddressAdd+'</td>');

									$td.appendTo($tr.appendTo($thead.appendTo($table)));

								$tr = $('<tr>');
	
									$th = $('<th>');

									$th.text('배송 요청사항');

									$th.appendTo($tr);	

									$td = $('<td colspan="3" >'+d.Memo+'</td>');
									
									$td.appendTo($tr.appendTo($thead.appendTo($table)));

									var $p_tr = $('<tr></tr>');
									
									$p_tr.appendTo($thead);

									var $p_td = $('<td colspan="8" class="t_goodsName t_center"></td>');
									
									$p_td.appendTo($p_tr);
									
									var $goodsName = $('<span>'+d.product_data[0].GoodsName+'</span>');

									$goodsName.appendTo($p_td);

	
								var $product_table = $("<table>");

								var $product_tr = $("<tr>");

									$tr = $('<tr>');

									// $th = $ ('<th>');

									// $th.text('상품명');

									// $th.appendTo($product_tr);
											
									$th = $ ('<th>');

									$th.text('옵션');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('수량');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('총액');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('결제상태');

									$th.appendTo($product_tr);


									$th = $ ('<th>');

									$th.text('다운가능기간');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('정산기준날짜');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('다운상태');

									$th.appendTo($product_tr);


									$product_tr.appendTo($product_table);


								d['product_data'].forEach(function(data){

									$tr = $('<tr>');

									$td = $('<td>'+data.CatCode+'</td>');


									var shot_CatCode = make_short_string(data.CatCode, 18);		

									if (shot_CatCode != data.CatCode) {		

										$td.attr("data-tooltip-text", data.CatCode);	
									};
									$td.text(shot_CatCode);

									$td.appendTo($tr);

									$td = $('<td> '+data.Amount+'</td>');

									$td.appendTo($tr);

									$td = $('<td>'+commaCheck(data.Price)+'원</td>');

									$td.appendTo($tr);

									$td = $('<td>'+data.OrderState+'</td>');

									$td.appendTo($tr);

									$td = $('<td> '+data.OrderDateTime+' <i class="fas fa-edit"></i></td>');
									$td.attr("onClick", "show_OrderDateTime()");

									$td.appendTo($tr);

									$td = $('<td>'+data.FixStateDate+' <i class="fas fa-edit"></i></td>');
									$td.attr("onClick", "show_FixStateDate()");

									

									$td.appendTo($tr);

									$td = $('<td>'+data.FixState+'</td>');

									$td.appendTo($tr);

									$tr.appendTo($product_table);

								});

								$p_tr = $('<tr></tr>');
								
								$p_tr.appendTo($thead);

								$p_td = $('<td colspan="4" class="product_table"></td>');
								
								$p_td.appendTo($p_tr);
								
								$product_table.appendTo($p_td);
							
							return $table;

						}




						function modal_pay() {
							
								var $modal = $('#Modal_Popup');
								
								$modal.find(".modal-dialog").attr("style", "max-width: 1000px;");

								var $btn = $(event.target);

								var order_data = jQuery.parseJSON( $btn.attr("data-json") ); // return JSON string

								// 기본 주문 정보
								// var result = $btn.attr("data-result");
								// var OrRegCode = $btn.attr("data-OrRegCode");
								// var GoodsName = $btn.attr("data-GoodsName");
								// var OrderName = $btn.attr("data-OrderName");
								// var OrderState = $btn.attr("data-OrderState");
								// var CatCode = $btn.attr("data-CatCode");//옵션명
								// var UserEmail = $btn.attr("data-UserEmail");
								// var SettlePrice = $btn.attr("data-SettlePrice"); //금액

								// 상세정보(옵션)
								// var FixState = $btn.attr("data-FixState");//확정상태


								var $save_button = $modal.find("btn-primary");

								$save_button.attr("disabled" , "disabled");

								var header = $modal.find(".modal-title");
								header.text("결제상태 변경");


								var body = $modal.find(".modal-body").empty();

								var table = $('<table style="width:100%;">');
								table.appendTo(body);

								var tr = $('<tr>');
								tr.appendTo(table);

									var th =$('<th style="padding:10px; width:310px; ">');
									th.text('주문번호');
									th.appendTo(tr);

									var td = $('<td style="padding-left:6px;">' +  order_data.OrRegCode+'</td>');
									td.appendTo(tr);

								var tr = $('<tr>');
								tr.appendTo(table);	

									var th =$('<th style="padding:10px; width:310px; ">');
									th.text('주문자명');
									th.appendTo(tr);

									var td = $('<td style="padding-left:6px;">'  + order_data.OrderName+' (' + order_data.UserEmail+ ')</td>');
									td.appendTo(tr);



								var tr = $('<tr>');
								tr.appendTo(table);		

									var th =$('<th style="padding:10px; width:310px; ">');
									th.text('결제상태');
									th.appendTo(tr);

									var td = $('<td style="padding-left:6px;">');
									td.appendTo(tr);

									

							//select opt
								var $select = $('<select name="pay_opt" onchange="pay_opt()"  data-OrRegCode='+ order_data.OrRegCode+' data-ori_value='+ order_data.result+'></select>');
								
								$select.appendTo(td);

								if(order_data.FixState === "확정완료"){

									$select.attr("disabled", "disabled");

								}

								// datatable ajax initComplete 에서 Order_State를 전역변수로 저장
								$.each( Order_State, function ( value, str) {
									// 결재상태 텍스트와 같으면 option 에 selected 추가하기 위해 변수를 설정
									// 하단 조건문과 동일한 기능
									var str_select = (order_data.result == str) ? "selected" : "";

									var $option = $('<option value="'+ order_data.value+'" '+str_select+'>'+ str+'</option>');
									$option.appendTo($select);
								})
									
								// 이렇게 하고싶다!!!!
								// var tr = $('<tr>');
								// tr.appendTo(table);

								// 	var th = $('<th style="padding:10px; width:310px; ">');
								// 	th.text('상품명');
								// 	th.appendTo(tr);

								// 	td = $('<td style="padding-left:6px;" rowspan="6">'  + order_data.product_data[0].GoodsName+'</td>');
								// 	td.appendTo(tr);

								var $p_tr = $('<tr></tr>');
											
									$p_tr.appendTo(table);

									var $p_td = $('<td colspan="4" class="t_goodsName t_center"></td>');
									
									$p_td.appendTo($p_tr);
									
									var $goodsName = $('<span>'+order_data.product_data[0].GoodsName+'</span>');

									$goodsName.appendTo($p_td);

								$p_tr = $('<tr></tr>');
											
								$p_tr.appendTo(table);

								var $p_td = $('<td colspan="4" class="product_table"></td>');

								$p_td.appendTo($p_tr);	

								var $product_table = $("<table>");
								$product_table.appendTo($p_td);



								var $product_tr = $("<tr>");
								$product_tr.addClass('modal_pay_table');

									// $tr = $('<tr>');

									$th = $ ('<th>');

									$th.text('옵션');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('수량');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('총액');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('결제상태');

									$th.appendTo($product_tr);


									$th = $ ('<th>');

									$th.text('다운가능기간');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('정산기준날짜');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('다운상태');

									$th.appendTo($product_tr);

									$th = $ ('<th>');

									$th.text('검수상태');

									$th.appendTo($product_tr);

									$product_tr.appendTo($product_table);




								order_data['product_data'].forEach(function(data){

											$tr = $('<tr>');

											$td = $('<td>'+data.CatCode+'</td>');


											var shot_CatCode = make_short_string(data.CatCode, 18);		

											if (shot_CatCode != data.CatCode) {		

												$td.attr("data-tooltip-text", data.CatCode);	
											};
											$td.text(shot_CatCode);

											$td.appendTo($tr);

											$td = $('<td> '+data.Amount+'</td>');

											$td.appendTo($tr);

											$td = $('<td>'+commaCheck(data.Price)+'원</td>');

											$td.appendTo($tr);

											$td = $('<td>'+data.OrderState+'</td>');

											$td.appendTo($tr);

											$td = $('<td> '+data.OrderDateTime+'</td>');
											// $td = $('<td> '+data.OrderDateTime+' <i class="far fa-edit"></i></td>');

											$td.appendTo($tr);

											$td = $('<td>'+data.FixStateDate+' </td>');

											$td.appendTo($tr);

											$td = $('<td>'+data.FixState+'</td>');

											$td.appendTo($tr);

											$td = $('<td>'+data.OrdComplaint+'</td>');

											$td.appendTo($tr);


											

											$tr.appendTo($product_table);

										});

										$p_tr = $('<tr></tr>');
										
										$p_tr.appendTo($product_table);

										$p_td = $('<td colspan="4" class="product_table"></td>');
										
										$p_td.appendTo($p_tr);
										
									
									// return $product_table;
								// 

								
							
								var $save_button = $("#Modal_Popup > div > div > div.modal-footer > button.btn.btn-primary");

								$save_button.attr("disabled", "disabled");

								$modal.modal();

						}

						function pay_opt(){

							var select = $(event.target);

							var ori_value = select.attr("data-ori_value");

							var $save_button = $("#Modal_Popup > div > div > div.modal-footer > button.btn.btn-primary");

							if (ori_value == $(select).find("option:checked").text()) 
							{
								$save_button.attr("disabled", "disabled");
							}
							else{
								$save_button.prop("disabled", false);
							}

							if ($(select).find("option:checked").text() === "구매취소") {
								var $refun_modal = $('#Sub_Modal_Popup');

								$('#Modal_Popup').modal("hide");

								var header = $refun_modal.find(".modal-title");
								header.text("환불정보 입력[" + select.attr("data-OrRegCode") + "]");


								var body = $refun_modal.find(".modal-body").empty();

								var table = $('<table>').appendTo(body);

								var thead = $('<thead>').appendTo(table);


								var tr = $('<tr>').appendTo(thead);

								var th = $('<th>').appendTo(tr);
								th.text('은행');

								th = $('<th>').appendTo(tr);
								th.text('계좌번호');

								th = $('<th>').appendTo(tr);
								th.text('이름');



								tr = $('<tr>').appendTo(table);

								var td = $('<td>').appendTo(tr);
								var $bank_name = $('<input class="form-control small" id="bank_name" placeholder="은행명">');
								$bank_name.appendTo(td);

								var $bank_name = $('<input type="hidden" id="OrRegCode" value="'+select.attr("data-OrRegCode")+'" placeholder="주문번호" readonly>');
								$bank_name.appendTo(td);


								td = $('<td>').appendTo(tr);
								var $bank_account = $('<input class="form-control small" id="bank_account" placeholder="계좌번호">');

								$bank_account.appendTo(td);

								td = $('<td>').appendTo(tr);
								var $account_name = $('<input class="form-control small" id="account_name" placeholder="이름">');

								$account_name.appendTo(td);


								tr = $('<tr>').appendTo(table);	

								th = $('<th>').appendTo(tr);
								th.text('내용');

								td = $('<td colspan="2">').appendTo(tr);
								var $bank_memo = $('<textarea class="form-control small" id="memo" style="resize false" rows="15">');
								$bank_memo.appendTo(td);

								$refun_modal.modal();
							}

							var ok_btn = $('#Sub_Modal_Popup .btn-primary');

							ok_btn.on("click", function() {
								var $refun_modal = $('#Sub_Modal_Popup');

								var OrRegCode = $refun_modal.find("#OrRegCode");
								var bank_name = $refun_modal.find("#bank_name");
								var bank_account = $refun_modal.find("#bank_account");
								var account_name = $refun_modal.find("#account_name");
								var memo = $refun_modal.find("#memo");

								// todo : 환불 정보 입력 완료 후처리 작업 필요함 2020/12/30
								// 필요한 작업 내용
								// 1. 전송할 데이타의 적합성 확인 작업
								// 2. 데이터 전송, 서버 처리, 결과 확인(환불정보가 입력 되었습니다. error /은행명을 넣으시오/계좌번호 자리수가 부족하다/ 너 누구아???/ 넌 안돼~/  )
								// 3. 화면 갱신 ( 리프래시 )

								// alert("은행이름 : " + bank_name.val());
							});




						}

						function modal_memo(){

							var $modal = $('#Modal_Popup');

							var $btn = $(event.target);

							var MadminText = $btn.attr("data-MadminText");

							var header = $modal.find(".modal-title");
							header.text("비고");

							var body = $modal.find(".modal-body").empty();

							$modal.find(".modal-dialog").attr("style", "max-width: 800px;");

							var div = $( '<div class="table"> ' );

							div.appendTo(body);

							$modal.modal();

							function memo_split(str, separator){

								var memoText = str.split(separator);

								return memoText;

							}

							var add = '|';

							MadminText = MadminText.replace(/(<strong>)+/g, add).replace(/(<\/strong>)+/g, "").replace(/<br>/gi, "").replace(/]/gi, "[").replace(/\r/gm, "");

							var arr = memo_split(MadminText, add);

							var table = $('<table style="margin-bottom:25px; width: 100%;">');
							table.appendTo(div);

							var thead = $("<thead>");
							
							var th = $('<th>');
							th.text('관리자');
							th.appendTo(thead);

							var th = $('<th>');
							th.text('날짜');
							th.appendTo(thead);

							var th = $('<th>');
							th.text('내용');
							th.appendTo(thead);

							thead.appendTo(table);

							$.each(arr, function( key, value)
							{
								//tr 만들고
								var tr = $('<tr>');
								tr.appendTo(table);

								var sub_arr = memo_split(value, "[");

								if(sub_arr.length === 3){


									var td = $('<td>');
									td.text(sub_arr[0]);
									td.appendTo(tr);

									var td = $('<td>');
									td.text(sub_arr[1]);
									td.appendTo(tr);

									var td = $('<td>');
									td.text(sub_arr[2]);
									td.appendTo(tr);

									// console.log(sub_arr[0], sub_arr[1], sub_arr[2]);
								}
							});
						}

						function show_OrderDateTime(){
							
							var $modal = $('#Modal_Popup');

							var $btn = $(event.target);

							//var MadminText = $btn.attr("data-MadminText");
							// var order_data = jQuery.parseJSON( $btn.attr("data-json") );

							var header = $modal.find(".modal-title");
							header.text("다운로드 기간 변경");

							var body = $modal.find(".modal-body").empty();

							var table = $('<table style="width:100%;">');
							table.appendTo(body);

							var tr = $('<tr>');
							tr.attr("style","height:50px;");
							tr.appendTo(table);

								var th = $('<th>');
								th.text('기존');
								th.appendTo(tr);

								th = $('<th>');
								th.text('변경');
								th.appendTo(tr);
								

								th = $('<th>');
								th.text('현 시간부터 1시간');
								th.appendTo(tr);
								

								th = $('<th>');
								th.text('작성자');
								th.appendTo(tr);

							tr = $('<tr>');
							tr.appendTo(table);
							

							// order_data['product_data'].forEach(function(data){
							// 	var td = $('<td>'+data.OrderDateTime+'</td>');
							// 	td.appendTo(tr);

							// 	td = $('<td>'+data.OrderDateTime+'</td>');
							// 	td.appendTo(tr);

							// 	td = $('<td>'+data.OrderDateTime+'</td>');
							// 	td.appendTo(tr);

							// 	td = $('<td>'+data.OrderDateTime+'</td>');
							// 	td.appendTo(tr);
							// });

							
								








							$modal.modal();
						}

						function show_FixStateDate(){
							
							var $modal = $('#Modal_Popup');

							var $btn = $(event.target);

							//var MadminText = $btn.attr("data-MadminText");

							var header = $modal.find(".modal-title");
							header.text("정산기준 날짜 변경");

							var body = $modal.find(".modal-body").empty();

							var table = $('<table style="width:100%;">');
							table.appendTo(body);

							var table = $('<table style="width:100%;">');
							table.appendTo(body);							

							var tr = $('<tr>');
							tr.attr("style","height:50px;");
							tr.appendTo(table);

								var th = $('<th>');
								th.text('기존');
								th.appendTo(tr);

								th = $('<th>');
								th.text('변경');
								th.appendTo(tr);

								th = $('<th>');
								th.text('작성자');
								th.appendTo(tr);

							tr = $('<tr>');
							tr.appendTo(table);							


							$modal.modal();
						}

						$(document).ready(function() {

							var sale_config = {
								id : 'ScodeOne',
								class : 'form-control small',
								item : {
									"free": "무료상품",
									"market": "마켓상품",
									"fund": "펀딩상품",
								},
								default : {
									key : "",
									value: "전체",
								}
							};

							$("#div_salemark").append(MakeSelectBox(sale_config));

							var $dt = $('#dataTable');

                            var colomnSet = [
								{
									class: "details-control",
									orderable : false,
									data : null,
									defaultContent : "",
									title: "NO.",
									searchable: false,
									orderable: false,
								 },
								{ 
									title: "주문날짜",
									searchable: false,
									orderable: true,
									data: "OrderDate",
								 }, 
								{ 
									title: "주문번호",
									searchable: false,
									orderable: true,
									data: "OrRegCode",
									class:"details-control02",
								 },
								
								{ 
									title: "주문자",
									searchable: false,
									orderable: false,
									data: "OrderName",
									// class:"orderName",
									className:"t_center",
									createdCell : function( td, cellData, rowData, row, col ){
										var $span = $( '<span class="td_link">'+cellData+'</span>' ).click( function() {
											show_complain_jyh();
										} );

										// rowid, comp_state, goods_name, goods_opt

										$span.attr("data-target", "userinfo");

										$span.attr("data-userroid", rowData.orgUserrowid);

										$( td ).html( $span );


										if(cellData === undefined ){

											$span = $( '<span class="td_link">'+rowData.UserEmail+'</span>' )

										}else{

											$span = $( '<span class="td_link">'+cellData+'</span>' )

										}
									},

								 },
								 
								 { 
									title: "상품명",
									searchable: false,
									orderable: false,
									data: null,
								 },
								 { 
									title: "결제금액",
									searchable: false,
									orderable: false,
									data:null,
									className:"t_right",
								 },

								 { 
									title: "결제상태",
									searchable: false,
									orderable: true,
									data: "OrderState",
									className:"t_right",
									createdCell: function (td, cellData, rowData, row, col) {
										var $span = $('<span onclick="modal_pay()">'+cellData+'</span>');
										$span.addClass("td_link badge badge-secondary ");

										// $span.attr("data-toggle", "modal");
										// $span.attr("data-target", "#Modal_Popup");

										var json = JSON.stringify( rowData );
										$span.attr("data-json", json);

										// $span.attr("data-result", cellData);
										// $span.attr("data-OrRegCode", rowData.OrRegCode);

										// if (rowData.product_data.length > 0)
										// {
										// 	$span.attr("data-GoodsName", rowData.product_data[0].GoodsName);//상품명
										// 	$span.attr("data-CatCode", rowData.product_data[0].CatCode);//옵션명
										// }

										// $span.attr("data-OrderName", rowData.OrderName);//주문자명
										// $span.attr("data-OrderState", rowData.OrderState);//주문상태
										// $span.attr("data-FixState", rowData.product_data[0].FixState);//확정상태
										// $span.attr("data-UserEmail", rowData.UserEmail);
										// $span.attr("data-SettlePrice", rowData.SettlePrice);//결제 금액

										$span.text(cellData);

										$( td ).html( $span );


										if(cellData == '결제완료'){

											$span.addClass('badge bg-secondary text-light');

										} else {

											$span.addClass('badge bg-warning text-dark');

										}

									}

								 },

								  { 
									title: "분류",
									searchable: false,
									orderable: true,
									data: "ScodeOne",
									className:"t_right",
									createdCell: function (td, cellData, rowData, row, col) {
					                	var $span = $('<span>' + cellData + '</span>');

										if (cellData == '마켓') {
											$span.addClass('badge badge-success');
										} else {
											$span.addClass('badge badge-primary');
										}

										// return $span.prop("outerHTML");
										$( td ).html( $span );
									}
								 },

								  { 
									title: "검수",
									searchable: false,
									orderable: false,
									data: "OrdComplaint",
									className:"t_center",
									createdCell: function (td, cellData, rowData, row, col) {
										var td_html = "";

										$.each( rowData.product_data, function(  pkey, pvalue ) {

											if (pvalue['OrdComplaint'] !== '') {
												var $span = $("<span></span>");

												$span.addClass('td_link badge badge-danger');

												$span.attr("onClick", "show_complain_jyh()");

												$span.attr("data-rowid", pvalue.rowid);
												$span.attr("data-Gsid", pvalue.GsID);
												$span.attr("data-comp_state", pvalue.OrdComplaint);
												$span.attr("data-goods_name", pvalue.GoodsName);
												$span.attr("data-goods_opt", pvalue.CatCode);

												$span.attr("data-target", "complain");

													// rowid, comp_state, goods_name, goods_opt
												$span.text(pvalue.OrdComplaint + " [" + pvalue.CatCode + "]");

												td_html += $span[0].outerHTML;
											}
										});

					                    $( td ).html( td_html );

									}
								 },

								{ 
									title: "비고",
									searchable: false,
									orderable: false,
									data:null,
									className:"t_center",
									createdCell: function(td, cellData, rowData, row, col){
										var $span = $('<span class="badge bg-secondary text-light" onclick="modal_memo()">보기</span>');
										if (rowData.MadminText == "")
										{
											$span.text('+');
											$span.removeClass('badge bg-secondary text-light');
										}

										$span.attr("data-MadminText",  rowData.MadminText);




										$( td ).html( $span );


									}
								 },									 
							]

							var columnDefs = [

					          	{
					                "render": function ( data, type, row, meta ) {
										var row_no = meta['settings']['_iDisplayStart'] + meta.row + 1;

										return row_no;
					                },
					                "targets": 0,
									"width": "50px",
								},

								{
					                "render": function ( data, type, row ) {
										var $span = $('<span onclick="show_product( event.target, \'product\');" class="td_link">');

										if (data.product_data.length > 0)
										{
											// var $a = $("<a>");

											// $a.attr("href", '<?=$web_host?>/DisplayGoods.php?CCode='+data.product_data[0].ScodeOne+'&RgdCode='+data.product_data[0].GsID);
											// $a.attr("target", 'order_product');
											// $a.text(data.product_data[0].GoodsName);

											// $a.attr("data-HOST", "");
											// $a.attr("data-CCode", data.product_data[0].ScodeOne);
											// $a.attr("data-RgdCode", data.product_data[0].GsID);

											var $span = $('<span onclick="show_product( event.target, \'product\');" class="td_link">');
											$span.attr("data-HOST", "<?=$web_host?>/DisplayGoods.php");
											$span.attr("data-CCode", data.product_data[0].ScodeOne);
											$span.attr("data-RgdCode", data.product_data[0].GsID);

											var shot_str = make_short_string(data.product_data[0].GoodsName, 15);		// 문자를 자른다

											if (shot_str != data.product_data[0].GoodsName) {						// 원본과 비교
												// $span.attr("data-tooltip-text", data.product_data[0].GoodsName);	// 다르면 tooltip 을 넣는다
												$span.attr("data-toggle", "tooltip");
												$span.attr("data-placement", "top");
												$span.attr("data-original-title", "Tooltip on top");
												$span.attr("title", data.product_data[0].GoodsName);
											}

											$span.text(shot_str);

											// return '<span data-toggle="tooltip" title="' + data + '">' + data + '</span>';

											return $span.prop('outerHTML');
										} else {
											return '<span style="color: red; font-width: bold;">상품정보없음</span>';
										}
					                },
					                "width" : " 250px",
									"targets": 4,
								},
								{
									"render": function ( d, type, row ) {

										var $main_price = commaCheck(parseInt(d.SettlePrice))+' 원'   ;
										return $main_price;

									},
									
									"targets": 5,
								},

							
				
					        ]

                            var table_columns = [];

                            var $tr = $dt.find("thead tr");

                            $.each( colomnSet, function( key, value ) {
                                var colomn = [];

                                $.each( value, function( ckey, cvalue ) {
                                    colomn[ckey] = cvalue;
                                    if (ckey == 'title'){
                                        var $td = $("<td>"+cvalue+'</td>');
                                        $td.appendTo($tr);
                                    }
                                });
                                table_columns.push(colomn);
                            });

							var dt = $dt.DataTable( {

								"processing": true,
								"serverSide": true,
								"searching" : false,
								// "ordering": false,// 정렬 기능 
								"pagingType" : "full_numbers",
								"language" :{
							 		"decimal" : "",
							        "emptyTable" : "데이터가 없습니다.",
							        "info" : "_START_ - _END_ (총 _TOTAL_ 건)",
							        "infoEmpty" : "0건",
							        "infoFiltered" : "(전체 _MAX_ 건 중 검색결과)",
							        "infoPostFix" : "",
							        "thousands" : ",",
							        "lengthMenu" : "_MENU_ 개씩 보기",
							        "loadingRecords" : "로딩중...",
							        "processing" : "처리중...",
							        "search" : "검색 : ",
							        "zeroRecords" : "검색된 데이터가 없습니다.",
							        "paginate":{
										"first" : '<<',
										"last" : '>>',
										"previous" : '<',
										"next" : '>',
									},
							        "aria" : {
							            "sortAscending" : " :  오름차순 정렬",
							            "sortDescending" : " :  내림차순 정렬"
							        },

								},
								"ajax": {
									url: "/admin_api/order_list.new.php",
									"data": function ( d ) {
										var $search_form = $(".search_form");

										// d.Start_Date = $search_form.find("#start_date").val();
										// d.End_Date = $search_form.find("#end_date").val();

										// var state_value = $search_form.find("#order_state option:checked").val();

										// 	if (state_value !== undefined)
										// 	{
										// 		d.OrderState = (state_value == undefined) ? "" : state_value;
										// 	}

										// 	var order_name = $search_form.find("#OrderName").val();
										// 	if (order_name !== "")
										// 	{
										// 		d.OrderName = order_name;
										// 	}
											
										// 	var order_num = $search_form.find("#OrRegCode").val();
										// 	if (order_num !== "")
										// 	{
										// 		d.OrRegCode = order_num;
										// 	}

										// 	var order_id = $search_form.find("#OrderID").val();
										// 	if (order_id !== "")
										// 	{
										// 		d.OrderID = order_id;
										// 	}

										d = Make_SearchData(d, $(".search_form :input"));
									},
									dataFilter: function(data){
										var json = jQuery.parseJSON( data );
										
										var $order_div = $("#div_orderstate");

										if ($order_div.html() == "") {

											// var $select = $('<select id="order_state" class="form-control small"></select>');

											// // datatable ajax initComplete 에서 Order_State를 전역변수로 저장
											// $.each( json.Order_State, function ( value, str) {
											// 	str = (value == "0") ? "-주문상태-" : str;
											// 	var $option = $('<option value="'+value+'">'+ str+'</option>');
											// 	$option.appendTo($select);
											// })

											// $select.appendTo($order_div);

											var order_state_config = {
												id : 'OrderState',
												class : 'form-control small',
												item : json.Order_State,
												default : {
													key : "",
													value: "-주문상태-",
												}
											};

											$order_div.append(MakeSelectBox(order_state_config));

										}
										

										var $payType_div = $("#div_payType");

										if ($payType_div.html() == "") {

											// var $select = $('<select id="pay_Type" class="form-control small"></select>');

											// var $option = $('<option value=""> -결제방식- </option>');
											// $option.appendTo($select);

											// $.each( json.pay_type, function ( index, obj) {
											// 	// str = (value == "0") ? "결제방식" : str;
												
											// 	for (const [key, value] of Object.entries(obj))
											// 	{
											// 		var $option = $('<option value="'+  key+'">'+ value +'</option>');
											// 		$option.appendTo($select);
											// 	}
											// })

											// $select.appendTo($payType_div);
											var payType_config = {
												id : 'SettleType',
												class : 'form-control small',
												item : json.pay_type,
												default : {
													key : "",
													value: "-결제방식-",
												}
											};

											$payType_div.append(MakeSelectBox(payType_config));

										}



										return JSON.stringify( json ); // return JSON string
									}


								},
								"columns": colomnSet,

						        "columnDefs": columnDefs,

								"initComplete":function( settings, json){
									Order_State = json.Order_State;
								}								
							} );

							
						 // Array to track the ids of the details displayed rows
						    var detailRows = [];
						 
						    $dt.on( 'click', 'tr td.details-control, tr td.details-control02', function () {

						        var tr = $(this).closest('tr');

						        var row = dt.row( tr );

						        var idx = $.inArray( tr.attr('id'), detailRows );
						 
						        if ( row.child.isShown() ) {

						            tr.removeClass( 'shown' );

						            row.child.hide();
						 
						            // Remove from the 'open' array
						            detailRows.splice( idx, 1 );

						        }

						        else {

						            tr.addClass( 'shown' );

						            row.child( product_list( row.data() ) ).show();
						 
						            // Add to the 'open' array
						            if ( idx === -1 ) {

						                detailRows.push( tr.attr('id') );
						            }
						        }
						    } );
						 
						    // On each draw, loop over the `detailRows` array and show any child rows
						    dt.on( 'draw', function () {
								$('[data-toggle="tooltip"]').tooltip();

						        $.each( detailRows, function ( i, id ) {

						            $('#'+id+' td.details-control').trigger( 'click' );
						         

						        } );

							} );
							
							$(".search_date").on("click", function() {
								var range = $(this).attr("data-reange");

								let today = new Date(); 

								var s_day = "";
								var e_day = getFormatDate(today); // 오늘날짜 넣기

								var compute_day = null;

								switch (range)
								{
									case "today":
										s_day = e_day;
									break;
									case "week":
										compute_day = new Date(today-(3600000*24*7));
										s_day = getFormatDate(compute_day); // 오늘 날짜에서 -7
									break;
									case "month":
										s_day = e_day.substring(0, 8) + '01'; // 이번달 1일
									break;
									case "30":
										compute_day = new Date(today-(3600000*24*30));
										s_day = getFormatDate(compute_day); // 오늘 날짜에서 -7
									break;
								}

								$("#Start_Date").val(s_day);
								$("#End_Date").val(e_day);
							});
							
							$("#btn_search").on("click", function() {
								dt.ajax.reload();
							});


						} ); // end of document ready

						
					</script>   


			    </div>
            </div>
        </div>
    </div>

</div>


<?
    include "../inc/bottom.php";
?>
