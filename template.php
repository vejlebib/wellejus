<?php
/**
 * @file
 * Preprocess and Process Functions.
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