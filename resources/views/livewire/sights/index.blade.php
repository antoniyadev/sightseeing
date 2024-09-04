<div class="container max-w-7xl md:mx-auto">
    <img src="storage/hero.jpg" class="w-full" />
    @if(!$sights->isEmpty())
    <div class="shadow-xl bg-base-100">
        <div class="grid grid-cols-4 px-4 py-4 mb-4 space-x-4">
            <div>
                <div class="mb-1 font-semibold">Search</div>
                <input
                    type="text"
                    wire:model.live="searchText"
                    placeholder="Search for any text"
                    class="w-full max-w-xs input input-bordered"
                />
            </div>
            <div>
                <div class="mb-1 font-semibold">Category</div>
                <select
                    wire:model.live="searchCategory"
                    class="w-full max-w-xs select select-bordered"
                >
                    <option selected>Choose one category</option>
                    @foreach($categories as $id => $category)
                    <option value="{{ $id }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <div class="mb-1 font-semibold">Location</div>
                <select
                    wire:model.live="searchLocation"
                    class="w-full max-w-xs select select-bordered"
                >
                    <option selected>Choose one location</option>
                    @foreach($locations as $id => $location)
                    <option value="{{ $id }}">{{ $location }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <div class="mb-1 font-semibold">Price</div>
                <div class="flex space-x-2">
                    <input
                        type="range"
                        wire:model.live="maxPrice"
                        min="0"
                        max="500"
                        class="mt-3 range range-accent range-xs"
                    />
                    <span>${{ $maxPrice }}</span>
                </div>
            </div>
        </div>
    </div>

    <x-breadcrumbs
        class="mb-4"
        :links="['Sights' => route('sights.index')]"
    ></x-breadcrumbs>
    <div class="grid grid-cols-3 gap-4 mb-4">
        @foreach ($sights as $sight)
        <x-sight-card :$sight
            ><p class="text-wrap">
                {!!nl2br(Str::limit($sight->description, 150))!!}
            </p></x-sight-card
        >
        @endforeach
    </div>
    <div class="flex justify-center mb-10 join">
        {{ $sights->links('custom-pagination-links-view') }}
    </div>

    @else
    <p class="m-5 text-3xl text-center">No sights found</p>
    @endif
</div>
