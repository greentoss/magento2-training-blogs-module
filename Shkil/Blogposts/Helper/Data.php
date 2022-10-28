<?php

namespace Shkil\Blogposts\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;

class Data extends AbstractHelper
{
    const DATE_FORMAT = 'blog/general/date_format';

    /**
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function getDateFormat($store = null)
    {
        return $this->scopeConfig->getValue($this::DATE_FORMAT, ScopeInterface::SCOPE_STORE, $store);
    }
}
