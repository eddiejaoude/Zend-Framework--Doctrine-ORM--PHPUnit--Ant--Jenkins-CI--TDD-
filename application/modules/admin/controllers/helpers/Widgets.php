<?php

class Zend_Controller_Action_Helper_Widgets extends
                Zend_Controller_Action_Helper_Abstract
{
    function direct($path, $layout)
    {
    	$content = file_get_contents($path . $layout);
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
    		$view->setScriptPath($path);
    		$content = $view->render($layout);
    		
    		$view->setScriptPath(APPLICATION_PATH . "/../template/views/" . $data['module'] . "/");
    		
    		$data['data'] = $view->action(
    			'widget',
    			$data['widget'],
    			$data['module']
    		);
    		
    		$content = str_replace($data['code'], $data['data'], $content);
    	}
        return $content;
    }
}