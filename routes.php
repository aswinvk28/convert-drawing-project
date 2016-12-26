<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$routes = array(
    '/' => array(
        'callable' => 'page_get_home',
        'variables' => array(
            'page' => array('content' => array())
        )
    ),
    '/features' => array(
        'callable' => 'page_get_features',
        'variables' => array(
            'page' => array('content' => array())
        )
    ),
    '/pricing' => array(
        'callable' => 'page_get_pricing',
        'variables' => array(
            'page' => array('content' => array())
        )
    ),
    '/contact-us' => array(
        'callable' => 'page_get_contact_us',
        'variables' => array(
            'page' => array('content' => array(), 'sidebar' => array())
        )
    )
);