<?php

namespace App\Rules;

use App\Models\Attribute;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateAttributes implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            $fail("The {$attribute} must be an array.");
            return;
        }

        $keys = array_keys($value);

        // Fetch attribute names and their expected types from DB
        $dbAttributes = Attribute::whereIn('name', $keys)
            ->pluck('type', 'name')
            ->toArray();

        foreach ($keys as $key) {
            if (!array_key_exists($key, $dbAttributes)) {
                $fail("The attribute key '{$key}' is invalid.");
                continue;
            }

            $expectedType = $dbAttributes[$key];
            $attributeValue = $value[$key];

            // Validate value based on type
            if ($expectedType === 'text' && (!is_string($attributeValue) || is_numeric($attributeValue))) {
                $fail("The attribute '{$key}' must be a text string.");
            }
            if ($expectedType === 'number' && !is_numeric($attributeValue)) {
                $fail("The attribute '{$key}' must be a number.");
            }
            if ($expectedType === 'date') {
                $date = null;

                if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $attributeValue)) {
                    $date = Carbon::createFromFormat('d-m-Y', $attributeValue);
                }

                if (!$date) {
                    $fail("The attribute '{$key}' must be a valid date in DD-MM-YYYY format.");
                } elseif ($date->isBefore(Carbon::today())) {
                    $fail("The attribute '{$key}' must be a date after today.");
                }
            }
            if ($expectedType === 'select' && !is_string($attributeValue)) {
                $fail("The attribute '{$key}' must be a valid selection option.");
            }
        }
    }
}
