# Advanced Search Macros

These macros are for the default Advanced Search template.

Assumes the following imports are in place

{% import "forms-1.001.twig" as form %}

{% import "searchTools-1.002.twig" as tools %}

As these may be referenced by macros below.

Logical twig elements such as ```{% if not middleware %}``` are not included as they do not return html elements. Nor are block definitions or spacesless. Nor are inline macros as they are self describing.

| Macro        | Creates           
| ------------- |:-------------:
|{% include 'navbar-1.000.twig' %}|```<nav class="IDX-navbar IDX-navbar-default" role="navigation"><div class="IDX-container-navbar"><!-- Brand and toggle get grouped for better mobile display --><div class="IDX-navbar-header"><button type="button" class="IDX-navbar-toggle IDX-collapsed" data-toggle="idx-collapse" data-target="#IDX-navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="IDX-icon-bar"></span><span class="IDX-icon-bar"></span><span class="IDX-icon-bar"></span></button></div><!-- Collect the nav links, forms, and other content for toggling --><div class="IDX-collapse IDX-navbar-collapse" id="IDX-navbar-collapse"><ul class="IDX-nav IDX-navbar-nav"><li class="IDX-searchNavItem IDX-nav-advanced IDX-active"><a href="https://testDomain.idxbroker.com/idx/search/advanced" class="IDX-searchNavLink"><span>Advanced Search</span></a></li><li class="IDX-searchNavItem IDX-nav-listingid"><a href="https://testDomain.idxbroker.com/idx/search/listingid" class="IDX-searchNavLink"><span>Listing ID</span></a></li><li class="IDX-searchNavItem IDX-nav-address"><a href="https://testDomain.idxbroker.com/idx/search/address" class="IDX-searchNavLink"><span>Address</span></a></li><li class="IDX-searchNavItem IDX-nav-mapsearch"><a href="https://testDomain.idxbroker.com/idx/map/mapsearch" class="IDX-searchNavLink"><span>Map Search</span></a></li></ul></div><!-- /.navbar-collapse --></div><!-- /.container-fluid --></nav>```
|{{pageSettings&#124;json_encode}}|```{"advancedFields":"on","queryArray":{"page":"advanced","pctPreview":"47","stp":"s"}}```
|{{cczListRules&#124;json_encode}}|```{"city":"City","county":"County","zipcode":"Postal Code"}```
|{{ mlsList&#124;json_encode }}|```{"a175":{"name":"Lexington Bluegrass MLS","shortName":"LBAR","soldActivated":"n","countryCode":"US","newAcqSys":"y","propTypes":{"1":"Business","2":"Commercial Land","3":"Comm\/Prof\/Industrial","4":"Farm & Lots","5":"Multi-Housing","6":"Residential","7":"Rent\/Lease"},"propSubTypes":{"1":["Manufacturing","Other","Restaurant\/Food","Retail","Service","Wholesale\/Distrib."],"2":["Commercial Land"],"3":["Business","Business\/Flex","Hotel\/Motel","Industrial","Mixed Use","Mobile Home Park","Office","Other","Recreation","Restaurant","Retail","Warehouse"],"4":["Farm","Lot"],"5":["Multi-Housing"],"6":["Condominium","Single Family Residence","Townhouse"],"7":["Apartment","Condominium","Single Family Residence","Townhouse"]},"ptData":{"1":{"id":1,"mlsPropertyType":"Business","propertyType":"Business Opportunity","pt":"bo","parentPtID":8,"bed":"n","bath":"n","multipleStreetFields":"y","availPropStatus":["Active"],"propSubTypes":["Manufacturing","Other","Restaurant\/Food","Retail","Service","Wholesale\/Distrib."],"allowedForDisplay":true},"2":{"id":2,"mlsPropertyType":"Commercial Land","propertyType":"Commercial","pt":"com","parentPtID":5,"bed":"n","bath":"n","multipleStreetFields":"y","availPropStatus":["Active"],"propSubTypes":["Commercial Land"],"allowedForDisplay":true},"3":{"id":3,"mlsPropertyType":"Comm\/Prof\/Industrial","propertyType":"Commercial","pt":"com","parentPtID":5,"bed":"n","bath":"n","multipleStreetFields":"y","availPropStatus":["Active"],"propSubTypes":["Business","Business\/Flex","Hotel\/Motel","Industrial","Mixed Use","Mobile Home Park","Office","Other","Recreation","Restaurant","Retail","Warehouse"],"allowedForDisplay":true},"4":{"id":4,"mlsPropertyType":"Farm & Lots","propertyType":"Farms","pt":"frm","parentPtID":4,"bed":"y","bath":"y","multipleStreetFields":"y","availPropStatus":["Active"],"propSubTypes":["Farm","Lot"],"allowedForDisplay":true},"5":{"id":5,"mlsPropertyType":"Multi-Housing","propertyType":"Multifamily Residential","pt":"mfr","parentPtID":2,"bed":"y","bath":"y","multipleStreetFields":"y","availPropStatus":["Active"],"propSubTypes":["Multi-Housing"],"allowedForDisplay":true},"6":{"id":6,"mlsPropertyType":"Residential","propertyType":"Single Family Residential","pt":"sfr","parentPtID":1,"bed":"y","bath":"y","multipleStreetFields":"y","availPropStatus":["Active"],"propSubTypes":["Condominium","Single Family Residence","Townhouse"],"allowedForDisplay":true},"7":{"id":7,"mlsPropertyType":"Rent\/Lease","propertyType":"Rentals","pt":"rnt","parentPtID":3,"bed":"y","bath":"y","multipleStreetFields":"y","availPropStatus":["Active"],"propSubTypes":["Apartment","Condominium","Single Family Residence","Townhouse"],"allowedForDisplay":true}}}}```
|{{ currentScript }}|search
|{{ pageID }}|18486
|{{ middleware }}|
|{{ advancedFields }}|1
|{{ idxID }}|1
|{{propTypes.displayName}}|Property Type
|{{subTypes.displayName}}|Property Sub Type
|{{statuses.displayName}}|Status
|{{ searchLoader.clientLogo }}|https://s3.amazonaws.com/clientphotos.idxbroker.com/clientLogo/clientLogo-809
|{% include 'multipleMlsDisclaimers-1.000.twig' %}|
|{{ queryArray&#124;raw }}|{"queryArray":{"page":"advanced","pctPreview":"47","stp":"s"}}
|{{ defaultPriceData&#124;raw }}|{"min":{"1":"200000","2":"200000","3":"200000","4":"200000","5":"200000","6":"200000","7":"200000"},"max":{"1":"800000","2":"800000","3":"800000","4":"800000","5":"800000","6":"800000","7":"800000"}}
