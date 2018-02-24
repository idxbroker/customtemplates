{% import _self as tools %}

{# Main idx page content here. #}
{% block idxContent %}
    {% spaceless %}
        {# Page-specific content. #}
        {% if agentInfo %}
            {% set showAgentInfo = true %}
            {% set columnSize = 'col-xs-12' %}
        {% endif %}
        {% if showAgentInfo %}
            {% import "mobileFirstRosterTools-1.001.twig" as rosterTools %}
            {{ rosterTools.agentBio(agentInfo) }}
        {% endif %}
        <div id="IDX-resultsRow">
            <div id="IDX-resultsContainer" class="IDX-pageContainer {{ columnSize }} IDX-totalResults-{{ totalResults }}">
                {# Header will have pagination and map. #}
                {% set defaultIdxID = '' %}
                {% if refinementData.idxID %}
                    {% set defaultIdxID = refinementData.idxID %}
                {% endif %}
                <div id="IDX-resultsHeader" class="IDX-contentHeader">
                    {% if nonCommingleIdxId is iterable %}
                        <ul class="IDX-nav IDX-nav-pills">
                            {% if not noAll %}
                                {{ tools.link(pager, 1, 'Search Results', 'IDX-comminglePill', 'idxID-all', defaultIdxID == '') }}
                            {% endif %}
                            {% for idxID, info in nonCommingleIdxId %}
                                {{ tools.link(info, 1, info.name, 'IDX-comminglePill', 'idxID-' ~ idxID, defaultIdxID == idxID) }}
                            {% endfor %}
                        </ul>
                        <hr>
                    {% endif %}

                    {# Top pager. #}
                    <div id="IDX-resultsPager-header" class="IDX-row-content IDX-center">
                        {% spaceless %}
                            <div class="IDX-pagination-action">
                                <a href="#" class="IDX-btn IDX-btn-default{% if pager.currentPage == 1 %} IDX-disabled{% endif %}"
                                {% if pager.currentPage == 1 %}disabled{% endif %}
                                role="button" id="IDX-pagination-header-prev"></a>
                            </div>
                            <div id="IDX-pagination" class="IDX-pagination-action">
                                <select id="IDX-pagination-pagers-header" class="IDX-select" name="pagination" autocomplete="off">
                                    {% if pager.lastPage == 0 %}
                                        <option value="0" selected>0 / 0</option>
                                    {% else %}
                                        {% for i in range(1, pager.lastPage)  %}
                                            <option value="{{ i }}" {% if pager.currentPage == i %}selected{% endif %}>{{ i }} / {{ pager.lastPage }}</option>
                                        {% endfor %}
                                    {% endif %}
                                </select>
                            </div>
                            <div class="IDX-pagination-action" >
                                <a href="#" class="IDX-btn IDX-btn-default{% if pager.currentPage == pager.lastPage %} IDX-disabled{% endif %}"
                                {% if pager.currentPage == pager.lastPage %}disabled{% endif %}
                                role="button" id="IDX-pagination-header-next"></a>
                            </div>
                        {% endspaceless %}
                    </div>
                    {% if truncated %}
                    {% elseif totalResults == 0 %}
                        <div id="IDX-noResultsMessage" class="IDX-resultsCountMessage">
                            {% if pageURL == 'agent' %}
                                This agent has no active listings currently.
                            {% else %}
                                Your search did not return any results. Please try to broaden your search criteria or feel free to try again later.
                            {% endif %}
                        </div>
                    {% endif %}

                    {% if pageURL != 'agent' %}
                        {% spaceless %}
                            <div id="IDX-resultsTopActions" class="IDX-topActions IDX-control-group">
                                <div id="IDX-resultsActionSave" class="IDX-topAction">
                                    {% if nav.searchSavedPreviously %}
                                        <a id="IDX-saveSearch" href="#saveSearch" class="IDX-btn IDX-btn-default IDX-disabled">Saved!</a>
                                    {% else %}
                                        <a id="IDX-saveSearch" href="#saveSearch" class="IDX-btn IDX-btn-default">Save Search</a>
                                    {% endif %}
                                    <div id="IDX-saveSearchWrapper" class="IDX-hidden">
                                        <form id="IDX-saveSearchForm" action="/idx/ajax/verse.php" method="post" class="IDX-resetForm">
                                            <input type="hidden" name="action" value="saveSearch" />
                                            {% if savedLink %}
                                                <input type="hidden" name="savedLink" value="{{ savedLink }}">
                                                <input type="hidden" name="queryString" value="{{ savedLinkSettings.queryString }}" class="IDX-queryString" />
                                            {% else %}
                                                <input type="hidden" name="queryString" value="{{ saveQueryString }}" class="IDX-queryString" />
                                            {% endif %}
                                            <input type="hidden" name="searchPageID" value="{{ searchPageID }}" class="IDX-searchPageID" />
                                        </form>
                                    </div>
                                </div>
                                <div id="IDX-resultsActionNew" class="IDX-topAction">
                                    <a id="IDX-newSearch" href="{{ nav.newSearchLink }}" class="IDX-btn IDX-btn-default">New Search</a>
                                </div>
                                {% if nav.modifySearch %}
                                    <div id="IDX-resultsLinkModify" class="IDX-topAction">
                                        <a id="IDX-modifySearch" href="{{ nav.modifySearchLink }}" class="IDX-btn IDX-btn-default">Modify Search</a>
                                    </div>
                                {% endif %}
                            </div>
                        {% endspaceless %}
                    {% endif %}

               
                </div>
                <!-- /results header -->

                <div id="IDX-resultsFooter" class="IDX-contentFooter">
                    {# Bottom pager. #}
                    <div id="IDX-resultsPager-footer" class="IDX-row-content IDX-center">
                      
                </div>
       
            </div>
        </div>
    {% endspaceless %}
{% endblock %}

{# Macros. #}
{% macro field(listing, field, display, options) %}
    {% if attribute(listing, field) is defined %}
        {% set value = attribute(listing, field) %}
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
                <span class="IDX-resultsText">{{ value|capitalize }}</span>
            {% endif %}
        </div>
        {% endif %}
    {% endif %}
{% endmacro %}

{% macro priceField(type, price, idxID) %}
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
        {# Add rules. #}
        {% set rules = attribute(mlsRules, idxID) %}
        <div class="IDX-field-{{ type }} IDX-field-price IDX-field">
            <span class="IDX-label">{{ label }}</span>
            <span class="IDX-text">{{ formatPrice(price) }}{{ rules.priceSuffix }}</span>
        </div>
    {% endspaceless %}
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

{% macro baths(listing) %}
    {% set fb = attribute(listing, 'fullBaths') %}
    {% set pb = attribute(listing, 'partialBaths') %}
    {% set tb = attribute(listing, 'totalBaths') %}
    {% import _self as this %}

    {% if fb > 0 and pb > 0 %}
        {{ this.field(listing, 'totalBaths', labels.totalBaths) }}
        {{ this.field(listing, 'fullBaths', labels.fullBaths) }}
        {{ this.field(listing, 'partialBaths', labels.partialBaths) }}
    {% elseif fb > 0 %}
        {{ this.field(listing, 'totalBaths', labels.totalBaths) }}
        {{ this.field(listing, 'fullBaths', labels.fullBaths) }}
    {% elseif tb > 0 and pb > 0 %}
        {{ this.field(listing, 'totalBaths', labels.totalBaths) }}
        {{ this.field(listing, 'partialBaths', labels.partialBaths) }}
    {% elseif tb > 0 %}
        {{ this.field(listing, 'totalBaths', labels.totalBaths) }}
    {% endif %}
{% endmacro %}

{% macro resultsContent(category, resultData, orderByRule, orderByPropTypes, orderByPtField) %}
    {% import _self as tools %}
    {% spaceless %}
    <div id="IDX-resultsContent" class="IDX-tabPane">

        {# Control the order of showing them. #}
        {# Loop through all the result data given. #}
        {% for category in [ 'supplemental', 'soldPending', 'featured', 'active', 'historical' ] %}

            {% set data = attribute(resultData, category) %}
            {# Confirm there is actually data first. #}
            {% if data %}
            <div id="IDX-results{{ category|capitalize }}Listings" class="IDX-resultsListings">
                {% if pageURL == 'agent' %}
                    {% set display = 'Agent Listings' %}
                {% elseif category == 'soldPending' %}
                    {% set display = 'Sold/Pending' %}
                {% elseif category == 'active' %}
                    {% set display = 'Search' %}
                {% else %}
                    {% set display = category|capitalize %}
                {% endif %}

                <h4 id="IDX-resultsSeparatorText{{ category|capitalize }}" class="IDX-resultsSeparatorText {{ orderByRule }}">
                    {{ display }}{% if pageURL != 'agent' %} Results{% endif %}
                </h4>
                <hr id="IDX-resultsSeparator{{ category|capitalize }}" class="IDX-resultsSeparator {{ orderByRule }}" />

                {% set prevPropType = '' %}
                {% set prevLikeParentPtID = '' %}
                {% set prevLikeMlsPtID = '' %}

                {# Loop through each listing. #}
                <div class="IDX-resultsCellsContainer" style="overflow-y:auto; height:800px;">
                {% for listing in data %}
                    {# If supplemental listing and client has mulstiple mlss, user likeParentPtID to figure out the property type. #}
                    {% if listing.idxID == 'a999' and orderByPtField == 'parentPtID' %}
                        {% if orderByRule == 'propertyTypeThenPrice' and prevLikeParentPtID != listing.likeParentPtID %}
                            <h4 class="IDX-propertyTypeHeader">{{ attribute(orderByPropTypes, listing.likeParentPtID) }}</h4>
                        {% endif %}
                    {# If supplemental listing and the client has a single mls, user likeMlsPtID to figure out the property type. #}
                    {% elseif listing.idxID == 'a999' and orderByPtField == 'mlsPtID' %}
                        {% if orderByRule == 'propertyTypeThenPrice' and prevLikeMlsPtID != listing.likeMlsPtID %}
                            <h4 class="IDX-propertyTypeHeader">{{ attribute(orderByPropTypes, listing.likeMlsPtID) }}</h4>
                        {% endif %}
                    {% else %}
                        {% if orderByRule == 'propertyTypeThenPrice' and prevPropType != attribute(listing, orderByPtField) %}
                            <h4 class="IDX-propertyTypeHeader">
                                {{ attribute(orderByPropTypes, attribute(listing, orderByPtField)) }}
                            </h4>
                        {% endif %}
                    {% endif %}

                    {% if listing.idxID == 'a999' %}
                        {% if orderByPtField == 'mlsPtID' %}
                            {% set prevPropType = listing.likeMlsPtID %}
                            {% set prevLikeMlsPtID = listing.likeMlsPtID %}
                        {% elseif orderByPtField == 'parentPtID' %}
                            {% set prevPropType = listing.likeParentPtID %}
                            {% set prevLikeParentPtID = listing.likeParentPtID %}
                        {% endif %}
                    {% elseif listing.idxID != 'a999' %}
                        {% set prevLikeMlsPtID = attribute(listing, orderByPtField) %}
                        {% set prevLikeParentPtID = attribute(listing, orderByPtField) %}
                        {% set prevPropType = attribute(listing, orderByPtField) %}
                    {% endif %}

                    <div class="IDX-resultsCell" data-propCat="{{ category }}" data-idxid="{{ listing.idxID }}" data-idxStatus="{{ listing.idxStatus }}" data-price="{{ listing.price }}" data-listingid="{{ listing.listingID }}" data-mlsptid="{{ listing.mlsPtID }}" {% if listing.latitude != 0 and listing.longitude != 0 %}data-lat="{{ listing.latitude }}" data-lng="{{ listing.longitude }}"{% endif %}>
                        <div class="IDX-cellInnerWrapper">
                            <div class="IDX-row-content">
                                <!-- Content row. -->
                                {# Displays the whole address for a listings (will be a link to details page). #}
                                <div class="IDX-resultsAddress">
                                    <a href="{{ listing.detailsURL }}" class="IDX-resultsAddressLink">
                                        {# Street info. #}
                                        <span class="IDX-resultsAddressNumber">{{ listing.streetNumber }} </span>
                                        <span class="IDX-resultsAddressDirection">{{ listing.streetDirection }} </span>
                                        <span class="IDX-resultsAddressName">{{ listing.streetName }}</span>
                                        {% if listing.unitNumber %}
                                            <span class="IDX-resultsAddressUnitNumber">{{ listing.unitNumber }}&nbsp;</span>
                                        {% endif %}
                                        {% if listing.streetName %}<span class="IDX-resultsEndAddressCommaOne">, </span>{% endif %}
                                        {# CCZ info. #}
                                        <span class="IDX-resultsAddressCity">{{ listing.cityName }}</span>
                                        <span class="IDX-resultsEndAddressCommaTwo">, </span>
                                        <span class="IDX-resultsAddressState">{{ listing.state }} </span>
                                        <span class="IDX-resultsAddressStateAbrv">{{ listing.stateAbrv }} </span>
                                        <span class="IDX-resultsAddressZip">{{ listing.zipcode }}</span>
                                        {% if listing.zip4 > 0 %}<span class="IDX-addressZip4">-{{ listing.zip4 }}</span>{% endif %}
                                    </a>
                                </div>
                                {# Display the primary photo. #}
                                <div class="IDX-resultsPhoto">
                                    <a href="{{ listing.detailsURL }}" class="IDX-resultsPhotoLink">
                                        <noscript class="IDX-loadImage" data-src="{{ listing.primaryPhoto }}">
                                            <img alt="{{ listing.address }}, {{ listing.cityName }}, {{ listing.stateAbrv }} {{ listing.zipcode }}" src="{{ listing.primaryPhoto }}" class="IDX-resultsPhotoImg" {% if width %}width="{{ width }}" {% endif %} {% if height %}height="{{ height }}"{% endif %}>
                                        </noscript>
                                    </a>
                                </div>
                                <div class="IDX-resultsMainInfo IDX-panel IDX-panel-default">
                                    <div class="IDX-panel-heading">
                                        {% spaceless %}
                                            {# listingID. #}
                                            {{ tools.field(listing,'listingID',labels.listingID) }}
                                            {# Short name of the MLS. #}
                                            <div class="IDX-market IDX-resultsField">
                                                {{ listing.mls }}
                                            </div>
                                        {% endspaceless %}
                                    </div>
                                    <div class="IDX-panel-body">
                                        {% spaceless %}
                                            <div class="IDX-resultsMainInfoLeft">
                                                {# Figures out the price and labeling to display (standard, sold, rent/lease, etc). #}
                                                {% if listing.idxStatus == 'sold' or listing.archiveStatus == 'sold' %}
                                                    {% if listing.rntLse == 'lease' and listing.rntLsePrice > 0 %}
                                                        {{ tools.priceField('leased', listing.rntLsePrice, listing.idxID) }}
                                                    {% elseif listing.rntLse == 'rental' and listing.rntLsePrice > 0 %}
                                                        {{ tools.priceField('rented', listing.rntLsePrice, listing.idxID) }}
                                                    {% elseif listing.soldPrice and listing.soldPrice > 0 %}
                                                        {{ tools.priceField('soldPrice', listing.soldPrice, listing.idxID) }}
                                                    {% elseif listing.listingPrice %}
                                                        {{ tools.priceField('soldPrice', listing.listingPrice, listing.idxID) }}
                                                    {% endif %}
                                                    {{ tools.field(listing, 'soldDate', labels.soldDate, { dateFormat: 'n/j/Y' }) }}
                                                {% elseif (listing.rntLse == 'lease' or listing.rntLse == 'rental') and listing.rntLsePrice > 0 %}
                                                    {{ tools.priceField(listing.rntLse, listing.rntLsePrice, listing.idxID) }}
                                                {% else %}
                                                    {{ tools.priceField('listingPrice', listing.listingPrice, listing.idxID) }}
                                                {% endif %}
                                                {{ tools.field(listing, 'pricePerSqFt', labels.pricePerSqFt, { priceFormat: true }) }}
                                                {# Output status. #}
                                                {{ tools.field(listing, 'propStatus', labels.propStatus) }}

                                                {# Output bedrooms. #}
                                                {{ tools.field(listing, 'bedrooms', labels.bedrooms) }}

                                                {# Does the work for figuring out what bath fields to output (full, partial, or total). #}
                                                {{ tools.baths(listing) }}
                                            </div>
                                            <div class="IDX-resultsMainInfoRight">
                                                {# Use checkNum to only output if they are greater than 0. #}
                                                {{ tools.checkNum(listing, 'sqFt', labels.sqFt) }}
                                                {{ tools.checkNum(listing, 'acres', labels.acres) }}
                                                {{ tools.field(listing, 'subdivision', labels.subdivision) }}
                                            </div>
                                        {% endspaceless %}
                                    </div>
                                </div>
                                {# Photogallery, vt, oh, saveProperty, detailsLink. #}
                                <div class="IDX-row-content">
                                    <div class="IDX-resultsCellActions">
                                        {# Link to the photo gallery page. #}
                                        {% if listing.image.totalCount > 0 %}
                                            <div class="IDX-resultsPhotogallery">
                                                <a href="{{ baseURL }}photogallery/{{ listing.idxID }}/{{ listing.listingID }}" class="IDX-resultsCellAction IDX-btn IDX-btn-default">
                                                    Photo Gallery <span class="IDX-galleryCount">({{ listing.image.totalCount }})</span>
                                                </a>
                                            </div>
                                        {% endif %}
                                        {# Display virtual tours and open house links which will open in modals. #}
                                        {# Virtual tours. #}
                                        {% if clientRules.resultsVirtualTour != 'none' and listing.vtCount > 0 %}
                                            <div class="IDX-resultsVirtualTour">
                                                {% if listing.vtCount == 1 %}
                                                    <a href="javascript:void(0)" class="IDX-resultsCellAction IDX-psudolink IDX-btn IDX-btn-default" onclick="window.open('{{ listing.mediaData.vt.0.url }}', '{{ listing.mediaData.vt.0.title }}', 'width={{ listing.mediaData.vt.0.width }}, height={{ listing.mediaData.vt.0.height }}, resizable=1, scrollbars=1, status=0, titlebar=0')" href="#">
                                                        {{ listing.mediaData.vt.0.descriptor|default('Virtual Tour') }}
                                                    </a>
                                                {% else %}
                                                    <a href="#IDX-resultsMediaVirtualTour-{{ listing.listingID }}" class="IDX-resultsMediaVirtualTour IDX-resultsCellAction IDX-psudolink IDX-btn IDX-btn-default">
                                                        Virtual Tours ({{ listing.vtCount }})
                                                    </a>
                                                    <div id="IDX-resultsMediaVirtualTour-{{ listing.listingID }}" class="IDX-mediaContentVT" title="Virtual Tours for #{{ listing.listingID }}">
                                                    {% for media in listing.mediaData.vt %}
                                                        <div class="IDX-mediaModalVT">
                                                            <a class="IDX-resultsCellAction IDX-btn IDX-btn-default" onclick="window.open('{{ media.url }}', '{{ media.title }}', 'width={{ media.width|default('800') }}, height={{ media.height|default('600') }}, resizable=1, scrollbars=1, status=0, titlebar=0')" href="javascript:void(0)">
                                                                {{ media.descriptor|default('Virtual Tour') }}
                                                            </a>
                                                            <br />
                                                            <span class="IDX-mediaModalText">{{ media.text }}</span>
                                                        </div>
                                                    {% endfor %}
                                                    </div>
                                                {% endif %}
                                            </div>
                                        {% endif %}
                                        {# Open house. #}
                                        {% if listing.ohCount > 0 and listing.mediaData|length > 0 %}
                                            {% set elementID = 'IDX-openHouses-' ~ listing.idxID ~ '-' ~ listing.listingID %}
                                            {% set title %}
                                                Open House{% if listing.ohCount > 1 %}s{% endif %} For #{{ listing.listingID }}
                                            {% endset %}
                                            <div class="IDX-resultsOpenHouse">
                                                <a href="#IDX-resultsMediaOpenHouse-{{ listing.listingID }}" class="IDX-resultsCellAction IDX-btn IDX-btn-default">
                                                    Open House {% if mediaData.oh.ohCount > 1 %}({{ mediaData.oh.ohCount }}){% endif %}
                                                </a>
                                                <div id="IDX-resultsMediaOpenHouse-{{ listing.listingID }}" class="IDX-mediaContentOH" title="{{ title }}">
                                                    {% for media in listing.mediaData.oh %}
                                                        <div class="IDX-openHouseTitle">
                                                            {% if media.url %}<a href="{{ media.url }}" class="IDX-openHouseTitleLink" target="_blank">{% endif %}
                                                                {{ media.descriptor|default('Open House') }}
                                                            {% if media.url %}</a>{% endif %}
                                                        </div>
                                                        <div class="IDX-openHouseDateTime">
                                                            <span class="IDX-openHouseDate">{{ media.freeFormDate }}</span>
                                                            <span class="IDX-openHouseTime">{{ media.freeFormTime }}</span>
                                                        </div>
                                                        <div class="IDX-openHouseText">{{ media.text }}</div>
                                                        {% if media.hostedBy %}<div class="IDX-openHouseHostedBy">{{ media.hostedBy }}</div>{% endif %}
                                                    {% endfor %}
                                                </div>
                                            </div>
                                        {% endif %}

                                        {# Custom link. #}
                                        {% if listing.customLink.text and listing.customLink.url %}
                                            <div class="IDX-resultsCustomLink">
                                                <a
                                                    href="{{ listing.customLink.url }}"
                                                    target="_blank"
                                                    class="IDX-resultsCellAction IDX-btn IDX-btn-default"
                                                >{{ listing.customLink.text }}</a>
                                            </div>
                                        {% endif %}

                                        {# Save property link. #}
                                        <div class="IDX-resultsSaveProperty">
                                            {% if not listing.propertySavedPreviously %}
                                                <a data-listingid="{{ listing.listingID }}" data-idxid="{{ listing.idxID }}" href="#saveProperty" class="IDX-resultsCellAction IDX-btn IDX-btn-default" id="IDX-SP-{{ listing.idxID }}-{{ listing.listingID }}">
                                                    Save Property
                                                </a>
                                            {% else %}
                                                <a data-listingid="{{ listing.listingID }}" data-idxid="{{ listing.idxID }}" href="#saveProperty" class="IDX-resultsCellAction IDX-resultsCellSaved IDX-btn IDX-btn-default IDX-disabled" disabled="disabled" id="IDX-SP-{{ listing.idxID }}-{{ listing.listingID }}">
                                                    Saved!
                                                </a>
                                            {% endif %}
                                        </div>

                                        {# Link to details page. #}
                                        <div class="IDX-resultsDetailsLink">
                                            <a href="{{ listing.detailsURL }}" class="IDX-resultsCellAction IDX-btn IDX-btn-default">
                                                View Details
                                            </a>
                                        </div>
                                         {# Property remarks. #}
                                <div class="IDX-resultsDescription">{{ listing.remarksConcat|raw }}</div>
                                {# MLS logo and courtesy. #}
                                <div class="IDX-mlsContainer">
                                    <div class="IDX-MLSLogo">{{ listing.logo|raw }}</div>
                                    <div class="IDX-MLSCourtesy">{{ listing.courtesy|raw }}</div>
                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="IDX-hopoZoning">
                                <label>Hopo Zoning:</label>{{ listing.hopoZoning }}
                            </div>
                            {{ listing.listingSelectorCourtesy|raw }}
                        </div>
                    </div>
                {% endfor %}
                </div>
            </div>
            {% endif %}
        {% endfor %}
    </div>
    {% endspaceless %}
{% endmacro %}

{% macro link(pager, i, display, class, id, active) %}
    {% set path = pager.allPath|default(pager.path) %}
    <li class="{{ class }} {% if active %}IDX-active{% endif %}" id="{{ id }}" role="presentation">
        <a href="{{ path|replace({'%25start%25':i}) }}">
            {{ display|default(i) }}
        </a>
    </li>
{% endmacro %}
{# Results map. #}
                   
{# New map pins+clusters. #}
{% include 'leaflet-1.001.twig' %}

{# Results content. #}
{{ tools.resultsContent(category, resultData, orderByRule, orderByPropTypes, orderByPtField) }}

<div id="IDX-custom-resultsMap">
                        <div id="IDX-map"></div>
                    </div>
                    

                    {% include 'multipleMlsDisclaimers-1.000.twig' %}


