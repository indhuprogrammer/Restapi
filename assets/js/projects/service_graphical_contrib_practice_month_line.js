/*
 *@Sales Forecast
 *@Sales Forecast Controller
*/
// csrf_token_name,csrf_hash_token,site_base_url & accesspageis global js variable

var params  = {};
params[csrf_token_name] = csrf_hash_token;

$(function() {
	var series_lbl = {};
	if(con_pra_month_label != null){
	for(var i = 0; i < con_pra_month_label.length; i++) {
		series_lbl[i] = { label: con_pra_month_label[i] };
	}
	var xticks         = con_pra_month_x_val;
	var cur_name 	   = default_currency_name;
	var yaxis_label    = 'Month';
	
	plot2 = $.jqplot('contribution_trend', con_pra_month_value, {
		// title: ' ',
		animate: !$.jqplot.use_excanvas,
		seriesDefaults:{
			// renderer:$.jqplot.BarRenderer,
			shadow: false,
			// pointLabels: { show: true, ypadding:3 },
			pointLabels: { show: true },
			rendererOptions: {
				barWidth: 34,
				animation: { speed: 1000 },
				fillToZero: true
			}
		},
		axesDefaults: {
			tickRenderer: $.jqplot.CanvasAxisTickRenderer ,         
			tickOptions: {
			  //angle: 10,
			  fontSize: '10pt'            
			},
			rendererOptions: { baselineWidth: 0.5, baselineColor: '#444444', animation: { speed: 1000 }, drawBaseline: true }
		},
		axes: {
			xaxis: {
				label:yaxis_label+' --->',
				renderer: $.jqplot.CategoryAxisRenderer,
				ticks: xticks
			},
			yaxis: {
				min:0, max: 100, Ticks: [[0],[10],[20],[30],[40],[50],[60],[70],[80],[90],[100]],
				label:'Contribution (%) --->',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:series_lbl,
		legend:{
			renderer: jQuery.jqplot.EnhancedLegendRenderer,
			show:true,
			// placement: 'outside',
			fontSize: '8pt',
			rendererOptions: { numberRows:2 },
			marginTop: "-43px",
			right: "-8px",
			// location: 's',
			border: false
		},
		grid: {
			drawGridLines: true,        // wether to draw lines across the grid or not.
			gridLineColor: '#ffffff',   // CSS color spec of the grid lines.
			background: '#ffffff',      // CSS color spec for background color of grid.
			borderColor: '#ffffff',     // CSS color spec for border around grid.
			//borderWidth: 2.0,           // pixel width of border around grid.
			//backgroundColor: 'transparent', 
			drawBorder: false,
			shadow: false
		},
		highlighter: { show: false },
		seriesColors: ["#1a5a2e", "#027997", "#cc0000", "#c747a3", "#910000", "#66ffcc", "#bfdde5", "#cc99cc", "#492970", "#f0eded", "#0d233a", "#4bb2c5", "#a35b2e", "#4b5de4", "#422460", "#953579"],
		highlighter: { show: true, tooltipAxes: 'y', formatString: '%s', lineWidthAdjust:5.5, tooltipOffset:8 },
	});
	}
});
//////////////////////////////////////////////////////////////////// end ///////////////////////////////////////////////////
