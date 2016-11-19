<?php
/**
 * mm_ddNumericFields
 * @version 1.1.1 (2013-12-11)
 * 
 * @desc A widget for ManagerManager plugin denying using any chars in TV fields but numeric.
 * 
 * @uses MODXEvo.plugin.ManagerManager >= 0.6.
 * 
 * @param $fields {string_commaSeparated} — TV names to which the widget is applied. @required
 * @param $roles {string_commaSeparated} — The roles that the widget is applied to (when this parameter is empty then widget is applied to the all roles). Default: ''.
 * @param $templates {string_commaSeparated} — Id of the templates to which this widget is applied. Default: ''.
 * @param $allowFloat {boolean} — Float number availability status (true — float numbers may be used, false — float numbers using is not available). Default: true.
 * @param $decimals {integer} — Number of chars standing after comma (0 — any). Default: 0.
 * 
 * @link http://code.divandesign.biz/modx/mm_ddnumericfields/1.1.1
 * 
 * @copyright 2012–2013 DivanDesign {@link http://www.DivanDesign.biz }
 */

function mm_ddNumericFields(
	$fields = '',
	$roles = '',
	$templates = '',
	$allowFloat = 1,
	$decimals = 0
){
	global $modx, $mm_current_page;
	$e = &$modx->Event;
	
	if (
		$e->name == 'OnDocFormRender' &&
		useThisRule($roles, $templates)
	){
		$fields = tplUseTvs($mm_current_page['template'], $fields);
		if ($fields == false){return;}
		
		$output = '';
		
		$output .= '//---------- mm_ddNumericFields :: Begin -----'.PHP_EOL;
		
		foreach ($fields as $field){
			$output .=
'
$j("#tv'.$field['id'].'").ddNumeric({
	allowFloat: '.intval($allowFloat).',
	decimals: '.intval($decimals).'
});
';
		}
		
		$output .= '//---------- mm_ddNumericFields :: End -----'.PHP_EOL;
		
		$e->output($output);
	}
}
?>