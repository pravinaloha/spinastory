<?php


class MY_Contoller extends CI_Controller {
    var $javascript     = array();
    var $css            = array();

    protected function addjs($js = array()) {
        if(is_array($js)) $this->javascript = array_merge($this->javascript,$js);
        else $this->javascript[] = $js;
    }

    protected function addcss($css = array()) {
        if(is_array($css)) $this->css = array_merge($this->css,$css);
        else $this->css[] = $css;
    }
}