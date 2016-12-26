<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function page_get_features($context, $route, $page) {
    ob_start();
    require_once PAGE_ROOT . "/pages/features/features.php";
    $page['content'] = ob_get_contents();
    ob_end_clean();
    $page['section_name'] = "features";
    return $page;
}

function page_get_pricing($context, $route, $page) {
    ob_start();
    require_once PAGE_ROOT . "/pages/pricing/pricing.php";
    $page['content'] = ob_get_contents();
    ob_end_clean();
    $page['section_name'] = "features";
    return $page;
}

function page_get_contact_us($context, $route, $page) {
    ob_start();
    require_once PAGE_ROOT . "/pages/contact_us/contact_us.php";
    $page['content'] = ob_get_contents();
    ob_end_clean();
    $page['section_name'] = "features";
    return $page;
}

function page_get_home($context, $route, $page) {
    ob_start();
    require_once PAGE_ROOT . "/pages/home/home.php";
    $page['content'] = ob_get_contents();
    ob_end_clean();
    $page['section_name'] = "home";
    return $page;
}

function page_execute_script($page, $context, $route) {
    return render_template(PAGE_ROOT . "/templates/layout.tpl.php", array('page' => $page, 'section_name' => $page['section_name']));
}