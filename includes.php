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
            $this->page_variables['html_content'] .= call_user_func('page_execute_script', $page, $route['callable'], $this, $route);
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
    require_once($filePath);
    $contents = ob_get_contents();
    ob_end_clean();
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