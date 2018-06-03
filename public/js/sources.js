/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, exports) {

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var apiKey = '600b1a5d21a245d0ba6dc3e3a2c07120';
    var sources_tab = [];

    window.check_source = function show_news(elem) {

        var source_id = elem.attr('source_id');
        elem.toggleClass('btn-success');

        if (elem.hasClass('btn-success')) {
            sources_tab.push(source_id);
        } else {
            sources_tab = jQuery.grep(sources_tab, function (value) {
                return value != source_id;
            });
        }
    };

    $('.source-save-btn').on('click', function () {
        console.log(sources_tab);

        $.post("/update_source", { sources: sources_tab }).done(function (data) {});
    });

    function get_sources() {
        $.post("/get_sources").done(function (data) {
            if (data === "null") {
                return;
            }

            var selected_list = jQuery.parseJSON(data);

            $.each(selected_list, function (key, value) {
                console.log(value);

                $("[source_id=" + value + "]").addClass('btn-success');
            });

            // sources = server_answer.join(',');
        });
    }

    function updatePage(data) {
        data.then(function (result) {

            var sources_tab = result['sources'];

            $.each(sources_tab, function (key, value) {

                $('.source-block').append('' + ' <div class="source-item source d-flex"  source_id="' + value.id + '" onclick="check_source($(this))" >\n' + '                    <div class="title">' + value.name + '</div>\n' + '                </div>');
            });
        });
    }

    function get_source_list() {
        var url = 'https://newsapi.org/v2/sources?' + '&apiKey=' + apiKey;

        var req = new Request(url);

        fetch(req).then(function (response) {
            updatePage(response.json());
            get_sources();
        });
    }

    get_source_list();
});

/***/ })

/******/ });