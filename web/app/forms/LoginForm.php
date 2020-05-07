<?php


namespace MovieSpace\Forms;


use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Class LoginForm
 *
 * Represents the User Login form
 *
 * @package MovieSpace\Forms
 */
class LoginForm extends Form
{
    public function initialize($user)
    {
        // Email / Username form element
        $email = new Email('email', [
            'placeholder'   => 'enter your login email',
            'class'         => 'form-control',
            'required'      => 'required'
        ]);
        $email->setLabel('Login Email');    // Sets a label
        // Add validators (required, valid email)
        $email->addValidators([
            new PresenceOf([
                'message'   => 'Your login email address is required'
            ]),
            new \Phalcon\Validation\Validator\Email([
                'message'   => 'Please enter a valid email address'
            ])
        ]);
        $this->add($email); // Adds the email element to the form

        // Password form element
        $password = new Password('password', [
            'placeholder'   => 'enter your login password',
            'class'         => 'form-control',
            'required'      => 'required'
        ]);
        $password->setLabel('Login Password');  // Sets a label for the element
        // Add a 'required' validator
        $password->addValidator(
            new PresenceOf([
                'message'   => 'your login password is required'
            ])
        );
        $this->add($password);  // Adds the password element to the form

        // Form Submit button
        $submitButton = new Submit('submit_button', [
            'class'     => 'btn btn-primary',
            'id'        => 'submit_button'
        ]);
        $submitButton->setDefault('Login'); // Sets the button's text
        $this->add($submitButton);  // Adds the button to the form
    }
}