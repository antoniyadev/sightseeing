<?php

namespace App\Livewire\Sights;

use Livewire\Component;
use App\Models\Sight;
use App\Facades\Cart;

class Show extends Component
{
    public Sight $sight;
    public $quantity;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->quantity = 1;
    }

    public function render()
    {
        return view('livewire.sights.show');
    }

    /**
     * Adds an item to cart.
     *
     * @return void
     */
    public function addToCart(): void
    {
        Cart::add($this->sight, $this->quantity);
        $this->dispatch('cart-updated', quantity: $this->quantity,  message: "Ticket added to cart!");
    }
}
