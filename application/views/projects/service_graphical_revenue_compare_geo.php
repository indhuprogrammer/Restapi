<script>
//for practicewise invoice compare
//var default_currency_name = '<?php echo $this->default_cur_name; ?>';
var prac_inv_practic_val = <?php echo json_encode($prat_inv_compare['practic_val']); ?>;
var prac_inv_curr_yr_val = <?php echo json_encode($prat_inv_compare['curr_yr_val']); ?>;
var prac_inv_last_yr_val = <?php echo json_encode($prat_inv_compare['last_yr_val']); ?>;
var revenue_label = "<?php echo $prac_filter_by; ?>";
</script>
<style type="text/css">
/*#revenue_practice_compare_bar .jqplot-point-label.jqplot-series-0 {
	color:#00a7e5;
}
#revenue_practice_compare_bar .jqplot-point-label.jqplot-series-1 {
	color:#00e143;
}*/
#revenue_practice_compare_bar .jqplot-point-label {
  writing-mode:vertical-rl;
  transform: rotate(180deg);
}
#revenue_practice_compare_bar .jqplot-highlighter-tooltip, #revenue_practice_compare_bar .jqplot-canvasOverlay-tooltip {
    border: solid 1px #583703;
    font-size: 1.0em;
    white-space: nowrap;
    background: #a26403;
    padding: 1px;
	color:#FFF;
	font-weight:bold;
	z-index:9999;
}
</style>
<h5 class="revenue_compare_head_bar">
<span class="forecast-heading">Geography Wise Revenue Comparison</span>
</h5>
<!--radio name="revenue_name" value="Practice">Practice</radio> <radio name="revenue_name" value="Geography">Geography</radio-->
<div id="revenue_practice_compare_bar" class="plot" style="position: relative; height: 320px; padding-bottom:22px;"></div>

<script type="text/javascript" src="assets/js/projects/service_graphical_revenue_practice_compare_bar.js?v1=1"></script>