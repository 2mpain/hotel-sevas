<?php

namespace App\Observers;

use App\Events\FeedbackCreatedEvent;
use App\Models\Feedback;
use App\Services\Customers\CustomerSettingsGettingService;
use Illuminate\Support\Facades\Log;

class FeedbackObserver
{
    public function __construct(
        private CustomerSettingsGettingService $customerSettingsGettingService,
    ) {
    }
    /**
     * Handle the Feedback "created" event.
     */
    public function created(Feedback $feedback): void
    {
        try {
            $customer = $this->customerSettingsGettingService
                ->getCustomerByEmail($feedback->getEmail());
            
            if ($customer) {
                $feedback->setCustomerId($customer->getId());
                $feedback->saveOrFail();
            }
        } catch (\Throwable $e) {}
    }
}
