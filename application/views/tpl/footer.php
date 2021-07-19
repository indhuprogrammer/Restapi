<div id="footer">
	<p class="footer-text">Copyright &copy; <?php echo  date ('Y'); ?> <a href="http://mail.com" target="_blank">eNoah iSolution Pvt Ltd.</a> <?php echo  $cfg['app_name'] . ' ' . $cfg['app_version'] ?> was last updated <?php echo  $cfg['app_date'] ?></p> 
	
	<p class="footer-logo"><img src="assets/img/footer-enoah-logo.png" alt=""/></p>
	
	<p id="back-top">
		<a href="#top"><span></span>Back to Top</a>
	</p>
</div>
</div>
<script type="text/javascript">
$(function(){
  $('#footer-links li a').click(function(){
    window.open(this.href);
    return false;
  });
  $('.g-search').css('color', '#777777').focus(function(){
		if ($(this).val() == 'Lead No, Job Title, Name or Company') {
			$(this).val('').css('color', '#333333');
		}
	}).blur(function(){
		if ($(this).val() == '') {
			$(this).css('color', '#777777').val('Lead No, Job Title, Name or Company');
		}
	});
  $('.pjt-search').css('color', '#777777').focus(function(){
		if ($(this).val() == 'Project Title, Name or Company') {
			$(this).val('').css('color', '#333333');
		}
	}).blur(function(){
		if ($(this).val() == '') {
			$(this).css('color', '#777777').val('Project Title, Name or Company');
		}
	});
})

function searchDatatable() {
	$('#advance_customer_search').hide();
	var entity    = $("#cus_entity").val();
	var region    = $("#cus_region").val();
	var isClient     = $("#cus_isClient").val();
	var status     = $("#cus_status").val();
	var aging_report     = $("#aging_report").val();
	var url = window.location.pathname;
	var urlsplit = url.split("/");
	if(urlsplit[3] == 'aging_report'){
		url = site_base_url+"customers/aging_report/search";
	}else{
		url = site_base_url+"customers/index/search";
	}
	$.ajax({
		type: "POST",	
		url: url,
		data: "filter=filter"+"&entity="+entity+"&status="+status+"&region="+region+"&page="+aging_report+"&isClient="+isClient+"&"+csrf_token_name+'='+csrf_hash_token,
		beforeSend:function(){
			$('#results').empty();
			$('#results').html('<div style="margin:20px;" align="center">Loading Content.<br><img alt="wait" src="'+site_base_url+'assets/images/ajax_loader.gif"><br>Thank you for your patience!</div>');
		},
		success: function(res) {
			$('#results').html(res);
			$('#load').hide();
			$('#advance_customer_search').show();
			$('#val_export').val('search');
		}
	});
	return false;  //stop the actual form post !important!


};	


$(document).ready(function(){
	// hide #back-top first
	$("#back-top").hide();

	var url = window.location.pathname;
	var urlsplit = url.split("/");
	if(urlsplit[2] == 'customers'){
	myVar = setInterval("searchDatatable()",60000);
	// console.log(window.location.pathname);
}
;
	// fade in #back-topcons
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	$('.menuStyle li ul').hover(function(){
		$(this).siblings('a').addClass('parentMenu');
	},
	function(){
		$(this).siblings('a').removeClass('parentMenu');
	}
	);
	

});
$.ajaxSetup ({
    cache: false
	});

//To add target blank for user guide menu
$("#top_menu_110 ul li:last-child a").attr('target','_blank');
$("#top_menu_171 ul li:last-child a").attr('target','_blank');
$("#top_menu_203 a").attr('target','_blank');

$.get("dashboard/toHandleSOAMenu", function(data, status){
    if(data != 1){ $("#sub_menu_201").remove(); }
  });

function download_invoice(eid,f_name,type){
	n_f_name = f_name.replace(/[^A-Za-z0-9.]/g, "");
	window.location.href = site_base_url+'project/download_invoice/'+eid+'/'+n_f_name+'/'+type;
}

//Function to download invoice from AWS
function download_invoice_aws(eid,f_name,type){
	n_f_name = f_name.replace(/[^A-Za-z0-9.]/g, "");
	window.location.href = site_base_url+'project/download_invoice_aws/'+eid+'/'+n_f_name+'/'+type;
}
	
</script>
</body>
</html>
