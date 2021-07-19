/*
 *@Quotation View
 */

var owner = $("#owner").val();
var leadassignee = $("#leadassignee").val();
var regionname = $("#regionname").val();
var countryname = $("#countryname").val();
var statename = $("#statename").val();
var locname = $("#locname").val();
var stage = $("#stage").val();
var customer = $("#customer").val();
var service = $("#service").val();
var lead_src = $("#lead_src").val();
var industry = $("#industry").val();
var worth = $("#worth").val();
var lead_status = $("#lead_status").val();
var lead_indi = $("#lead_indi").val();
var keyword = $("#keyword").val();
//alert(keyword);
if (keyword == "Lead No, Job Title, Name or Company")
    keyword = 'null';

//for ie ajax loading issue appending random number
if (query_type == 'load_proposal_expect_end') {
   //alert('if');
    var sturl = site_base_url + "asset_register/advance_filter_search/load_proposal_expect_end/?" + Math.random();
    $('#advance_search_results').load(sturl);
} else {
// alert('hi');return false;
    var sturl = site_base_url + "asset_register/advance_filter_search/?" + Math.random();
    $('#advance_search_results').load(sturl);
}
$('.js_advanced_filter').click(function(){
  $('#advance_filters').slideToggle();
})

$('#asset_search').submit(function(){

  $('#advance').hide();
  $('#load').show();
  $('#ajax_loader').show();
  // $('#default_view').html('');
  // $('#default_view').hide()
  var keyword = $("#keyword").val();
  var department = $("#department").val();
  var asset_owner = $("#asset_owner").val();
  var asset_type = $("#asset_type").val();
  var storage_mode = $("#storage_mode").val();
  var confidentiality = $("#confidentiality").val();
  var availability = $("#availability").val();
  var location_type = $("#location_type").val();
  var project_id = $("#project_id").val();
  var asset_name = $("#asset_name").val();
  var labelling = $("#labelling").val();
  var asset_location = $("#asset_location").val();
  var params = {'keyword':keyword,
              'department':department,
              'asset_owner':asset_owner,
              'asset_type':asset_type,
              'storage_mode':storage_mode,
              'availability':availability,
              'confidentiality':confidentiality,
              'location_type':location_type,
              'project_id':project_id,
              'asset_name':asset_name,
              'labelling':labelling,
              'asset_location':asset_location,
            };
 params[csrf_token_name] = csrf_hash_token;

 $.ajax({
       type: 'POST',
       url: site_base_url+'asset_register/advance_filter_search',
       data: params,
       success: function(data) {
     $('#load').hide();
      $('#advance').show();
     $('#ajax_loader').hide();
     $('#advance_search_results').html(data);
     $('.data-tbl').dataTable();
     $('#advance_search_results').show();

       }
   });
   return false;
})
