void 0===window.kintRich&&(window.kintRich=function(){"use strict";var e={selectText:function(e){var t=window.getSelection(),a=document.createRange();a.selectNodeContents(e),t.removeAllRanges(),t.addRange(a)},each:function(e,t){Array.prototype.slice.call(document.querySelectorAll(e),0).forEach(t)},hasClass:function(e,t){return!!e.classList&&(void 0===t&&(t="kint-show"),e.classList.contains(t))},addClass:function(e,t){void 0===t&&(t="kint-show"),e.classList.add(t)},removeClass:function(e,t){return void 0===t&&(t="kint-show"),e.classList.remove(t),e},toggle:function(t,a){var o=e.getChildren(t);o&&(void 0===a&&(a=e.hasClass(t)),a?e.removeClass(t):e.addClass(t),1===o.childNodes.length&&(o=o.childNodes[0].childNodes[0])&&e.hasClass(o,"kint-parent")&&e.toggle(o,a))},toggleChildren:function(t,a){var o=e.getChildren(t);if(o){var r=o.getElementsByClassName("kint-parent"),s=r.length;for(void 0===a&&(a=!e.hasClass(t));s--;)e.toggle(r[s],a)}},toggleAll:function(t){for(var a=document.getElementsByClassName("kint-parent"),o=a.length,r=!e.hasClass(t.parentNode);o--;)e.toggle(a[o],r)},switchTab:function(t){var a,o=t.previousSibling,r=0;for(t.parentNode.getElementsByClassName("kint-active-tab")[0].className="",t.className="kint-active-tab";o;)1===o.nodeType&&r++,o=o.previousSibling;a=t.parentNode.nextSibling.childNodes;for(var s=0;s<a.length;s++)s===r?(a[s].style.display="block",1===a[s].childNodes.length&&(o=a[s].childNodes[0].childNodes[0])&&e.hasClass(o,"kint-parent")&&e.toggle(o,!1)):a[s].style.display="none"},mktag:function(e){return"<"+e+">"},openInNewWindow:function(t){var a=window.open();a&&(a.document.open(),a.document.write(e.mktag("html")+e.mktag("head")+e.mktag("title")+"Kint ("+(new Date).toISOString()+")"+e.mktag("/title")+e.mktag('meta charset="utf-8"')+document.getElementsByClassName("kint-script")[0].outerHTML+document.getElementsByClassName("kint-style")[0].outerHTML+e.mktag("/head")+e.mktag("body")+'<input style="width: 100%" placeholder="Take some notes!"><div class="kint-rich">'+t.parentNode.outerHTML+"</div>"+e.mktag("/body")),a.document.close())},sortTable:function(e,t){var a=e.tBodies[0],o=function(e){var a=1===t?e.replace(/^#/,""):e;return isNaN(a)?e.trim().toLocaleLowerCase():(a=parseFloat(a),isNaN(a)?e.trim():a)};[].slice.call(e.tBodies[0].rows).sort(function(e,a){return e=o(e.cells[t].textContent),a=o(a.cells[t].textContent),e<a?-1:e>a?1:0}).forEach(function(e){a.appendChild(e)})},showAccessPath:function(t){for(var a=t.childNodes,o=0;o<a.length;o++)if(e.hasClass(a[o],"access-path"))return void(e.hasClass(a[o],"kint-show")?e.removeClass(a[o]):(e.addClass(a[o]),e.selectText(a[o])))},getParentByClass:function(t,a){for(void 0===a&&(a="kint-rich");(t=t.parentNode)&&!e.hasClass(t,a););return t},getParentHeader:function(t,a){for(var o=t.nodeName.toLowerCase();"dd"!==o&&"dt"!==o&&e.getParentByClass(t);)t=t.parentNode,o=t.nodeName.toLowerCase();return e.getParentByClass(t)?("dd"===o&&a&&(t=t.previousElementSibling),t&&"dt"===t.nodeName.toLowerCase()&&e.hasClass(t,"kint-parent")?t:void 0):null},getChildren:function(e){do{e=e.nextElementSibling}while(e&&"dd"!==e.nodeName.toLowerCase());return e},keyboardNav:{targets:[],target:0,active:!1,fetchTargets:function(){e.keyboardNav.targets=[],e.each(".kint-rich nav, .kint-tabs>li:not(.kint-active-tab)",function(t){0===t.offsetWidth&&0===t.offsetHeight||e.keyboardNav.targets.push(t)})},sync:function(t){var a=document.querySelector(".kint-focused");if(a&&e.removeClass(a,"kint-focused"),e.keyboardNav.active){var o=e.keyboardNav.targets[e.keyboardNav.target];e.addClass(o,"kint-focused"),t||e.keyboardNav.scroll(o)}},scroll:function(e){var t=function(e){return e.offsetTop+(e.offsetParent?t(e.offsetParent):0)},a=t(e)-window.innerHeight/2;window.scrollTo(0,a)},moveCursor:function(t){for(e.keyboardNav.target+=t;e.keyboardNav.target<0;)e.keyboardNav.target+=e.keyboardNav.targets.length;for(;e.keyboardNav.target>=e.keyboardNav.targets.length;)e.keyboardNav.target-=e.keyboardNav.targets.length;e.keyboardNav.sync()},setCursor:function(t){e.keyboardNav.fetchTargets();for(var a=0;a<e.keyboardNav.targets.length;a++)if(t===e.keyboardNav.targets[a])return e.keyboardNav.target=a,!0;return!1}},mouseNav:{lastClickTarget:null,lastClickTimer:null,lastClickCount:0,renewLastClick:function(){window.clearTimeout(e.mouseNav.lastClickTimer),e.mouseNav.lastClickTimer=window.setTimeout(function(){e.mouseNav.lastClickTarget=null,e.mouseNav.lastClickTimer=null,e.mouseNav.lastClickCount=0},250)}}};return window.addEventListener("click",function(t){var a=t.target,o=a.nodeName.toLowerCase();if(e.mouseNav.lastClickTarget&&e.mouseNav.lastClickTimer&&e.mouseNav.lastClickCount)return a=e.mouseNav.lastClickTarget,1===e.mouseNav.lastClickCount?(e.toggleChildren(a.parentNode),e.keyboardNav.setCursor(a),e.keyboardNav.sync(!0),e.mouseNav.lastClickCount++,e.mouseNav.renewLastClick()):(e.toggleAll(a),e.keyboardNav.setCursor(a),e.keyboardNav.sync(!0),e.keyboardNav.scroll(a),window.clearTimeout(e.mouseNav.lastClickTimer),e.mouseNav.lastClickTarget=null,e.mouseNav.lastClickTarget=null,e.mouseNav.lastClickCount=0),!1;if(e.getParentByClass(a)){if("dfn"===o)e.selectText(a);else if("th"===o)return t.ctrlKey||e.sortTable(a.parentNode.parentNode.parentNode,a.cellIndex),!1;if(a=e.getParentHeader(a),a&&(e.keyboardNav.setCursor(a.querySelector("nav")),e.keyboardNav.sync(!0)),a=t.target,"li"===o&&"kint-tabs"===a.parentNode.className)return"kint-active-tab"!==a.className&&e.switchTab(a),a=e.getParentHeader(a,!0),a&&(e.keyboardNav.setCursor(a.querySelector("nav")),e.keyboardNav.sync(!0)),!1;if("nav"===o)return"footer"===a.parentNode.nodeName.toLowerCase()?(e.keyboardNav.setCursor(a),e.keyboardNav.sync(!0),a=a.parentNode,e.hasClass(a)?e.removeClass(a):e.addClass(a)):(e.toggle(a.parentNode),e.keyboardNav.fetchTargets(),e.mouseNav.lastClickCount=1,e.mouseNav.lastClickTarget=a,e.mouseNav.renewLastClick()),!1;if(e.hasClass(a,"kint-ide-link")){var r=new XMLHttpRequest;return r.open("GET",a.href),r.send(null),!1}if(e.hasClass(a,"kint-popup-trigger")){var s=a.parentNode;if("footer"===s.nodeName.toLowerCase())s=s.previousSibling;else for(;s&&!e.hasClass(s,"kint-parent");)s=s.parentNode;e.openInNewWindow(s)}else{if(e.hasClass(a,"kint-access-path-trigger"))return e.showAccessPath(a.parentNode),!1;if("pre"===o&&3===t.detail)e.selectText(a);else if(e.getParentByClass(a,"kint-source")&&3===t.detail)e.selectText(e.getParentByClass(a,"kint-source"));else if(e.hasClass(a,"access-path"))e.selectText(a);else if("a"!==o)return a=e.getParentHeader(a),a&&(e.toggle(a),e.keyboardNav.fetchTargets()),!1}}},!1),window.onkeydown=function(t){if(t.target===document.body&&!t.altKey&&!t.ctrlKey){if(68===t.keyCode){if(e.keyboardNav.active)e.keyboardNav.active=!1;else if(e.keyboardNav.active=!0,e.keyboardNav.fetchTargets(),0===e.keyboardNav.targets.length)return e.keyboardNav.active=!1,!0;return e.keyboardNav.sync(),!1}if(!e.keyboardNav.active)return!0;if(9===t.keyCode)return e.keyboardNav.moveCursor(t.shiftKey?-1:1),!1;if(38===t.keyCode||75===t.keyCode)return e.keyboardNav.moveCursor(-1),!1;if(40===t.keyCode||74===t.keyCode)return e.keyboardNav.moveCursor(1),!1;var a=e.keyboardNav.targets[e.keyboardNav.target];if("li"===a.nodeName.toLowerCase()){if(32===t.keyCode||13===t.keyCode)return e.switchTab(a),e.keyboardNav.fetchTargets(),e.keyboardNav.sync(),!1;if(39===t.keyCode||76===t.keyCode)return e.keyboardNav.moveCursor(1),!1;if(37===t.keyCode||72===t.keyCode)return e.keyboardNav.moveCursor(-1),!1}if(a=a.parentNode,65===t.keyCode)return e.showAccessPath(a),!1;if("footer"===a.nodeName.toLowerCase()&&e.hasClass(a.parentNode,"kint-rich")){if(32===t.keyCode||13===t.keyCode)e.hasClass(a)?e.removeClass(a):e.addClass(a);else if(37===t.keyCode||72===t.keyCode)e.removeClass(a);else{if(39!==t.keyCode&&76!==t.keyCode)return!0;e.addClass(a)}return!1}if(32===t.keyCode||13===t.keyCode)return e.toggle(a),e.keyboardNav.fetchTargets(),!1;if(39===t.keyCode||76===t.keyCode||37===t.keyCode||72===t.keyCode){var o=37===t.keyCode||72===t.keyCode;if(e.hasClass(a))e.toggleChildren(a,o),e.toggle(a,o);else{if(o){var r=e.getParentHeader(a.parentNode.parentNode,!0);r&&(a=r,e.keyboardNav.setCursor(a.querySelector("nav")),e.keyboardNav.sync())}e.toggle(a,o)}return e.keyboardNav.fetchTargets(),!1}}},e}());
