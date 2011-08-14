<?php
  /**
 * Returns a <select> tag populated with all the states in the country.
 *
 * The select_state_tag builds off the traditional select_tag function, and is conveniently populated with 
 * all the states in the default country (sorted alphabetically). Each option in the list has a state code (two-character 
 * for US and Canada) for its value and the state's name as its display title.
 * The options[] array may also contain the following non-html options:
 *   A states[] array containing a list of states to be added in the form array
 * Here's an example of an <option> tag generated by the select_state_tag:
 *
 * <samp>
 *  <option value="NY">New York</option>
 * </samp>
 *
 * <b>Examples:</b>
 * <code>
 *  echo select_state_tag('state', 'NY');
 * </code>
 *
 * @param  string field name 
 * @param  string selected field value (two-character state code)
 * @param  string country (two-character country code)
 * @param  array  additional HTML compliant <select> tag parameters. 
 *                May also include a 'states[]' array containing a list of states to be removed from the list
 *                May also include a 'country' value that will select the states from a country code
 * @return string <select> tag populated with all the states in the default or selected country.
 * @see select_tag, options_for_select
 */
function select_state_tag($name, $value, $options = array())
{
   if (isset($options['country']))
   {
      $country = $options['country'];
      unset($options['country']);
   }
   
   $states = getStates($country);

  if (isset($options['states']) && is_array($options['states']))
  {
    foreach ($options['states'] as $key)
    {
       if (isset($states[$key]))
       {
          unset($states[$key]);
       }
    }
    unset($options['states']);
  }

   if (isset($options['sort']))
   {
      asort($states);
      unset($options['sort']);
   }

  $option_tags = options_for_select($states, $value);

  return select_tag($name, $option_tags, $options);
}

  /**
 * Returns a <select> tag populated with all the states in a country.
 *
 * @param  string object name 
 * @param  string method name 
 * @param  array  additional HTML compliant <select> tag parameters. May also include the following options:
 *                'states[]' -- an array containing a list of states to be removed from the list
 *                'country'  -- a value that will select the states from a country code
 *                'sort'     -- will cause the list to be re-sorted alphabetically
 * @param  string default object value (usually a two-character state code)
 * @return string <select> tag populated with all the states in the default or selected country.
 * @see select_state_tag
 */
function object_select_state_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $value = _get_object_value($object, $method, $default_value);

  return select_state_tag(_convert_method_to_name($method, $options), $value, $options);
}

/**
* returns an array of states for use by select_state_tag
* 
* Can either contain the list directly or the list of states for each country can be loaded 
* from a file named -- "_StateList" . $countryCode . ".php"
*
* @param  string $country country selector code 
* @return array list of states
*/
function getStates($country = 'us')
{
   require("_StateList$country.php");
}

