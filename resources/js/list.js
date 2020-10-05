//
// list.js
//

(function() {
    setTimeout( function() {
    var lists = document.querySelectorAll('[data-list]');
    var sorts = document.querySelectorAll('[data-sort]');
    // var lists = document.querySelectorAll('.list')

    function init(list) {
      var listAlert = list.querySelector('.list-alert');
      var listAlertCount = list.querySelector('.list-alert-count');
      var listAlertClose = list.querySelector('.list-alert .close');
      var listCheckboxes = list.querySelectorAll('.list-checkbox');
      var listCheckboxAll = list.querySelector('.list-checkbox-all');
      var listPaginationPrev = list.querySelector('.list-pagination-prev');
      var listPaginationNext = list.querySelector('.list-pagination-next');
      var listFilters = document.querySelectorAll('.list-filter')
      var listOptions = list.dataset.list && JSON.parse(list.dataset.list);
      var additionalFilterBtn = list.querySelector('.addl-filter-btn');
      var additionalFilters = $('.addl-filter');
      var clearFiltersBtn = $('.clear-filters-btn')[0]

      var defaultOptions = {
        listClass: 'list',
        searchClass: 'list-search',
        sortClass: 'list-sort'
      };

      // Merge options
      var options = Object.assign(defaultOptions, listOptions);

      // Init
      var listObj = new List(list, options);

      // Pagination (next)
      if (listPaginationNext) {
        listPaginationNext.addEventListener('click', function(e) {
          e.preventDefault();

          var nextItem = listObj.i + listObj.page;

          if (nextItem <= listObj.size()) {
            listObj.show(nextItem, listObj.page);
          }
        });
      }

      // Pagination (prev)
      if (listPaginationPrev) {
        listPaginationPrev.addEventListener('click', function(e) {
          e.preventDefault();

          var prevItem = listObj.i - listObj.page;

          if (prevItem > 0) {
            listObj.show(prevItem, listObj.page);
          }
        });
      }

      // Checkboxes
      if (listCheckboxes) {
        [].forEach.call(listCheckboxes, function(checkbox) {
          checkbox.addEventListener('change', function() {
            countCheckboxes(listCheckboxes, listAlert, listAlertCount);

            if (listCheckboxAll) {
              listCheckboxAll.checked = false;
            }
          });
        });
      }

      // Checkbox
      if (listCheckboxAll) {
        listCheckboxAll.addEventListener('change', function() {
          [].forEach.call(listCheckboxes, function(checkbox) {
            checkbox.checked = listCheckboxAll.checked;
          });

          countCheckboxes(listCheckboxes, listAlert, listAlertCount);
        });
      }

      // Alert
      if (listAlertClose) {
        listAlertClose.addEventListener('click', function(e) {
          e.preventDefault();

          if (listCheckboxAll) {
            listCheckboxAll.checked = false;
          }

          [].forEach.call(listCheckboxes, function(checkbox) {
            checkbox.checked = false;
          });

          countCheckboxes(listCheckboxes, listAlert, listAlertCount);
        });
      }

      if (listFilters) {
          listFilters.forEach( function( filter ) {
            filter.addEventListener('click', function(e, filter) {
                e.preventDefault();
                filterList()
            })
          })
        }

        if (additionalFilters) {
            additionalFilters.each( function( filter ) {
                $(this)[0].addEventListener('change', function( e, filter ) {
                    e.preventDefault();
                    filterList()
                })
            })
        }

        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function( e, filter ) {
                e.preventDefault();
                additionalFilters.each( function() {
                    $(this).val('any')
                })
                filterList()
            })
        }


        function filterList() {
            var text = $('.list-filter.active').text();
            var filters = [];

            if (additionalFilters) {
                additionalFilters.each( function( filter) {
                    filters.push({
                        'value': $(this).val(),
                        'key': $(this).data('filter-key')
                    })
                })
            }

            listObj.filter(function(item) {
                let valid = true
                if (item.values()['orders-account'] != text && text != 'All Accounts' ) {
                    // Check addl filters here
                    valid = false
                }

                if (filters) {
                    filters.forEach( function( filter) {
                        if (!item.values()[filter.key].includes( filter.value ) && !item.values()[filter.key].replace(/&amp;/g, '&').includes( filter.value ) && filter.value != 'any' ) {
                            valid = false
                        }
                    })
                }

                return valid;
            });
        }
    };


    function countCheckboxes(listCheckboxes, listAlert, listAlertCount) {
      var checked = [].slice.call(listCheckboxes).filter(function(checkbox) {
        return checkbox.checked;
      });

      if (listAlert) {
        checked.length ? listAlert.classList.add('show') : listAlert.classList.remove('show');
        listAlertCount.innerHTML = checked.length;
      }
    };

    if (typeof List !== 'undefined' && lists) {
      [].forEach.call(lists, function(list) {
        init(list);
      });
    }


    if (typeof List !== 'undefined' && sorts) {
      [].forEach.call(sorts, function(sort) {
        sort.addEventListener('click', function(e) {
          e.preventDefault();
        });
      });
    }
}, 200)
  })();
