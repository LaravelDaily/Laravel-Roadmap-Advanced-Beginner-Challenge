<?php

namespace App\Http\Livewire;

use Livewire\Component;
class Notification extends Component
{

    public $notifications;
    public $showNotification = 'hide';
    public function markAsRead($id)
    {
        auth()->user()->notifications->where('id', $id)->first()->markAsRead();
        $this->notifications = auth()->user()->unreadNotifications;
        $this->showNotification = 'show';
    }

    public function markAllAsRead()
    {
        $this->notifications->markAsRead();
        $this->notifications = auth()->user()->unreadNotifications;
        $this->showNotification = 'show';
    }

    public function mount()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
