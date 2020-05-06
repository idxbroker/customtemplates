/** mobileFirstResults javascript file */
(function(window, undefined) {
    'use strict';
    //var hasDisplayedMap = false;
    // Bind click to save property button.
    window.savePropertySuccess = function(responseText, statusText, xhr, $form) {
        var element = idx('#IDX-SP-' + responseText.idxID + '-' + responseText.listingID);
        if (responseText.status ==='success') {
            element.addClass('IDX-resultsCellSaved').text('Saved!');
            idx($form).resetForm();
        } else {
            element.after('Error saving property');
        }
    };
    window.saveSearchSuccess = function(responseText, statusText, xhr, $form) {
        var element = idx('#IDX-saveSearch');
        if (responseText.status === 'success') {
            element.text('Saved!');
            idx($form).resetForm();
        } else {
            element.after('Error saving search');
        }
    };

    var saveSearch = function(e) {
        e.preventDefault();
        var queryString = idx('#IDX-saveSearchForm .IDX-queryString').val();
        var searchPageID = idx('#IDX-saveSearchForm .IDX-searchPageID').val();
        var softLoggedIn = idx('#IDX-registration').attr('data-softLoggedIn');
        // Logged In.
        if (idx('#IDX-main').hasClass('IDX-loggedIn') && !softLoggedIn) {
            // They are logged in, submit the form.
            idx('#IDX-saveSearchForm').ajaxSubmit({
                dataType:'json',
                success: saveSearchSuccess
            });
        } else {
            queryString = idx('#IDX-saveSearchForm .IDX-queryString').val();
            searchPageID = idx('#IDX-saveSearchForm .IDX-searchPageID').val();
            idx('.IDX-saveParams').attr('disabled','disabled');
            idx('.IDX-saveWhat').val('search').removeAttr('disabled');
            idx('.IDX-queryString').val(queryString).removeAttr('disabled');
            idx('.IDX-searchPageID').val(searchPageID).removeAttr('disabled');
            idx('#IDX-registration').dialog('open');
        }
    };

    var saveProperty = function(e) {
        e.preventDefault();

        var idxID = idx(this).attr('data-idxid');
        var listingID = idx(this).attr('data-listingid');
        var softLoggedIn = idx('#IDX-registration').attr('data-softLoggedIn');

        // Logged In.
        if (idx('#IDX-main').hasClass('IDX-loggedIn') && !softLoggedIn) {
            // They are logged in, submit the form.
            idx('#IDX-savePropertyForm .IDX-idxID').val(idxID);
            idx('#IDX-savePropertyForm .IDX-listingID').val(listingID);

            idx('#IDX-savePropertyForm').ajaxSubmit({
                dataType:'json',
                success: savePropertySuccess
            });
        } else {
            var idxID = idx(this).attr('data-idxid');
            var listingID = idx(this).attr('data-listingid');
            idx('.IDX-saveParams').attr('disabled','disabled');
            idx('.IDX-saveWhat').val('property').removeAttr('disabled');
            idx('.IDX-idxID').val(idxID).removeAttr('disabled');
            idx('.IDX-listingID').val(listingID).removeAttr('disabled');
            idx('#IDX-registration').dialog('open');
        }
    };

    var MobileFirst = function() {
        this.pageSettings = {
            queryArray: {}
        };
        this.defaultPriceData = {};

        // Try to load page setting.
        if (idx('#IDX-pageSettings').length) {
            var settingsString = idx('#IDX-pageSettings').text();
            var settingsObj =  JSON.parse(settingsString);
            idx.extend(this.pageSettings, settingsObj);
        }

        // Try to load default price data.
        if (idx('#IDX-defaultPriceData').length) {
            var defaultPriceText = idx('#IDX-defaultPriceData').text();
            var defaultPriceObj = JSON.parse(defaultPriceText);
            idx.extend(this.defaultPriceData, defaultPriceObj);
        }

        var isNeedToCheckMinAndMax = function(target) {
            return target.pageSettings.queryArray.pt &&
                (target.defaultPriceData.min || target.defaultPriceData.max) &&
                (! target.pageSettings.queryArray.lp && ! target.pageSettings.queryArray.hp);
        };

        // Set min and max price.
        if (isNeedToCheckMinAndMax(this)) {
            if (this.defaultPriceData.min) {
                this.pageSettings.queryArray.lp = this.defaultPriceData.min[this.pageSettings.queryArray.pt];
            }
            if (this.defaultPriceData.max) {
                this.pageSettings.queryArray.hp = this.defaultPriceData.max[this.pageSettings.queryArray.pt];
            }
        }
    };

    MobileFirst.prototype.generatePrices = function(input) {
        // Convert input to string.
        input = input.toString();
        var symbol;
        if (! input.match(/^\d+$|^\d+(-$|\+$|-\d+$)/)) {
            return [];
        }
        if (input.match(/\d+-$/)) {
            input = input.substr(0, input.indexOf('-')).toString();
            symbol = '-';
        }
        if (input.match(/\d+-\d+$/)) {
            return [input];
        }
        if (input.indexOf('+') !== -1) {
            return [input];
        }

        var length = input.length,
            maximum = (Math.pow(10, length) - 1),
            lessThan = input + '-',
            moreThan = input + '+',
            between = input + '-' + maximum;

        if (symbol === '-') {
            return [lessThan, between];
        }

        return [ lessThan, moreThan, between ];
    };

    MobileFirst.prototype.setPageSettings = function (settings) {
        if (typeof settings === 'object') {
            this.pageSettings = idx.extend(this.pageSettings, settingsString);
        } else {
            console.error('Please pass setting object');
        }
        return this.pageSettings;
    };

    var mobileFirst = new MobileFirst();

    var openVirtualTourModal = function(e) {
        e.preventDefault();
        idx(idx(this).attr('href')).dialog('open');
    };

    idx(function() {
        // Bind.
        idx('#IDX-saveSearch').click(saveSearch);
        idx('a[href="#saveProperty"]').click(saveProperty);
        idx('a.IDX-resultsMediaVirtualTour').click(openVirtualTourModal);

        var sanitizeSearchForm = function () {
            var searchForm = idx('#IDX-refinementSearchForm');
            var searchCriteriaFields = searchForm.find('input, select');
            idx(searchCriteriaFields).each(function(index, element) {
                if (idx(element).val() === '') {
                    idx(element).prop('disabled', true);
                }
            });
            idx('input[name=price]').prop('disabled', true);
            if (idx('#IDX-ccz-select').val()) {
                var cczType = idx('#IDX-ccz').val();
                idx('#IDX-ccz-select').attr('name', cczType + '[]');
            }
            var savedLinkInput = idx('[name="slID"]');
            if (savedLinkInput && savedLinkInput.val() !== '') {
                idx('[name="pgon"]').attr('disabled', 'disabled');
            }
        };
        var goToPage = function (start) {
            var isSavedLink = idx('input[name="savedLink"]').length ? true : false;
            var newLocation = '';
            var per = (function () {
                if (idx('#IDX-per').length) {
                    return idx('#IDX-per').val();
                } else {
                    return undefined;
                }
            })();
            if (window.location.search.match(/start=[^&]*/)) {
                newLocation =  window.location.href.replace(/start=\d+/,'start=' + start);
            } else {
                if (window.location.search === '') {
                    newLocation = window.location.href + '?start=' + start;
                } else {
                    newLocation = window.location.href + '&start=' + start;
                }
                newLocation += isSavedLink ? (per ? '&per=' + per : '') : '';
            }
            window.location = newLocation;
        };
        // Common functions for number select2.
        var createNumberChoices = function (term, data, label) {
            label = label || '';
            if (idx(data).filter(function() { return this.text.localeCompare(term)===0; }).length===0) {
                if (term.match(/\d+/)) {
                    return { id:term, text:label + term };
                }
            }
        };

            var createCurrencyChoices = function(term, data, label) {
            label = label || '';
            if (idx(data).filter(function() {
                    return this.text.localeCompare(term) === 0;
                }).length === 0) {
                if (term.match(/\d+/)) {
                    return {
                        id: term,
                        text: label + currencyFormat(term)
                    };
                }
            }
        };

        // Function for generating guesses in the min and max select2 dropdown.
        var currencyQuery = function(query, label) {
            label = label || '';
            if (query.term.match(/\d+$/)) {
                var data = {
                        results: []
                    };

                query.callback(data);
            } else {
                return [{
                    id: '',
                    text: 'No matches found'
                }];
            }
        };
        var numberQuery = function(query, label) {
            label = label || '';
            if (query.term.match(/\d+$/)) {
                var data = {
                        results: []
                    },
                    i, s;

                query.callback(data);
            } else {
                return [{
                    id: '',
                    text: 'No matches found'
                }];
            }
        };

         // Function to add commas and $ to numbers for currency.
        var currencyFormat = function (num){
            num = num.toString();
            // If there is a decimal only use numbers to the left of it.
            num = num.split('.');
            // Only numbers.
            num = num[0].replace(/\D/g,'');
            var numLength = num.length;
            numLength /= 3;
            for(var i = 0; i<numLength; i++) {
                num = num.replace(/(\d+)(\d{3})/, '$1'+','+'$2');
            }
            return '$'+num;
        };

        var numberFormatResult = function(state) {
            if (state.id.match(/\d+$/)) {
                return state.text;
            }
            return 'No matches found';
        };
        var numberFormatSelection = function(state) {
            if (state.id.match(/\d+$/)) {
                return state.text;
            }
        };
        idx('#IDX-pagination-pagers-header, #IDX-pagination-pagers-footer').select2({
            matcher: function(term, text) {
                var regx = new RegExp(term + '\\s\\/');
                return regx.exec(text);
            }
        });
        idx('#IDX-pagination-pagers-header, #IDX-pagination-pagers-footer').on('change', function(e) {
            e.preventDefault();
            goToPage(e.val);
        });
        idx('#IDX-pagination-header-prev, #IDX-pagination-footer-prev').click(function(e) {
            e.preventDefault();
            var start = idx('#IDX-start').val();
            start = parseInt(start, 10) - 1;
            goToPage(start);
        });
        idx('#IDX-pagination-header-next, #IDX-pagination-footer-next').click(function(e) {
            e.preventDefault();
            var start = idx('#IDX-start').val();
            start = parseInt(start, 10) + 1;
            goToPage(start);
        });
        idx('.IDX-resultsOpenHouse a').click(function(e) {
            e.preventDefault();
            var target = idx(this).attr('href');
            idx(target).dialog({
                width: 300,
                position: {
                    my: 'center',
                    at: 'center',
                    of: window
                }
            });
            idx(target).dialog('open');
        });
        idx('.IDX-mediaContentVT, .IDX-mediaContentOH').dialog({
            autoOpen: false,
            resizable: false
        });

        // City, county, postal code.
        var cityCountyPostalCodePlaceholder = idx('#IDX-ccz-select').siblings('label').text();
        var queryString = decodeURIComponent(decodeURIComponent(idx('#IDX-saveSearchForm input[name="queryString"]').val()));
        var cczInitialValues = [];
        if (queryString.match(/(city|county|zipcode)\[/)) {
            var cczOptions = idx('#IDX-ccz-select option').slice(1, idx('#IDX-ccz-select option').size());
            //cczInitialValues = idx.map(cczOptions, function(object) {
              //  return idx(object).val();
            //});
        }
        idx('select#IDX-ccz-select').val(cczInitialValues).select2({
            placeholder: cityCountyPostalCodePlaceholder
        });

        // Prop status.
        var propStatuses = idx.map(idx('#IDX-refinepropStatus option:selected'), function(object) {
            return idx(object).val();
        });
        idx('select#IDX-refinepropStatus').val(propStatuses).select2({
            placeholder: idx('#IDX-refinepropStatus').siblings('label').text()
        });

        // Min price.
        var minPricePlaceholder = idx('#IDX-minPrice').siblings('label').text() || 'Min Price';
        var minPriceLabel = minPricePlaceholder + ': ';
         idx('#IDX-minPrice').select2({
            placeholder: minPricePlaceholder,
            allowClear: true,
            initSelection: function(element, callback) {
                var val = idx(element).val();
                callback({id: val, text: minPriceLabel + currencyFormat(val)});
            },
            query: function(query) {
                return currencyQuery(query, minPriceLabel);
            },
            createSearchChoice: function(term, data) {
                return createCurrencyChoices(term, data, minPriceLabel);
            },
            formatResult: function(state) {
                if (state.id === '' || state.id.match(/\d+$/)) {
                    return state.text;
                }
            },
            formatSelection: function(state) {
                if (state.id === '' || state.id.match(/\d+$/)) {
                    idx('input[name=lp]').val(state.id);
                    return state.text;
                }
            },
            formatSearching: function() {
                return 'Enter any number';
            }
        });

        // Max price.
        var maxPricePlaceholder = idx('#IDX-maxPrice').siblings('label').text() || 'Max Price';
        var maxPriceLabel = maxPricePlaceholder + ': ';
        idx('#IDX-maxPrice').select2({
            placeholder: maxPriceLabel,
            allowClear: true,
            initSelection: function(element, callback) {
                var val = idx(element).val();
                callback({id: val, text: maxPriceLabel + currencyFormat(val)});
            },
            query: function(query) {
                return currencyQuery(query, maxPriceLabel);
            },
            createSearchChoice: function(term, data) {
                return createCurrencyChoices(term, data, maxPriceLabel);
            },
            formatResult: function(state) {32
                if (state.id === '' || state.id.match(/\d+$/)) {
                    return state.text;
                }
            },
            formatSelection: function(state) {
                if (state.id === '' || state.id.match(/\d+$/)) {
                    idx('input[name=hp]').val(state.id);
                    return state.text;
                }
            },
            formatSearching: function() {
                return 'Enter any Number';
            }
        });

        idx('input#IDX-price').on('change', function() {
            var price = idx(this).val();
            if (price) {
                if (price.match(/\d+\-\d+/)) {
                    var prices = price.split('-');
                    if (parseFloat(prices[0]) < parseFloat(prices[1])) {
                        idx('#IDX-lp').val(prices[0]);
                        idx('#IDX-hp').val(prices[1]);
                    } else {
                        idx('#IDX-lp').val(prices[1]);
                        idx('#IDX-hp').val(prices[0]);
                    }
                }
                if (price.match(/\d+\+$/)) {
                    idx('#IDX-lp').val(price.replace('+', ''));
                    idx('#IDX-hp').val(null);
                }
                if (price.match(/\d+\-$/)) {
                    idx('#IDX-lp').val(null);
                    idx('#IDX-hp').val(price.replace('-', ''));
                }
            } else {
                idx('#IDX-lp').val(null);
                idx('#IDX-hp').val(null);
            }
        });

        var lp = idx('#IDX-lp').val();
        var hp = idx('#IDX-hp').val();
        if (lp !== '' && hp !== '') {
            idx('input#IDX-price').val(lp + '-' + hp).trigger('change');
        } else if (lp !== '') {
            idx('input#IDX-price').val(lp + '+').trigger('change');
        } else if (hp !== '') {
            idx('input#IDX-price').val(hp + '-').trigger('change');
        }
        // Sqft.
        var sqftPlaceholder = idx('#IDX-sqft').siblings('label').text() || 'Square Feet';
        var sqftLabel = sqftPlaceholder + ': ';
        idx('input#IDX-sqft').select2({
            placeholder: sqftPlaceholder,
            allowClear: true,
            initSelection: function(ele, callback) {
                var val = idx(ele).val();
                if (val) {
                    callback({id: val, text: sqftLabel + val});
                }
            },
            query: function(query) {
                return numberQuery(query, sqftLabel);
            },
            createSearchChoice: function(term, data) {
                return createNumberChoices(term, data, sqftLabel);
            },
            formatResult: numberFormatResult,
            formatSelection: numberFormatSelection,
            formatSearching: function() {
                return 'Enter any number';
            }
        });
        var addPlaceholder = idx('#IDX-add').siblings('label').text() || 'Max Days Listed';
        idx('input#IDX-add').select2({
            placeholder: addPlaceholder,
            allowClear: true,
            initSelection: function(ele, callback) {
                var val = idx(ele).val();
                if (val) {
                    callback({id: val, text: val});
                }
            },
            query: function(query) {
                return numberQuery(query, '');
            },
            createSearchChoice: createNumberChoices,
            formatResult: function(state) {
                if (state.id.match(/\d+$/)) {
                    var label = (state.id === '1') ? ' day' : ' days';
                    return state.text + label;
                }
            },
            formatSelection: function(state) {
                if (state.id === '' || state.id.match(/\d+$/)) {
                    var label = (state.id === '1') ? ' day' : ' days';
                    return state.text + label;
                }
            },
            formatSearching: function() {
                return 'Enter any number';
            }
        });
        // Per page.
        idx('select#IDX-per').select2({
            placeholder: 'Results per page',
            formatResult: function(state) {
                if (state.id.match(/\d+$/)) {
                    return '<b>' + state.text + '</b>' + ' results per page';
                }
            },
            formatSelection: function(state) {
                if (state.id.match(/\d+$/)) {
                    return '<b>' + state.text + '</b>' + ' results per page';
                }
            }
        });
        // Sort by.
        idx('select#IDX-srt').select2({
            placeholder: 'Sort By'
        });
        // Refinement toggle.
        idx('#IDX-resultsRefineSearchToggle').click(function(e) {
            e.preventDefault();
            if (idx('#IDX-resultsRefineSearchToggle').hasClass('IDX-dropdown-open')) {
                idx('#IDX-resultsRefineSearchToggle').removeClass('IDX-dropdown-open');
            } else {
                idx('#IDX-resultsRefineSearchToggle').addClass('IDX-dropdown-open');
            }
            idx('#IDX-resultsRefineSearchWrap').toggle();
        });
        // Refinement form.
        idx('#IDX-resultsRefineSubmit').click(function(e) {
            e.preventDefault();
            sanitizeSearchForm();
            idx('#IDX-refinementSearchForm').submit();
        });

        // Load images via js after the page loads all together.
        idx('.IDX-loadImage').each(function() {
            var element = idx(this);
            var img = idx('<img />').attr({
                'src': element.data('src'),
                'class': 'IDX-resultsPhotoImg'
            }).load(function() {
                element.before(img);
            });
            img.attr('src', element.data('src'));
        });
        // Handle courtesy cssSelector rules.
        if (idx('.IDX-mlsSelectorRulesCourtesy').size() > 0) {
            var parent = '.IDX-resultsCell';
            idx('.IDX-mlsSelectorRulesCourtesy > div', parent).each(function(key, value) {
                var selector = idx(this).children('.IDX-selector').text();
                var selectorText = idx(this).children('.IDX-selectorText').html();
                idx(selector, idx(this).closest(parent)).after(selectorText);
            });
        }
        // Resize event handler.
        idx(window).smartresize(function() {
            if (idx.Modernizr.mq('only screen and (min-width: 640px)')) {
                idx('#IDX-resultsRefineSearchWrap').show();
            } else {
                if (idx('#IDX-resultsRefineSearchToggle').hasClass('IDX-dropdown-open')) {
                    idx('#IDX-resultsRefineSearchWrap').show();
                } else {
                    idx('#IDX-resultsRefineSearchWrap').hide();
                }
            }

            if (idx('.IDX-mediaContentOH').dialog('isOpen')) {
                idx('.IDX-mediaContentOH ').dialog("option", "position", { at: "center", collision: "fit", my: "center", of: window });
            }
        });

        idx(window).trigger('resize');
    });
})(window);
