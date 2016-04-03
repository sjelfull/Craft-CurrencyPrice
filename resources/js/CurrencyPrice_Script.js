/**
 * Currency Price plugin for Craft CMS
 *
 * Currency Price JS
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   CurrencyPrice
 * @since     1.0.0
 */

$(function () {
    var filter = $('[data-id="js-currencyPrice"]').searcher({
        //itemSelector: 'js-row',
        //textSelector: 'js-text',
        inputSelector: '.js-currencyPriceInput'
    });
});
