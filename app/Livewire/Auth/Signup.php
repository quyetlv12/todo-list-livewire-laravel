<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Signup extends Component
{
    public $email;
    public $password;
    public $name;

    public function render()
    {
        return view('livewire.auth.signup');
    }
    public function signupUser()
    {
        $this->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required',
                'password' => 'required'
            ]
        );

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        Auth::login($user);
        $this->dispatch('show-modal-signup-success');
        return $this->redirect('/', navigate: true);
    }
}
