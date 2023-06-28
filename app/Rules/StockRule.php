<?php

namespace App\Rules;

use App\Models\Items;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StockRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $item = Items::find($value);

    }
}
