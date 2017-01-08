/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var sections = ["contact_us", "pricing", "features", "home"];

function header_animate(elem) {
    if(document.getElementById("header_top").style.display != "none") {
        $('#header_top').slideUp(250, function() {
            elem.firstChild.className = "glyphicon glyphicon-chevron-down";
        });
    } else if(document.getElementById("header_top").style.display == "none") {
        $('#header_top').slideDown(250, function() {
            elem.firstChild.className = "glyphicon glyphicon-chevron-up";
        });
    }
}

function navigate_to_section(elem, section, navigation) {
    if(navigation && section) {
        // elem is null, navigation and section assigned
        if(window.location.hostname.indexOf("enscalo.co.uk") !== -1) {
            ga('send', 'event', 'Button', section, window.location.pathname);
        }
        window.location.href = "/" + route_section_mapping()[section];
        return false;
    }
    var section = section ? section : elem.attributes.getNamedItem("href").nodeValue.replace("#", ""), offset = 0, height = $('#page_header').height();
    switch(section) {
        case "home":
            offset = $('a[name="section_home"]').offset();
            break;
        case "features":
            offset = $('a[name="section_features"]').offset();
            break;
        case "pricing":
            offset = $('a[name="section_pricing"]').offset();
            break;
        case "contact_us":
            offset = $('a[name="section_contact_us"]').offset();
            break;
        default:
            offset = {top: 0, left: 0};
            break;
    }
    $('a.menu-link').parent().removeClass("list-group-item-info");
    $(elem).parent().addClass("list-group-item-info");
    $('body').scrollTop(offset.top - height + 2);
    return false;
}

function get_offsets() {
    var offset = {}, offsets = [];
    offset = $('a[name="section_contact_us"]').offset();
    offsets.push({contact_us: offset});
    offset = $('a[name="section_pricing"]').offset();
    offsets.push({pricing: offset});
    offset = $('a[name="section_features"]').offset();
    offsets.push({features: offset});
    offset = $('a[name="section_home"]').offset();
    offsets.push({home: offset});
    return offsets;
}

function section_route_mapping() {
    return {
        "home": "home",
        "features": "features",
        "pricing": "pricing",
        "contact-us": "contact_us"
    };
}

function route_section_mapping() {
    return {
        "home": "home",
        "features": "features",
        "pricing": "pricing",
        "contact_us": "contact-us"
    };
}

(function($, window) {
    
    var scrollTop = $('body').scrollTop(), height = $('#page_header').height();
    var offsets = get_offsets();
    $('a.menu-link').parent().removeClass("list-group-item-info");
    for(var index in offsets) {
        if(scrollTop + height >= offsets[index][sections[index]].top) {
            $('a[href="#' + sections[index] + '"]').parent().addClass("list-group-item-info");
            break;
        }
    }
    $(window).scroll(function(event) {
        var scrollTop = $('body').scrollTop();
        $('a.menu-link').parent().removeClass("list-group-item-info");
        for(var index in offsets) {
            if(scrollTop + height >= offsets[index][[sections[index]]].top) {
                $('a[href="#' + sections[index] + '"]').parent().addClass("list-group-item-info");
                break;
            }
        }
    });
    
    if(route) {
        var elements = document.getElementsByName(route);
        if(route.indexOf("/") !== -1) {
            route = route.substr(0, route.indexOf("/"));
        }
        navigate_to_section(elements.item(0), section_route_mapping()[route]);
    }
    
    if(window.location.hostname.indexOf("enscalo.co.uk") !== -1) {
        _V_("video_containter").bigPlayButton.el.onclick = function(event) {
            ga('send', 'event', 'Video', 'play', 'Site');
        };
    }
    
})(jQuery, window);