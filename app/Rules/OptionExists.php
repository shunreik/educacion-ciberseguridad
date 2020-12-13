<?php

namespace App\Rules;

use App\Models\Question;
use Illuminate\Contracts\Validation\Rule;

class OptionExists implements Rule
{
    public $questions; //array

    public $answer;//model instance Answer
    public $options;//arrau
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($answer = null, $options = [])
    {
        // $this->questions = $questions;
        $this->answer = $answer;
        $this->options = $options;
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
        //Se verifica que la opción seleccionada exista y esté relacionada al cuestionado
        $exists = false;

        if ($this->answer->id === $value) {
            $exists = true;
        } else {
            foreach ($this->options as $option) {
                if ($option->id === $value) {
                    $exists = true;
                    break;
                }
            }
        }

        // foreach ($this->questions as $question) {
            
        // }

        // $findAnswer = Answer::find($value);
        // // 
        // if (!is_null($findAnswer)) {
        //     $exists = true;
        // } else {
        //     $findOption = Option::find($value);
        //     if (!is_null($findOption)) {
        //         $exists = true;
        //     }
        // }

        return $exists;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.option');
    }
}
