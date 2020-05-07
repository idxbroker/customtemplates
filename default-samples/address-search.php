{% import "forms-1.001.twig" as form %}
{% import "searchTools-1.003.twig" as tools %}
{# sample #}
{% block idxContent %}
    {% spaceless %}
        <div id="IDX-searchPageWrapper" class="IDX-pageContainer">
            {% include 'navbar-1.000.twig' %}
            <div id="IDX-pageSettings" class="IDX-hidden">{{ pageSettings|json_encode }}</div>
            <form action="{{ formAction }}" method="get" name="IDXsearchForm" id="IDX-searchForm" class="IDX-searchForm IDX-searchForm-{{ currentScript }} {% if v1searchMarkup %}IDX-v1searchMarkup{% endif %}{% if emailUpdateSignup %}IDX-emailUpdateSignupForm{% endif %}"{% if middleware %} target="_blank"{% endif %} data-pageid="{{ pageID }}" data-middleware="{{ middleware }}" data-advfields="{{ advancedFields }}">
                {% if customNewSearch %}
                    <input type="hidden" name="idxsrp" value="{{ pageID }}" />
                {% endif %}
                {{ tools.mls({ force: true, includeBlank: true, blankDisplay: 'All', elementClass: 'IDX-select' }) }}
                <div id="IDX-coreSearchFields" class="IDX-row-content">
                    {% spaceless %}
                        <div id="IDX-pt-group" class="IDX-control-group {% if hiddenFields.pt %}IDX-hidden{% endif %}">
                            <div class="IDX-controls">
                                <label for="IDX-pt" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">{{ propTypes.displayName }}</label>
                                <select id="IDX-pt" class="IDX-select" name="pt" autocomplete="off">
                                    <option></option>
                                    {% for value, name in propTypes.values %}
                                        <option value="{{ value }}" {% if currentPt.0 == value %}selected="selected"{% endif %}>{{ name }}</option>
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                    {% endspaceless %}
                    {% spaceless %}
                        {% if cczListRules|length > 0 %}
                            {# Hidden inputs for custom city/county/zipcode lists. #}
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
                                                    <optgroup label="{{ cities.displayName }}" data-type="city">
                                                        {% for value, name in cities.values %}
                                                            <option value="{{ value }}" data-type="city">{{ name }}</option>
                                                        {% endfor %}
                                                    </optgroup>
                                                {% elseif ccz == 'county' %}
                                                    <optgroup label="{{ counties.displayName }}"  data-type="county">
                                                        {% for value, name in counties.values %}
                                                            <option value="{{ value }}" data-type="county">{{ name }}</option>
                                                        {% endfor %}
                                                    </optgroup>
                                                {% elseif ccz == 'zipcode' %}
                                                    <optgroup label="{{ zipcodes.displayName }}" data-type="zipcode">
                                                    {% for value, name in zipcodes.values %}
                                                        <option value="{{ value }}" data-type="zipcode">{{ name }}</option>
                                                    {% endfor %}
                                                    </optgroup>
                                                {% endif %}
                                            {% endfor %}
                                        </select>
                                    </div>
                                    <input type="text" name="ccz" id="IDX-ccz" class="IDX-hide">
                                </div>
                        {% endif %}
                        {# Address. #}
                        <div class="IDX-single" id="IDX-addressWrap">
                            <label for="IDX-address">Address</label>
                            <input type="text" id="IDX-address" name="aw_address">
                        </div>

                        {# Refinement. #}
                        {% if refinement %}
                            <div id="IDX-searchRefinement-group" class="IDX-control-group {% if hiddenFields.searchRefinement %}IDX-hidden{% endif %}">
                                <div class="IDX-controls">
                                    <label for="IDX-searchRefinement" class="{% if middleware %}IDX-control-label{% else %} IDX-label-for-nojs {% endif %}">Refinement</label>
                                    <select id="IDX-searchRefinement" name="searchRefinement" class="IDX-select" multiple="multiple">
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
                                <input type="text" class='IDX-hide' name="amin_photocount" value="">
                                <input type="text" class='IDX-hide' name="wvt" value="">
                                <input type="text" class='IDX-hide' name="woh" value="">
                                <input type="text" class='IDX-hide' name="fl" value="">
                            </div>
                        {% endif %}
                    {% endspaceless %}
                </div>
                <div id="IDX-action-buttons" class="IDX-row-content">
                    <button type="reset" id="IDX-formReset" class="IDX-btn IDX-btn-default">Reset</button>
                    <button type="submit" id="IDX-formSubmit" class="IDX-btn IDX-btn-primary">Search</button>
                </div>
            </form>
            <br class="IDX-clear" />

            {% if not middleware %}
                <div id="IDX-editSavedSearch" class="IDX-hide">
                    <div style="text-align:center;" id="IDX-editSavedSearchMessage"></div>
                </div>
                {# Only include the disclaimers frontend. #}
                {% include 'multipleMlsDisclaimers-1.000.twig' %}
            {% endif %}
        </div>
    {% endspaceless %}
{% endblock %}
