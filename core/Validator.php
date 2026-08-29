<?php
class Validator
{
    public static function required(string $value, string $field): ?string
    {
        if ($value === "")
        {
            return "$field cannot be empty";
        }
        return null;
    }

    public static function minLength(string $value, int $min, string $field): ?string
    {
        if ( strlen($value) < $min )
        {
            return "$field cannot be less than $min characters";
        }
        return null;
    }

    public static function email(string $value): ?string
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false)
        {
            return "Wrong email format";
        }
        return null;
    }
}