<?php

/**
 * Displays a view of products referenced from the given node, in a megarow.
 */
function mobilephonesbox_process_product_variations_view($node) {
  $title = t('Variations for product %title', array('%title' => $node->title));
  $output = views_embed_view('birou_administare_variante_preparate', 'default', $node->nid);

  return views_megarow_display($title, $output, $node->nid);
}


/** 
 * Page preprocessor we use to check to see if there is the sidebar and then pass it on to the node level 
 * @param $vars 
 * @return unknown_type 
 */ 

/*function mobilephonesbox_process_page(&$vars)
{ 
//GB: We want the Node, if it's exists to know about the $sidebar_first and if it's loaded as it will determine what image style to use 
  if(isset($vars["page"]["sidebar_first"]))
  {
    // add the flag to the node to say it's been set and there is only a single node to display 
    if(isset($vars["page"]["content"]["system_main"]["nodes"]) && count($vars["page"]["content"]["system_main"]["nodes"]) == 2)
	{ 
      $keys = array_keys($vars["page"]["content"]["system_main"]["nodes"]); 
      // Set a new variable called sidebar_first equal to true on the node.tpl level 
      $vars["page"]["content"]["system_main"]["nodes"][$keys[0]]['#node']->sidebar_first = true; 
    } 
	
  }  
dpm($vars);
} 
*/
function mobilephonesbox_preprocess_page(&$variables) {
  if (arg(0)=='node' && is_numeric(arg(1))) {
  //dpm($variables);
  
  //am adaugat eu in sept 2013 doar linia cu  if-ul de mai jos pt. ca dadea ceva notice-uri:
   // Notice: Undefined index: nodes în mobilephonesbox_preprocess_page() (linia 41 din /home/mygigast/public_html/sites/all/themes/mobilephonesbox/template.php).
   // Warning: array_keys() expects parameter 1 to be array, null given în mobilephonesbox_preprocess_page() (linia 41 din /home/mygigast/public_html/sites/all/themes/mobilephonesbox/template.php).

  if(isset($variables["page"]["content"]["content"]["content"]["system_main"]["nodes"])){
	  $keys = array_keys($variables["page"]["content"]["content"]["content"]["system_main"]["nodes"]);
	  // Do logic here
  }
	  if (isset($variables["page"]["content"]["content"]["sidebar_first"]) || isset($variables["page"]["content"]["content"]["sidebar_second"])) {
		$variables["page"]["content"]["content"]["content"]["system_main"]["nodes"][$keys[0]]['#node']->sidebars = true; //or false
	  }
  }
  
  
  //adaugat pt. modificare background la 2013.11.06
  
  
/*    $node = menu_get_object();
  
  if ($node->nid) {
	 //dpm($variables);
    // We're on a node page
	drupal_add_css('body { background:url(' . $path . ') left top no-repeat !important; }', 'inline');
    if (isset($node->field_images [$node->language][0]['fid'])) {
      // Load the file object
      $file = file_load($node->field_images[$node->language][0]['fid']);

      // Get a web accessible URL for the image
      $path = file_create_url($file->uri);

      // Add the background to an inline CSS tag
      drupal_add_css('body { background:url(' . $path . ') left top no-repeat !important; }', 'inline');
    }
  }
*/


if (isset($variables['node']->nid)) 
	{
        $uri = $variables['node']->field_images['und'][0]['uri'];
        $path = file_create_url($uri);
        drupal_add_css('body:before { background:url(' . $path . ') /*left top no-repeat !important*/; }', 'inline', array('weight' => 0));
    }
	else { echo 'Node not set';
	}
  
  
}
 
/*function mobilephonesbox_process_node(&$variables, $hook) {
  //observe that our flag was passed
  if (arg(0)=='node' && is_numeric(arg(1))) {
  //dpm($variables);
  }
}
*/


/*function mobilephonesbox_preprocess_page(&$vars) {
  $node = menu_get_object();
  dpm($vars);
  if ($node->nid) {
    // We're on a node page
    if (isset($node->field_images [$node->language][0]['fid'])) {
      // Load the file object
      $file = file_load($node->field_images[$node->language][0]['fid']);

      // Get a web accessible URL for the image
      $path = file_create_url($file->uri);

      // Add the background to an inline CSS tag
      drupal_add_css('body { background:url(' . $path . ') left top no-repeat !important; }', 'inline');
    }
  }
}
*/