<?php
// $Id$

/**
 * Override of theme_ting_search_form().
 */
function wellejus_ting_search_form($form){
  $form['submit']['#type']  = "submit" ;
  $form['submit']['#src']   = drupal_get_path('theme','wellejus')."/images/searchbutton.png";
  $form['submit']['#attributes']['class']   = "";

  return drupal_render($form);
}

/**
 * Override of theme_user_login_block().
 */
function wellejus_user_login_block($form){
  $form['submit']['#type']  = "submit" ;
  $form['submit']['#src']   = drupal_get_path('theme','wellejus')."/images/accountlogin.png";
  $form['submit']['#attributes']['class']   = "";


  $name = drupal_render($form['name']);
  $pass = drupal_render($form['pass']);
  $submit = drupal_render($form['submit']);
  $remember = drupal_render($form['remember_me']);

  return  $name . $pass .$submit . $remember . drupal_render($form);
}

