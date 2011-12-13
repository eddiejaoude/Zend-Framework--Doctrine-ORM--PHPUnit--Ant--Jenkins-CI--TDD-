<?php

/**
 * Theme selection form
 *
 * @author 			David Weinraub <david@papayasoft.com>
 * @category   		Real Browser
 * @package 		Auth Module
 * @version 		SVN: $Id:$
 *
 */
class Auth_Form_ThemeSelect extends Zend_Form
{

    protected $themes = array(
        'master',
        'basic',
    );
    
    public function init()
    {
        $this->setMethod('post')
            ->setAction($this->getView()->url(array(
                    'module' => 'auth',
                    'controller' => 'theme',
                    'action' => 'update')));

        # theme
        $theme = new Zend_Form_Element_Select('theme');
        $theme->setLabel('Theme')
            ->setMultiOptions(array_combine($this->themes, $this->themes))
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addFilter('StringToLower')
            ->addValidator('NotEmpty');
        
        # redirectUrl
        $redirectUrl = new Zend_Form_Element_Hidden('redirectUrl');
        $redirectUrl->setValue($_SERVER['REQUEST_URI']);

        # Submit
        $submit = new Zend_Form_Element_Submit('Select');
        $submit->setIgnore(true);

        # Create
        $this->addElements(array($theme, $redirectUrl, $submit));
    }
}

