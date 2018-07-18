# Custom Template Documentation


## IDX Broker uses Twig for templates
What is Twig?

> Twig is a modern template engine for PHP. Twig compiles templates down to plain optimized PHP code. The overhead compared to regular PHP code was reduced to the very minimum.



## Basic usage with IDX Broker
1. Use the sample-twig file in this repo
2. Modify as needed
3. Add to DEMO or client account

----

### Requirements and things to remember
* This is for IDX Broker Partners ONLY. Clients will not be allowed to create templates.
* Because we are not writing these templates, IDX Broker will not be supporting them.
* There is no way of removing a template if a client leaves your dev code.
* MLS Disclaimers & Courtesies must match standard IDX templates.
* Versioning is not completely supported at this time.
* Currently there is no way to restrict a client from getting your template should you publish it.
* IDX Broker will not be involved in any disputes over templates.
* To preview a template you have customized in the editor the template must be applied to your DEMO account. This account must have https enabled.

>This offering is still in alpha stage and will be evolving.
Feedback welcome.

## Samples and definitions
In this repo you will find macro definitions in the macros folder. These are macros and the resulting text or html produced by the macro.

These may require twig file imports and will be noted.

Macros like  {{ value }} from a loop are not defined.

Macros that set a value or macros the are used to check if a setting is populated are also not defined.

Pull requests welcome for any definitions missed or you feel should be added.

### Finding more
You can print out all keys in a macro using a for loop. Example below prints out all keys in the listings macro.

```
<ul>
    {% for key in listing|keys %}
        <li>{{ key }}</li>
    {% endfor %}
</ul>
```

## Helpful Links 
[Twig](http://twig.sensiolabs.org/)