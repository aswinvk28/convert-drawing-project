/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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