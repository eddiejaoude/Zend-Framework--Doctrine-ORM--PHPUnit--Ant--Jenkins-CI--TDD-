<?php

class Zend_Controller_Action_Helper_Widgets extends
                Zend_Controller_Action_Helper_Abstract
{
    function direct($layout)
    {
    	$path = APPLICATION_PATH . DIRECTORY_SEPARATOR .
    		'..' . DIRECTORY_SEPARATOR . 
    		'template' . DIRECTORY_SEPARATOR . 
    		'page-layouts' . DIRECTORY_SEPARATOR . 
    		$layout;
    	$content = file_get_contents($path);
    	Zend_Debug::dump($content);
    	$pattern = '/<widget.*\:*\/>/';
    	preg_match_all($pattern, $content, $widgets);
    	
    	$settings = Array();
    	$i = 1;
    	foreach ($widgets[0] as $widget)
    	{
    		$widgetData = substr($widget, strpos($widget, ' ')+1, -3);
    		$id = explode(':', $widgetData);
    		$viewFile = explode('.', $id[0]);
    		$data['code'] = $widget;
    		$data['viewFile'] = $viewFile[1];
    		$module = explode("_", $viewFile[0]);
    		$data['module'] = $module[0];
    		$data['widget'] = $module[1];
    		(count($id) == 2)? $data['options'] = explode('|',$id[1]): $id ;
    		
    		$view = Zend_Layout::getMvcInstance()->getView();
    		$view->setScriptPath(APPLICATION_PATH . "/../template/views/" . $data['module'] . "/");
    		//Zend_Debug::dump($data); die;
    		
    		$data['data'] = $view->action(
    			'widget',
    			$data['widget'],
    			$data['module']
    		);
    		$settings[$i] = $data;
    		$content = str_replace($data['code'], $data['data'], $content);
    		
    		Zend_Debug::dump($content);
    		Zend_Debug::dump($settings);
    	}
    	die;
        return $settings;
    }
}