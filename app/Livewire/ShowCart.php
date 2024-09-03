<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ShowCart extends Component
{
    protected $total;
    protected $content;
    public $currentStep = 1;
    public $totalSteps = 3;
    public $paymentMethods = Order::PAYMENT_METHODS;
    public $paymentMethod = 'pay_card';
    public $dates = [];

    protected $listeners = [
        'cart-updated' => 'updateCart',
    ];
    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->updateCart();

        //create an empty element foreach ticket in dates array
        $keys = $this->content->keys();
        foreach ($keys as $key) {
            $this->dates[$key] = [];
        }
    }
    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.cart', [
            'total' => $this->total,
            'content' => $this->content,
        ]);
    }
    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id, $quantity = 1): void
    {
        Cart::remove($id);
        $this->dispatch('cart-updated', quantity: $quantity, message: 'Ticket removed!');
        $this->updateCart();
    }

    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart($message = null): void
    {
        Cart::clear();
        $this->updateCart();
        $this->dispatch('cart-updated', quantity: 0, message: $message);
    }
    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $quantity = $action == 'minus' ? -1 : 1;
        $this->dispatch('cart-updated', quantity: $quantity);
        $this->updateCart();
    }
    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }

    public function incrementStep()
    {
        $this->updateCart();
        if (!$this->validateForm()) return;
        if ($this->currentStep > $this->totalSteps)
            return;
        $this->currentStep++;
    }

    public function decrementStep()
    {
        $this->updateCart();
        if ($this->currentStep < 1)
            return;
        $this->currentStep--;
    }

    public function validateForm()
    {
        if ($this->currentStep === 1) {
            // check if there is at least one ticket in cart
            $validated = $this->content->filter(function ($item) {
                return $item['quantity'] > 0;
            })->isNotEmpty();
            if (!$validated) {
                $this->addError('tickets', 'Please choose at least one ticket!');
            }
        } elseif ($this->currentStep === 2) {
            $validated = $this->paymentMethod != '';
            if (!$validated) {
                $this->addError('paymentMethod', 'Please choose a payment method!');
            }
        }
        return $validated;
    }

    public function getTickets()
    {
        return $this->content;
    }

    public function addDate($sightId)
    {
        $this->updateCart();
        Cart::updateDate($sightId, $this->dates[$sightId]);
    }

    public function submit()
    {
        try {
            $this->updateCart();
            $order = Order::create(
                [
                    'user_id' => Auth::id(),
                    'payment_method' => $this->paymentMethod,
                ]
            );
            $sights = $this->content->map(function ($item) use ($order) {
                $item['order_id'] = $order->id;
                return collect($item)->only(['sight_id', 'quantity', 'order_id', 'date'])->toArray();
            })->values()->toArray();
            foreach ($sights as $sight) {
                $order->sights()->create($sight);
            }
            $this->clearCart('Order created successfully.');

        } catch (\Exception $e) {
            $this->addError('error', 'Error!');
        };
    }
}
