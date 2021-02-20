<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\View\Components\GuestLayout;
use Livewire\Component;


class UserTable extends Component
{
    public $c=2;
    public function render()
    {
        $usuarios=User::paginate();
        return view('livewire.user-table',compact('usuarios'));
    }
}
