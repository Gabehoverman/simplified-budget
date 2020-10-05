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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/list.js":
/*!******************************!*\
  !*** ./resources/js/list.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

//
// list.js
//
(function () {
  setTimeout(function () {
    var lists = document.querySelectorAll('[data-list]');
    var sorts = document.querySelectorAll('[data-sort]'); // var lists = document.querySelectorAll('.list')

    function init(list) {
      var listAlert = list.querySelector('.list-alert');
      var listAlertCount = list.querySelector('.list-alert-count');
      var listAlertClose = list.querySelector('.list-alert .close');
      var listCheckboxes = list.querySelectorAll('.list-checkbox');
      var listCheckboxAll = list.querySelector('.list-checkbox-all');
      var listPaginationPrev = list.querySelector('.list-pagination-prev');
      var listPaginationNext = list.querySelector('.list-pagination-next');
      var listFilters = document.querySelectorAll('.list-filter');
      var listOptions = list.dataset.list && JSON.parse(list.dataset.list);
      var additionalFilterBtn = list.querySelector('.addl-filter-btn');
      var additionalFilters = $('.addl-filter');
      var clearFiltersBtn = $('.clear-filters-btn')[0];
      var defaultOptions = {
        listClass: 'list',
        searchClass: 'list-search',
        sortClass: 'list-sort'
      }; // Merge options

      var options = Object.assign(defaultOptions, listOptions); // Init

      var listObj = new List(list, options); // Pagination (next)

      if (listPaginationNext) {
        listPaginationNext.addEventListener('click', function (e) {
          e.preventDefault();
          var nextItem = listObj.i + listObj.page;

          if (nextItem <= listObj.size()) {
            listObj.show(nextItem, listObj.page);
          }
        });
      } // Pagination (prev)


      if (listPaginationPrev) {
        listPaginationPrev.addEventListener('click', function (e) {
          e.preventDefault();
          var prevItem = listObj.i - listObj.page;

          if (prevItem > 0) {
            listObj.show(prevItem, listObj.page);
          }
        });
      } // Checkboxes


      if (listCheckboxes) {
        [].forEach.call(listCheckboxes, function (checkbox) {
          checkbox.addEventListener('change', function () {
            countCheckboxes(listCheckboxes, listAlert, listAlertCount);

            if (listCheckboxAll) {
              listCheckboxAll.checked = false;
            }
          });
        });
      } // Checkbox


      if (listCheckboxAll) {
        listCheckboxAll.addEventListener('change', function () {
          [].forEach.call(listCheckboxes, function (checkbox) {
            checkbox.checked = listCheckboxAll.checked;
          });
          countCheckboxes(listCheckboxes, listAlert, listAlertCount);
        });
      } // Alert


      if (listAlertClose) {
        listAlertClose.addEventListener('click', function (e) {
          e.preventDefault();

          if (listCheckboxAll) {
            listCheckboxAll.checked = false;
          }

          [].forEach.call(listCheckboxes, function (checkbox) {
            checkbox.checked = false;
          });
          countCheckboxes(listCheckboxes, listAlert, listAlertCount);
        });
      }

      if (listFilters) {
        listFilters.forEach(function (filter) {
          filter.addEventListener('click', function (e, filter) {
            e.preventDefault();
            filterList();
          });
        });
      }

      if (additionalFilters) {
        additionalFilters.each(function (filter) {
          $(this)[0].addEventListener('change', function (e, filter) {
            e.preventDefault();
            filterList();
          });
        });
      }

      if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function (e, filter) {
          e.preventDefault();
          additionalFilters.each(function () {
            $(this).val('any');
          });
          filterList();
        });
      }

      function filterList() {
        var text = $('.list-filter.active').text();
        var filters = [];

        if (additionalFilters) {
          additionalFilters.each(function (filter) {
            filters.push({
              'value': $(this).val(),
              'key': $(this).data('filter-key')
            });
          });
        }

        listObj.filter(function (item) {
          var valid = true;

          if (item.values()['orders-account'] != text && text != 'All Accounts') {
            // Check addl filters here
            valid = false;
          }

          if (filters) {
            filters.forEach(function (filter) {
              if (!item.values()[filter.key].includes(filter.value) && !item.values()[filter.key].replace(/&amp;/g, '&').includes(filter.value) && filter.value != 'any') {
                valid = false;
              }
            });
          }

          return valid;
        });
      }
    }

    ;

    function countCheckboxes(listCheckboxes, listAlert, listAlertCount) {
      var checked = [].slice.call(listCheckboxes).filter(function (checkbox) {
        return checkbox.checked;
      });

      if (listAlert) {
        checked.length ? listAlert.classList.add('show') : listAlert.classList.remove('show');
        listAlertCount.innerHTML = checked.length;
      }
    }

    ;

    if (typeof List !== 'undefined' && lists) {
      [].forEach.call(lists, function (list) {
        init(list);
      });
    }

    if (typeof List !== 'undefined' && sorts) {
      [].forEach.call(sorts, function (sort) {
        sort.addEventListener('click', function (e) {
          e.preventDefault();
        });
      });
    }
  }, 200);
})();

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/list.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/GabeHoverman/Simplified-Budget/resources/js/list.js */"./resources/js/list.js");


/***/ })

/******/ });