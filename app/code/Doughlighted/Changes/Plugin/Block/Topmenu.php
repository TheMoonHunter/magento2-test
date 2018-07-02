<?php 

namespace Doughlighted\Changes\Plugin\Block;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Store\Model\StoreManagerInterface;

class Topmenu {

    /**
     * @var NodeFactory
     */
    protected $nodeFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(NodeFactory $nodeFactory, StoreManagerInterface $storeManager) {
        $this->nodeFactory = $nodeFactory;
	$this->storeManager = $storeManager;
    }

    public function beforeGetHtml(\Magento\Theme\Block\Html\Topmenu $subject,
        			  $outermostClass = '',
        			  $childrenWrapClass = '',
        			  $limit = 0) {
	$homeNode = $this->getNode($subject, 'Home', 'home');
	$aboutUsNode = $this->getNode($subject, 'About Us', 'about-us');
	//$pricingNode = $this->getNode($subject, 'Pricing', 'pricing');
	//$contactUsNode = $this->getNode($subject, 'Contact Us', 'contact-us');
	//$faqNode = $this->getNode($subject, 'FAQs', 'faqs');
	
        $subject->getMenu()->addChild($homeNode);
	$subject->getMenu()->addChild($aboutUsNode);
	//$subject->getMenu()->addChild($pricingNode);
	//$subject->getMenu()->addChild($contactUsNode);
	//$subject->getMenu()->addChild($faqNode);
    }

    public function afterGetHtml(\Magento\Theme\Block\Html\Topmenu $subject, $result) {
	$result .= '<li  class="level0 nav-4 level-top">';
	$result .= '<a href="http://paulo.magento2.cp-m2.com/pricing/"  class="level-top" ><span>Pricing</span></a>';
	$result .= '</li>';

	$result .= '<li  class="level0 nav-5 level-top">';
        $result .= '<a href="http://paulo.magento2.cp-m2.com/contact-us/"  class="level-top" ><span>Contact Us</span></a>';
        $result .= '</li>';

	$result .= '<li  class="level0 nav-6 level-top">';
        $result .= '<a href="http://paulo.magento2.cp-m2.com/faqs/"  class="level-top" ><span>FAQs</span></a>';
        $result .= '</li>';

	return $result;
    }

    protected function getNode($subject, $name, $id) {
	return $this->nodeFactory->create(
            [
                'data' => $this->getNodeAsArray($name, $id),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree()
            ]
        );
    }

    protected function getNodeAsArray($name, $id)
    {
	$url = $this->storeManager->getStore()->getUrl($id);
	if ($id == "home") {
	    $url = $this->storeManager->getStore()->getBaseUrl();
	}
        return [
            'name' => __($name),
            'id' => $id . '-link',
            'url' => $url,
            'has_active' => false,
            'is_active' => false // (expression to determine if menu item is selected or not)
        ];
    }
}

