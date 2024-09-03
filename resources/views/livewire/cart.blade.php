<div
    class="flex flex-col justify-center max-w-5xl p-5 mx-auto my-2 align-middle bg-white border-2 rounded"
>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
    @endif @if ($content->count() > 0)
    <ul class="mb-5 steps steps-vertical lg:steps-horizontal">
        <li class="step @if($currentStep >= 1) step-neutral @endif">
            Choose tickets
        </li>
        <li class="step @if($currentStep >= 2) step-neutral @endif">
            Choose payment method
        </li>
        <li class="step @if($currentStep >= 3) step-neutral @endif">
            Get Summary
        </li>
    </ul>
    @error('tickets')
    <div role="alert" class="mt-10 alert alert-error">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-6 h-6 stroke-current shrink-0"
            fill="none"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
        </svg>
        <span>{{ $message }}</span>
    </div>
    @enderror @error('paymentMethod')
    <div role="alert" class="mt-10 alert alert-error">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-6 h-6 stroke-current shrink-0"
            fill="none"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
        </svg>
        <span>{{ $message }}</span>
    </div>
    @enderror
    <div class="mt-10">
        @if($currentStep === 1) @foreach ($content as $id => $item)
        <div class="flex">
            <div class="max-w-lg p-5">{{ $item["name"] }}</div>
            <div class="flex space-x-2">
                <button
                    class="btn btn-square btn-outline"
                    wire:click="updateCartItem({{ $id }}, 'minus')"
                >
                    -
                </button>
                <input
                    type="number"
                    placeholder="{{ $item['quantity'] }} "
                    class="max-w-[5rem] input input-bordered"
                />

                <button
                    class="btn btn-square btn-outline"
                    wire:click="updateCartItem({{ $id }}, 'plus')"
                >
                    +
                </button>
                <button
                    class="btn btn-square btn-outline btn-error"
                    wire:click="removeFromCart({{ $id }}, {{
                        $item['quantity']
                    }} )"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <x-datepicker
                class="px-3"
                wire:model="dates.{{ $id }}"
                wire:key="dates-{{ $id }}"
                :sightId="$id"
            />
        </div>
        @endforeach
        <hr class="my-2" />
        <p class="mb-2 text-xl text-right">Total: ${{ $total }}</p>
        @endif @if($currentStep === 2)

        <div class="space-y-2 form-control">
            @foreach ($paymentMethods as $key=>$value)
            <div>
                <input
                    type="radio"
                    wire:model="paymentMethod"
                    value="{{ $key }}"
                    class="radio"
                />
                <span class="label-text">{{ $value }}</span>
            </div>
            @endforeach
        </div>
        @endif @if($currentStep === 3)
        <div class="mx-auto shadow-xl card bg-base-100 max-w-196">
            <div class="card-body">
                <h2 class="text-center uppercase card-title">Your Summary</h2>
                <hr />
                <div class="flex flex-col">
                    <h1 class="font-bold">Tickets:</h1>
                    @foreach($this->getTickets() as $ticket)
                    <div>
                        {{ $ticket["quantity"] }} x {{ $ticket["name"] }} ({{
                            $ticket["date"]
                        }})
                    </div>
                    @endforeach
                    <div class="mt-5 font-bold">Payment method:</div>
                    <span>
                        {{$this->paymentMethods[$this->paymentMethod]}}</span
                    >
                </div>
            </div>
        </div>

        @endif
    </div>

    <div class="flex justify-center mt-5 space-x-2">
        @if($currentStep > 1)
        <button class="btn btn-outline" wire:click="decrementStep">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
            </svg>
            Back
        </button>
        @endif @if($currentStep < $totalSteps)
        <button class="btn btn-accent" wire:click="incrementStep">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
            </svg>
            Next
        </button>
        @endif @if($currentStep === $totalSteps)
        <button class="btn btn-accent" wire:click="submit">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
            </svg>
            Submit
        </button>
        @endif
    </div>
    @else

    <p class="mb-2 text-3xl text-center">Your cart is empty!</p>
    @endif
</div>
