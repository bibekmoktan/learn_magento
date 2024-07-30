<?php
namespace Codilar1\Wallet\Api;

use Codilar1\Wallet\Api\Data\CustomerWalletInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface CustomerWalletRepositoryInterface
{
    /**
     * Save customer wallet.
     *
     * @param CustomerWalletInterface $customerWallet
     * @return CustomerWalletInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(CustomerWalletInterface $customerWallet);

    /**
     * Retrieve customer wallet by ID.
     *
     * @param int $walletId
     * @return CustomerWalletInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($walletId);

    /**
     * Retrieve customer wallet by customer ID.
     *
     * @param int $customerId
     * @return CustomerWalletInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByCustomerId($customerId);

    /**
     * Retrieve customer wallets matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete customer wallet.
     *
     * @param CustomerWalletInterface $customerWallet
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(CustomerWalletInterface $customerWallet);

    /**
     * Delete customer wallet by ID.
     *
     * @param int $walletId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($walletId);
}
