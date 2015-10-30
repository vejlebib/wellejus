<?php
/**
 * @file
 * Preprocess, process and theme Functions.
 */

/**
 * Implements theme_menu_link().
 *
 * Add specific markup for top-bar menu exposed as menu_block_4.
 */
function wellejus_menu_link__menu_tabs_menu($vars) {
  // Check for our 'openhours' link
  if ($vars['element']['#href'] == 'openhours') {
    list($element, $sub_menu) = _wellejust_process_menu_links($vars);

    $element['#localized_options']['attributes']['class'][] = 'js-topbar-link';

    // Insert a 'clock' fa icon before openhours menu-link.
    $title_prefix = '<i class="icon-time"></i>';
    $element['#localized_options']['attributes']['class'][] = 'topbar-link-hours';
    $element['#attributes']['class'][] = 'topbar-link-hours';


    $output = l($title_prefix . '<span>' . $element['#title'] . '</span>', $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  }

  // If it wasn't our link; pass on the rendering to DDBasic.
  return ddbasic_menu_link__menu_tabs_menu($vars);
}

/**
 * Implements theme_menu_link().
 */
function wellejus_menu_link__menu_secondary_menu($vars) {
  list($element, $sub_menu) = _wellejust_process_menu_links($vars);

  $title_prefix = '';

  switch ($element['#href']) {
    case 'https://www.facebook.com/vejlebibliotekerne':
      $title_prefix = '<i class="icon-large icon-facebook-sign"></i>';
      break;
    case 'contact':
      $title_prefix = '<i class="icon-large icon-envelope"></i>';
      break;
  }

  $output = l($title_prefix . '<span>' . $element['#title'] . '</span>', $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements theme_menu_link()
 */
function wellejus_menu_link__main_menu(&$vars) {
  list($element, $sub_menu) = _wellejust_process_menu_links($vars);

  $title_prefix = '';

  switch (drupal_get_path_alias($element['#href'])) {
    case '<front>':
      $title_prefix = '<i class="icon-large icon-home"></i>';
      break;
    case 'arrangementer':
      $title_prefix = '<i class="icon-large icon-calendar"></i>';
      break;
    case 'inspiration':
      $title_prefix = '<i class="icon-large icon-lightbulb"></i>';
      break;
    case 'pa-nettet':
      $title_prefix = '<i class="icon-large icon-globe"></i>';
      break;
    case 'sadan-gor-du':
      $title_prefix = '<i class="icon-large icon-wrench"></i>';
      break;
  }

  $output = l($title_prefix . '<span>' . $element['#title'] . '</span>', $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Helper function for default processing of menu link elements.
 */
function _wellejust_process_menu_links(&$vars) {
  $element = $vars['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  // Add default class to a tag.
  $element['#localized_options']['attributes']['class'] = array(
    'menu-item',
  );

  // Filter classes.
  $element['#attributes']['class'] = ddbasic_remove_default_link_classes($element['#attributes']['class']);

  // Make sure text string is treated as html by l function.
  $element['#localized_options']['html'] = TRUE;

  return array($element, $sub_menu);
}

/**
 * Implements theme_menu_tree().
 */
function wellejus_menu_tree__menu_information_menu(&$vars) {
  return '<ul class="information-menu">' . $vars['tree'] . '</ul>';
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function wellejus_form_search_block_form_alter(&$form, &$form_state) {
  $form['search_block_form']['#title'] = t('Search');
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function wellejus_form_user_login_block_alter(&$form, &$form_state) {
  $form['name']['#title_display'] = 'invisible';
  $form['pass']['#title_display'] = 'invisible';
}

/**
 * Implements hook_js_alter().
 */
function wellejus_js_alter(&$js) {
  // Override the ding_tabroll module js, so that we can adjust the rotation speed
  $module_path = drupal_get_path('module', 'ding_tabroll') . '/js/ding_tabroll.js';
  if (isset($js[$module_path])) {
    $theme_path = drupal_get_path('theme', 'wellejus') . '/scripts/wellejus.ding_tabroll.js';
    // Copy the settings
    $js[$theme_path] = $js[$module_path];
    // Override the data
    $js[$theme_path]['data'] = $theme_path;
    unset($js[$module_path]);
  }
}

/**
 * Implements hook_preprocess_ting_object().
 */
function wellejus_preprocess_ting_object(&$vars) {
  if (isset($vars['elements']['#view_mode']) && $vars['elements']['#view_mode'] == 'full') {
    // ting_object and ting_collection entities use the same template.
    if (isset($vars['elements']['#entity_type']) && $vars['elements']['#entity_type'] == 'ting_object') {
      $holdings = $vars['content']['holdings-available'];
      $vars['content']['holdings-available'] = $vars['content']['material-details'];
      $vars['content']['material-details'] = $holdings;
    }
  }
}
