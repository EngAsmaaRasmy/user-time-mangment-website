<?php

namespace App\Rules;

use App\Models\RangeTime;
use Illuminate\Contracts\Validation\Rule;

class TimeAvailabilityRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($time = null)
    {
        $this->time = $time;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return RangeTime::isTimeAvailable(request()->input('weekday'), $value, request()->input('end_time'), request()->input('pharmacy_id'), request()->input('user_id'), $this->time);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This time is not available';
    }
}
