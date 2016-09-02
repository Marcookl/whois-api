<?php 

namespace App\Models;

class WhoisData {


    protected $_info;

    public function getInfo()
    {
        return $this->_info;
    }
    public function setInfo($val)
    {
        $this->_info = $val;
        return $this;
    }   

    public function toArray()
    {
        return array(
            'data'    => $this->getInfo()
        );
    }
}
