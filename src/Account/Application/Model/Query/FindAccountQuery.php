<?php

namespace App\Account\Application\Model\Query;

use App\Shared\Application\Cqrs\QueryInterface;

readonly class FindAccountQuery implements QueryInterface
{
    public function __construct(
        private string $accountId
    )
    {
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }
}