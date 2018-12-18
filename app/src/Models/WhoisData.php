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
        if ($val['regrinfo']['domain']['expiry date'] && !$val['regrinfo']['domain']['expires']) {
            $timestamp = strtotime($val['regrinfo']['domain']['expiry date']);
            $val['regrinfo']['domain']['expires'] = date('Y-m-d', $timestamp);
        }
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
