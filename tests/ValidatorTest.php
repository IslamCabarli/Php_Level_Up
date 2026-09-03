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

        public function testMinLength (): void
        {
            $data = [
                'title' => 'oxa',
                'description' => 'salam',
            ];
            $errors = Validator::validate($data,
                [
                    'title' => ['min:4'],
                    'description' => ['min:6'],
                ]);
            $this->assertNotEmpty($errors);
        }


        public function testEmail(): void
        {
            $data = [
                'email' => 'ramil@',
            ];
            $errors = Validator::validate($data,
                    [
                       'email' => ['email'],
                    ]);

            $this->assertNotEmpty($errors);
        }
    }