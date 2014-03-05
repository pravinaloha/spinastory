<?php

class MY_Loader extends CI_Loader {

    public function template($template_name, $vars = array(), $return = FALSE, $headers = true) {
        $content = '';
        if($headers)
            $content .= $this->view('header', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        if($headers)
            $content .= $this->view('footer', $vars, $return);

        if ($return) {
            return $content;
        }
    }

    //This will proccess a view for ajax call backs and echo json.
    function process_view($view, $pagedata = FALSE, $extras = FALSE) {
        $CI = & get_instance();
        $output = array();
        if ($view) {
            ob_start();
            $CI->load->template($view, $pagedata, false ,false);
            $html = ob_get_contents();
            ob_end_clean();
            $output['html'] = $html;
        }

        if ($extras) {
            foreach ($extras as $key => $data) {
                $output[$key] = $data;
            }
        }

        echo json_encode($output);
    }

}