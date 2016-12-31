<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "routes.php";
require_once "config.php";

function page_shutdown_site() {
    
    session_destroy();
    
}

class Context extends stdClass
{
    function dispatch($routes)
    {
        if($GLOBALS['single_page']) {
            $this->dispatch_single_page($routes);
        } else {
            $this->dispatch_multi_page($routes);
        }
    }
    
    function dispatch_single_page($routes) 
    {
        foreach($routes as $path => $route) {
            extract($route['variables']);
            $page = call_user_func($route['callable'], $this, $route, $page);
            $this->page_variables['html_content'] .= call_user_func('page_execute_script', $page, $this, $route);
        }
        echo render_template(PAGE_ROOT . "/templates/page.tpl.php", $this->page_variables);
    }
    
    function dispatch_multi_page($routes)
    {
        if(array_key_exists($this->path, $routes)) {
            call_user_func('page_execute_script', $routes[$this->uri]['callable'], $this, $routes[$this->path]);
        } elseif(array_key_exists($output['q'], $routes)) {
            call_user_func('page_execute_script', $routes["/" . $output['q']]['callable'], $this, $routes[$output['q']]);
        }
    }
}

function get_page_context() {
    $output = array();
    $context = new Context();
    $context->uri = $_SERVER['REQUEST_URI'];
    $context->path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $context->http_method = $_SERVER['REQUEST_METHOD'];
    $context->query = $_SERVER['QUERY_STRING'];
    $context->host = $_SERVER['HTTP_HOST'];
    $context->is_https = isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : false;
    $context->ip = $_SERVER['REMOTE_ADDR'];
    $context->q = isset($_GET['q']) ? $_GET['q'] : '';
    $context->parse = parse_url($context->query, PHP_URL_QUERY);
    $context->hash = parse_url($context->query, PHP_URL_FRAGMENT);
    $context->variables = parse_str($context->query, $output);
    $context->page_variables = array('html_content' => '');
    
    return $context;
}

function render($content) {
    if (empty($content))
        return "";
    $result = "";
    if(is_string($content)) return $content;
    foreach($content as $row) {
        $result .= $row;
    }
    return $result;
}

function render_template($filePath, $variables) {
    extract($variables);
    ob_start();
    require($filePath);
    $contents = ob_get_clean();
    return $contents;
}

function html_wrapper($content, $options = array()) {
    $prefix = "";
    if(isset($options['tag'])) {
        $prefix .= "<" . $options['tag'];
    }
    if(isset($options['class'])) {
        $prefix .= " class=\"{$options['class']}\"";
    }
    $prefix .= ">";
    $prefix .= "</" . $options['tag'];
    return $prefix;
}

function site_sanitize_params_contact_us($post, &$params = array()) {
    if(empty($post)) return false;
    $params["contact_name"] = filter_input(INPUT_POST, "contact_name", FILTER_SANITIZE_STRING, 
            array("flags" => array(FILTER_FLAG_STRIP_BACKTICK, FILTER_FLAG_ENCODE_HIGH, FILTER_FLAG_ENCODE_LOW)));
    $params["contact_email"] = filter_input(INPUT_POST, "contact_email", FILTER_VALIDATE_EMAIL);
    $params["plan_selected"] = filter_input(INPUT_POST, "plan_selected", FILTER_SANITIZE_STRING,
            array("flags" => array(FILTER_FLAG_STRIP_BACKTICK, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_STRIP_LOW)));
    if($post["submit"] == "submit" && count(array_filter($params)) == 3) {
        return 200;
    }
    return 400;
}

function site_process_mail_body_contact_us($params, $context, $to) {
    $date = new DateTime('now');
    $body = "\n\n
    Contact Name:\n
    {$params['contact_name']}\n
    
    Date:\n
    {$date->format("Y-m-d H:i:s")}\n
    
    Plan Selected:\n
    {$params['plan_selected']}\n
    
    Contact Email:\n
    {$params['contact_email']}\n
    
    IP Address:\n
    {$context->ip}\n
    
    This is a request for Sign up received by {$to} on {$date->format("Y-m-d H:i:s")} in the name of {$params['contact_name']}. Please contact {$params['contact_email']} as soon as possible for the enquiry,
    about {$params['plan_selected']}.\n
    ";
    
    $params['body'] = $body;
    
    return $params;
}

function site_send_mail($from = "", $to = array(), $body = "", $subject = "") {
    if(empty($to)) return false;
    $headers = array();
    if($from) {
        $headers[] = "From: <{$from}>";
    }
    $mail = mail($to[0], $subject, $body, implode("\r\n", $headers));
    return $mail;
}