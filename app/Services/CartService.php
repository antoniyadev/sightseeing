<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Ramsey\Uuid\Type\Integer;

class CartService
{
    const DEFAULT_INSTANCE = 'shopping-cart';

    protected $session;
    protected $instance;

    /**
     * Constructs a new cart object.
     *
     * @param Illuminate\Session\SessionManager $session
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    /**
     * Adds a new item to the cart.
     *
     * @param string $id
     * @param string $name
     * @param string $price
     * @param string $quantity
     * @param array $options
     * @return void
     */
    public function add($sight, $quantity): void
    {
        $id = $sight->id;
        $price = $sight->price;

        $cartItem = $this->createCartItem($sight->id, $sight->title, $price, $quantity);

        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem['quantity'] = $content[$id]['quantity'] + $quantity;
        }

        $content->put($id, $cartItem);

        $this->session->put(self::DEFAULT_INSTANCE, $content);
    }

    /**
     * Updates the quantity of a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function update(string $id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content[$id];

            switch ($action) {
                case 'plus':
                    $cartItem['quantity'] = $content[$id]['quantity'] + 1;
                    break;
                case 'minus':
                    $updatedQuantity = $content[$id]['quantity'] - 1;

                    $cartItem['quantity'] = $updatedQuantity;
                    break;
            }

            $content->put($id, $cartItem);

            $this->session->put(self::DEFAULT_INSTANCE, $content);
        }
    }

    public function updateDate(string $id, string $date = null): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content[$id];
            $cartItem['date'] = $date ?? null;
            $content->put($id, $cartItem);
            $this->session->put(self::DEFAULT_INSTANCE, $content);
        }
    }

    /**
     * Removes an item from the cart.
     *
     * @param string $id
     * @return void
     */
    public function remove(string $id): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $this->session->put(self::DEFAULT_INSTANCE, $content->except($id));
        }
    }

    /**
     * Clears the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->session->forget(self::DEFAULT_INSTANCE);
    }


    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    public function content(): Collection
    {
        return is_null($this->session->get(self::DEFAULT_INSTANCE)) ? collect([]) : $this->session->get(self::DEFAULT_INSTANCE);
    }

    /**
     * Returns total price of the items in the cart.
     *
     * @return string
     */
    public function total(): string
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            return $total += $item['price'] * $item['quantity'];
        });

        return number_format($total, 2);
    }

    public function countCartItems()
    {
        $content = $this->getContent();

        $count = $content->reduce(function ($count, $item) {
            return $count += 1 * $item['quantity'];
        });

        return $count ?? 0;
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    protected function getContent(): Collection
    {
        return $this->session->has(self::DEFAULT_INSTANCE) ? $this->session->get(self::DEFAULT_INSTANCE) : collect([]);
    }

    /**
     * Creates a new cart item from given inputs.
     *
     * @param string $name
     * @param string $price
     * @param string $quantity
     * @param array $options
     * @return Illuminate\Support\Collection
     */
    protected function createCartItem(int $sightId, string $name, string $price, string $quantity): array
    {
        $price = floatval($price);
        $quantity = intval($quantity);

        return [
            'sight_id' => $sightId,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'date' => null
        ];
    }
}
