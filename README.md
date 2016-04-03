# Currency Price plugin for Craft CMS

Fieldtype that allow you to input a price in multiple currencies.

## Installation

To install Currency Price, follow these steps:

1. Download & unzip the file and place the `currencyprice` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/sjelfull/Craft-CurrencyPrice.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3. Install plugin in the Craft Control Panel under Settings > Plugins
4. The plugin folder should be named `currencyprice` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

Currency Price works on Craft 2.4.x and Craft 2.5.x.

## Configuring Currency Price

Select the currencies you want to enable in the fieldtype settings.

## Using Currency Price

You can get a currency in your template like so:
```
    {{ fieldHandle.getPrice('USD') }}
```

If the currency doesn't exist, `null` will be returned.

## Currency Price Roadmap

* Add default toggle to currency list
* Improve template methods
* Add filter to convert a price into another currency on the fly

## Currency Price Changelog

### 1.0.0 -- 2016.04.03

* Initial release

Brought to you by [Fred Carlsen](http://sjelfull.no)