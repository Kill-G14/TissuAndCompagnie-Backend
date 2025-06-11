<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Models\Customer;

class CustomerService{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    public function createCustomer(Customer $customer): bool {
        return $this->customerRepository->create($customer);
    }

    public function getCustomer($idCustomer) {
        return $this->customerRepository->getCustomer($idCustomer);
    }

    public function updateCustomer($id, $email, $password, $firstName, $lastName, $phone, $isDeleted) {
        $this->customerRepository->updateCustomer($id, $email, $password, $firstName, $lastName, $phone, $isDeleted);
    }

    public function deleteCustomer($id) {
        $this->customerRepository->deleteCustomer($id);
    }
}