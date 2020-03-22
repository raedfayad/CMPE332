<?php
DEFINE("ORG_TYPE", "Organization");
DEFINE("ORG_TYPE_SPCA", "SPCA");
DEFINE("ORG_TYPE_SHELTER", "Shelters");
DEFINE("ORG_TYPE_RESCUE", "Rescue Organizations");

function get_string_form_data($name, $superglobal, $filter = FILTER_SANITIZE_STRING) {
	$form_data = '';
	if (array_key_exists($name, $superglobal)) {
		$form_data = trim($superglobal[$name]);
		$form_data = filter_var($form_data, $filter);
	}
	
	return $form_data;
}
?>
