<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function page_get_features($context, $route, $page) {
    ob_start();
    require_once PAGE_ROOT . "/pages/features/features.php";
    $page['content'] = ob_get_clean();
    $page['section_name'] = "features";
    return $page;
}

function page_get_pricing($context, $route, $page) {
    ob_start();
    require_once PAGE_ROOT . "/pages/pricing/pricing.php";
    $page['content'] = ob_get_clean();
    $page['section_name'] = "pricing";
    return $page;
}

function page_get_contact_us($context, $route, $page) {
    if($context->http_method == "POST") {
        $params = array();
        $valid = site_sanitize_params_contact_us($_POST, $params);
        if(!$valid) {
            $params = print_r($_POST, true);
            trigger_error("Contact Us form parameters error\n{$params}\n" . " on " . date("Y-m-d H:i:s"), E_USER_WARNING);
            http_response_code(404);
            return;
        }
        if($valid !== 200) {
            $params = print_r($_POST, true);
            trigger_error("Contact Us form parameters error\n{$params}\n" . " on " . date("Y-m-d H:i:s"), E_USER_WARNING);
            http_response_code($valid);
            return;
        }
        http_response_code(200);
        $params = site_process_mail_body_contact_us($params, $context, $GLOBALS['email_to']);
        $mail = site_send_mail($params["contact_email"], array($GLOBALS['email_to']), $params['body'], $params['plan_selected']);
        if($mail) { 
            $page['message'] = "The mail has been delivered"; 
            trigger_error($page['message'] . " on " . date("Y-m-d H:i:s"), E_USER_NOTICE);
        } else {
            $page['message'] = "The mail could not be sent"; 
            trigger_error($page['message'] . " on " . date("Y-m-d H:i:s"), E_USER_ERROR);
        }
    }
    $content = render_template(PAGE_ROOT . "/pages/contact_us/contact_us.php", array('page' => $page));
    $page['content'] = $content;
    $page['section_name'] = "contact_us";
    return $page;
}

function page_get_home($context, $route, $page) {
    ob_start();
    require_once PAGE_ROOT . "/pages/home/home.php";
    $page['content'] = ob_get_clean();
    $page['section_name'] = "home";
    return $page;
}

function page_execute_script($page, $context, $route) {
    return render_template(PAGE_ROOT . "/templates/layout.tpl.php", array('page' => $page, 'section_name' => $page['section_name']));
}