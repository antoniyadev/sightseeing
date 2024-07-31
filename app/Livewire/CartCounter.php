<?php

namespace App\Livewire;

use App\Facades\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCounter extends Component
{
    public $count = 0;

    #[On('cart-updated')]
    public function updateCartCount($quantity)
    {
        $this->count =  Cart::countCartItems() + $quantity;
    }

    public function render()
    {
        $this->count =  Cart::countCartItems();
        return view('livewire.cart-counter');
    }
}
