<?php
/**
 * mm_ddNumericFields
 * @version 1.1 (2013-05-20)
 * 
 * A widget for ManagerManager plugin denying using any chars in TV fields but numeric.
 * 
 * @uses ManagerManager plugin 0.5.
 * 
 * @param $tvs {comma separated string} - TV names to which the widget is applied. @required
 * @param $roles {comma separated string} - The roles that the widget is applied to (when this parameter is empty then widget is applied to the all roles). Default: ''.
 * @param $templates {comma separated string} - Id of the templates to which this widget is applied. Default: ''.
 * @param $allowFloat {0; 1} - Float number availability status (1 — float numbers may be used, 0 — float numbers using is not available). Default: 1.
 * @param $decimals {integer} - Number of chars standing after comma (0 — any). Default: 0.
 * 
 * @link http://code.divandesign.biz/modx/mm_ddnumericfields/1.1
 * 
 * @copyright 2013, DivanDesign
 * http://www.DivanDesign.ru
 */

function mm_ddNumericFields($tvs = '', $roles = '', $templates = '', $allowFloat = 1, $decimals = 0){
	global $modx, $mm_current_page;
	$e = &$modx->Event;
	
	if ($e->name == 'OnDocFormRender' && useThisRule($roles, $templates)){
		$output = '';
		
		$tvs = tplUseTvs($mm_current_page['template'], $tvs);
		if ($tvs == false){
			return;
		}
		
		$output .= "\n// ---------------- mm_ddNumericFields :: Begin ------------- \n";
		
		//Include jquery.ddTools
		$output .= includeJs($modx->config['site_url'].'assets/plugins/managermanager/js/jquery.ddTools-1.8.1.min.js', 'js', 'jquery.ddTools', '1.8.1');

		foreach ($tvs as $tv){
			$output .= '
$j("#tv'.$tv['id'].'").ddNumeric({
	allowFloat: '.intval($allowFloat).',
	decimals: '.intval($decimals).'
});
			';
		}

		$output .= "\n// ---------------- mm_ddNumericFields :: End -------------";

		$e->output($output . "\n");
	}
}
?>