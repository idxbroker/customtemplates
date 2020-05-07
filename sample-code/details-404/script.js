(function() {
    // bankrate
    var bankRateSetup = function(){
        if (idx('#IDX-BankRateTool-Dialog').size() || idx('#IDX-bankRate').size()) {
            Number.prototype.formatMoney = function(c, d, t){
                var n = this,
                    _c = isNaN(c = Math.abs(c)) ? 2 : c,
                    _d = d === undefined ? '.' : d,
                    _t = t === undefined ? ',' : t,
                    s = n < 0 ? '-' : '',
                    i = parseInt(n = Math.abs(+n || 0).toFixed(_c), 10) + '',
                    j = (j = i.length) > 3 ? j % 3 : 0;
                return s + (j ? i.substr(0, j) + _t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + _t) + (_c ? _d + Math.abs(n - i).toFixed(_c).slice(2) : '');
            };
            var listingDefaultInfo = JSON.parse(idx('#IDX-mortgageDefaultQueryParameters').text().replace(/\s*/g,''));
            // format price field.
            idx('.IDX-priceField').on('change', function(){
                var val = idx(this).val();
                val = val.replace(/[,|$]/g,'');
                var floatVal;
                if (val.match(/.*\..*/)) {
                    floatVal = parseFloat(val);
                } else {
                    floatVal = parseInt(val, 10);
                }

                idx(this).val(floatVal.formatMoney());
                if (idx(this).data('type') === 'downPayment') {
                    var loanAmount = listingDefaultInfo.price - floatVal;
                    idx('#IDX-loanAmount input').val(loanAmount.formatMoney());
                } else {
                    var downPayment = listingDefaultInfo.price - floatVal;
                    idx('#IDX-downPayment input').val(downPayment.formatMoney());
                }
            });
            var noResult = '<div id="IDX-mortgageRatesResultInfo">' +
                '<h3>There are no rates available for the product you selected.</h3>' +
            '</div>';
            var template = '<div class="IDX-bankRateRowContent" data-role="content" data-editorial="{{isEditorial}}">'+
                    '<div class="IDX-mortgageRatesLogoInfo">'+
                        '<a class="IDX-mortgageRatesLogo" href="{{cpc}}" target="_blank"><img src="http://www.bankrate.com/system/img/inst/{{logo}}"/></a>'+
                        '<div class="IDX-mortgageRatesBankInfo">' +
                            '<p class="IDX-mortgageRatesAdvertiser">{{advertiser}}</p>'+
                            '<p class="IDX-noMargin"><span class="IDX-mortgageRatesNMLS IDX-mortgageRatesLabel"><small>NMLS # {{nmls}}</small></span></p>'+
                            '<p class="IDX-noMargin"><span class="IDX-mortgageRatesSlic IDX-mortgageRatesLabel"><small>State Lic # {{slicense}}</small></span></p>'+
                            '<h4 class="IDX-noMargin"><span class="IDX-mortgageRatesPhone"><a href="tel://{{phone}}">{{phone}}</a></span></h4>'+
                        '</div>' +
                    '</div>'+
                    '<div class="IDX-mortgageRatesInfo">'+
                        '<p class="IDX-mortgageRatesAPR"><span class="IDX-mortgageRatesLabel">APR: </span>{{apr}}% </p>'+
                        '<p class="IDX-mortgageRatesRate"><span class="IDX-mortgageRatesLabel">Rate: </span>{{rate}}%</p>'+
                        '<p class="IDX-mortgageRatesPoints"><span class="IDX-mortgageRatesLabel">Points: </span>{{points}}</p>'+
                        '<p class="IDX-mortgageRatesFees" ><span class="IDX-mortgageRatesLabel">Fees: </span>${{fees}}</p>'+
                        '<p class="IDX-mortgageRatesCaps"><span class="IDX-mortgageRatesLabel">Caps: </span>{{firstcap}}/{{addcap}}/{{lifecap}}</p>'+
                    '</div>'+
                    '<div class="IDX-mortgageRatesBottom">'+
                        '<p class="IDX-mortgageRatesEst">${{estpayment}}/mo <small>{{date}}</small></p>'+
                        '<a class="IDX-mortgageRatesGoBtn" rel="nofollow" href="javascript:void(0)" onclick="javascript:window.location=\'{{cpc}}\'">Next</a>'+
                    '</div>'+
            '</div><hr/>';
            var generateMortgages = function() {
                var mortgages = idx.extend({}, listingDefaultInfo);
                mortgages.downPayment = parseFloat(idx('#IDX-downPayment input').val().replace(/,/g,''));
                mortgages.loanAmount = mortgages.price - mortgages.downPayment;
                mortgages.fico = idx('#IDX-mortgageRatesFico').val().replace(/,/g,'');
                mortgages.products = idx('#IDX-mortgageRatesProductId').val();
                mortgages.legacyID = idx('#IDX-mortgageRatesProductId option:selected').data('legacyid');
                mortgages.ltv = (mortgages.loanAmount / mortgages.price) * 100;
                return mortgages;
            };
            var xhr;
            var gatherBankRateData = function() {
                // clean previous result.
                idx('#IDX-mortgageShowAllRates').hide();
                idx('#IDX-bankRateContent').empty();
                idx('#IDX-BankRateDataloading').show();
                var mortgages = generateMortgages();
                if (xhr) {
                    xhr.abort();
                }
                xhr = idx.ajax({
                    url: '/idx/api/mortgages/rates',
                    data: {zip: mortgages.zipcode, loanAmount: mortgages.loanAmount, fico: mortgages.fico, ltv: mortgages.ltv, products: mortgages.products, points: mortgages.points }
                });
                xhr.done(function (resp) {
                    if (resp && resp.result && typeof(resp.result[0]) === 'object') {
                        var advertiser, temp, regex, field, points, isEditorial;
                        resp.result.forEach(function(advertiser) {
                            isEditorial = advertiser.ispaid.toLowerCase() === 'false';
                            if (advertiser.svydate) {
                                advertiser.svydate = new Date(advertiser.svydate).toDateString().replace(/\s\d{4}/, '');
                            } else {
                                advertiser.svydate = new Date().toDateString().replace(/\s\d{4}/, '');
                            }
                            temp = template;
                            regex = new RegExp('{{isEditorial}}');
                            temp = temp.replace(regex, isEditorial);
                            for (field in advertiser) {
                                if (advertiser.hasOwnProperty(field)) {
                                    regex = new RegExp('{{'+field+'}}', 'g');
                                    temp = temp.replace(regex, advertiser[field]);
                                }
                            }
                            if (!advertiser.points) {
                                regex = new RegExp('{{points}}');
                                points = parseFloat(advertiser.originationpoints) + parseFloat(advertiser.discpoints);
                                temp = temp.replace(regex, points);
                            }
                            regex = new RegExp('{{[a-zA-Z]+}}');
                            temp = temp.replace(regex, '');
                            idx('#IDX-bankRateContent').append(temp);
                        });
                        idx('div[data-editorial="true"] .IDX-mortgageRatesLogo').hide();
                        idx('div[data-editorial="true"] .IDX-mortgageRatesGoBtn').hide();
                        idx('#IDX-mortgageShowAllRates').show();
                        if (idx('#IDX-mortgageRatesProductId option:selected').text().match(/arm/i)) {
                            idx('.IDX-mortgageRatesCaps').show();
                        } else {
                            idx('.IDX-mortgageRatesCaps').hide();
                        }
                        idx('.IDX-mortgageRatesNMLS').each(function(index, ele){
                            if (idx(ele).text() == 'NMLS # ')
                                idx(ele).remove();
                        });
                        idx('.IDX-mortgageRatesSlic').each(function(index, ele){
                            if (idx(ele).text() == 'State Lic # ')
                                idx(ele).remove();
                        });
                        if (idx(window).width() <=480) {
                            idx('.IDX-mortgageRatesInfo').addClass('IDX-mortgageRatesInfo-small');
                        } else {
                            idx('.IDX-mortgageRatesInfo').removeClass('IDX-mortgageRatesInfo-small');
                        }

                        if (idx(window).width() <= 420) {
                            idx('.IDX-mortgageRatesLogo img').addClass('IDX-mortgageRatesLogoImg-small');
                            idx('#IDX-mortgageRatesTable').addClass('IDX-mortgageRatesTable-small');
                        } else {
                            idx('.IDX-mortgageRatesLogo img').removeClass('IDX-mortgageRatesLogoImg-small');
                            idx('#IDX-mortgageRatesTable').removeClass('IDX-mortgageRatesTable-small');
                        }
                    } else {
                        idx('#IDX-bankRateContent').append(noResult);
                    }
                }).always(function () {
                    xhr = undefined;
                    idx('#IDX-BankRateDataloading').hide();
                });
            };
            var seeMoreRates = function () {
                var mortgages = generateMortgages();
                if (mortgages.zipcode !== '') {
                    var points;
                    if ( mortgages.points === 'One') {
                        points = 'ZeroToOne';
                    } else if ( mortgages.points === 'Two' ) {
                        points = 'OneToTwo';
                    } else {
                        points = mortgages.points;
                    }
                    window.open('http://www.bankrate.com/funnel/mortgages/mortgage-results.aspx?pid=p:idxb&zip=' + mortgages.zipcode + '&loan=' + mortgages.loanAmount + '&perc=' + mortgages.ltv +'&prods=' + mortgages.legacyID + '&points=' + points);
                }
                else{
                    window.open('http://www.bankrate.com/funnel/mortgages/?pid=p:idxb&loan=' + mortgages.loanAmount + '&prods=' + mortgages.legacyID + '&points=All');
                }
            };
            idx('#searchBankRate').click(function (e) {
                e.preventDefault();
                gatherBankRateData();
            });
            // show all rate links
            idx('#IDX-mortgageShowAllRates').click(function(e) {
                e.preventDefault();
                seeMoreRates();
            });
            idx('a[href="#IDX-bankRate"]').click(function(e){
                e.preventDefault();
                var mortgages = generateMortgages();
                idx('#IDX-loanAmount input').val(mortgages.loanAmount.formatMoney());
                idx('#IDX-downPayment input').val(mortgages.downPayment.formatMoney());
                // open bankrate dialog
                idx("#IDX-BankRateTool-Dialog").dialog({
                    resizable: false,
                    modal: true,
                    width: '90%'
                });
                gatherBankRateData();
                idx('#IDX-mortgageRatesContent').show();
            });
            // center dialog
            idx(window).resize(function() {
                // if (idx(window)) {};
                idx("#IDX-BankRateTool-Dialog").dialog("option", "position", {at: "center", collision: "fit", my: "center"});
            });
        }
    }

    if (idx.Modernizr.mq('only screen and (min-width: 640px)')) {
        
        if (!idx('#IDX-detailsWrapper').attr('data-collapse-details')) {
            idx('.IDX-panel-collapse').collapse('show');
            idx('.IDX-panel-collapse-toggle').removeClass('IDX-collapsed');
        }        
        idx('#IDX-firstDate').datepicker();
        idx('#IDX-secondDate').datepicker();
    } else {
        idx('.IDX-panel-collapse').collapse('hide');
        idx('.IDX-panel-collapse-toggle').addClass('IDX-collapsed');
    }
    var openVirtualTourModal = function(e) {
        e.preventDefault();
        idx(idx(this).attr('href')).dialog('open');
    };

    // load slideshow images later.
    idx(function () {

        /**
         * Handle courtesy cssSelector rules
         */
        if (idx('.IDX-mlsSelectorRulesCourtesy').size() > 0) {

            var container = '#IDX-main';

            // standard selector rules, container based on the page category
            idx('.IDX-mlsSelectorRulesCourtesy > div').each(function(key, value) {
                var selector = idx(this).children('.IDX-selector').text();
                var selectorText = idx(this).children('.IDX-selectorText').html();
                idx(selector, container).append(selectorText);
            });
        }

        idx('.IDX-mediaContentVT, .IDX-mediaContentOH').dialog({
            autoOpen: false,
            resizable: false
        });

        idx('#IDX-detailsVirtualTour').click(openVirtualTourModal);

        idx('#IDX-saveProperty').click(function(e) {
            e.preventDefault();
            var softLoggedIn = idx('#IDX-registration').attr('data-softLoggedIn');
            var idxID = idx(this).attr('data-idxid');
            var listingID = idx(this).attr('data-listingid');

            if (idx('#IDX-main').hasClass('IDX-loggedIn') && !softLoggedIn) {
                idx('#IDX-savePropertyForm .IDX-idxID').val(idxID);
                idx('#IDX-savePropertyForm .IDX-listingID').val(listingID);

                // they are logged in, submit the form
                idx('#IDX-savePropertyForm').ajaxSubmit({
                    dataType:'json',
                    success: function(responseText, statusText, xhr, $form) {
                        var element = idx('#IDX-saveProperty');
                        if (responseText.status === 'success' || responseText.status === 'duplicate') {
                            element.text('Saved!');
                        } else {
                            element.after('Error saving property');
                        }
                    }
                });
            } else {
                idx('.IDX-saveParams').attr('disabled','disabled');
                idx('.IDX-saveWhat').val('property').removeAttr('disabled');
                idx('.IDX-idxID').val(idxID).removeAttr('disabled');
                idx('.IDX-listingID').val(listingID).removeAttr('disabled');
                idx('#IDX-registration').dialog('open');
            }
        });

        idx('.IDX-detailsshowcaseSlides a').click(function(e){
            e.preventDefault();

            changePrimaryImg(idx(this));
        });
        // schedule link
        idx('#IDX-scheduleShowing').click(function(e) {
            e.preventDefault();
            if (idx('#IDX-detailsContactForm:visible').size() && idx('#IDX-scheduleshowingContactForm').size()) {
                window.location = window.location.href.replace(window.location.hash, '') + '#IDX-detailsContactForm';
            } else {
                window.location = idx(this).attr('href');
            }
        });

        // contact agent
        idx('#IDX-contactAgent').click(function(e) {
            e.preventDefault();
            if (idx('#IDX-detailsContactForm:visible').size() && idx('#IDX-detailscontactContactForm').size()) {
                window.location = window.location.href.replace(window.location.hash, '') + '#IDX-detailsContactForm';
            } else {
                window.location = idx(this).attr('href');
            }
        });
         // request more info
        idx('#IDX-moreinfo').click(function(e) {
            e.preventDefault();
            if (idx('#IDX-detailsContactForm:visible').size() && idx('#IDX-moreinfoContactForm').size()) {
                window.location = window.location.href.replace(window.location.hash, '') + '#IDX-detailsContactForm';
            } else {
                window.location = idx(this).attr('href');
            }
        });

        // swipe
        idx('#IDX-primaryPhoto a').click(function(e){
            e.preventDefault();
        });
        var primaryPhotoElement = document.getElementById('IDX-primaryPhoto');
        var hammer = new idxHammer.Manager(primaryPhotoElement);
        hammer.add(new idxHammer.Swipe({direction: idxHammer.DIRECTION_HORIZONTAL, velocity: 0.5}));
        hammer.on('swipeleft', function() {
            slideNext();
        });
        hammer.on('swiperight', function() {
            slidePrev();
        });

        // bankRate
        bankRateSetup();
        /**
         * Set the carousel properties.
         *
         * @return array The carousel array.
         */
        var idxSlides = idxSlides || {};

        if (!idxSlides.slideShow) {
            idxSlides.slideShow = (function () {
                var slideShowElement = undefined;
                var slideShowContainer = '.IDX-carouselWrapper';
                var slides = '.IDX-carouselThumb';
                var prev = '.IDX-carouselLeft, #IDX-arrow-previous';
                var next = '.IDX-carouselRight, #IDX-arrow-next';
                var activeSlide = 'IDX-showcaseSlide-active';
                var primaryPhotoId = 'IDX-detailsPrimaryImg'
                var indexBoundaries = {
                    min: undefined,
                    max: undefined
                };
                var slideWidth = 65;
                // Buffer time in ms to allow for animations to complete before next code execution.
                var buffer = 200;

                // Get a non-rounded number of visible images.
                var getVisibleImages = function () {
                    return slideShowElement.width() / slideWidth;
                }

                // Get a rounded-down number of images. We don't want partial images in this instance.
                var getVisibleImagesRounded = function () {
                    return Math.ceil(getVisibleImages());
                }

                // Determines how far we can scroll right.
                var getMaxPosX = function () {
                    return idx(slideShowContainer).width() - slideShowElement.width();
                }

                // Returns the CSS:right position of the carousel.
                var position = function () {
                    var pos = idx(slideShowContainer).css('right');
                    return parseInt(pos.substr(0, pos.length - 2));
                }

                // calculate the minimum visible slide index.
                var getIndexBoundaries = function () {
                    var pos = position();
                    // Determine if the position divides between slideWidth evenly or not.
                    if (pos % slideWidth == 0) {
                        indexBoundaries.min = pos / slideWidth;
                    } else {
                        indexBoundaries.min = ((pos - (pos % slideWidth)) / slideWidth);
                    }
                    indexBoundaries.max = indexBoundaries.min + getVisibleImages();
                    return indexBoundaries;
                }

                // Replaces the thumbnail src attribute with the data-src attribute.
                var loadSlideThumbnail = function(index) {
                    var image = idx(slides).eq(index).children('img[data-loaded="false"]');
                    if (image.length > 0) {
                        image
                            .attr('src', image.attr('data-src'))
                            .attr('data-loaded', true);
                    }
                }

                var removeActive = function (index, callback) {
                    idx('.' + activeSlide).removeClass(activeSlide);
                    if (callback) {
                        callback();
                    }
                }

                var setActive = function (index, callback) {
                    idx(slides)
                        .eq(index)
                        .addClass(activeSlide);
                    idx('#' + primaryPhotoId).attr('src', idx(slides).eq(index).children('img').attr('data-src'));
                    if (callback) {
                        callback();
                    }
                }

                // Calculates a new position based on the selected index and current position.
                var calcNewPosition = function (index) {
                    var newPos, maxPosX, currentPos;
                    newPos = {
                        right: index * slideWidth,
                        animate: false
                    };
                    maxPosX = getMaxPosX();
                    currentPos = position();

                    // Don't animate we're near the edge of our slides.
                    if (index <= indexBoundaries.min || index >= Math.floor(indexBoundaries.max)) {
                        newPos.animate = true;
                    }
                    if (newPos.right > maxPosX || currentPos > maxPosX) {
                        // We're skipping from first image to last image.
                        newPos.right = maxPosX;
                    }

                    if (currentPos > maxPosX) {
                        newPos.animate = true;
                    }

                    // If we somehow fall below our minimum right position.
                    if (newPos.right < 0) {
                        newPos.right = 0;
                    }

                    // If newPos > maxPosX && pos > 0, don't animate it.
                    if (newPos == maxPosX && currentPos > 0) {
                        newPos.animate = false;
                    }
                    return newPos;
                }

                var animateSlide = function (index, callback) {
                    var newPos = calcNewPosition(index);
                    // If the newly calculated position falls within our slider boundaries.
                    if (newPos.animate) {
                        slideShowElement
                            .find(slideShowContainer)
                            .stop()
                            .css({
                                right: newPos.right
                            });
                        // Buffer to allow CSS transition to complete before we recalculate the boundaries.
                        setTimeout(function() {
                            indexBoundaries = getIndexBoundaries();
                            lazyLoadImages();
                        }, buffer)
                    }
                    if (callback) {
                        callback();
                    }
                }

                var lazyLoadImages = function () {
                    for (var i=indexBoundaries.min; i<=Math.ceil(indexBoundaries.max); i++) {
                        loadSlideThumbnail(i);
                    }
                }

                var newSlide = function (index) {
                    if (index < 0) {
                        // Send to last slide instead.
                        index = idx(slides).last().index();
                    } else if (index > (idx(slides).length - 1)) {
                        // Send to first slide.
                        index = 0;
                    }

                    // Animate the slide.
                    animateSlide(index, function () {
                        removeActive(index, function () {
                            setActive(index);
                        });
                    });
                }

                var setup = function () {
                    // Set slide length.
                    idx(slideShowContainer)
                        .css({
                            width: idx(slides).length * slideWidth
                        });
                    // Apply some CSS to override any client modifications, otherwise they could break the slider.
                    idx(slides).children('img').slice(0, idx(slides).length).css({
                        'box-sizing': 'border-box',
                        'object-fit': 'cover',
                        'max-width': slideWidth - 10
                    });
                    // Calc min/max visible indexes, loop through for lazy-loading.
                    var visibleImages = getVisibleImagesRounded();
                    for (var i=0; i<visibleImages; i++) {
                        loadSlideThumbnail(i);
                    }
                    // Set new index boundaries.
                    indexBoundaries = getIndexBoundaries();
                }

                // Return the object literal w/ initiators.
                return {
                    init: function(el) {
                        slideShowElement = el;
                        setup();
                        el.parent()
                            // Previous/Next button click event handlers.
                            .on('click', prev, function () {
                                newSlide(el.find('.' + activeSlide).prev().index());
                            })
                            .on('click', next, function () {
                                // Use activeSlide.index() + 1 here to avoid a possibility of -1.
                                newSlide(el.find('.' + activeSlide).index() + 1);
                            })
                            // Individual slide click handler.
                            .on('click', slides, function () {
                                var index = idx(this).index();
                                if (index == indexBoundaries.min && index > 0) {
                                    index = index - 1;
                                }
                                newSlide(index);
                            });
                        // Swipe support.
                        var photoElement = document.getElementById(primaryPhotoId);
                        var hammer = new idxHammer.Manager(photoElement);
                        hammer.add(new idxHammer.Swipe({direction: idxHammer.DIRECTION_HORIZONTAL, velocity: 0.5}));
                        hammer.on('swipeleft', function() {
                            newSlide(el.find('.' + activeSlide).index() + 1);
                        });
                        hammer.on('swiperight', function() {
                            newSlide(el.find('.' + activeSlide).prev().index());
                        });
                        // Resize handler.
                        idx(window).smartresize(function () {
                            setup();
                            newSlide(el.find('.' + activeSlide).index());
                        });
                    }
                }
            })();
        }
        idxSlides.slideShow.init(idx('#IDX-detailsShowcaseSlides'));
    });

})(window, undefined);
