{% import "detailsTools-1.002.twig" as tools %}
{# sample #}
{# main idx page content here #}
{% block idxContent %}
    {% spaceless %}
        {# page specific content #}
        {% if mlsRules.remarksPrefixText and mlsRules.remarksPrefixField %}
            {% set remarksConcat = mlsRules.remarksPrefixText ~ ' ' ~ attribute(_context, mlsRules.remarksPrefixField) ~ ' - ' ~ remarksConcat %}
        {% endif %}
<h1>test</h1>
        <div id="IDX-detailsWrapper" class="IDX-pageContainer" data-collapse-details="{{ collapseMobileFirstDetailsFields }}">
            {% block idxDetailsHeader %}
                <div id="IDX-detailsTopNav" {% if nav.prev or nav.next %}class="IDX-detailsTrack"{% endif %}>
                    {% if nav.prev or nav.next %}
                        <div id="IDX-nextLastButtons" class="IDX-row-content">
                            <div id="IDX-nextLastPosition" class="IDX-alert IDX-alert-info">Currently viewing {{ nav.position.current }} of {{ nav.position.total }}</div>

                            <a href="{{ detailsBaseURL }}{{ nav.prev.detailsURL }}" class="IDX-btn IDX-btn-default {% if not nav.prev %}disabled{% endif %}" {% if not nav.prev %}disabled={% endif %}>Prev Property</a>
                            {% if nav.next %}
                                <a href="{{ detailsBaseURL }}{{ nav.next.detailsURL }}" class="IDX-btn IDX-btn-default">Next Property</a>
                            {% endif %}
                        </div>
                    {% endif %}
                    <div id="IDX-detailsTopActions" class="IDX-topActions IDX-row-content" >
                        {% spaceless %}
                            {% if missingProperty == false and propArchived == false %}
                                <div id="IDX-detailsActionSave" class="IDX-topAction">
                                    {% if propertySavedPreviously %}
                                        <a id="IDX-saveProperty" data-listingid="{{ listingID }}" data-idxid="{{ idxID }}" href="#saveProperty" class="IDX-saveProperty IDX-btn IDX-btn-default">Saved!</a>
                                    {% else %}
                                        <a id="IDX-saveProperty" data-listingid="{{ listingID }}" data-idxid="{{ idxID }}" href="#saveProperty" class="IDX-saveProperty IDX-btn IDX-btn-default" >Save Property</a>
                                    {% endif %}
                                </div>
                            {% endif %}
                            <div id="IDX-detailsActionNew" class="IDX-topAction" >
                                {% if nav.newSearch %}
                                    <a  id="IDX-newSearch" href="{{ nav.newSearch }}" class="IDX-btn IDX-btn-default">New Search</a>
                                {% endif %}
                            </div>
                            {% if nav.modifySearch %}
                                <div id="IDX-detailsActionModify" class="IDX-topAction">
                                    <a  id="IDX-modifySearch" href="{{ nav.modifySearch }}" class="IDX-btn IDX-btn-default">Modify Search</a>
                                </div>
                            {% endif %}
                            {% if nav.backToResults %}
                                <div class="IDX-topAction" id="IDX-detailsActionBack">
                                    <a id="IDX-backToResults" href="{{ nav.backToResults }}" class="IDX-btn IDX-btn-default">Back to Results</a>
                                </div>
                            {% endif %}
                        {% endspaceless %}
                    </div>
                </div>
            {% endblock %}

            {% if missingProperty %}
                <p id="IDX-detailsMissingPropertyAlert" class="IDX-missingPropertyAlert IDX-alert">We're sorry! The property you tried to view does not seem to exist. This could be because the property has left market and entered a Sold or Pending state. If you would like more information about properties similar to the one you were trying to find, please contact <a id="IDX-missingPropertyContactLink" href="{{ contactPageURL }}">{{ displayName }}</a>. You can also try performing a <a id="IDX-missingPropertyNewSearchLink" href="{{ newSearchURL }}">New Search</a>!</p>
            {% elseif propArchived %}
                <p id="IDX-detailsMissingPropertyAlert" class="IDX-missingPropertyAlert IDX-alert">We're sorry! The property at {{ address }} in {{ cityName }} , {{ state }} currently has an unknown property status. This could be because the property is pending sale, sold, or is off the market. If you would like more information about properties similar to {{ address }} in {{ cityName }}, {{ state }}, please contact <a id="IDX-missingPropertyContactLink" href="{{ contactPageURL }}">{{ displayName }}</a>. You can also try performing a <a id="IDX-missingPropertyNewSearchLink" href="{{ newSearchURL }}">New Search</a>!</p>
            {% elseif invalidMLS %}
                <p id="IDX-detailsInvalideMlsAlert" class="IDX-alert">This account does not have permission to show the requested MLS's data.</p>
            {% else %}
               <div id="IDX-details-row-content" class="IDX-row-content">
                    <div id="IDX-detailsHotActions">
                        {# virtual tours #}
                        {% if mediaData.vtCount > 0 %}
                            <div id="IDX-detailsHotAction-vt" class="IDX-detailsHotAction">
                                {% if mediaData.vtCount == 1 %}
                                    <a onclick="window.open('{{ mediaData.vt.0.url }}', 'VirtualTour', 'width=800, height=600, resizable=1, scrollbars=1, status=0, titlebar=0')" href="javascript:void(0)" class="IDX-detailsVirtualTourAction IDX-btn IDX-btn-default">
                                        {{ mediaData.vt.0.descriptor|default('Virtual Tour') }}
                                    </a>
                                {% else %}
                                    <a href="#IDX-detailsMediaVirtualTour" id="IDX-detailsVirtualTour" class="IDX-psudolink IDX-mediaModal IDX-btn IDX-btn-default">Virtual Tours ({{ mediaData.vtCount }})</a>
                                    <div id="IDX-detailsMediaVirtualTour" class="IDX-mediaContentVT" title="Virtual Tours for #{{ listingID }}">
                                        {% for media in mediaData.vt %}
                                            <div class="IDX-mediaModalVT">
                                                <a class="IDX-vtLink" onclick="window.open('{{ media.url }}', '{{ media.title }}', 'width={{ media.width|default('800') }}, height={{ media.height|default('600') }}, resizable=1, scrollbars=1, status=0, titlebar=0')" href="javascript:void(0)">
                                                    {{ media.descriptor|default('Virtual Tour') }}
                                                </a>
                                                <span class="IDX-mediaModalText">{{ media.text }}</span>
                                            </div>
                                        {% endfor %}
                                    </div>
                                {% endif %}
                            </div>
                        {% endif %}
                        {# contact agent #}
                        <div id="IDX-detailsHotAction-contact" class="IDX-detailsHotAction">
                            {% if featuredAgentInfo %}
                                <a href="{{ "/idx/contact?agentID=" ~ featuredAgentInfo.userID }}" id="IDX-contactAgent" class="IDX-btn IDX-btn-default">Contact Agent</a>
                            {% else %}
                                <a href="{{ moreInfoLink }}" id="IDX-moreinfo" class="IDX-btn IDX-btn-default">More Information</a>
                            {% endif %}

                        </div>
                        {% if idxStatus == 'active' %}
                            <div id="IDX-detailsHotAction-schedule" class="IDX-detailsHotAction">
                                <a id="IDX-scheduleShowing" href="{{ scheduleShowingLink }}" class="IDX-btn IDX-btn-default">Schedule Showing</a>
                            </div>
                        {% endif %}


                        {# tools.displayMortgageCalcLink #}
                        {% if parentPtID not in [3, 10] and rntLsePrice == 0 and idxStatus == 'active' %}
                            <div id="IDX-detailsHotAction-mortgage" class="IDX-detailsHotAction">
                                <a id="IDX-mortgageLink" href="{{ mortgageLink }}" class="IDX-btn IDX-btn-default">Mortgage Calculator</a>
                            </div>
                        {% endif %}
                        <div id="IDX-detailsHotAction-print" class="IDX-detailsHotAction">
                            <a target="_blank" href="?printable" id="IDX-printable" class="IDX-btn IDX-btn-default">Printable Flyer</a>
                        </div>
                        {% if customLink.url and customLink.text %}
                            <div id="IDX-detailsHotAction-{{ customLink.text | lower | trim(' ') }}" class="IDX-detailsHotAction">
                                <a class="IDX-CustomLink IDX-btn IDX-btn-default" href="{{ customLink.url }}" target="_blank">{{ customLink.text }}</a>
                            </div>
                        {% endif %}
                    </div>
                    <div id="IDX-detailsHead">
                        <div id="IDX-detailsMedia">
                            <div id="IDX-primaryPhoto" class="IDX-detailsPhotosWrap">
                                <a href="#"  class="IDX-thumbnail">
                                    <img src="{{ imageData.1.url }}" id="IDX-detailsPrimaryImg" data-img-index="1"/>
                                </a>
                                {% if imageData.totalCount > 1 %}
                                    <a id="IDX-arrow-previous" class="IDX-arrow">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                    <a id="IDX-arrow-next" class="IDX-arrow">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                {% endif %}
                            </div>
                            <div id="IDX-detailsShowcaseSlides" style="overflow: hidden; height: auto; position: relative; padding: 8px 30px; max-width: 1620px; overflow-x: hidden; margin: 0 auto;">
                                <div class="IDX-carouselWrapper" data-count="{{ imageData.totalCount }}" style="right: 0;">
                                    {% for key, img in imageData if img.url %}
                                        <a href="#" data-index="{{ loop.index0 }}" class="IDX-carouselThumb IDX-detailsImage-{{ key }}{% if key == 1 %} IDX-showcaseSlide-active{% endif %}" style="position: relative">
                                            <img src="/images/ajaxLoadLarge.gif" data-loaded="false" data-src="{{ img.url }}" />
                                        </a>
                                    {% endfor %}
                                </div>
                                <div class="IDX-carouselNavWrapper IDX-carouselLeft">
                                    <i class="fa fa-angle-left"></i>
                                </div>
                                <div class="IDX-carouselNavWrapper IDX-carouselRight">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                            <!-- image -->
                            {% if imageData.totalCount > 0 %}
                                <div id="IDX-detailsGalleryAction">
                                    <a id="IDX-photoGalleryLink" href="{{ photoGalleryLink }}" class="IDX-btn IDX-btn-default">
                                        View Photo Gallery<span id="IDX-photoGalleryCount"> ({{ imageData.totalCount }})</span>
                                    </a>
                                </div>
                            {% endif %}
                        </div>
                        <hr>
                        <div id="IDX-detailsAddress">
                            <a href="#" class="IDX-psudolink">
                                <div class="IDX-detailsAddressInfo">
                                    <span class="IDX-detailsAddressNumber">{{ streetNumber }} </span>
                                    <span class="IDX-detailsAddressDirection">{{ streetDirection }} </span>
                                    <span class="IDX-detailsAddressName">{{ streetName }}</span>{% if unitNumber %}&nbsp;<span class="IDX-detailsAddressUnitNumber">{{ unitNumber }}</span>{% endif %}{% if streetName %}<span class="IDX-detailsEndAddressComma">,&nbsp;</span>{% endif %}
                                </div>
                                <div class="IDX-detailsAddressLocationInfo">
                                    <span class="IDX-detailsAddressCity">{{ cityName }}</span>,
                                    <span class="IDX-detailsAddressState">{{ state }} </span>
                                    <span class="IDX-detailsAddressStateAbrv">{{ stateAbrv }}</span>
                                    <span class="IDX-detailsAddressZipcode">{{ zipcode }}</span>{% if zip4 > 0 %}<span class="IDX-addressZip4">-{{ zip4 }}{% endif %}
                                </div>
                            </a>
                        </div>
                        <div id="IDX-detailsMainInfo" class="IDX-panel IDX-panel-default">
                            <div class="IDX-panel-heading">
                                {{ _self.field(_context, 'listingID', labels.listingID)}}
                            </div>
                            <div class="IDX-panel-body">
                                <!-- listing price -->
                                {% if idxStatus == 'sold' %}
                                    {% if rntLse == 'lease' and rntLsePrice > 0 %}
                                        {{ _self.priceField('leased',rntLsePrice) }}
                                    {% elseif rntLse == 'rental' and rntLsePrice > 0 %}
                                        {{ _self.priceField('rented',rntLsePrice) }}
                                    {% elseif soldPrice and soldPrice > 0 %}
                                        {{ _self.priceField('soldPrice', soldPrice) }}
                                    {% elseif listingPrice %}
                                        {{ _self.priceField('soldPrice', listingPrice) }}
                                    {% endif %}

                                    {{ _self.field(_context, 'soldDate', labels.soldDate, { dateFormat: 'n/d/Y' } )}}
                                {% elseif (rntLse == 'lease' or rntLse == 'rental') and rntLsePrice > 0 %}
                                    {{ _self.priceField(rntLse,rntLsePrice) }}
                                {% else %}
                                    {{ _self.priceField('listingPrice',listingPrice) }}
                                {% endif %}
                                {% if pricePerSqFt > 0 %}
                                    {{ _self.field(_context, 'pricePerSqFt', labels.pricePerSqFt, { priceFormat: true }) }}
                                {% endif %}

                                {% if idxStatus != 'sold' %}
                                    {{ tools.bankRateTool(displayBankRateEstPayment, mortgagePayment) }}
                                {% endif %}
                                {{ _self.field(_context, 'propStatus', labels.propStatus) }}
                                {{ _self.field(_context, 'bedrooms', labels.bedrooms) }}
                                {{ _self.baths(_context) }}
                                {{ _self.checkNum(_context, 'sqFt', labels.sqFt) }}
                                {{ _self.checkNum(_context, 'acres', labels.acres) }}
                                {% if not contentFields %}
                                    {% set contentFields = {"core": [ "countyName", "subdivision", "yearBuilt", "propType", "propSubType" ]} %}
                                {% endif %}
                                {% for divID,fields in contentFields %}
                                    <div id="IDX-contentFields-{{ divID }}" class="IDX-contentFields">
                                    {% for field in fields %}
                                        {{ _self.field(_context, field, attribute(labels, field)) }}
                                    {% endfor %}
                                    </div>
                                {% endfor %}
                                {% if featured == 'y' %}
                                    {% include 'mobileFirstFeaturedAgent-1.000.twig' %}
                                {% endif %}
                            </div>
                        </div>
                    </div>
                    {# determine if there is a open house #}
                    {% if mediaData.ohCount > 0 %}
                    <div id="IDX-openHouses">
                        <h3 id="IDX-openHouseHeader">Upcoming Open House{% if mediaData.ohCount > 1 %}s{% endif %}</h3>
                        {% for oh in mediaData.oh %}
                            <div class="IDX-openHouseWrapper">
                                <h4 class="IDX-ohFreeFormDate">{{ oh.freeFormDate }}</h4>
                                <div class="IDX-openHouse">
                                    <div class="IDX-openHouseTime"><span class="IDX-ohWhen">Time: </span><span class="IDX-ohFreeFormTime">{{ oh.freeFormTime }}</span></div>
                                    {% if oh.text %}<div class="IDX-ohText">{{ oh.text }}</div>{% endif %}
                                    {% if oh.descriptor %}<div class="IDX-ohDescriptor">{{ oh.descriptor }}</div>{% endif %}
                                    {% if oh.ohLink %}<a href="{{ oh.ohLink }}" class="IDX-ohLink">More Info</a>{% endif %}
                                    {% if oh.hostedBy %}<div class="IDX-ohHostedBy">{{ oh.hostedBy }}</div>{% endif %}
                                </div>
                            </div>
                        {% endfor %}
                        <a id="IDX-ohMoreInfo" href="{{ moreInfoLink }}">Request More Info</a>
                    </div>
                    {% endif %}

                    {% if mediaData.vtCount > 0 %}
                        {% set hasVT = true %}
                    {% endif %}

                    <div id="IDX-description" class="IDX-well">
                        {{ tools.remarks }}
                    </div>


                {# The BankRate for standard wrapper. The BankRate for mobile is in mobileFooter twig #}
                {% if wrapperMode != 'mobile' %}
                    {% if idxStatus == 'sold' %}
                        {% if rntLse == 'lease' and rntLsePrice > 0 %}
                            {% set price = rntLsePrice %}
                        {% elseif rntLse == 'rental' and rntLsePrice > 0 %}
                            {% set price = rntLsePrice %}
                        {% elseif soldPrice and soldPrice > 0 %}
                            {% set price = soldPrice %}
                        {% endif %}
                    {% elseif (rntLse == 'lease' or rntLse == 'rental') and rntLsePrice > 0 %}
                        {% set price = rntLsePrice %}
                    {% else %}
                        {% set price = listingPrice %}
                    {% endif %}
                    {% if displayBankRateEstPayment == 'y'%}
                        <div id="IDX-BankRateTool-Dialog" title="Mortgage Rates - {{ cityName }}, {{ stateAbrv }} {{ zipcode }} {{ price }}">
                            <div id="IDX-mortgageDefaultQueryParameters" class="IDX-hidden">
                                {"zipcode": "{{ zipcode }}", "price": "{{ mortgageListingPrice }}"}
                            </div>
                            <div id="IDX-mortgageRatesContent">
                                <div id="IDX-mortgageRatesTable">
                                    <div id="IDX-downPayment" class="IDX-mortgageRatesRow">
                                        <span class="IDX-mortgageLabel IDX-textRight">Down Payment</span>
                                        <input type="text" class="IDX-priceField" value="{{ mortgageDownPayment }}" data-type="downPayment" placeholder="Down Payment">
                                    </div>
                                    <div id="IDX-creditScore" class="IDX-mortgageRatesRow">
                                        <span class="IDX-mortgageLabel IDX-textRight">Credit Score</span>
                                        <select id="IDX-mortgageRatesFico" name="ficoDllName">
                                            <option value="660|679">660 - 679</option>
                                            <option value="680|699">680 - 699</option>
                                            <option value="700|719">700 - 719</option>
                                            <option value="720|739">720 - 739</option>
                                            <option value="740|1000" selected="">740+</option>
                                        </select>
                                    </div>
                                    <div id="IDX-points" class="IDX-mortgageRatesRow">
                                        <span class="IDX-mortgageLabel IDX-textRight">Points</span>
                                        <select  id="IDX-mortgageRatesPoints" name="points">
                                            <option value="All" selected>All</option>
                                            <option value="Zero">Zero</option>
                                            <option value="One">Zero To One</option>
                                            <option value="Two">One To Two</option>
                                        </select>
                                    </div>
                                    <div id="IDX-loanAmount" class="IDX-mortgageRatesRow">
                                        <span class="IDX-mortgageLabel IDX-textRight">Loan Amount</span>
                                        <input type="text" class="IDX-priceField" value="{{ mortgageLoadAmounts }}" data-type="loadAmount" placeholder="Loan Amount">
                                    </div>
                                    <div id="IDX-loanType"  class="IDX-mortgageRatesRow">
                                        <span class="IDX-mortgageLabel IDX-textRight">Loan Type</span>
                                        <select name="IDX-mortgageRatesProductId" id="IDX-mortgageRatesProductId">
                                            <option value="1" data-legacyID="1">30 yr fixed</option>
                                            <option value="2" data-legacyID="2">15 yr fixed</option>
                                            <option value="3" data-legacyID="3">1 yr ARM</option>
                                            <option value="5" data-legacyID="5">30 yr FHA Mortgage</option>
                                            <option value="6" data-legacyID="6">5/1 ARM</option>
                                            <option value="8" data-legacyID="8">3/1 ARM</option>
                                            <option value="9" data-legacyID="9">7/1 ARM</option>
                                            <option value="10" data-legacyID="10">10/1 ARM</option>
                                            <option value="116" data-legacyID="215">15 yr fixed refi</option>
                                            <option value="117" data-legacyID="216">30 yr fixed refi</option>
                                            <option value="118" data-legacyID="217">1 yr ARM refi</option>
                                            <option value="119" data-legacyID="218">3/1 ARM refi</option>
                                            <option value="120" data-legacyID="219">5/1 ARM refi</option>
                                            <option value="121" data-legacyID="220">7/1 ARM refi</option>
                                            <option value="122" data-legacyID="221">10/1 ARM refi</option>
                                            <option value="156" data-legacyID="265">30 yr FHA refi</option>
                                            <option value="266" data-legacyID="387">20 yr fixed</option>
                                            <option value="267" data-legacyID="388">10 yr fixed</option>
                                            <option value="268" data-legacyID="389">3/1 ARM (interest only)</option>
                                            <option value="269" data-legacyID="390">5/1 ARM (interest only)</option>
                                            <option value="271" data-legacyID="392">20 yr fixed refi</option>
                                            <option value="272" data-legacyID="393">10 yr fixed refi</option>
                                            <option value="304" data-legacyID="425">3/1 ARM refi (interest only)</option>
                                            <option value="305" data-legacyID="426">5/1 ARM refi (interest only)</option>
                                            <option value="322" data-legacyID="447">7/1 ARM (interest only)</option>
                                            <option value="323" data-legacyID="448">7/1 ARM refi (interest only)</option>
                                            <option value="324" data-legacyID="449">30 year VA Mortgage Loan</option>
                                            <option value="325" data-legacyID="450">30 year VA mortgage refi</option>
                                            <option value="427" data-legacyID="565">30 yr fixed (interest only)-0 point</option>
                                            <option value="428" data-legacyID="566">40 yr fixed-0 point</option>
                                        </select>
                                    </div>
                                    <div class="IDX-mortgageRatesRow">
                                        <button id="searchBankRate" class="IDX-btn IDX-btn-default">Search</button>
                                    </div>
                                    <hr>
                                    <div id="IDX-bankRateContent"></div>
                                </div>
                                <a href="#" id="IDX-mortgageShowAllRates">Show All Rates</a>
                            </div>
                            <div id="IDX-BankRateDataloading"><img src='/images/ajaxLoadBar.gif'/></div>
                        </div>
                    {% endif %}
                {% endif %}
               </div>

               {% block idxDetailsSubContent %}
                {# based on settings passed check for maps or other widgets to include here #}
                {% if clientRules.detailsMapType != 'none' and clientRules.detailsMapLocation == 'beforeFields' %}
                    <div id="IDX-mapContainer" class="IDX-well">
                        {% if latitude and longitude %}
                            {% if idxStatus == 'sold' %}
                                {% set propCat='soldPending' %}
                            {% elseif idxStatus != null %}
                                {% set propCat=idxStatus %}
                            {% else %}
                                {% set propCat='active' %}
                            {% endif %}

                            <div id="IDX-detailsMap">
                                <div
                                    id="IDX-map"
                                    class="IDX-detailsMap"
                                    data-lat="{{ latitude }}"
                                    data-lng="{{ longitude }}"
                                    data-price="{{ price }}"
                                    data-idxStatus="{{ idxStatus }}"
                                    data-idxid="{{ idxid }}"
                                    data-listingid="{{ listingID }}"
                                    data-mlsptid="{{ mlsPtID }}"
                                    data-propcat="active"
                                >
                                </div>
                            </div>
                            {# include our new pins/clusters #}
                            {% include 'leaflet-1.000.twig' %}
                        {% endif %}
                    </div>
                {% endif %}
                {% if clientRules.displayWalkscoreWidget == 'beforeFields' %}
                    {{ tools.walkscore }}
                {% endif %}
                {# display the field containers #}
                <div id="IDX-fieldsWrapper">
                    {% for container in containerData %}
                            {% set class = 'IDX-fieldContainer ' %}
                            {% if container.containerColumns == 1 %}
                                {% set class = class ~ 'IDX-fieldOneColumn' %}
                            {% else %}
                                {% set class = class ~ 'IDX-fieldTwoColumn' %}
                            {% endif %}
                            {% if container.containerID == 'hopoZoning' %}
                                {% set class = class ~ ' IDX-hopoZoning' %}
                            {% endif %}
                            {% if container.emptyContainer %}
                                {% set class = class ~ ' IDX-emptyFieldContainer' %}
                            {% endif %}

                            <div id="IDX-detailsContainer-{{ idxID }}-{{ layoutID }}-{{ container.containerID }}" class="{{ class }} IDX-panel IDX-panel-default">
                                <div class="IDX-panel-heading" role="tab" id="IDX-panel-heading-{{ idxID }}-{{ layoutID }}-{{ container.containerID }}">
                                    <h4 class="IDX-panel-title">
                                        <a class="IDX-panel-collapse-toggle IDX-collapsed" data-toggle="idx-collapse" href="#IDX-panel-body-{{ idxID }}-{{ layoutID }}-{{ container.containerID }}" aria-expanded="false" aria-controls="IDX-panel-body-{{ idxID }}-{{ layoutID }}-{{ container.containerID }}">
                                            {{ container.containerTitle }}
                                            <span class="IDX-icon-arrow-up"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="IDX-panel-body-{{ idxID }}-{{ layoutID }}-{{ container.containerID }}" class="IDX-panel-collapse IDX-collapse" role="tabpanel" aria-labelledby="IDX-panel-heading-{{ idxID }}-{{ layoutID }}-{{ container.containerID }}" aria-expanded="false">
                                    <div class="IDX-panel-body">
                                        {{ _self.fieldContainerSide(container.fields.left,'left') }}

                                        {% if container.containerColumns == 2 %}
                                            {{ _self.fieldContainerSide(container.fields.right,'right') }}
                                        {% endif %}
                                    </div>
                                </div>
                            </div>
                    {% endfor %}
                    {% if displayGreatSchools %}
                        <div id="IDX-detailsContainer-greatSchools" class="IDX-panel IDX-panel-default">
                            <div class="IDX-panel-heading" role="tab">
                                <h4 class="IDX-panel-title">
                                    <a class="IDX-panel-collapse-toggle IDX-collapsed" data-toggle="idx-collapse" href="#IDX-panel-body-greatSchools" aria-expanded="false" aria-controls="IDX-panel-body-greatSchools">
                                        Area Info
                                        <span class="IDX-icon-arrow-up"></span>
                                    </a>
                                </h4>
                            </div>
                            <div class="IDX-panel-body">
                                {{ tools.greatSchools({ id: 'IDX-panel-body-greatSchools', class: 'IDX-panel-collapse IDX-collapse', role: 'tabpanel', hideTitle: true }) }}
                            </div>
                        </div>
                    {% endif %}
                </div>

                {# based on settings passed check for maps or other widgets to include here #}
                {% if clientRules.detailsMapType != 'none' and clientRules.detailsMapLocation == 'afterFields' %}
                    {% if idxStatus == 'sold' %}
                        {% set propCat='soldPending' %}
                    {% elseif idxStatus != null %}
                        {% set propCat=idxStatus %}
                    {% else %}
                        {% set propCat='active' %}
                    {% endif %}
                    {# include our new pins/clusters #}
                    {% include 'leaflet-1.000.twig' %}
                    {{ tools.map }}
                {% endif %}
                {% if clientRules.displayWalkscoreWidget == 'afterFields' %}
                    {{ tools.walkscore }}
                {% endif %}
               {% endblock %}
            {% endif %}
        </div>

        {# dislcaimer / courtesy / css selector #}
        {% if missingProperty == false and propArchived == false %}
            {% include 'singleMlsDisclaimers-1.000.twig' %}
        {% endif %}
        <hr>
        {% if contactOnDetails %}
            <div id="IDX-detailsContactForm">
                {% include 'mobileFirstContactComp-1.000.twig' %}
            </div>
        {% endif %}


        {# Page Footer Content #}
        {# Content we'll need on pages #}
        {% if mobileViewingFull %}<div class="IDX-swapMobileView"><a id="IDX-viewMobileSite" href="?mobilesite{{ searchString }}&mobile=true">View Mobile Site</a></div>{% endif %}
        {% if global.mobile %}<div class="IDX-swapMobileView"><a href="?fullsite{{ searchString }}" id="IDX-viewFullSite" rel="external">View Full Site</a></div>{% endif %}
    {% endspaceless %}

    {% include 'facebookPrecache-1.000.twig' %}
{% endblock %}

{% macro priceField(type,price,idxID) %}
    {% spaceless %}
        {% if type == 'soldPrice' %}
            {% set label = 'Sold For' %}
        {% elseif type == 'leased' %}
            {% set label = 'Leased For' %}
        {% elseif type == 'rented' %}
            {% set label = 'Rented For' %}
        {% elseif type == 'lease' %}
            {% set label = 'Lease Price' %}
        {% elseif type == 'rental' %}
            {% set label = 'Rental Price' %}
        {% else %}
            {% set label = labels.listingPrice %}
        {% endif %}
        {# add rules #}
        {% set rules = attribute(mlsRules,idxID) %}
        <div class="IDX-field-{{ type }} IDX-field-price IDX-field">
            <span class="IDX-label">{{ label }}</span>
            <span class="IDX-text">{{ formatPrice(price) }}{{ rules.priceSuffix }}</span>
        </div>
    {% endspaceless %}
{% endmacro %}
{# same in the mobileFirstResults #}
{% macro field(listing,field,display,options) %}
    {% if attribute(listing,field) is defined %}
        {% set value = attribute(listing,field) %}
        {% if value %}
            {% if options.numberFormat %}
                {% set value = value|number_format(options.numberFormat)|replace({'.00':''}) %}
            {% endif %}
            {% if options.dateFormat %}
                {% set value = value|date(options.dateFormat) %}
            {% endif %}
            {% if options.priceFormat %}
                {% set value = '$' ~ value|number_format(2) %}
            {% endif %}
        <div class="IDX-field-{{ field }} IDX-field {% if isNumeric(value) and value == 0 or value is empty %} IDX-zero{% endif %}">
            {% if options.labelAfter %}
                <span class="IDX-text">{{ value }}</span>
                {% if display %}<span class="IDX-label">{{ display }}</span>{% endif %}
            {% else %}
                {% if display %}<span class="IDX-label">{{ display }}</span>{% endif %}
                <span class="IDX-text">{{ value }}</span>
            {% endif %}
        </div>
        {% endif %}
    {% endif %}
{% endmacro %}
{% macro checkNum(listing, field, display) %}
    {% if attribute(listing, field) > 0 %}
        <div class="IDX-field-{{ field }} IDX-field">
            <span class="IDX-label">{{ display }}</span>
            {% spaceless %}
                <span class="IDX-text">
                {% if field == 'sqFt' %}
                    {{ attribute(listing, field)}}
                {% else %}
                    {{ attribute(listing, field) }}
                {% endif %}
                </span>
            {% endspaceless %}
        </div>
    {% endif %}
{% endmacro %}
{# baths fields #}
{% macro baths(listing) %}
    {% set fb = attribute(listing, 'fullBaths') %}
    {% set pb = attribute(listing, 'partialBaths') %}
    {% set tb = attribute(listing, 'totalBaths') %}
    {% import _self as this %}

    {% if fb > 0 and pb > 0 %}
        {{ this.field(listing,'totalBaths',labels.totalBaths) }}
        {{ this.field(listing,'fullBaths',labels.fullBaths) }}
        {{ this.field(listing,'partialBaths',labels.partialBaths) }}
    {% elseif fb > 0 %}
        {{ this.field(listing,'totalBaths',labels.totalBaths) }}
        {{ this.field(listing,'fullBaths',labels.fullBaths) }}
    {% elseif tb > 0 and pb > 0 %}
        {{ this.field(listing,'totalBaths',labels.totalBaths) }}
        {{ this.field(listing,'partialBaths',labels.partialBaths) }}
    {% elseif tb > 0 %}
        {{ this.field(listing,'totalBaths',labels.totalBaths) }}
    {% endif %}
{% endmacro %}
{% macro fieldContainerSide(fields,side) %}
    {% if fields > 0 %}
        <div class="IDX-fieldContainerList IDX-fieldContainerList{{ side|capitalize  }}">
        {% for field, label in fields %}

            {% set data = attribute(_context,field) %}
            {% if clientRules.showEmptyDetailData == 'n' and (isEmpty(data) or data == '0.00') %}
                {# we are not to show empty data, so dont show anything #}
            {% else %}
                {# only display field with label #}
                {% if field in labels|keys %}
                    <div id="IDX-field-{{ field }}" class="IDX-field">
                        <span class="IDX-label">{{ attribute(labels, field) }}</span>
                        <span class="IDX-text">
                        {% if isArray(data) %}
                            {{ data|join(', ') }}
                        {% else %}
                            {{ data }}
                        {% endif %}
                        </span>
                    </div>
                {% endif %}
            {% endif %}
        {% endfor %}
        </div>
    {% endif %}
{% endmacro %}
