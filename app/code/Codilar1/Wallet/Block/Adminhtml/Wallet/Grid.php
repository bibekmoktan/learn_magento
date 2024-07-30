<?php
namespace Codilar1\Wallet\Block\Adminhtml\Wallet;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data as BackendHelper;
use Codilar1\Wallet\Model\ResourceModel\CustomerWallet\CollectionFactory as WalletCollectionFactory;

class Grid extends Extended
{
    protected $_walletCollectionFactory;

    public function __construct(
        Context $context,
        BackendHelper $backendHelper,
        WalletCollectionFactory $walletCollectionFactory,
        array $data = []
    ) {
        $this->_walletCollectionFactory = $walletCollectionFactory;
        parent::__construct($context, $backendHelper, $data);
        $this->setId('walletGrid');
        $this->setDefaultSort('wallet_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = $this->_walletCollectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('wallet_id', [
            'header' => __('ID'),
            'index' => 'wallet_id',
        ]);

        $this->addColumn('customer_id', [
            'header' => __('Customer ID'),
            'index' => 'customer_id',
        ]);

        $this->addColumn('balance', [
            'header' => __('Balance'),
            'index' => 'balance',
        ]);

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
