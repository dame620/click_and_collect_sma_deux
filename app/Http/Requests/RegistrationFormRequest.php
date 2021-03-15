<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
{

    public function wantsJson()
    {
        return true;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => 'required',
            'email'      => 'required|email',
            'telephone'  => 'required',
            'adresse'    => 'required',
            'dateofbirth'=> 'required',
            'password'   => 'required|min:8|confirmed',
        ];
    }


    public function messages()
    {
        return [
            'name.required'        => 'Vous devez saisir votre nom complet.',
            'email.required'       => 'Vous devez saisir une adresse email.',
            'email.email'          => "L'adresse email n'est pas valide.",
            'telephone.required'   => "Vous devez saisir un numéro de téléphone.",
            'adresse.required'     => "Vous devez saisir une adresse",
            'dateofbirth.required' => "Vous devez saisir une date de naissance",
            'password.required'    => "Vous devez saisir un mot de passe",
            'password.min'         => "Le mot de passe est trop court (minimum:: min caractères)",
            'password.confirmed'   => "Les mots de passe ne correspondent pas.",
        ];
    }
}
