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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var news_tab = [];
    var apiKey = '600b1a5d21a245d0ba6dc3e3a2c07120';
    var sources = '';
    var news_page = 1;
    var current_reading_news = 0;

    function get_sources() {
        $.post("/get_sources").done(function (data) {
            if (data === "null") {
                $('.news-block').append("<h4 class='text-center'>Please, select at least one <a href='/sources'>source</a>.</h4>");
                return;
            }
            var server_answer = jQuery.parseJSON(data);

            sources = server_answer.join(',');

            get_news();
        });
    }

    $(window).scroll(function () {
        var w_scroll = $(window).scrollTop();
        var w_h = $(window).height();
        var doc_h = $(document).height();

        if (w_scroll + w_h == doc_h) {
            news_page++;
            get_news();
        }
    });

    window.detail_news = function show_news(nbr) {
        current_reading_news = nbr;

        $('.modal-title').html(news_tab[nbr].title);

        $('.modal-body .img').css('background-image', 'url(' + news_tab[nbr].urlToImage + ')');
        $('.modal-body .description').html(news_tab[nbr].description);
        $('.modal .source-link').attr('href', news_tab[nbr].url);
    };

    $('.next-news').on('click', function () {
        detail_news(current_reading_news + 1);
    });

    $('.prev-news').on('click', function () {
        if (current_reading_news > 0) {
            detail_news(current_reading_news - 1);
        }
    });

    function updatePage(data) {

        data.then(function (result) {
            // news_tab.push(result['articles']);
            // console.log(news_tab);
            // console.log(result['articles']);


            $.each(result['articles'], function (key, value) {
                // console.log(value);
                news_tab.push(value);

                $('.news-block').append(' <div onclick="detail_news(' + key * news_page + ')" news_n="' + key * news_page + '" data-toggle="modal" type=""   data-target="#myModal" class="news-item card d-flex">\n' +
                // '                                    <div class="img" style="background-image: url(' + value.urlToImage + ')">\n' +
                // '                                    </div>\n' +
                '\n' + '                                    <div class="news-info">\n' + '                                        <div class="title">' + value.title + '</div>\n' +
                // '                                        <div class="description">' + value.description + '</div>\n' +
                '\n' + '                                        <div class="add-info">\n' +
                // '                                            <div class="news-source">' + value.source['name'] + '</div>\n' +
                // '                                            <div class="publication">' + value.publishedAt + '</div>\n' +
                '                                        </div>\n' + '                                    </div>\n' + '                            </div>');
            });
        });
    }

    function get_news() {
        var url = 'https://newsapi.org/v2/top-headlines?' + 'sources=' + sources + '&page=' + news_page + '&apiKey=' + apiKey;

        var req = new Request(url);

        fetch(req).then(function (response) {
            updatePage(response.json());
        });
    }

    get_sources();
});

/***/ })

/******/ });