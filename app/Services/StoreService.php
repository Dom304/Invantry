<?php

namespace App\Services;

use App\Models\Store;

/**
 * Class StoreService
 *
 * The StoreService class is responsible for handling business logic associated with stores.
 * It provides methods to perform operations such as creating a new store. This allows for
 * the encapsulation of complex business logic that can be reused throughout the application,
 * keeping controllers lean and focused on handling HTTP requests and responses.
 */

class StoreService
{
    /**
     * Create a new store.
     *
     * @param array $requestData
     * @return Store
     */
    public function createStore($requestData)
    {
        return Store::create($requestData);
    }
}
