<?php
    use Core\Validator;
    use PHPUnit\Framework\TestCase;
    class ValidatorTest extends TestCase
    {
        public function testRequiredField (): void
        {
            $data = [
                'email' => '',
                'password' => '12345678',
            ];

            $errors = Validator::validate($data,
                [
                    'email' => ['required'],
                    'password' => ['required'],
                ]);


            $this->assertNotEmpty($errors);
        }
    }