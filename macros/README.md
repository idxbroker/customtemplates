Macros

## About

[Twig macros](https://twig.symfony.com/doc/3.x/tags/macro.html) are reusable temple fragments.

Like a normal function in programming a twig macro has an output and can accept arguments.

IDX Broker uses these to abstract logic needed in dealing with the complexity of IDX data as well as to simplify the template code.

## Use

A macro can be imported or declared in your template. This means you can leverage existing IDX created macros or even create your own.

Macro Example

``` php
{% macro input(name, value, type = "text", size = 20) %}
    <input type="{{ type }}" name="{{ name }}" value="{{ value|e }}" size="{{ size }}" />
```

Example import of an existing IDX Broker macro

``` php
{% import "searchTools-1.003.twig" as tools %}
```

Example of a note macro
```
{# This is just a note #}
```