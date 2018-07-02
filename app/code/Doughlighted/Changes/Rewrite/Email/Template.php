<?php

namespace Doughlighted\Changes\Rewrite\Email;

class Template extends \Magento\Email\Model\Template {

    protected $area;

    public function setForcedArea($templateId) {
    	if (!isset($this->area)) {
            $this->area = $this->emailConfig->getTemplateArea($templateId);
    	}
    	return $this;
    }

}
