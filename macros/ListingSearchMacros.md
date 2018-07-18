# Listing ID Search Macros

These macros are for the default Listing ID template.

Assumes the following imports are in place

{% import "forms-1.001.twig" as form %}

{% import "searchTools-1.001.twig" as tools %}

As these may be referenced by macros below.

Logical twig elements such as ```{% if not middleware %}``` are not included as they do not return html elements. Nor are block definitions or spacesless. Nor are inline macros as they are self describing.


| Macro        | Creates           
| ------------- |:-------------:
| {% include 'multipleMlsDisclaimers-1.000.twig' %}     | ``` <div style="display:block; visibility:visible; text-align:center; padding:15px 0 10px 0;">Data services provided by <a href="http://www.idxbroker.com/" target="blank">IDX Broker</a></div> ```
|{% include 'navbar-1.000.twig' %} | ```<nav class="IDX-navbar IDX-navbar-default" role="navigation"><div class="IDX-container-navbar"><!-- Brand and toggle get grouped for better mobile display --><div class="IDX-navbar-header"><button type="button" class="IDX-navbar-toggle IDX-collapsed" data-toggle="idx-collapse" data-target="#IDX-navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="IDX-icon-bar"></span><span class="IDX-icon-bar"></span><span class="IDX-icon-bar"></span></button></div><!-- Collect the nav links, forms, and other content for toggling --><div class="IDX-collapse IDX-navbar-collapse" id="IDX-navbar-collapse"><ul class="IDX-nav IDX-navbar-nav"><li class="IDX-searchNavItem IDX-nav-advanced"><a href="https://eugenewebdevs.idxsandbox.com/idx/search/advanced" class="IDX-searchNavLink"><span>Advanced Search</span></a></li><li class="IDX-searchNavItem IDX-nav-listingid IDX-active"><a href="https://eugenewebdevs.idxsandbox.com/idx/search/listingid" class="IDX-searchNavLink"><span>Listing ID</span></a></li><li class="IDX-searchNavItem IDX-nav-address"><a href="https://eugenewebdevs.idxsandbox.com/idx/search/address" class="IDX-searchNavLink"><span>Address</span></a></li><li class="IDX-searchNavItem IDX-nav-mapsearch"><a href="https://eugenewebdevs.idxsandbox.com/idx/map/mapsearch" class="IDX-searchNavLink"><span>Map Search</span></a></li></ul></div><!-- /.navbar-collapse --></div><!-- /.container-fluid --></nav>```  
|{{ tools.listingID }} | ```<div id="IDX-listingID-group" class="IDX-control-group" data-role="fieldcontain"><label for="IDX-listingID" class="IDX-control-label">Listing ID</label><div class="IDX-controls"><input type="text" name="csv_listingID" id="IDX-listingID" value="" class="IDX-input" data-mini="true" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;"><p class="IDX-help-block">Enter up to 25 MLS numbers separated by commas, e.g., 34555867, 53457954, 54552147.</p></div></div>```
|{{ queryArray&#124;raw }}|```{"queryArray":{"page":"listingid","pctPreview":"3","stp":"m"}}```
|{{ defaultPriceData&#124;raw }} | ```{"min":{"bo":"200000","com":"200000","frm":"200000","mfr":"200000","sfr":"200000","rnt":"200000"},"max":{"bo":"800000","com":"800000","frm":"800000","mfr":"800000","sfr":"800000","rnt":"800000"}}```
