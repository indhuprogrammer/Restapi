<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('get_sap_email'))
{
	function get_sap_email($val)
	{	
        $CI = get_instance();	 
		$CI->db->select('*');	
		$CI->db->from($CI->cfg['dbpref']. 'sap_email_setting');
		$CI->db->where_in('approver_type',$val);
		$query 	= $CI->db->get();	
		return $results = $query->result();			
    }
}

if ( ! function_exists('get_sap_access'))
{
	function get_sap_access($val)
	{	
        $CI = get_instance();	 
		$CI->db->select('*');	
		$CI->db->from($CI->cfg['dbpref']. 'sap_access_setting');
		$CI->db->where_in('approver_type',$val);
		$query 	= $CI->db->get();	
		return $results = $query->result();			
    }
}

if ( ! function_exists('access_action'))
{
	function access_action($val)
	{	
        $CI = get_instance();	 
		$CI->db->select('members');	
		$CI->db->from($CI->cfg['dbpref']. 'sap_access_setting');
		$CI->db->where_in('approver_type',$val);
		$query 	= $CI->db->get();	
		return $results = $query->result();	         
    }
}

if ( ! function_exists('numberTowords'))
{
    function numberTowords($number,$entity,$currency)
    { 
        $dollar_currencies = ['$','usd','sgd','aud','myr','gbp'];
        $currency_to_check = trim(strtolower($currency));
        $Rupees = $and = $paise = '';
        $words = array(0 => '', 1 => 'one', 2 => 'two',
                3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
                7 => 'seven', 8 => 'eight', 9 => 'nine',
                10 => 'ten', 11 => 'eleven', 12 => 'twelve',
                13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
                19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
                40 => 'forty', 50 => 'fifty', 60 => 'sixty',
                70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
                $digits = array('', 'hundred','thousand','lakh', 'crore');
        $number = abs($number);
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        ## Processing complete amount
        if(in_array($currency_to_check,$dollar_currencies)){
            ## Processing US entity amount
            $locale     = 'en_US';
            $f = new NumberFormatter($locale, NumberFormatter::SPELLOUT);
            $Rupees = $f->format($no);
            $Rupees = str_replace("-"," ",$Rupees);
            $dollar = ($no > 1) ? " Dollars" : " Dollar";
            $Rupees = ucwords($Rupees).$dollar;            
        }else{
            ## Processing Other entity amount
            $hundred = null;
            $digits_length = strlen($no);
            $i = 0;
            $str = array();
            while( $i < $digits_length ) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += $divider == 10 ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
                    $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                } else $str[] = null;
            }
            $Rupees = implode('', array_reverse($str));    
        }
        ## Processing decimal value
        if($decimal > 0){
            if($decimal < 20){
                $f_dec = $words[$decimal];
            }else{
                    $decimal1 = floor($decimal / 10);
                    $f_dec = $words[$decimal1*10] . " " . $words[$decimal % 10];
            }
            $currency = getCurrencyDecimalName($entity,$currency);
            $cur_decimal_name = isset($currency->currency_decimal_name)?$currency->currency_decimal_name:'';

            if($decimal > 1){
                    $cur_decimal_name = isset($currency->currency_name_plural)?$currency->currency_name_plural:'';
            }
            $paise = $f_dec. ' '.$cur_decimal_name;
            $and = '';
            if(!$decimal){
                    $paise = '';
            }
            if($Rupees && $decimal){
                    $and = ' and ';
            }
        }
        return $Rupees. $and . $paise;
    } 	
}
if ( ! function_exists('invoice_serires'))
{
	function invoice_serires($entity,$series)
	{	
        $CI = get_instance();	 
		$CI->db->select('prefix');	
		$CI->db->from($CI->cfg['dbpref']. 'invoice_series');
		$CI->db->where('entity',$entity);
		$CI->db->where('series',$series);
		$query 	= $CI->db->get();	
		return $results = $query->result();	         
    }
}

if ( ! function_exists('getCurrencyDecimalName'))
{
	function getCurrencyDecimalName($entity,$currency)
	{	
		$CI = get_instance();	 
		$cfg	     = $CI->config->item('crm'); /// load config
		$CI->db->select('*');	
		$CI->db->from('crm_cus_currency');
		$CI->db->where('currency_code',$currency);
		$CI->db->where('country_code',$entity);
		$query 	= $CI->db->get();	
		return $results = $query->row();	         
    }
}
/* End of file sap_helper.php */
