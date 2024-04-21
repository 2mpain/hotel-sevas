<?php

namespace App\Http\Requests\Customers\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DateRangeRule implements ValidationRule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * 
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dates = explode(' - ', $value);

        if (count($dates) === 1) {
            try {
                Carbon::createFromFormat('Y-m-d', $value);
            } catch (\Exception $exception) {
                $fail(
                    sprintf('%s is not a valid date', $attribute)
                );
            }
        } elseif (count($dates) === 2) {
            try {
                $start = Carbon::createFromFormat('Y-m-d', $dates[0]);
                $end = Carbon::createFromFormat('Y-m-d', $dates[1]);

                if ($start->greaterThan($end)) {
                    $fail(
                        sprintf('%s start date must be before end date', $attribute)
                    );
                }
            } catch (\Exception $exception) {
                $fail(
                    sprintf('%s is not a valid date format', $attribute)
                );
            }
        } else {
            $fail(
                sprintf('%s is not a valid date range', $attribute)
            );
        }
    }
}
