{% import "forms-1.001.twig" as form %}
{% import "searchTools-1.002.twig" as tools %}
{# sample #}
{# --Content #}
{% block idxContent %}
    {% spaceless %}
        <div id="IDX-searchPageWrapper" class="IDX-pageContainer IDX-hide {% if middleware %} hide {% endif %}">
            {# only include the search nav on the frontend #}
            {% include 'navbar-1.000.twig' %}
            <!-- all inital info -->
            <div id="IDX-pageSettings" class="IDX-hide {% if middleware %} hide {% endif %}">{{pageSettings|json_encode}}</div>
            <div id="IDX-cczListRules" class="IDX-hide {% if middleware %} hide {% endif %}">{{cczListRules|json_encode}}</div>
            <div id="IDX-mlsList" class="IDX-hide {% if middleware %} hide {% endif %}">{{ mlsList|json_encode }}</div>

            <form action="{{ formAction }}" method="get" name="IDXsearchForm" id="IDX-searchForm"
                class="IDX-searchForm IDX-searchForm-{{ currentScript }}
                {% if v1searchMarkup %}IDX-v1searchMarkup{% endif %}
                {% if emailUpdateSignup %}IDX-emailUpdateSignupForm{% endif %}"
                {% if middleware %} target="_blank"{% endif %} data-pageid="{{ pageID }}" data-middleware="{{ middleware }}" data-advfields="{{ advancedFields }}">
                {% if customNewSearch %}
                    <input type="hidden" name="idxsrp" value="{{ pageID }}" />
                {% endif %}

                {% if emailUpdateSignup %}
                <div id="IDX-emailUpdateSignupStep1" class="IDX-emailUpdateSignupText">
                    Step 1: Perform a search using the provided form
                </div>
                {% endif %}

                <div id="IDX-coreSearchFields" class="IDX-row-content">
                    <div id="IDX-search-property-content" class="IDX-row-content">
                            {# idxID #}
                            {% spaceless %}
                                {# only need idxID for single mls searches #}
                                {% if single or options.force %}
                                    {% if mlsCount > 1 %}
                                        <div id="IDX-idxID-group" class="IDX-control-group {% if hiddenFields.idxID %}IDX-hidden{% endif %}">
                                            <div class="IDX-controls">
                                                <label for="IDX-idxID" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">Select Market Area</label>
                                                <select id="IDX-idxID" class="IDX-select" name="idxID" autocomplete="off">
                                                    <option></option>
                                                    {% for value, name in mls %}
                                                        <option value="{{value}}" {% if idxID == value %}selected="selected"{% endif %}>{{name}}</option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>
                                    {% else %}
                                        <input type="hidden" value="{{ idxID }}" name="idxID" id="IDX-idxID">
                                    {% endif %}
                                {% endif %}
                            {% endspaceless %}
                            {# property type#}
                            {% spaceless %}
                                <div id="IDX-pt-group" class="IDX-control-group {% if hiddenFields.pt %}IDX-hidden{% endif %}">
                                    <div class="IDX-controls">
                                        <label for="IDX-pt" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{propTypes.displayName}}</label>
                                        <select  id="IDX-pt" class="IDX-select" name="pt" autocomplete="off">
                                            <option></option>
                                            {% for value, name in propTypes.values %}
                                                <option value="{{value}}" {% if currentPt.0 == value %}selected="selected"{% endif %}>{{name}}</option>
                                            {% endfor %}
                                        </select>
                                    </div>
                                </div>
                            {% endspaceless %}
                            {# subType #}
                            {% spaceless %}
                                {% if single and subTypes.values > 0 %}
                                    {% set selectedSubTypes = settings.subType.default %}
                                    <div
                                        id="IDX-propSubType-group"
                                        class="IDX-control-group {% if hiddenFields.propSubType or not subTypes.values[currentPt.0] %}IDX-hidden{% endif %}"
                                        {# We don't want to confuse the JS. #}
                                        data-hidden="{% if hiddenFields.propSubType %}true{% endif %}"
                                    >
                                        <div class="IDX-controls">
                                            <label for="IDX-propSubType" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{subTypes.displayName}}</label>
                                            <select  id="IDX-propSubType" class="IDX-select" name="a_propSubType[]" autocomplete="off" multiple="multiple">
                                                <option></option>
                                                {% for value, name in attribute(subTypes.values, currentPt.0) %}
                                                    <option value="{{name}}" {% if name in selectedSubTypes %}selected="selected"{% endif %}>{{name}}</option>
                                                {% endfor %}
                                            </select>
                                        </div>
                                    </div>
                                {% endif %}
                            {% endspaceless %}
                            {# property status #}
                            {% spaceless %}
                                {% if statuses.values | length > 0 %}
                                    {% if single %}
                                        <div id="IDX-propStatus-group" class="IDX-control-group {% if hiddenFields.propStatus %}IDX-hidden{% endif %}">
                                            <div class="IDX-controls">
                                                <label for="IDX-propStatus" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{statuses.displayName}}</label>
                                                <select  id="IDX-propStatus" class="IDX-select" name="a_propStatus[]" autocomplete="off" multiple="multiple">
                                                    <option></option>
                                                    {% for value, name in attribute(statuses.values, currentPt.0) %}
                                                        <option value="{{name}}">{{name}}</option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>
                                    {% elseif 'sold' in statuses.values and statuses.searchable %}
                                        <div id="IDX-propStatus-group" class="IDX-control-group {% if hiddenFields.propStatus %}IDX-hidden{% endif %}">
                                            <div class="IDX-controls">
                                                <label for="IDX-propStatus" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{statuses.displayName}}</label>
                                                <select  id="IDX-propStatus" class="IDX-select" name="idxStatus" autocomplete="off" multiple="multiple">
                                                    <option></option>
                                                    {% for value, name in statuses.values %}
                                                        <option value="{{name}}">{{name}}</option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>
                                    {% endif %}
                                {% endif %}
                            {% endspaceless %}
                    </div>
                    <div id="IDX-search-primary-content" class="IDX-row-content">
                        {# ccz #}
                        {% spaceless %}
                            {% if cczListRules|length > 0 %}
                                {# hidden inputs for custom city/county/zipcode lists #}
                                {% for customListType, customListID in customCityCountyZipLists %}
                                    {% if customListType == 'city' %}
                                        {% set customList = 'ciID' %}
                                    {% elseif customListType == 'county' %}
                                        {% set customList = 'coID' %}
                                    {% elseif customListType == 'zipcode' %}
                                        {% set customList = 'pcID' %}
                                    {% endif %}
                                    <input type="hidden" name="{{ customList }}" id="{{ customList }}" value={{ customListID }}>
                                {% endfor %}

                                {% set cityClass = value %}
                                    <div id="IDX-ccz-group" class="IDX-control-group {% if hiddenFields.ccz %}IDX-hidden{% endif %}">
                                        {% if options.controllerFirst %}
                                            {{ local.cczController(options) }}
                                        {% endif %}
                                        {% set cczLabels = [] %}
                                        {% for item in [cities, counties, zipcodes] %}
                                            {% if item.displayName %}
                                                {% set cczLabels = cczLabels|merge([item.displayName]) %}
                                            {% endif %}
                                        {% endfor %}
                                        <div class="IDX-controls">
                                            <label for="IDX-ccz-select" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{ cczLabels|join(', ') }}</label>
                                            <select id="IDX-ccz-select" class="IDX-select" multiple="multiple">
                                                {% for ccz, display in cczListRules %}
                                                    {% set class %}IDX-cczList{% if loop.first %} IDX-active{% endif %}{% endset %}
                                                    {% if ccz == 'city' %}
                                                        <optgroup label="{{cities.displayName}}" data-type="city">
                                                            {% for value, name in cities.values %}
                                                                <option value="{{value}}" data-type="city">{{name}}</option>
                                                            {% endfor %}
                                                        </optgroup>
                                                    {% elseif ccz == 'county' %}
                                                        <optgroup label="{{counties.displayName}}"  data-type="county">
                                                            {% for value, name in counties.values %}
                                                                <option value="{{value}}" data-type="county">{{name}}</option>
                                                            {% endfor %}
                                                        </optgroup>
                                                    {% elseif ccz == 'zipcode' %}
                                                        <optgroup label="{{zipcodes.displayName}}" data-type="zipcode">
                                                        {% for value, name in zipcodes.values %}
                                                            <option value="{{value}}" data-type="zipcode">{{name}}</option>
                                                        {% endfor %}
                                                        </optgroup>
                                                    {% endif %}
                                                {% endfor %}
                                            </select>
                                        </div>
                                        <input type="text" name="ccz" id="IDX-ccz" class="IDX-hide {% if middleware %} hide {% endif %}">
                                    </div>
                            {% endif %}
                            {# price #}
                            <div id="IDX-minPrice-group" class="IDX-control-group{% if hiddenFields.lp %} IDX-hidden{% endif %}">
                                <div class="IDX-controls">
                                    <label for="IDX-lp" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{minPrice.displayName}}</label>
                                    <input type="text" name="lp" id="IDX-lp" value="{{ prices.min[currentPt[0]] }}" class="IDX-input" placeholder="{{minPrice.displayName}}">
                                </div>
                            </div>
                            <div id="IDX-maxPrice-group" class="IDX-control-group{% if hiddenFields.hp %} IDX-hidden{% endif %}">
                                <div class="IDX-controls">
                                    <label for="IDX-hp" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{maxPrice.displayName}}</label>
                                    <input type="text" name="hp" id="IDX-hp" value="{{ prices.max[currentPt[0]] }}" class="IDX-input" placeholder="{{maxPrice.displayName}}">
                                </div>
                            </div>
                            {# bedrooms #}
                            <div id="IDX-bd-group" class="IDX-control-group {% if hiddenFields.bd %}IDX-hidden{% endif %}">
                                <div class="IDX-controls">
                                    <label for="IDX-bd" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{bedrooms.displayName}}</label>
                                    <select id="IDX-bd" name="bd" class="IDX-select ">
                                        <option></option>
                                        {% for value, name in {'':'Any Number',0:'Studio',1:'1+', 2:'2+', 3:'3+', 4:'4+', 5:'5+', 6:'6+', 7:'7+',8:'8+',9:'9+',10:'10+'} %}
                                        <option value="{{value}}">{{name}}</option>
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>
                            {# bathrooms #}
                            <div id="IDX-tb-group" class="IDX-control-group {% if hiddenFields.tb %}IDX-hidden{% endif %}">
                                <div class="IDX-controls">
                                    <label for="IDX-tb" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{bathrooms.displayName}}</label>
                                    <select id="IDX-tb" name="tb" class="IDX-select">
                                        <option></option>
                                        {% for value, name in {'':'Any Number',1:'1+', 2:'2+', 3:'3+', 4:'4+', 5:'5+', 6:'6+', 7:'7+',8:'8+',9:'9+',10:'10+'} %}
                                        <option value="{{value}}">{{name}}</option>
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>
                            {# square feet #}
                            <div id="IDX-sqft-group" class="IDX-control-group {% if hiddenFields.sqft %}IDX-hidden{% endif %}">
                                <div class="IDX-controls">
                                    <label for="IDX-sqft" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{sqFt.displayName}}</label>
                                    <input type="text" name="sqft" id="IDX-sqft" value="" class="IDX-input" placeholder="{{sqFt.displayName}}">
                                </div>
                            </div>
                            {# acres #}
                            <div id="IDX-acres-group" class="IDX-control-group {% if hiddenFields.acres %}IDX-hidden{% endif %}">
                                <div class="IDX-controls">
                                    <label for="IDX-acres" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{acres.displayName}}</label>
                                    <input type="text" name="acres" id="IDX-acres" value="" class="IDX-input" placeholder="{{acres.displayName}}">
                                </div>
                            </div>
                        {% endspaceless %}
                    </div>
                    <div id="IDX-search-additional-content" class="IDX-row-content">
                        {# max days Listed #}
                        <div id="IDX-add-group" class="IDX-control-group {% if hiddenFields.add %}IDX-hidden{% endif %}">
                            <div class="IDX-controls">
                                <label for="IDX-add" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">Max Days Listed</label>
                                <input type="text" name="add" id="IDX-add" value="" class="IDX-input" placeholder="Max Days Listed">
                            </div>
                        </div>

                        {# refinement #}
                        {% if refinement %}
                        <div id="IDX-searchRefinement-group" class="IDX-control-group {% if hiddenFields.searchRefinement %}IDX-hidden{% endif %}" data-placeholder="Foo">
                            <div class="IDX-controls">
                                <label for="IDX-searchRefinement" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">Refinement</label>
                                <select id="IDX-searchRefinement" name="searchRefinement[]" class="IDX-select" multiple="multiple">
                                {% if not hiddenFields.photocount %}
                                    <option value="amin_photocount">Has Image</option>
                                {% endif %}
                                {% if not hiddenFields.wvt %}
                                    <option value="wvt">Has Virtual Tour</option>
                                {% endif %}
                                {% if not hiddenFields.woh %}
                                    <option value="woh">Has Open House</option>
                                {% endif %}
                                {% if not hiddenFields.fl %}
                                    <option value="fl">Featured Listings</option>
                                {% endif %}
                                </select>
                            </div>
                            <input type="text" class='IDX-hide {% if middleware %} hide {% endif %}' name="amin_photocount" value="">
                            <input type="text" class='IDX-hide {% if middleware %} hide {% endif %}' name="wvt" value="">
                            <input type="text" class='IDX-hide {% if middleware %} hide {% endif %}' name="woh" value="">
                            <input type="text" class='IDX-hide {% if middleware %} hide {% endif %}' name="fl" value="">
                        </div>
                        {% endif %}
                        {# Results per page#}
                        <div id="IDX-per-group" class="IDX-control-group {% if hiddenFields.per %}IDX-hidden{% endif %}">
                            <div class="IDX-controls">
                                <label for="IDX-per" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">Results per page</label>
                                <select id="IDX-per" name="per" class="IDX-select">
                                    <option></option>
                                    {% for i in [5,10,25,50,100] %}
                                        {% if i <= maxResultsPerPage %}
                                            <option value={{i}}>{{i}}</option>
                                        {% endif %}
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                        {# Sort by #}
                        <div id="IDX-srt-group" class="IDX-control-group {% if hiddenFields.srt %}IDX-hidden{% endif %}">
                            <div class="IDX-controls">
                                <label for="IDX-srt" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">Sort By</label>
                                <select id="IDX-srt" name="srt" class="IDX-select " autocomplete="off">
                                    <option></option>
                                    {% for value, name in {'newest':'Newest Listings', 'oldest':'Oldest Listings', 'pra':'Least expensive to most', 'prd':'Most expensive to least', 'bda':'Bedrooms (Low to High)', 'bdd':'Bedrooms (High to Low)', 'tba':'Bathrooms (Low to High)', 'tbd':'Bathrooms (High to Low)', 'sqfta':'Square Feet (Low to High)', 'sqftd':'Square Feet (High to Low)'} %}
                                        <option value="{{value}}">{{name}}</option>
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="IDX-action-buttons" class="IDX-row-content">
                    <button type="button" id="IDX-formReset" class="IDX-btn">Reset</button>
                    <button type="submit" id="IDX-formSubmit" class="IDX-btn IDX-btn-primary" data-action="search">
                    {% if middleware %}
                        View Results in New Window
                    {% elseif emailUpdateSignup %}
                        Next Step
                    {% else %}
                        Search
                    {% endif %}
                    </button>
                </div>
                {% if advancedFields %}
                    {% set advancedSearchFieldsVersion = '1.000' %}
                    <div id="IDX-advancedSearchFields" class="IDX-modAdvanced{% if advAjaxLoad %} IDX-advAjaxLoad{% endif %}" data-version="{{advancedSearchFieldsVersion}}"></div>
                {% endif %}
                <!-- If they want submit buttons at the bottom -->
                <div id="IDX-action-buttons-bottom" class="IDX-row-content IDX-hide {% if middleware %} hide {% endif %}">
                    <button type="button" id="IDX-formReset-bottom" class="IDX-btn">Reset</button>
                    <button type="submit" id="IDX-formSubmit-bottom" class="IDX-btn IDX-btn-primary" data-action="search">
                    {% if middleware %}
                        View Results in New Window
                    {% elseif emailUpdateSignup %}
                        Next Step
                    {% else %}
                        Search
                    {% endif %}
                    </button>
                </div>

                <div id="IDX-loadingScreen">
                    <!-- Logo -->
                    {% if searchLoader.showLogoLoadingScreen == 'y' and searchLoader.clientLogo %}<img src="{{ searchLoader.clientLogo }}" width="100px;"/><br />{% endif %}
                    <img src='/images/ajaxLoadBar.gif'/>
                </div>
            </form>

            {% if emailUpdateSignup %}
                <div id="IDX-emailUpdateSignupStep2Container" class="IDX-hide {% if middleware%} hide {% endif %}">
                    <div id="IDX-saveSearchWrapper" class="IDX-hide {% if middleware%} hide {% endif %}">
                        <form id="IDX-saveSearchForm" action="/idx/ajax/verse.php" method="post" class="IDX-resetForm">
                            <input type="hidden" name="action" value="emailUpdatesSearch" />
                            <input type="hidden" name="queryString" value="" class="IDX-queryString" />
                            <input type="hidden" name="searchPageID" value="{{ pageID }}" class="IDX-searchPageID" />
                        </form>
                    </div>
                </div>
            {% endif %}
            <br class="IDX-clear" />

            {% if not middleware %}
                <div id="IDX-editSavedSearch" class="IDX-hide {% if middleware%} hide {% endif %}">
                    <div style="text-align:center;" id="IDX-editSavedSearchMessage"></div>
                </div>
                {# only include the disclaimers frontend #}
                {% include 'multipleMlsDisclaimers-1.000.twig' %}
            {% endif %}

            {# pre-population variables #}
            {% if queryArray %}<div id="IDX-modifySearchData" class="IDX-hide {% if middleware%} hide {% endif %}">{{ queryArray|raw }}</div>{% endif %}
            {% if ssQueryArray %}<div id="IDX-editSavedSearchData" class="IDX-hide {% if middleware%} hide {% endif %}">{{ ssQueryArray|raw }}</div>{% endif %}

            {# default pricing data #}
            <div id="IDX-defaultPriceData" class="IDX-hide {% if middleware %} hide {% endif %}">{{ defaultPriceData|raw }}</div>
        </div>
    {% endspaceless %}
{% endblock %}
{# after all idx content #}
{% block idxSuffix %}
    {% if middleware %}
        <style>
            .IDX-wrapper-standard .IDX-control-group.IDX-hidden{ display: none;}
            #IDX-action-buttons #IDX-formReset {border: 1px solid #ccc}
            .control-group label { font-weight: normal;}
            .control-group input, .control-group span { min-height: 28px;}
            .IDX-control-group {box-sizing: border-box;}
            #IDX-action-buttons {width: 100% !important;}
            #IDX-action-buttons button {
                display: inline-block;
                margin-bottom: 0;
                font-weight: 400;
                text-align: center;
                vertical-align: middle;
                cursor: pointer;
                background-image: none;
                border: 1px solid transparent;
                white-space: nowrap;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857;
                border-radius: 0;
                -webkit-user-select: none;
                height: 40px;
            }
            #IDX-action-buttons .IDX-btn-primary {
                color: #fff;
                background-color: #428bca;
                border-color: #357ebd
            }
            .select2-search-field {
                width: 100%;
            }
            .select2-chosen, .select2-input.select2-default {
                font-size: 1em !important;
                font-family: sans-serif !important;
                width: 100% !important;
                height: 39px;
            }
            .select2-search-choice-close {background: transparent;}
            .IDX-pull-right {float: right !important;}
        </style>
        <script>
            idx.middleware = {{ middleware ? 'true' : 'false' }};
            idx(function() {
                // overwrite default moveHidden function in pageprefs.js
                window.moveHidden = function (container) {
                    var value = container.val();
                    // remove the hide toggle
                    container.find('.hideToggle').remove();
                    container.removeClass('hideToggleContainer');

                    // Special case for inital loading of hidden ccz
                    if (container.attr('id') == 'IDX-cczContainer') {
                        container = idx('.IDX-cczList.IDX-active');
                    }

                    var input = container.find('.IDX-controls input[name*=], .IDX-controls select');
                    if(input.size()) {
                        var field = input.attr('id').replace('IDX-', '');

                        var selector = container.attr('id');
                        var display = (field == 'srtd') ? 'Sort' : idx.trim(container.find('label').html());

                        display = '<strong>'+display+'</strong>';

                        if (value) {
                            display += ': ';

                            // special case for city/county/zip field because values and labels differ
                            if (cczField) {
                                // create the display from the ccz displays and not labels
                                idx('#'+selector+' .IDX-cczSelect option:selected').each(function() {
                                    if (key > 0) {
                                        display += ', ';
                                    }
                                    display += idx(this).html();
                                });
                            } else {
                                display += value;
                            }
                        }

                        var html = '<li data-field="'+field+'" data-value="'+value+'" data-selector="'+selector+'">'+display+'</li>';

                        // hide the original
                        idx(container).addClass('IDX-hidden');
                        idx(container).find('input, select').addClass('IDX-noSubmit');

                        // add to list of hidden fields
                        idx('#hiddenFields').append(html);
                    }
                    // show the hidden fields
                    idx('#hiddenFieldContainer').removeClass('hide');
                };
            });
        </script>
    {% endif %}
{% endblock %}
