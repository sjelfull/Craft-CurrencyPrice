<?php
/**
 * Currency Price plugin for Craft CMS
 *
 * CurrencyPrice FieldType
 *
 * --snip--
 * Whenever someone creates a new field in Craft, they must specify what type of field it is. The system comes with
 * a handful of field types baked in, and we’ve made it extremely easy for plugins to add new ones.
 *
 * https://craftcms.com/docs/plugins/field-types
 * --snip--
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   CurrencyPrice
 * @since     1.0.0
 */

namespace Craft;

class CurrencyPriceFieldType extends BaseFieldType
{
    /**
     * Returns the name of the fieldtype.
     *
     * @return mixed
     */
    public function getName ()
    {
        return Craft::t('Currency Price');
    }

    /**
     * Returns the content attribute config.
     *
     * @return mixed
     */
    public function defineContentAttribute ()
    {
        return [ AttributeType::Mixed, 'model' => 'CurrencyPriceModel' ];
    }

    /**
     * Returns the field's input HTML.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return string
     */
    public function getInputHtml ($name, $value)
    {
        if ( !$value )
            $value = new CurrencyPriceModel();

        $id           = craft()->templates->formatInputId($name);
        $namespacedId = craft()->templates->namespaceInputId($id);

        // Include our Javascript & CSS
        //craft()->templates->includeCssResource('currencyprice/css/fields/CurrencyPriceFieldType.css');

        /* -- Variables to pass down to our rendered template */

        $variables = array(
            'id'                => $id,
            'name'              => $name,
            'namespaceId'       => $namespacedId,
            'values'            => $value,
            'enabledCurrencies' => $this->getSettings()->enabledCurrencies,
        );

        return craft()->templates->render('currencyprice/fields/CurrencyPriceFieldType.twig', $variables);
    }

    public function getSettingsHtml ()
    {
        //$enabledCurrencies = $this->getSettings()->enabledCurrencies;
        $currencies = $this->getCurrencies();

        return craft()->templates->render('currencyprice/CurrencyPrice_Settings', array(
            'settings'   => $this->getSettings(),
            'currencies' => $currencies,
        ));
    }

    protected function defineSettings ()
    {
        return array(
            'enabledCurrencies' => [ AttributeType::Mixed, 'default' => [ ] ],
        );
    }

    public function prepSettings ($settings)
    {
        if ( isset($settings['enabledCurrencies']) ) {
            foreach ($settings['enabledCurrencies'] as $currency => $value) {
                if ( $value !== '1' ) {
                    unset($settings['enabledCurrencies'][ $currency ]);
                }
            }
        }

        return $settings;
    }


    /**
     * Returns the input value as it should be saved to the database.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function prepValueFromPost ($value)
    {
        return $value;
    }

    /**
     * Prepares the field's value for use.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function prepValue ($value)
    {
        return $value;
    }

    protected function getCurrencies ()
    {
        // Currency files courtesy of https://github.com/Commercie/currency
        $folder     = IOHelper::getFolder(CRAFT_PLUGINS_PATH . 'currencyprice/lib/currencies/');
        $currencies = [ ];

        if ( $folder ) {
            $files = $folder->getContents($recursive = false, $filter = '.json');

            // Loop through and read
            foreach ($files as $file) {
                $content      = IOHelper::getFileContents($file);
                $currencies[] = json_decode($content, true);
            }
        }

        return $currencies;
    }
}