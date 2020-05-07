<?php


namespace MovieSpace\Forms;


use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

/**
 * Class RegisterForm
 *
 * Represents the User Registration
 * form...
 *
 * @package MovieSpace\Forms
 */
class RegisterForm extends Form
{
    public function initialize($user)
    {
        // FirstName form element
        $firstName = new Text('firstName', [
            'placeholder' => 'Your First Name',
            'class'       => 'form-control',
            'required'    => 'required'
        ]);
        $firstName->setLabel('First Name');
        $firstName->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'Your first name is required'
                    ]
                )
            ]
        );
        $this->add($firstName);

        // LastName form element
        $lastName = new Text('lastName',
            [
                'placeholder' => 'Your Last Name',
                'class'       => 'form-control',
                'required'    => 'required'
            ]);
        $lastName->setLabel('Last Name');
        $lastName->addValidators(
            [
                new PresenceOf
                (
                    [
                        'message' => 'Your last name is required'
                    ]
                )
            ]
        );
        $this->add($lastName);

        // Email form element
        $email = new Email('email',
            [
                'placeholder' => 'Your Login Email Address',
                'class'       => 'form-control',
                'required'    => 'required'
            ]
        );
        $email->setLabel('Login Email Address');    // Set the label
        // Add validators (required, valid email)
        $email->addValidators(
            [
                new PresenceOf
                (
                    [
                        'message' => 'Your login email address is required'
                    ]
                ),
                new EmailValidator(
                    [
                        'message' => 'Please enter a valid email address'
                    ]
                )
            ]
        );
        $this->add($email); // Adds the email element to the form

        // Password form element
        $password = new Password('password',
            [
                'placeholder' => 'Your Password',
                'class'       => 'form-control',
                'required'    => 'required'
            ]
        );
        $password->setLabel('Password'); // Sets the label
        // Add validators (required, string length range)
        $password->addValidators([
            new PresenceOf(
                [
                    'message' => 'Your password is required'
                ]
            ),
            new StringLength(
                [
                    'min'            => 6,
                    'max'            => 20,
                    'messageMaximum' => ucfirst('your password is too long, max 20 characters'),
                    'messageMinimum' => ucfirst('your password is too short, min 6 characters')
                ]
            )
        ]);
        $this->add($password); // Adds the password element to the form

        // Confirm password form element
        $passwordConfirmation = new Password('password_confirmation',
            [
                'placeholder' => 'Your Password Confirmation',
                'class'       => 'form-control',
                'required'    => 'required'
            ]);

        $passwordConfirmation->setLabel('Confirmation Password'); // Sets the label
        // Add validators (required, compare with initial password)
        $passwordConfirmation->addValidators([
            new PresenceOf(
                [
                    'message' => 'A confirmation password is required'
                ]
            ),
            new Identical(
                [
                    'accepted' => $password->getValue(),
                    'message'  => 'Your confirmation password is not the same that the first password'
                ]
            )
        ]);
        // Adds the password element to the form
        $this->add($passwordConfirmation);

        // Submit button
        $submitButton = new Submit('submit_button', [
            'class' => 'btn btn-primary',
        ]);
        $submitButton->setDefault('Register'); // sets the button's text
        // Adds the button to the form
        $this->add($submitButton);
    }
}