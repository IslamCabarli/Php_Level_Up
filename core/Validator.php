<?php
class Validator
{
    public static function required(string $value, string $field): ?string
    {
        if ($value === "") {
            return "$field cannot be empty";
        }
        return null;
    }

    public static function minLength(string $value, int $min, string $field): ?string
    {
        if (strlen($value) < $min) {
            return "$field cannot be less than $min characters";
        }
        return null;
    }

    public static function email(string $value): ?string
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            return "Wrong email format";
        }
        return null;
    }

    public static function validate(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? '';
            foreach ($fieldRules as $rule) {
                if ($rule === 'required') {

                    $error = self::required($value, ucfirst($field));

                    if ($error) {
                        $errors[] = $error;
                    }
                }
                if (str_starts_with($rule, 'min:')) {

                    $min = (int) str_replace('min:', '', $rule);

                    $error = self::minLength(
                        $value,
                        $min,
                        ucfirst($field)
                    );

                    if ($error) {
                        $errors[] = $error;
                    }
                }

                if ($rule === 'email') {

                    $error = self::email($value);

                    if ($error) {
                        $errors[] = $error;
                    }
                }
            }
        }
        return $errors;
    }
}