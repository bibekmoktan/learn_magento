<?php
namespace Codilar1\Wallet\Api\Data;

interface CustomerWalletInterface
{
    const WALLET_ID = 'wallet_id';
    const CUSTOMER_ID = 'customer_id';
    const BALANCE = 'balance';

    /**
     * Get wallet ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get customer ID
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Get balance
     *
     * @return float
     */
    public function getBalance();

    /**
     * Set wallet ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set customer ID
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Set balance
     *
     * @param float $balance
     * @return $this
     */
    public function setBalance($balance);
}
