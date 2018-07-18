{# 
    So you want create your own details page design... and you thought it was going to be easy :P

    There's actually a lot of different scenarios for a details page, here's some requirements and 
    checklists we use when creating a new details page.

    Requirements:
    * address
    * price
    * listingID
    * fields: beds, baths (totalBaths, fullBaths, partialBaths), sqft, acres, propStatus
    * photo (called with macro so there's a consistent containing ID for MLS Rules, tools.photo() )
    * featured agent
    * virtual tours & open houses
    * share this
    * custom link
    * description / remarks
    * actions: save property, more info, print

    Conditionals:
    * idxStatus == 'active': schedule showing, mortgage calculator
    
    Checklist:
    * Works for specified widths
    * Printable Looks Good (?printable)
    * "MLS" is not displayed anywhere.
    * Acceptable for all prop types and various kinds of data
#}

{# -------------------------------------------------------------------------------------------------------------- #
    Step #1 - Import the IDX Tools for Faster Development, it's versioned so it will never break your design.
 # -------------------------------------------------------------------------------------------------------------- #}
{% import "detailsTools-1.000.twig" as idx %}

{# -------------------------------------------------------------------------------------------------------------- #
    Step #2 - Let's get some required fields on the page.
 # -------------------------------------------------------------------------------------------------------------- #}

{# ADDRESS 1: Quick way to get the address on the page #}
{{ tools.address }}

{# ADDRESS 2: You could get the address on the page using the data directly and put it in a H1 tag. #}
<h1>
    {{ address }} or {{ streetNumber }} {{ streetDirection }} {{ streetName }} {{ unitNumber }}
    {{ cityName }} {{ stateAbrv }} or {{ state }}, {{ zipcode }}
    {# Conditionally add the zip4 if it has a value #}
    {% if zip4 > 0 %}-{{ zip4 }} {% endif %}
</h1>

{# PRICE 1: Let's get the price on the page, we'll add a special class if it's sold for styling. #}
<div id="IDX-price"{% if idxStatus == 'sold' %} class="IDX-archive IDX-{{ propStatus }}"{% endif %}>
    <span id="IDX-price-label">{{ priceLabel }} </span>
    {# Some MLS's have a rule for adding something to the price, we'll do that as well. #}
    <span id="IDX-price-text">{{ priceDisplay }} {{ mlsRules.priceSuffix -}}</span>
</div>

{# PRICE 2: Getting the same price output above can be done with our price macro... #}
{{ idx.simplePrice }}

{# The field macro is a quick way to get a field taking into the client settings (as well) #}
{{ idx.fieldNew('listingID') }}
{{ idx.fieldNew('sqFt') }}
{{ idx.fieldNew('acres') }}

{# Labels could be behind the field by passing in some additional options #}
{{ tools.fieldNew('bedrooms', {labelAfter:true}) }}
{{ tools.fieldNew('fullBaths', {labelAfter:true}) }}
{{ tools.fieldNew('totalBaths', {labelAfter:true}) }}

{# If you only want to show acres if the value is greater than zero... #}
{{ tools.numericField('partialBaths') }}


{# -------------------------------------------------------------------------------------------------------------- #
    Step 3: Photos, let's make this page look good! Oh wait, it depends on the photos. 
 # -------------------------------------------------------------------------------------------------------------- #}

{# These all include the photo gallery link #}
{{ idx.photo('single') }}
{{ idx.photo('gallery') }}
{{ idx.photo('three') }}


{# Create your own primary photo markup. MUST have the ID of #IDX-detailsPropertyPhoto for MLS Rules #}
<div id="IDX-detailsPropertyPhoto">
    <img src="{{ imageData.1.url }}" />
</div>

{# Use Twig's for tag for getting the first three images...  #}
<div id="IDX-detailsPropertyPhoto">
    {% for i in 1..3 %}
        {% set img = attribute(imageData, i) %}
        <img src="{{ img.url }}" />
    {% endfor %}
</div>

{# Just a link to the photo gallery page #}
{{ idx.photoGalleryLink }} 

or create your own: 
{% if imageData.totalCount > 0 %}
    <a href="{{ photoGalleryLink }}" class="btn">View Photos</a>
{% endif %}

{# -------------------------------------------------------------------------------------------------------------- #
    Step 4: Featured Agents... Office account featured pages should have the selling agent's info display.
 # -------------------------------------------------------------------------------------------------------------- #}

{# This should be a macro... but for now you could do this.  #}
 {% if featured == 'y' %}
     {% include 'featuredAgent-1.000.twig' %}
 {% endif %}


{# -------------------------------------------------------------------------------------------------------------- #
    Step 5: Other important infomation.
 # -------------------------------------------------------------------------------------------------------------- #}

{{ idx.virtualTour }}
{{ idx.openHouse }}
{{ idx.showingLink }}
{{ idx.remarks }}
{{ idx.map }}
{{ idx.shareThis('div','idx-shareThis', {smallIcons:true}) }}
{{ idx.mapLocation }}

{# Links to: more info, schedule showing, printable version, virtual tour, open house, and map location #}
{{ idx.links }} 

{# -------------------------------------------------------------------------------------------------------------- #
    Step 6: Lead generation tools.
 # -------------------------------------------------------------------------------------------------------------- #}

{{ idx.saveProperty }}
{{ idx.bankRateTool }}
<a href="{{ moreInfoLink }}">More Info</a>
<a href="{{ scheduleShowingLink }}">Schedule Showing</a>
<a target="_blank" href="?printable=1">Printable Flyer</a>

{# -------------------------------------------------------------------------------------------------------------- #
    Step 7: The advanced fields.
 # -------------------------------------------------------------------------------------------------------------- #}
 
{{ tools.fieldContainers }}
