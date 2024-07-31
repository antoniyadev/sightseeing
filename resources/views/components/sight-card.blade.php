<div class="shadow-xl card bg-base-100">
    <div class="card-body">
        <h2 class="flex justify-between card-title">
            <a
                wire:navigate
                href="{{ route('sights.show', $sight) }}"
                >{{$sight->title}}</a
            >
            <div class="p-5 text-sm badge badge-lg badge-secondary">
                {{$sight->category->title}}
            </div>
        </h2>

        @if(is_array($sight->images)) @foreach ($sight->images as $image)
        <figure>
            <img
                class="object-cover w-full h-48"
                src="{{ asset('storage/'.$image) }}"
                alt="{{$sight->title}}"
            />
        </figure>
        @endforeach @endif

        <div class="flex justify-between">
            <span class="py-3 badge badge-error badge-lg badge-outline">
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
                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"
                    />
                </svg>
                {{$sight->city?->name}}, {{$sight->city?->country->name}}
            </span>
            <span class="badge badge-lg badge-outline"
                >${{ $sight->price }}</span
            >
        </div>
        {{ $slot }}

        <div class="justify-center mt-5 space-x-2 card-actions">
            <button
                class="btn btn-accent"
                wire:click="addToCart({{ $sight->id }})"
            >
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
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                    />
                </svg>
                Buy Ticket
            </button>
            <a
                wire:navigate
                href="{{ route('sights.show', $sight) }}"
                class="btn btn-outline"
            >
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
                        d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                    />
                </svg>

                See more</a
            >
        </div>
    </div>
</div>
