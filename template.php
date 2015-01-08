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
  // Run classes array through our custom stripper.
  $vars['element']['#attributes']['class'] = ddbasic_remove_default_link_classes($vars['element']['#attributes']['class']);

  // Check if the class array is empty.
  if (empty($vars['element']['#attributes']['class'])) {
    unset($vars['element']['#attributes']['class']);
  }

  $element = $vars['element'];

  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  // Add default class to a tag.
  $element['#localized_options']['attributes']['class'] = array(
    'menu-item',
  );

  // Make sure text string is treated as html by l function.
  $element['#localized_options']['html'] = TRUE;

  $element['#localized_options']['attributes']['class'][] = 'js-topbar-link';

  // Add some icons to our top-bar menu. We use system paths to check against.
  switch ($element['#href']) {
    case 'search':
      $title_prefix = '<i class="icon-search"></i>';
      $element['#localized_options']['attributes']['class'][] = 'topbar-link-search';
      $element['#attributes']['class'][] = 'topbar-link-search';
      break;

    case 'node':
      // Special placeholder for mobile user menu. Fall through to next case.
      $element['#localized_options']['attributes']['class'][] = 'default-override';

    case 'user':
      $title_prefix = '<i class="icon-user"></i>';
      // If a user is logged in we change the menu item title.
      if (user_is_logged_in()) {
        $element['#title'] = t('My Account');
        $element['#attributes']['class'][] = 'topbar-link-user-account';
        $element['#localized_options']['attributes']['class'][] = 'topbar-link-user-account';
      }
      else {
        $element['#attributes']['class'][] = 'topbar-link-user';
        $element['#localized_options']['attributes']['class'][] = 'topbar-link-user';
      }
      break;

    case 'user/logout':
      $title_prefix = '<i class="icon-signout"></i>';
      $element['#localized_options']['attributes']['class'][] = 'topbar-link-signout';
      $element['#attributes']['class'][] = 'topbar-link-signout';

      // For some unknown issue translation fails for this title.
      $element['#title'] = t($element['#title']);
      break;

    case 'openhours':
      $title_prefix = '<i class="icon-time"></i>';
      $element['#localized_options']['attributes']['class'][] = 'topbar-link-hours';
      $element['#attributes']['class'][] = 'topbar-link-hours';
      break;
      
    default:
      $title_prefix = '<i class="icon-align-justify"></i>';
      $element['#localized_options']['attributes']['class'][] = 'topbar-link-menu';
      $element['#attributes']['class'][] = 'topbar-link-menu';
      break;
  }

  $output = l($title_prefix . '<span>' . $element['#title'] . '</span>', $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}


/**
 * Implements theme_menu_tree().
 */
function wellejus_menu_tree__menu_information_menu(&$vars) {
  return '<ul class="information-menu">' . $vars['tree'] . '</ul>';
}

/**
 * Implements hook_css_alter()
 * 
 * DDBasic theme integrates the color module. When subtheming it, 
 * we need to know whether the color module has been used to 
 * create a custom-color version of the ddbasic stylesheet - and ensure it is used.
 */
function wellejus_css_alter(&$css) {
  // Use DDBasic color-altered css if it exists
  $color_ddbasic_css = variable_get('color_ddbasic_stylesheets');
  if (!empty($color_ddbasic_css[0])) {
    $ddbasic_color_css_file = str_replace($GLOBALS['base_url'] . '/', '', file_create_url($color_ddbasic_css[0]));

    if (isset($css['profiles/ding2/themes/ddbasic/css/ddbasic.styles.css'])) {
      $css['profiles/ding2/themes/ddbasic/css/ddbasic.styles.css']['data'] = $ddbasic_color_css_file;
      $css['profiles/ding2/themes/ddbasic/css/ddbasic.styles.css']['type'] = 'file';
    }
  }
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
  $form['name']['#title'] = t('Login');
}
