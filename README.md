# Custom Template Documentation

# About

IDX Broker has opened up the IDX Broker page templating system.

In this system any IDX Broker Developer partner can create custom templates and distribute them to clients under their partner dev code.

# Use

The custom template system is accessible in your developer partner account in the "Designs" area.

All templates begin with the Mobile First template.

This template can then be customized. Access to the HTML, CSS JavaScript and even PHP is available.

Many IDX options and data are available via twi variables and marcos.

### IDX Broker uses Twig for templates

What is [Twig](http://twig.sensiolabs.org/)?

> Twig is a modern template engine for PHP. Twig compiles templates down to plain optimized PHP code. The overhead compared to regular PHP code was reduced to the very minimum.

# Requirements

* This is for IDX Broker Partners ONLY. Clients will not be allowed to create templates.
* Because IDX Broker is not producing these templates, IDX Broker will not be supporting them.
* There is no way of removing a template if a client leaves your dev code.
* MLS Disclaimers & Courtesies must match standard IDX templates. See a current IDX page for an example.
* Versioning is not completely supported at this time.
* Currently there is no way to restrict a client under your dev code from getting your template should you publish it.
* IDX Broker will not be involved in any disputes over templates.
* HTTPS. To preview a template you have customized in the editor the template must be applied to your DEMO account. This account must have https enabled.


# Samples and Definitions

In this repo you will find macro definitions in the macros folder. These are macros and the resulting text or html produced by the macro.

These may require twig file imports and will be noted.

Macros like  {{ value }} from a loop are not defined.

Macros that set a value or macros the are used to check if a setting is populated are also not defined.

### Exploring a macro

You can print out all keys in a macro using a for loop. Example below prints out all keys in the listings macro.

```
<ul>
    {% for key in listing|keys %}
        <li>{{ key }}</li>
    {% endfor %}
</ul>
```

Since many macros are populated by IDX data it is not possible to map a comprehensive list of values.