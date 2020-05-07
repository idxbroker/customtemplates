# Schema mark up in Custom Partner Template Detials page

## About

This partner Custom Template is meant to add Schema to a property details page in the IDX Broker system.

The benifit of this addition is for search engine results.

The assumption that feeding search engines more data is likely true, but the main goal is to diplay open house data in the search engine results.

### Structured Data Markup Vocabulary Used

* Offers http://schema.org/Offer - price and priceCurrency
* Address http://schema.org/PostalAddress - streetAddress, addressLocality, addressRegion, postalCode
* Event http://schema.org/Event - description, url, name, startDate, endDate, location
* Geo http://schema.org/GeoCoordinates - latitude, longitude

This markup has been added as [JSON-LD](https://en.wikipedia.org/wiki/JSON-LD).

However [Google recommends](https://developers.google.com/search/docs/guides/intro-structured-data) using JSON-LD for structured data whenever possible.

This is being explored in the dev branch of this repo.

## Use

Appply this details template to a client account.


## Required

* An active IDX Broker account
* IDX Broker Developer Partner on account

## Reference

https://schema.org/RealEstateAgent

## Testing

https://search.google.com/structured-data/testing-tool


## Transforming

In the mobile first template some data may need transformation.

This macro in particular:

{{ oh.freeFormDate }} = 'November 10th, 2018'

This is transformed using twig to the format needed. 

Example:

{{oh.freeFormDate|date('Y-m-d')}}

https://twig.symfony.com/doc/2.x/filters/date.html

## Warnings

As this definition changes there may be warnings. Additionally some of the vocabulary used seems to not fit real estate date perfectly.

This is [not a guarantee that google search result pages will show open house data](https://developers.google.com/search/docs/guides/sd-policies).

