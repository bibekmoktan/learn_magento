<?php
namespace Codilar1\Wallet\Model;

use Codilar1\Wallet\Api\CustomerWalletRepositoryInterface;
use Codilar1\Wallet\Api\Data\CustomerWalletInterface;
use Codilar1\Wallet\Model\ResourceModel\CustomerWallet as CustomerWalletResource;
use Codilar1\Wallet\Model\ResourceModel\CustomerWallet\CollectionFactory as CustomerWalletCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class CustomerWalletRepository implements CustomerWalletRepositoryInterface
{
    protected $resource;
    protected $customerWalletFactory;
    protected $customerWalletCollectionFactory;
    protected $searchResultsFactory;

    public function __construct(
        CustomerWalletResource $resource,
        CustomerWalletFactory $customerWalletFactory,
        CustomerWalletCollectionFactory $customerWalletCollectionFactory,
        SearchResultsFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->customerWalletFactory = $customerWalletFactory;
        $this->customerWalletCollectionFactory = $customerWalletCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    public function save(CustomerWalletInterface $customerWallet)
    {
        try {
            $this->resource->save($customerWallet);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $customerWallet;
    }

    public function getById($walletId)
    {
        $customerWallet = $this->customerWalletFactory->create();
        $this->resource->load($customerWallet, $walletId);
        if (!$customerWallet->getId()) {
            throw new NoSuchEntityException(__('Customer wallet with ID "%1" does not exist.', $walletId));
        }
        return $customerWallet;
    }

    public function getByCustomerId($customerId)
    {
        $customerWallet = $this->customerWalletFactory->create();
        $this->resource->load($customerWallet, $customerId, 'customer_id');
        if (!$customerWallet->getId()) {
            throw new NoSuchEntityException(__('Customer wallet for customer ID "%1" does not exist.', $customerId));
        }
        return $customerWallet;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->customerWalletCollectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function delete(CustomerWalletInterface $customerWallet)
    {
        try {
            $this->resource->delete($customerWallet);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    public function deleteById($walletId)
    {
        return $this->delete($this->getById($walletId));
    }
}
