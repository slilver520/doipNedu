	<section class="app-section">
		<div class="app-inner">
			<div class="title grid-div">
				<div class="left">
					<h3 class="tit-lv2">
						총
						<span class="result-count"><em id="pd_count">0</em>개</span>
					</h3>
				</div>
				<div class="right">
					<div class="input-item-inner filter">
						<label class="radio" style="cursor: pointer;">
							<input type="radio" id="radio_new" name="radio1" onclick="change_order(this);" value="new" checked><span>등록순</span>
						</label>
						<label class="radio" style="cursor: pointer;">
							<input type="radio" id="radio_recom" name="radio1" value="recom" onclick="change_order(this);"><span>추천순</span>
						</label>
						<label class="radio" style="cursor: pointer;">
							<input type="radio" id="radio_sale" name="radio1" onclick="change_order(this);" value="sale"><span>판매순</span>
						</label>
						<label class="radio" style="cursor: pointer;">
							<input type="radio" id="radio_point" name="radio1" onclick="change_order(this);" value="point"><span>평점순</span>
						</label>
						<label class="radio" style="cursor: pointer;">
							<input type="radio" id="radio_view" name="radio1" onclick="change_order(this);" value="view"><span>조회순</span>
						</label>
						<label class="radio" style="cursor: pointer;">
							<input type="radio" id="radio_like" name="radio1" onclick="change_order(this);" value="like"><span>좋아요순</span>
						</label>
					</div>
				</div>
			</div>

			<div class="list-products">
				<ul id="product_list">

				</ul>

				<div class="pagination">
					<ol class="pagination-inner">
				
					</ol>
				</div>
			</div>
		</div>
	</section>


<script type="text/javascript">
	var now_page = 1;
	var total_page = 1;
	var next_flag = true;
	var query_order = "new";

	var currentPage = "";

	if (location.hash !== "") {
		currentPage = location.hash.slice(1);
	}

	function make_productPage(product_list)
	{
		var $empty = $('<div style="height: 400px; width= 100%; vertical-align:center; text-align: center;"><img src="<?=$sub_path?>assets/images/nj01.png" alt="noSearch" style="width:150px; margin-bottom:15px;"><span style="display:block;">등록된 상품이 없어요..</span></div>');


		if (product_list.data.length > 0) {
			make_product("product_list", product_list.data);
		} else {

			$('.right').empty();
			$('.pagination-inner').empty();
			$("#product_list").empty().append($empty);
		}

		now_page = product_list.page_now;

		make_page_navigation(product_list);

		$( 'html, body' ).animate( { scrollTop : 0 }, 400 );
	}

	function get_nextPage(page)
	{
	    var mode = getParameterByName('mode');
	    var catCode = getParameterByName('catCode');

		if (location.hash !== "") {
			var hash = location.hash.slice(1);
			var arr = hash.split("/");
			query_order = (arr.length == 3) ? arr[2] : arr[3];

			if (arr.length !== 3) console.log(hash);
		}

	    var code = (catCode === null) ? "" : "/" + catCode;

	    var url_query = mode + code + "/" + page + "/" + query_order;

	    sync_ajax('/api-auth/' + url_query, '', make_productPage);  

	    if (mode == "funding")
	    {
	    	setTimeout(function() {
		        progressUi();
		    }, 10);
	    }

	    window.location.hash = '#' + url_query;
	    currentPage = location.hash.slice(1);

	    // $('input:radio[name=radio1]').removeAttr("checked");
	    // $('#radio_'+query_order).attr("checked", true);
	}

	function change_order(elm)
	{
		var hash = location.hash.slice(1);
		var arr = hash.split("/");

		var order_value = $(elm).val();

		var new_hash = "#" + arr[0] + '/1/' + order_value;

		if (arr.length == 4)
		{
			new_hash = "#" + arr[0] + '/' + arr[1] + '/1/' + order_value;			
		}

		window.location.hash = new_hash;

		get_nextPage(1);
	}

	$(window).on('hashchange', function() {
		if (location.hash !== "") {
			var page = location.hash.slice(1);
			var arr = page.split("/");
			var pos = (arr.length == 3) ? 1 : 2;
			var current = arr[pos];

			if (page !== null && currentPage !== page) {
				if (current == 1)
				{
					$('#radio_'+arr[pos+1]).trigger("click");
				} else {
					if (current == undefined || current == 'undefined')
					{
						console.log("what!!!");
					}
					get_nextPage(current);
				}
			}
		}
	});

	// var currentPage = $('#next').attr('href').slice(1);
	// get_nextPage(1);

	function make_page_navigation(product_list)
	{
		$('#pd_count').text(product_list['total']);	//총 갯수

		$('.pagination-inner').empty();

		if(product_list['page_now'] <= product_list['total_page']){

		 	var req_num_row = 5;

		 	var gap = Math.floor(req_num_row / 2)
		 	var start_page = product_list['page_now'] - gap;
		 	var end_page = product_list['page_now'] + gap;
		 	var prev_page = (now_page == 1) ? 1 : now_page -1;
		 	var next_page = (now_page == product_list['total_page']) ? product_list['total_page'] : now_page + 1;

			// 처음 이전



			var $first = $('<li class="gui first"><a href="#" onclick="get_nextPage(1);return false;">처음</a></li><li class="gui prev"><a href="#" onclick="get_nextPage(' + prev_page + ');return false;" class="prev">이전</a></li>');

			$first.prependTo($('.pagination-inner'));

		 	if (start_page < 1){
		 		start_page = 1;	
		 		end_page = req_num_row;	
		 	}

		 	if (end_page > product_list['total_page']){
		 		// start_page = (start_page > 1) ? product_list['total_page'] - req_num_row : 1;	
		 		end_page = product_list['total_page'];

		 		if (product_list['total_page'] - req_num_row < 1)
		 		{
		 			start_page = 1;
		 		} else {
		 			start_page = product_list['total_page'] - req_num_row + 1;
		 		}
		 	}

			for(var i = start_page; i<= end_page; i++ )
			{
			 	var $pages = $('<li class="page_number"></li>');

			 	if (product_list['page_now'] == i) {
			 		$pages.addClass("on");
			 		var $a = $('<a href="#" onclick="return false;" style="cursor: default">' + i + '</a>');

			 		$a.appendTo($pages);
			 	} else {
			 		var $a = $('<a href="#" onclick="get_nextPage(' + i + ');return false;">' + i + '</a>');

			 		$a.appendTo($pages);
			 	}

				$pages.appendTo($('.pagination-inner'));
			}

			var $next = $('<li class="gui next"><a href="#" onclick="get_nextPage(' + next_page + ');return false;">다음</a></li><li class="gui last"><a href="#" onclick="get_nextPage(' + product_list['total_page'] + ');return false;">끝</a></li>');
			$next.appendTo($('.pagination-inner'));

		}
	}


</script>