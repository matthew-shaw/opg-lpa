<?php

namespace App\Form\Fieldset;

use App\Filter\StandardInput as StandardInputFilter;
use App\Validator;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Callback;
use Zend\Validator\ValidatorInterface;
use DateTime;

class Date extends Fieldset
{
    /**
     * @var
     */
    private $inputFilter;

    /**
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name);

        $inputFilter = $this->inputFilter = new InputFilter;

        //------------------------
        // Day

        $field = new Text('day');
        $input = new Input($field->getName());

        $input->getFilterChain()
            ->attach(new StandardInputFilter);

        $input->getValidatorChain()
            ->attach(new Validator\NotEmpty(Validator\NotEmpty::INTEGER + Validator\NotEmpty::ZERO), true)
            ->attach(new Validator\Digits, true)
            ->attach($this->getValidDateValidator(), true)
            ->attach($this->getFutureDateValidator(), true);

        $this->add($field);
        $inputFilter->add($input);

        //------------------------
        // Month

        $field = new Text('month');
        $input = new Input($field->getName());

        $input->getFilterChain()
            ->attach(new StandardInputFilter);

        $input->getValidatorChain()
            ->attach(new Validator\NotEmpty(Validator\NotEmpty::INTEGER + Validator\NotEmpty::ZERO), true)
            ->attach(new Validator\Digits, true)
            ->attach($this->getValidDateValidator(), true)
            ->attach($this->getFutureDateValidator(), true);

        $this->add($field);
        $inputFilter->add($input);

        //------------------------
        // Year

        $field = new Text('year');
        $input = new Input($field->getName());

        $input->getFilterChain()
            ->attach(new StandardInputFilter);

        $input->getValidatorChain()
            ->attach(new Validator\NotEmpty(Validator\NotEmpty::INTEGER + Validator\NotEmpty::ZERO), true)
            ->attach(new Validator\Digits, true)
            ->attach($this->getValidDateValidator(), true)
            ->attach($this->getFutureDateValidator(), true);

        $this->add($field);
        $inputFilter->add($input);
    }

    /**
     * @return InputFilter
     */
    public function getInputFilter() : InputFilter
    {
        return $this->inputFilter;
    }

    /**
     * Combines the errors from each field into one.
     *
     * @param null $elementName
     * @return array
     */
    public function getMessages($elementName = null)
    {
        $messages = parent::getMessages($elementName);

        $combined = [];

        foreach ($messages as $errors) {
            $combined = array_merge($combined, $errors);
        }

        return $combined;
    }

    /**
     * @return ValidatorInterface
     */
    private function getValidDateValidator() : ValidatorInterface
    {
        $validator = new Callback(function ($value, $context) {
            if (count(array_filter($context)) != 3) {
                return true;
            }

            return checkdate($context['month'], $context['day'], $context['year']) && ($context['year'] < 9999);
        });

        $validator->setMessage('invalid-date', Callback::INVALID_VALUE);

        return $validator;
    }

    /**
     * @return ValidatorInterface
     */
    private function getFutureDateValidator() : ValidatorInterface
    {
        $validator = new Callback(function ($value, $context) {

            $context = array_filter($context);
            if (count($context) != 3) {
                // Don't validate unless all fields present.
                return true;
            }

            if (!checkdate($context['month'], $context['day'], $context['year'])) {
                // Don't validate if date is invalid
                return true;
            }

            $born = DateTime::createFromFormat('Y-m-d', "{$context['year']}-{$context['month']}-{$context['day']}");

            return ($born < new DateTime);
        });

        $validator->setMessage('future-date', Callback::INVALID_VALUE);

        return $validator;
    }

    /**
     * @return mixed
     */
    public function getDateValue()
    {
        $day = $this->get('day')->getValue();
        $month = $this->get('month')->getValue();
        $year = $this->get('year')->getValue();

        if (is_numeric($day) && is_numeric($month) && is_numeric($year)) {
            return new DateTime(sprintf('%s-%s-%s', $year, $month, $day));
        }

        return null;
    }
}
