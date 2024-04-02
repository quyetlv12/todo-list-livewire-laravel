<?php

namespace App\Livewire\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Header extends Component
{

    public $navigations = [
        [
            'name' => 'Trang chủ',
            'link' => '/',
            'slugName' => 'homepage'
        ],
        [
            'name' => 'Đã lưu',
            'link' => '/saved',
            'slugName' => 'saved'
        ]
        ];

    public function render()
    {
        return view('livewire.layout.header');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Toaster::success('Đăng xuất thành công');
        return $this->redirect('/login' , navigate:true);

    }
}
