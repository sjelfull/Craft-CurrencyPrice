<?php
/**
 * Currency Price plugin for Craft CMS
 *
 * CurrencyPrice Model
 *
 * --snip--
 * Models are containers for data. Just about every time information is passed between services, controllers, and
 * templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 * --snip--
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   CurrencyPrice
 * @since     1.0.0
 */

namespace Craft;

class CurrencyPriceModel extends BaseModel
{
    /**
     * Defines this model's attributes.
     *
     * @return array
     */
    protected function defineAttributes ()
    {
        return array_merge(parent::defineAttributes(), array(
            'price' => array( AttributeType::Mixed, 'default' => [ ] ),
        ));
    }

    public function getPrice ($code = null)
    {
        $prices   = $this->getAttribute('price');
        $currency = null;

        if ( isset($prices[ $code ]) ) {
            $currency = $prices[ $code ];
        }

        return $currency;
    }

}