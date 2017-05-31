
<?php

/**
 * JCH Optimize - Joomla! plugin to aggregate and minify external resources for
 * optmized downloads
 * @author Samuel Marshall <sdmarshall73@gmail.com>
 * @copyright Copyright (c) 2010 Samuel Marshall
 * @license GNU/GPLv3, See LICENSE file
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * If LICENSE file missing, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die;

include_once dirname(dirname(__FILE__)) . '/jchoptimize/loader.php';


class JFormFieldAjax extends JFormField
{
	protected $type = 'ajax';

	public function __construct($form = null)
	{
		$app = JFactory::getApplication();
			
		if ($app->input->get('jchajax') == '1')
		{

			while(@ob_end_clean());


			$action = $app->input->get('action', '', 'string');

			if (!$action)
			{
				exit();
			}

			jimport('joomla.event.dispatcher');

			$plugin = JchPlatformPlugin::getPlugin();

			if (!$plugin)
			{
				exit();
			}

			$dispatcher = JDispatcher::getInstance();
			$className  = 'Plg' . $plugin->type . $plugin->name;

			if(!class_exists($className))
			{
				$path = JPATH_PLUGINS . '/' . $plugin->type . '/' . $plugin->name . '/' . $plugin->name . '.php';
				require_once $path;
			}

			$jchoptimize = new $className($dispatcher, (array) ($plugin));
			$jchoptimize->loadLanguage();

			try
			{
				$results = $dispatcher->trigger('onAjax' . ucfirst($action));
			}
			catch (Exception $e)
			{
				$results = $e;
			}


			if (is_scalar($results))
			{
				$out = (string) $results;
			}
			else
			{
				$out = implode((array) $results);
			}

			echo $out;


			exit();
		}
	}



	public function setup(SimpleXMLElement $element, $value, $group = NULL)
	{

		if (!defined('JCH_VERSION'))
		{
			define('JCH_VERSION', '5.1.0');
		}

		static $cnt = 1;

		if($cnt == 1)
		{
			JHtml::script('jui/jquery.min.js', FALSE, TRUE);

			$oDocument = JFactory::getDocument();
			$sScript   = '';

			$oDocument->addStyleSheetVersion(JUri::root(true) . '/media/plg_jchoptimize/css/admin.css', JCH_VERSION);
			$oDocument->addScriptVersion(JUri::root(true) . '/media/plg_jchoptimize/js/admin-joomla.js', JCH_VERSION);
			$oDocument->addScriptVersion(JUri::root(true) . '/media/plg_jchoptimize/js/admin-utility.js', JCH_VERSION);

			$uri         = clone JUri::getInstance();
			$domain      = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port')) . JchOptimizeHelper::getBaseFolder();
			$plugin_path = 'plugins/system/jch_optimize/';

			$ajax_url = JURI::getInstance()->toString() . '&jchajax=1';

			$sScript .= <<<JCHSCRIPT
function submitJchSettings(){
	Joomla.submitbutton('plugin.apply');
}                        
jQuery(document).ready(function() {
    jQuery('.collapsible').collapsible();
  });
			
var jch_observers = [];        
var jch_ajax_url = '$ajax_url';
JCHSCRIPT;

			$oDocument->addScriptDeclaration($sScript);
			$oDocument->addStyleSheet('//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css');
			JHtml::script('plg_jchoptimize/jquery.collapsible.js', FALSE, TRUE);

	##<procode>##   

			$domain = str_replace('/administrator', '', $domain);

			$ajax_optimizeimages = $ajax_url . '&action=optimizeimages';
			$ajax_filetree       = $ajax_url . '&action=filetree&XDEBUG_SESSION_START=1';

			$oDocument->addStyleSheetVersion(JUri::root(true) . '/media/plg_jchoptimize/css/pro-jquery.filetree.css', JCH_VERSION);
			$oDocument->addScriptVersion(JUri::root(true) . '/media/plg_jchoptimize/js/pro-jquery.filetree.js', JCH_VERSION);
			$oDocument->addScriptVersion(JUri::root(true) . '/media/plg_jchoptimize/js/pro-admin-utility.js', JCH_VERSION);

			JHtml::script('jui/jquery.ui.core.js', FALSE, TRUE);

	//                $ajax_url     = $domain . '/administrator/index.php?option=com_ajax&plugin=optimizeimages&format=raw';
	//                $fileTreePath = $domain . '/administrator/index.php?option=com_ajax&plugin=filetree&format=raw';

			JHtml::stylesheet('plg_jchoptimize/pro-jquery-ui-progressbar.css', array(), TRUE);

			JHtml::script('plg_jchoptimize/pro-jquery.ui.progressbar.js', FALSE, TRUE);

			$message = addslashes(JchPlatformUtility::translate('Please select files or subfolders to optimize'));
			$noproid = addslashes(JchPlatformUtility::translate('Please enter your Download ID on the Pro Options tab'));

			$sScript = <<<JCHSCRIPT
			
jQuery(document).ready( function() {
	jQuery("#file-tree-container").fileTree({
		root: "",
		script: "$ajax_filetree",
		expandSpeed: 100,
		collapseSpeed: 100,
		multiFolder: false
	}, function(file) {});
});

var jch_ajax_optimizeimages = '$ajax_optimizeimages';                        
var jch_message = '$message';   
var jch_noproid = '$noproid';        
			
JCHSCRIPT;
			$oDocument->addScriptDeclaration($sScript);

	##</procode>##                
		}

		$cnt++;
	 
		return false;
	}

        protected function getInput()
	{
		return false;
	}
}
