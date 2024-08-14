<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Validation\Rules\Unique;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $nip;
    public $password;
    

    //register user
    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:4|max:255',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        auth()->login();

        return redirect('/admin');


    }


    

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
