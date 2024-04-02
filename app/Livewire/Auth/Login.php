<?php

namespace App\Livewire\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public function render()
    {
        return view('livewire.auth.login');
    }
    public function loginUser(Request $request){
        $validate = $this->validate(
            [
                'email' => 'required|max:255',
                'password' => 'required' 
            ]
        );
        if (Auth::attempt($validate)) {
            # code...
            $request->session()->regenerateToken();
            Toaster::success('Đăng nhập thành công !');
            return $this->redirect('/' , navigate:true);
        }
        $this->addError('email' ,'Không tìm thấy email');
    }
}
