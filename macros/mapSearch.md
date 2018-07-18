# Map Search Macros

These macros are for the default Listing ID template.

Assumes the following imports are in place

{# mobileFirstMapsearch-1.002.twig #}

As these may be referenced by macros below.

Logical twig elements such as ```{% if not middleware %}``` are not included as they do not return html elements. Nor are block definitions or spacesless. Nor are inline macros as they are self describing.

| Macro        | Creates           
| ------------- |:-------------:
|{% include 'navbar-1.000.twig' %}|```<nav class="IDX-navbar IDX-navbar-default" role="navigation"><div class="IDX-container-navbar"><!-- Brand and toggle get grouped for better mobile display --><div class="IDX-navbar-header"><button type="button" class="IDX-navbar-toggle IDX-collapsed" data-toggle="idx-collapse" data-target="#IDX-navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="IDX-icon-bar"></span><span class="IDX-icon-bar"></span><span class="IDX-icon-bar"></span></button></div><!-- Collect the nav links, forms, and other content for toggling --><div class="IDX-collapse IDX-navbar-collapse" id="IDX-navbar-collapse"><ul class="IDX-nav IDX-navbar-nav"><li class="IDX-searchNavItem IDX-nav-advanced"><a href="https://testDomain.idxbroker.com/idx/search/advanced" class="IDX-searchNavLink"><span>Advanced Search</span></a></li><li class="IDX-searchNavItem IDX-nav-listingid"><a href="https://testDomain.idxbroker.com/idx/search/listingid" class="IDX-searchNavLink"><span>Listing ID</span></a></li><li class="IDX-searchNavItem IDX-nav-address"><a href="https://testDomain.idxbroker.com/idx/search/address" class="IDX-searchNavLink"><span>Address</span></a></li><li class="IDX-searchNavItem IDX-nav-mapsearch IDX-active"><a href="https://testDomain.idxbroker.com/idx/map/mapsearch" class="IDX-searchNavLink"><span>Map Search</span></a></li></ul></div><!-- /.navbar-collapse --></div><!-- /.container-fluid --></nav>```
|{{ minPrice.displayName }}|Min Price
|{{ maxPrice.displayName }}|Max Price
|{% include 'mobileFirstMapSearchForm-1.002.twig' %}|```<div class="IDX-criteriaLeft"><input type="hidden" name="idxID" value="a175"><div id="IDX-bedrooms-group" class="IDX-slider"><label for="IDX-bedrooms">Bedrooms:<span id="IDX-numBedrooms">Any</span></label><select name="bd" id="IDX-bedrooms" style="display: none;"><option value="0" selected="selected">0+</option><option value="1">1+</option><option value="2">2+</option><option value="3">3+</option><option value="4">4+</option><option value="5">5+</option><option value="6">6+</option><option value="7">7+</option><option value="8">8+</option><option value="9">9+</option></select><div id="IDX-bedrooms-slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-slider-range-min ui-widget-header" style="width: 0%;"></div><a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></a></div><script>idx(function(){var idxBedroomsSelect=idx('#IDX-bedrooms');var idxBedroomsNumDisplay=idx('#IDX-numBedrooms');var idxBedroomsSlider=idx('<div id="IDX-bedrooms-slider"></div>').insertAfter(idxBedroomsSelect).slider({min:0,max:9,range:"min",value:idxBedroomsSelect[0].selectedIndex,slide:function(event,ui){var value=ui.value;idxBedroomsSelect[0].selectedIndex=value;idxBedroomsSelect.val(value);var display=(value==0)?'Any':value+'+';idxBedroomsNumDisplay.html(display)},create:function(event,ui){var value=idxBedroomsSelect.val();var display=(value==0)?'Any':value+'+';idxBedroomsNumDisplay.html(display)}});idx("#IDX-bedrooms").change(function(){idxBedroomsSlider.slider("value",this.selectedIndex)});idxBedroomsSelect.hide()});</script></div><div id="IDX-bathrooms-group" class="IDX-slider"><label for="IDX-bathrooms">Total Baths:<span id="IDX-numBathrooms">Any</span></label><select name="tb" id="IDX-bathrooms" style="display: none;"><option value="0" selected="selected">0+</option><option value="1">1+</option><option value="2">2+</option><option value="3">3+</option><option value="4">4+</option><option value="5">5+</option><option value="6">6+</option><option value="7">7+</option><option value="8">8+</option><option value="9">9+</option></select><div id="IDX-bathrooms-slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-slider-range-min ui-widget-header" style="width: 0%;"></div><a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></a></div><script>idx(function(){var idxBathroomsSelect=idx('#IDX-bathrooms');var idxBathroomsNumDisplay=idx('#IDX-numBathrooms');var idxBathroomsSlider=idx('<div id="IDX-bathrooms-slider"></div>').insertAfter(idxBathroomsSelect).slider({min:0,max:9,range:"min",value:idxBathroomsSelect[0].selectedIndex,slide:function(event,ui){var value=ui.value;idxBathroomsSelect[0].selectedIndex=value;idxBathroomsSelect.val(value);var display=(value==0)?'Any':value+'+';idxBathroomsNumDisplay.html(display)},create:function(event,ui){var value=idxBathroomsSelect.val();var display=(value==0)?'Any':value+'+';idxBathroomsNumDisplay.html(display)}});idx("#IDX-bathrooms").change(function(){idxBathroomsSlider.slider("value",this.selectedIndex)});idxBathroomsSelect.hide()});</script></div><div id="IDX-propStatus-group" class="IDX-control-group"><label for="IDX-propStatus" class="IDX-control-label">Status</label><div class="IDX-controls"><select id="IDX-propStatus" name="a_propStatus[]" class="IDX-select " autocomplete="off" multiple="multiple" data-native-menu="false" size="4"><option value="Active">Active</option></select></div></div><div id="IDX-allStatuses" style="display:none !important;">{"1":["Active"],"2":["Active"],"3":["Active"],"4":["Active"],"5":["Active"],"6":["Active"],"7":["Active"]}</div></div><div class="IDX-criteriaRight"><div id="IDX-pt-group" class="IDX-control-group"><label for="IDX-pt" class="IDX-control-label">Property Type</label><div class="IDX-controls"><select id="IDX-pt" name="pt" class="IDX-select IDX-searchType-s" autocomplete="off"><option value="">All</option><option value="1">Business</option><option value="2">Commercial Land</option><option value="3">Comm/Prof/Industrial</option><option value="4">Farm&amp;Lots</option><option value="5">Multi-Housing</option><option value="6">Residential</option><option value="7">Rent/Lease</option></select></div></div><div id="IDX-sqft-group" class="IDX-control-group" data-role="fieldcontain"><label for="IDX-sqft" class="IDX-control-label">SqFt</label><div class="IDX-controls"><input type="text" name="sqft" id="IDX-sqft" value="" class="IDX-input" data-mini="true" placeholder="SqFt" onfocus="this.placeholder = ''" onblur="this.placeholder = 'SqFt'"></div></div><div id="IDX-add-group" class="IDX-control-group" data-role="fieldcontain"><label for="IDX-add" class="IDX-control-label">Max Days Listed</label><div class="IDX-controls"><input type="text" name="add" id="IDX-add" value="" class="IDX-input" data-mini="true" placeholder="Max Days Listed" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Max Days Listed'"></div></div><div id="IDX-acres-group" class="IDX-control-group" data-role="fieldcontain"><label for="IDX-acres" class="IDX-control-label">Acres</label><div class="IDX-controls"><input type="text" name="acres" id="IDX-acres" value="" class="IDX-input" data-mini="true" placeholder="Acres" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Acres'"></div></div><div id="IDX-map-ccz"><div id="IDX-city-group" class="IDX-control-group IDX-cczList IDX-active"><div class="IDX-controls"><select id="IDX-city" name="city" class="IDX-select IDX-cczSelect" autocomplete="off" onchange="flyTo(this.name, this.value);"><option value="">Fly to City</option><option value="341">Ages Brookside</option><option value="457">Albany</option><option value="1294">Annville</option><option value="1707">Artemus</option><option value="1793">Ashland</option><option value="2014">Auburn</option><option value="2050">Augusta</option><option value="2293">Bagdad</option><option value="2544">Barbourville</option><option value="2556">Bardstown</option><option value="2870">Baxter</option><option value="3120">Beattyville</option><option value="3243">Bee Spring</option><option value="3332">Belfry</option><option value="3702">Berea</option><option value="3795">Berry</option><option value="3936">Beverly</option><option value="4003">Big Creek</option><option value="4126">Bimble</option><option value="4415">Bledsoe</option><option value="4461">Bloomfield</option><option value="4978">Booneville</option><option value="5045">Boston</option><option value="5157">Bowling Green</option><option value="5785">Brodhead</option><option value="5812">Bronston</option><option value="5910">Brooksville</option><option value="6358">Burgin</option><option value="6372">Burkesville</option><option value="6398">Burlington</option><option value="6457">Burnside</option><option value="6685">Cadiz</option><option value="6834">Calvert City</option><option value="7005">Campbellsville</option><option value="7021">Campton</option><option value="7096">Cannon</option><option value="7305">Carlisle</option><option value="7444">Carrollton</option><option value="7698">Catlettsburg</option><option value="7736">Cawood</option><option value="7763">Cecilia</option><option value="7911">Center</option><option value="7974">Centertown</option><option value="8020">Central City</option><option value="9023">Clay City</option><option value="9097">Clearfield</option><option value="9586">Coldiron</option><option value="9810">Columbia</option><option value="10063">Connersville</option><option value="10257">Corbin</option><option value="10292">Corinth</option><option value="10592">Covington</option><option value="10633">Coxs Creek</option><option value="10650">Crab Orchard</option><option value="10724">Cranks</option><option value="10846">Crestwood</option><option value="11136">Cumberland</option><option value="11280">Cynthiana</option><option value="11490">Danville</option><option value="12012">Demossville</option><option value="12059">Denniston</option><option value="12215">Dewitt</option><option value="12403">Dixon</option><option value="12811">Dry Ridge</option><option value="13034">Dunnville</option><option value="13270">East Bernstadt</option><option value="13947">Edmonton</option><option value="14044">Ekron</option><option value="14230">Elizabethtown</option><option value="14293">Elkhorn City</option><option value="14315">Elkton</option><option value="14527">Elsmere</option><option value="15034">Eubank</option><option value="15127">Evarts</option><option value="15178">Ewing</option><option value="15332">Ezel</option><option value="15607">Falmouth</option><option value="15661">Farmers</option><option value="15871">Ferguson</option><option value="15971">Finchville</option><option value="16112">Flat Lick</option><option value="16122">Flatgap</option><option value="16149">Flemingsburg</option><option value="16211">Florence</option><option value="16863">Frankfort</option><option value="16880">Franklin</option><option value="17075">Frenchburg</option><option value="17233">Fulton</option><option value="17749">Georgetown</option><option value="17965">Girdler</option><option value="18007">Glasgow</option><option value="18862">Grassy Creek</option><option value="18882">Gravel Switch</option><option value="18898">Gray</option><option value="18927">Grayson</option><option value="20072">Hardinsburg</option><option value="20108">Harlan</option><option value="20150">Harold</option><option value="20252">Harrodsburg</option><option value="20273">Hartford</option><option value="20595">Hazard</option><option value="20604">Hazel Green</option><option value="20730">Heidrick</option><option value="20785">Helton</option><option value="20814">Henderson</option><option value="21278">Hillsboro</option><option value="21355">Hindman</option><option value="21370">Hinkle</option><option value="22078">Huddy</option><option value="22321">Hustonville</option><option value="22360">Hyden</option><option value="22588">Inez</option><option value="22778">Irvine</option><option value="22789">Irvington</option><option value="22927">Jackson</option><option value="23030">Jamestown</option><option value="23243">Jeffersonville</option><option value="23596">Junction City</option><option value="23799">Keavy</option><option value="24297">Kings Mountain</option><option value="24946">Lagrange</option><option value="25448">Lancaster</option><option value="25528">Langley</option><option value="25800">Lawrenceburg</option><option value="25913">Lebanon</option><option value="25996">Leesburg</option><option value="26314">Lexington</option><option value="26348">Liberty</option><option value="26437">Lily</option><option value="26830">Livingston</option><option value="27042">London</option><option value="27321">Louisa</option><option value="27336">Louisville</option><option value="27462">Loyall</option><option value="27669">Lynch</option><option value="27825">Mackville</option><option value="27947">Magnolia</option><option value="28110">Manchester</option><option value="29007">Mayfield</option><option value="29048">Mayslick</option><option value="29054">Maysville</option><option value="29201">Mc Kee</option><option value="29481">Means</option><option value="29601">Melbourne</option><option value="29993">Middleburg</option><option value="30016">Middlesboro</option><option value="30105">Midway</option><option value="30290">Millersburg</option><option value="30569">Miracle</option><option value="30967">Monticello</option><option value="31144">Morehead</option><option value="31451">Mount Eden</option><option value="31532">Mount Olivet</option><option value="31612">Mount Vernon</option><option value="61893">Mt Sterling</option><option value="31803">Munfordville</option><option value="57879">N Middletown</option><option value="31950">Nancy</option><option value="32486">New Haven</option><option value="32548">New Liberty</option><option value="32958">Nicholasville</option><option value="34221">Oil Springs</option><option value="34405">Olive Hill</option><option value="34453">Olympia</option><option value="34509">Oneida</option><option value="35008">Owensboro</option><option value="35014">Owenton</option><option value="35017">Owingsville</option><option value="35125">Paducah</option><option value="35156">Paint Lick</option><option value="35168">Paintsville</option><option value="35471">Paris</option><option value="35573">Parksville</option><option value="35665">Partridge</option><option value="35732">Pathfork</option><option value="36045">Pendleton</option><option value="36243">Perryville</option><option value="36360">Phelps</option><option value="36420">Phyllis</option><option value="36525">Pikeville</option><option value="36619">Pine Knot</option><option value="36641">Pine Ridge</option><option value="36712">Pineville</option><option value="36761">Pinsonfork</option><option value="37074">Pleasureville</option><option value="37824">Prestonsburg</option><option value="37883">Princeton</option><option value="38102">Putney</option><option value="38536">Ravenna</option><option value="39254">Richmond</option><option value="39421">Rineyville</option><option value="39709">Robinson Creek</option><option value="39855">Rockholds</option><option value="39985">Rogers</option><option value="40593">Russell Springs</option><option value="40731">Sadieville</option><option value="41141">Salt Lick</option><option value="41170">Salvisa</option><option value="41173">Salyersville</option><option value="41360">Sandgap</option><option value="41403">Sandy Hook</option><option value="41798">Science Hill</option><option value="42433">Sharpsburg</option><option value="42511">Shelbiana</option><option value="42537">Shelbyville</option><option value="42607">Shepherdsville</option><option value="43041">Simpsonville</option><option value="43095">Sitka</option><option value="43156">Slade</option><option value="43240">Smith</option><option value="43464">Somerset</option><option value="43934">Southgate</option><option value="44007">Sparta</option><option value="44252">Springfield</option><option value="44387">Stamping Ground</option><option value="44413">Stanford</option><option value="44443">Stanton</option><option value="44456">Stanville</option><option value="45048">Strunk</option><option value="45921">Taylor Mill</option><option value="45934">Taylorsville</option><option value="46586">Tollesboro</option><option value="46712">Totz</option><option value="47301">Tyner</option><option value="47631">Upton</option><option value="48767">Vanceburg</option><option value="48769">Vancleve</option><option value="48971">Verona</option><option value="48989">Versailles</option><option value="49397">Virgie</option><option value="49523">Waco</option><option value="49535">Waddy</option><option value="49747">Wallingford</option><option value="49752">Wallins</option><option value="50356">Waynesburg</option><option value="50533">Wellington</option><option value="50933">West Liberty</option><option value="51643">Whitesburg</option><option value="51688">Whitley City</option><option value="51742">Wickliffe</option><option value="51894">Williamsburg</option><option value="51925">Williamstown</option><option value="51953">Willisburg</option><option value="52045">Wilmore</option><option value="52124">Winchester</option><option value="52173">Windsor</option><option value="52474">Woodbine</option><option value="52658">Woollum</option><option value="52701">Worthington</option></select></div></div><div id="IDX-county-group" class="IDX-control-group IDX-cczList"><div class="IDX-controls"><select id="IDX-county" name="county" class="IDX-select IDX-cczSelect" autocomplete="off" onchange="flyTo(this.name, this.value);"><option value="">Fly to County</option><option value="2293">Adair</option><option value="3228">Anderson</option><option value="1596">Ballard</option><option value="248">Barren</option><option value="1967">Bath</option><option value="1223">Bell</option><option value="1795">Boone</option><option value="2737">Bourbon</option><option value="1327">Boyd</option><option value="2882">Boyle</option><option value="267">Bracken</option><option value="877">Breathitt</option><option value="1500">Breckinridge</option><option value="2357">Bullitt</option><option value="3089">Caldwell</option><option value="642">Campbell</option><option value="2576">Carroll</option><option value="1434">Carter</option><option value="1969">Casey</option><option value="3056">Clark</option><option value="2005">Clay</option><option value="250">Clinton</option><option value="1567">Cumberland</option><option value="2862">Daviess</option><option value="1807">Edmonson</option><option value="2381">Elliott</option><option value="2747">Estill</option><option value="3233">Fayette</option><option value="1571">Fleming</option><option value="700">Floyd</option><option value="3081">Franklin</option><option value="2607">Fulton</option><option value="3115">Gallatin</option><option value="2394">Garrard</option><option value="2246">Grant</option><option value="1839">Graves</option><option value="1201">Greenup</option><option value="2020">Hardin</option><option value="465">Harlan</option><option value="1949">Harrison</option><option value="2198">Hart</option><option value="1683">Henderson</option><option value="1972">Henry</option><option value="1069">Jackson</option><option value="998">Jefferson</option><option value="3207">Jessamine</option><option value="1646">Johnson</option><option value="1400">Kenton</option><option value="1000">Knott</option><option value="1288">Knox</option><option value="2412">Larue</option><option value="2470">Laurel</option><option value="364">Lawrence</option><option value="1773">Lee</option><option value="1319">Leslie</option><option value="2073">Letcher</option><option value="2467">Lewis</option><option value="2833">Lincoln</option><option value="359">Logan</option><option value="1934">Madison</option><option value="1962">Magoffin</option><option value="2257">Marion</option><option value="1445">Marshall</option><option value="1781">Martin</option><option value="2824">Mason</option><option value="1495">McCracken</option><option value="1986">McCreary</option><option value="1717">Meade</option><option value="2915">Menifee</option><option value="2189">Mercer</option><option value="1777">Metcalfe</option><option value="3200">Montgomery</option><option value="2090">Morgan</option><option value="1812">Muhlenberg</option><option value="1621">Nelson</option><option value="2566">Nicholas</option><option value="1791">Ohio</option><option value="1581">Oldham</option><option value="3133">Owen</option><option value="2204">Owsley</option><option value="2368">Pendleton</option><option value="505">Perry</option><option value="442">Pike</option><option value="2226">Powell</option><option value="334">Pulaski</option><option value="3210">Robertson</option><option value="2336">Rockcastle</option><option value="2720">Rowan</option><option value="2392">Russell</option><option value="3108">Scott</option><option value="1531">Shelby</option><option value="3083">Simpson</option><option value="3268">Spencer</option><option value="2539">Taylor</option><option value="697">Todd</option><option value="2138">Trigg</option><option value="709">Warren</option><option value="3245">Washington</option><option value="1659">Wayne</option><option value="2075">Webster</option><option value="2813">Whitley</option><option value="1963">Wolfe</option><option value="3263">Woodford</option></select></div></div><div id="IDX-zipcode-group" class="IDX-control-group IDX-cczList"><div class="IDX-controls"><select id="IDX-zipcode" name="zipcode" class="IDX-select IDX-cczSelect" autocomplete="off" onchange="flyTo(this.name, this.value);"><option value="">Fly to Postal Code</option><option value="40003">40003</option><option value="40004">40004</option><option value="40008">40008</option><option value="40013">40013</option><option value="40014">40014</option><option value="40022">40022</option><option value="40031">40031</option><option value="40033">40033</option><option value="40040">40040</option><option value="40046">40046</option><option value="40051">40051</option><option value="40055">40055</option><option value="40057">40057</option><option value="40065">40065</option><option value="40067">40067</option><option value="40069">40069</option><option value="40071">40071</option><option value="40076">40076</option><option value="40078">40078</option><option value="40079">40079</option><option value="40107">40107</option><option value="40117">40117</option><option value="40140">40140</option><option value="40146">40146</option><option value="40162">40162</option><option value="40165">40165</option><option value="40204">40204</option><option value="40207">40207</option><option value="40215">40215</option><option value="40223">40223</option><option value="40245">40245</option><option value="40261">40261</option><option value="40272">40272</option><option value="40291">40291</option><option value="40299">40299</option><option value="40310">40310</option><option value="40311">40311</option><option value="40312">40312</option><option value="40313">40313</option><option value="40316">40316</option><option value="40319">40319</option><option value="40322">40322</option><option value="40324">40324</option><option value="40328">40328</option><option value="40330">40330</option><option value="40336">40336</option><option value="40337">40337</option><option value="40340">40340</option><option value="40342">40342</option><option value="40343">40343</option><option value="40346">40346</option><option value="40347">40347</option><option value="40348">40348</option><option value="40350">40350</option><option value="40351">40351</option><option value="40353">40353</option><option value="40355">40355</option><option value="40356">40356</option><option value="40357">40357</option><option value="40358">40358</option><option value="40359">40359</option><option value="40360">40360</option><option value="40361">40361</option><option value="40363">40363</option><option value="40369">40369</option><option value="40370">40370</option><option value="40371">40371</option><option value="40372">40372</option><option value="40374">40374</option><option value="40376">40376</option><option value="40379">40379</option><option value="40380">40380</option><option value="40383">40383</option><option value="40385">40385</option><option value="40387">40387</option><option value="40390">40390</option><option value="40391">40391</option><option value="40392">40392</option><option value="40394">40394</option><option value="40402">40402</option><option value="40403">40403</option><option value="40409">40409</option><option value="40411">40411</option><option value="40419">40419</option><option value="40422">40422</option><option value="40432">40432</option><option value="40436">40436</option><option value="40437">40437</option><option value="40440">40440</option><option value="40442">40442</option><option value="40444">40444</option><option value="40445">40445</option><option value="40446">40446</option><option value="40447">40447</option><option value="40448">40448</option><option value="40456">40456</option><option value="40458">40458</option><option value="40459">40459</option><option value="40461">40461</option><option value="40464">40464</option><option value="40468">40468</option><option value="40472">40472</option><option value="40475">40475</option><option value="40481">40481</option><option value="40484">40484</option><option value="40486">40486</option><option value="40489">40489</option><option value="40502">40502</option><option value="40503">40503</option><option value="40504">40504</option><option value="40505">40505</option><option value="40507">40507</option><option value="40508">40508</option><option value="40509">40509</option><option value="40510">40510</option><option value="40511">40511</option><option value="40513">40513</option><option value="40514">40514</option><option value="40515">40515</option><option value="40516">40516</option><option value="40517">40517</option><option value="40536">40536</option><option value="40555">40555</option><option value="40569">40569</option><option value="40601">40601</option><option value="40602">40602</option><option value="40604">40604</option><option value="40701">40701</option><option value="40729">40729</option><option value="40734">40734</option><option value="40737">40737</option><option value="40740">40740</option><option value="40741">40741</option><option value="40743">40743</option><option value="40744">40744</option><option value="40759">40759</option><option value="40762">40762</option><option value="40769">40769</option><option value="40771">40771</option><option value="40801">40801</option><option value="40806">40806</option><option value="40807">40807</option><option value="40810">40810</option><option value="40815">40815</option><option value="40819">40819</option><option value="40820">40820</option><option value="40823">40823</option><option value="40824">40824</option><option value="40828">40828</option><option value="40831">40831</option><option value="40840">40840</option><option value="40854">40854</option><option value="40855">40855</option><option value="40856">40856</option><option value="40862">40862</option><option value="40863">40863</option><option value="40865">40865</option><option value="40870">40870</option><option value="40873">40873</option><option value="40902">40902</option><option value="40903">40903</option><option value="40905">40905</option><option value="40906">40906</option><option value="40913">40913</option><option value="40914">40914</option><option value="40915">40915</option><option value="40921">40921</option><option value="40923">40923</option><option value="40927">40927</option><option value="40931">40931</option><option value="40935">40935</option><option value="40939">40939</option><option value="40943">40943</option><option value="40944">40944</option><option value="40949">40949</option><option value="40953">40953</option><option value="40962">40962</option><option value="40965">40965</option><option value="40972">40972</option><option value="40977">40977</option><option value="40979">40979</option><option value="40982">40982</option><option value="40997">40997</option><option value="41002">41002</option><option value="41003">41003</option><option value="41004">41004</option><option value="41005">41005</option><option value="41006">41006</option><option value="41008">41008</option><option value="41009">41009</option><option value="41010">41010</option><option value="41014">41014</option><option value="41015">41015</option><option value="41018">41018</option><option value="41031">41031</option><option value="41033">41033</option><option value="41035">41035</option><option value="41039">41039</option><option value="41040">41040</option><option value="41041">41041</option><option value="41042">41042</option><option value="41045">41045</option><option value="41049">41049</option><option value="41055">41055</option><option value="41056">41056</option><option value="41059">41059</option><option value="41061">41061</option><option value="41064">41064</option><option value="41071">41071</option><option value="41083">41083</option><option value="41086">41086</option><option value="41092">41092</option><option value="41093">41093</option><option value="41097">41097</option><option value="41101">41101</option><option value="41129">41129</option><option value="41143">41143</option><option value="41164">41164</option><option value="41171">41171</option><option value="41173">41173</option><option value="41179">41179</option><option value="41183">41183</option><option value="41189">41189</option><option value="41219">41219</option><option value="41230">41230</option><option value="41238">41238</option><option value="41240">41240</option><option value="41250">41250</option><option value="41255">41255</option><option value="41301">41301</option><option value="41311">41311</option><option value="41314">41314</option><option value="41332">41332</option><option value="41339">41339</option><option value="41352">41352</option><option value="41360">41360</option><option value="41365">41365</option><option value="41385">41385</option><option value="41386">41386</option><option value="41403">41403</option><option value="41425">41425</option><option value="41465">41465</option><option value="41472">41472</option><option value="41479">41479</option><option value="41501">41501</option><option value="41514">41514</option><option value="41522">41522</option><option value="41528">41528</option><option value="41553">41553</option><option value="41554">41554</option><option value="41555">41555</option><option value="41560">41560</option><option value="41562">41562</option><option value="41572">41572</option><option value="41645">41645</option><option value="41653">41653</option><option value="41659">41659</option><option value="41701">41701</option><option value="41722">41722</option><option value="41749">41749</option><option value="41776">41776</option><option value="41822">41822</option><option value="41828">41828</option><option value="41835">41835</option><option value="41858">41858</option><option value="42001">42001</option><option value="42029">42029</option><option value="42041">42041</option><option value="42079">42079</option><option value="42087">42087</option><option value="42101">42101</option><option value="42129">42129</option><option value="42133">42133</option><option value="42134">42134</option><option value="42141">42141</option><option value="42206">42206</option><option value="42207">42207</option><option value="42211">42211</option><option value="42214">42214</option><option value="42220">42220</option><option value="42301">42301</option><option value="42303">42303</option><option value="42328">42328</option><option value="42330">42330</option><option value="42347">42347</option><option value="42409">42409</option><option value="42420">42420</option><option value="42445">42445</option><option value="42501">42501</option><option value="42503">42503</option><option value="42518">42518</option><option value="42519">42519</option><option value="42528">42528</option><option value="42539">42539</option><option value="42541">42541</option><option value="42544">42544</option><option value="42549">42549</option><option value="42553">42553</option><option value="42565">42565</option><option value="42567">42567</option><option value="42602">42602</option><option value="42628">42628</option><option value="42629">42629</option><option value="42631">42631</option><option value="42633">42633</option><option value="42634">42634</option><option value="42635">42635</option><option value="42642">42642</option><option value="42653">42653</option><option value="42701">42701</option><option value="42717">42717</option><option value="42718">42718</option><option value="42724">42724</option><option value="42728">42728</option><option value="42757">42757</option><option value="42765">42765</option><option value="42784">42784</option><option value="43031">43031</option><option value="44168">44168</option><option value="45060">45060</option><option value="45159">45159</option><option value="49351">49351</option><option value="49356">49356</option></select></div></div><div id="IDX-cczController"><div class="IDX-form-group"><span data-flytoname="city" class="IDX-flyTo IDX-label IDX-label-default IDX-active " onclick="flyToToggle(this);">City</span><span data-flytoname="county" class="IDX-flyTo IDX-label IDX-label-default " onclick="flyToToggle(this);">County</span><span data-flytoname="zipcode" class="IDX-flyTo IDX-label IDX-label-default " onclick="flyToToggle(this);">Postal Code</span></div></div></div></div><div id="IDX-refinementSearchHidden" class="hidden"><input type="hidden" name="ublat" id="IDX-ublat" value="0"><input type="hidden" name="ublong" id="IDX-ublong" value="0"><input type="hidden" name="lblat" id="IDX-lblat" value="0"><input type="hidden" name="lblong" id="IDX-lblong" value="0"><input type="hidden" name="centerlat" id="IDX-centerlat" value="0"><input type="hidden" name="centerlong" id="IDX-centerlong" value="0"><input type="hidden" name="zoom" id="IDX-zoom" value="0"><input type="hidden" name="mapType" id="IDX-mapType" value="0"><input type="hidden" name="pgon" id="IDX-pgon" value=""><input type="hidden" name="layerType" id="IDX-layerType" value=""><input type="hidden" name="clat" id="IDX-clat" value=""><input type="hidden" name="clng" id="IDX-clng" value=""><input type="hidden" name="mapCenterLat" id="IDX-mapCenterLat" value=""><input type="hidden" name="mapCenterLong" id="IDX-mapCenterLong" value=""><input type="hidden" name="radius" id="IDX-radius" value=""></div><div class="IDX-clearfix"></div><div class="IDX-row"><div class="col-lg-12"><button type="submit" id="IDX-formSubmit" class="IDX-btn IDX-btn-block IDX-btn-default"><i class="fa fa-refresh"></i>&nbsp;<span>Update Search</span></button></div></div>```
|{{ mapData&#124;json_encode&#124;raw }}|```{"mobile":false,"middleware":false,"mapKey":null,"mapEngine":"mapquest","clientAppDomain":"https:\/\/testDomain.idxbroker.com","uniqueID":"","mapSourceJS":["\/\/staticos.idxsandbox.com\/graphical\/javascript\/leaflet.js","\/\/staticos.idxsandbox.com\/graphical\/frontend\/javascript\/maps\/plugins\/leaflet.draw.js","\/\/www.mapquestapi.com\/sdk\/leaflet\/v2.2\/mq-map.js?key=APIKEY"],"mapClustering":false,"mapClusteringMobile":false,"autoRefresh":false,"metric":false,"mapCenterLat":"40.790479","mapCenterLong":"-73.972819","zoomLevel":"13","mapType":"Map","pinType":"","pageID":18494,"currentPage":"mapsearch.php","mapEngineTemplate":"mapquest.twig","mapUse":"search","cdn":{},"cdnDomain":"\/\/staticos.idxsandbox.com","accountLevel":"20"}```
|{{ script }}|```!function(i,e){"use strict";idx(function(){if(!i.mobile){var e=JSON.parse(idx("#IDX-defaultPriceData").text()),o=function(i,o){i=i||"all",o=o||"all";var n=e[i].min[o],t=e[i].max[o];idx("#IDX-lp").val(n),idx("#IDX-hp").val(t)},n=function(){return idx('[name="idxID"]').val()?idx('[name="idxID"]').val():"all"},t=function(){return idx("#IDX-pt").val()?idx("#IDX-pt").val():"all"};idx("#IDX-pt").on("change",function(){o(n(),t())}),o(n(),t()),"geolocation"in navigator&&"https:"===document.location.protocol&&idx("#IDX-userLocation").show().css("display","inline-block")}idx("#IDX-mobile-mapsearch").on("pagebeforehide",function(){buildQueryObject(),idx.mobile.hidePageLoadingMsg(),"undefined"!==map&&map&&L.DomEvent.removeListener(map,"moveend",triggerMapChange)}),idx("#IDX-mapAlert").hide(),idx("#IDX-mapSearch").click(function(i){i.preventDefault(),refreshButtonClick()}),idx("button.IDX-close").click(function(i){i.preventDefault(),idx(this).parent("#IDX-mapAlert").hide()}),idx("#IDX-userLocation").off("click").on("click",function(){navigator.geolocation?navigator.geolocation.getCurrentPosition(function(i){idx(".IDX-mapControlWindow").hide(),storeZoom(),recenterMapTo(i.coords.latitude,i.coords.longitude,!0),triggerMapChange(),idx("#IDX-mapRefresh"+uniqueID).fadeOut("fast"),refreshMap()},function(i){console&&console.error(i);idx("#IDX-userLocation").html("Not Available")}):alert("Location gathering is not supported by your browser")})})}(window);```
|{{ cdn.make('/graphical/frontend/javascript/maps/idxmap'~mapData.mapEngine~'.1.0.1.min.js') }}|//staticos.idxbroker.com/graphical/frontend/javascript/maps/idxmapmapquest.1.0.1.min.js
|{{ cdn.make('/graphical/css/font-awesome-4.7.0.min.css') }}|//staticos.idxsandbox.com/graphical/css/font-awesome-4.7.0.min.css
|{{ cdn.make('/graphical/css/mobileFirst.css') }}|//staticos.idxsandbox.com/graphical/css/mobileFirst.css
|{{ searchURL }}|https://testDomain.idxbroker.com/idx/map/mapsearch
|{{ defaultPriceData&#124;raw }}|```{"all":{"min":{"8":"200000","5":"200000","4":"200000","2":"200000","3":"200000","1":"200000","all":"200000"},"max":{"8":"800000","5":"800000","4":"800000","2":"800000","3":"800000","1":"800000","all":"800000"}},"a175":{"min":{"1":"200000","2":"200000","3":"200000","4":"200000","5":"200000","6":"200000","7":"200000","all":"200000"},"max":{"1":"800000","2":"800000","3":"800000","4":"800000","5":"800000","6":"800000","7":"800000","all":"800000"}}}```