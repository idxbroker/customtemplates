# Search Results Macros

These macros are for the default Results template.

Assumes the following imports are in place

{% import _self as tools %}

{% import "mobileFirstRosterTools-1.001.twig" as rosterTools %}

As these may be referenced by macros below.

Logical twig elements such as ```{% if not middleware %}``` are not included as they do not return html elements. Nor are block definitions or spacesless elements. Nor are inline macros as they are pretty much self describing.

| Macro        | Creates           
| ------------- |:-------------:
|{{ rosterTools.agentBio(agentInfo) }} | ```<div id="IDX-agentbio" class="IDX-row IDX-agentbio IDX-agentbio__collapse"><div id="IDX-bioPanelWrapper" class="col-xs-12"><div class="IDX-panel IDX-panel-default IDX-rosterAgentPanel"><div class="IDX-panel-body IDX-bioPanelBody"><div class="IDX-row IDX-row__equal"><div class="col-md-4 IDX-bioInfo"><div class="IDX-row"><div class="col-xs-12"><img alt="" src="/images/missingAgent.png" class="IDX-img-responsive IDX-rosterAgentImage"><h3 class="IDX-bioName"></h3><ul id="IDX-agentInfo-group" class="IDX-agentInfo-group IDX-list-unstyled"></ul><ul class="IDX-list-unstyled IDX-actionLinks"><li class="IDX-rosterresultsEmailLink" role="presentation"></li><li class="IDX-rosterViewSoldListings"><a href="/soldPending" title="View Active Listings" class="IDX-rosterCategoryLink"><i class="fa fa-list-ul"></i>View Sold Listings</a></li></ul></div></div></div><div id="IDX-agent-bio-wrapper" class="col-md-8 IDX-agent-bio-wrapper"><div class="IDX-row IDX-agent-bio-inner"><div id="IDX-bioDetails" class="col-xs-12 IDX-flex-col IDX-bioDetails IDX-bioDetails__limited"><span class="IDX-bioDetails__inner" style=""></span></div></div><div id="IDX-bio-collapse" class="IDX-row IDX-hidden"><div class="col-xs-12 IDX-bioExpand IDX-text-center"><span class="IDX-bioExpand__text">Expand</span><i class="fa fa-angle-down IDX-bioExpand__icon"></i></div></div></div></div></div></div></div><div id="IDX-bioResultsWrapper"></div></div>```
|{{ totalResults }}| "500""
|{{ saveQueryString }}|"page%3Dlistings%26pctPreview%3D41"
|{{ searchPageID }}|"18489"
|{{ nav.newSearchLink }}|"https://testDomain.idxbroker.com/idx/search/listingid"
|{{ nav.modifySearchLink }}|"https://testDomain.idxbroker.com/idx/search/listingid?modifySearch=true"
|{{ display }}| Y
|{{ category }}|"results"
|{{ listing.idxID }}|a000
|{{ listing.idxStatus }}|active
|{{ listing.price }}|19575000
|{{ listing.listingID }}|1313251
|{{ listing.mlsPtID }}|1
|{{ listing.latitude }}|37.665157
|{{ listing.longitude }}|-116.025575
|{{ listing.detailsURL }}|https://testDomain.idxbroker.com/idx/details/listing/a000/1313251/123-Fake-Streeet
|{{ listing.streetNumber }}|123
|{{ listing.streetDirection }}|N
|{{ listing.streetName }}|Fake Street
|{{ listing.unitNumber }}|1
|{{ listing.cityName }}|Fake Town
|{{ listing.state }}|fakeState
|{{ listing.stateAbrv }}|FS
|{{ listing.zipcode }}|99999
|{{ listing.zip4 }}|1111
|{{ listing.primaryPhoto }}|https://media.thisMLS.com/mls/listingpics/bigphoto/051/1313251.jpg
|{{ listing.address }}|123 Fake Street
|{{ tools.field(listing,'listingID',labels.listingID) }}|```<div class="IDX-field-listingID IDX-field "><span class="IDX-label">Listing ID</span><span class="IDX-resultsText">1313251</span></div><div class="IDX-market IDX-resultsField">FMLS</div>```
|{{ listing.mls }}|a000
|{{ tools.field(listing, 'pricePerSqFt', labels.pricePerSqFt, { priceFormat: true }) }}|add html here
|{{ tools.field(listing, 'propStatus', labels.propStatus) }}|add html here
|{{ tools.field(listing, 'bedrooms', labels.bedrooms) }}|add html here
|{{ tools.baths(listing) }}|add html here
|{{ tools.checkNum(listing, 'sqFt', labels.sqFt) }}|add html here
|{{ tools.checkNum(listing, 'acres', labels.acres) }}|add html here
|{{ tools.field(listing, 'subdivision', labels.subdivision) }}|add html here
|{{ baseURL }}|"https://testDomain.idxbroker.com/idx/"
|{{ listing.image.totalCount }}|1
|listing.vtCount| 1
|{{ media.url }}| https://www.youtube.com/watch?v=qpMvS1Q1sos&list=PL628B1FFF96678C60&index=148
|{{ media.title }}| Virtual Tour
|{{ media.width&#124;default('800') }}|800
|{{ media.height&#124;default('600') }|600
|{{ media.text }}|Stuff and things
|listing.ohCount&#124;add| 1
|{{ listing.remarksConcat&#124;raw }}|```Location, location, location!! Where everybody wants to be, regional commerce center location with potential for immediate success and high returns!```
|{{ listing.logo&#124;raw }}|```<div class="IDX-MLSLogo"><img src="https://s3.amazonaws.com/staticos.idxbroker.com/mls-logos/a175-logoURL" width="100" height="50" border="0" alt="MLS Logo"></div>```
|{{ listing.courtesy&#124;raw }}|Listing courtesy of a Fake Office
|{{ listing.hopoZoning }}|<label>Hopo Zoning:</label>r2581403433
|{{ listing.listingSelectorCourtesy&#124;raw }}|
|{{ tools.resultsContent(category, resultData, orderByRule, orderByPropTypes, orderByPtField) }}|add html here
| {% include 'multipleMlsDisclaimers-1.000.twig' %}|```<div style="text-align:left; padding:10px 0;"><div style="float:left; padding-right:8px;"><img src="https://s3.amazonaws.com/staticos.idxbroker.com/mls-logos/a175-logoURL2" alt=""></div>The data relating to real estate for sale on this web site comes in part from the Internet Data Exchange (IDX) of the Lexington Bluegrass Multiple Listing System. Real estate listings held by brokerage firms other than DEMO - Antonio are marked with the IDX logo and detailed information about them includes the name of the listing brokers. The information being provided is for consumers' personal, non-commercial use and may not be used for any purpose other than to identify prospective properties consumers may be interested in purchasing. Information deemed reliable but is not guaranteed.</div>```
