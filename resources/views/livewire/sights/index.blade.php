<div class="md:container md:mx-auto">
    <div class="shadow-xl bg-base-100">
        <div class="grid grid-cols-2 gap-4 px-4 py-4 mb-4">
            <div>
                <div class="mb-1 font-semibold">Search</div>
                <x-text-input placeholder="Search for any text" wireModelLive="searchText"/>
            </div>
            <div>
                <div class="mb-1 font-semibold">Price</div>
                <div class="flex space-x-2">
                    <x-text-input wireModelLive="minPrice" value="" placeholder="from"/>
                    <x-text-input wireModelLive="maxPrice" value="" placeholder="to"/>
                </div>
            </div>
            <div><select wire:model.live="searchCategory" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"> 
                <option value="0">Choose one category</option>
                @foreach($categories as $id => $category)
                    <option value="{{ $id }}"> {{ $category }} </option>
                @endforeach
            </select></div>
            <div>
                <select wire:model.live="searchLocation" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"> 
                    <option value="0">Choose one location</option>
                </select>
            </div>
        </div>
    </div>

    <x-breadcrumbs class="mb-4" :links="['Sights' => route('sights.index')]"></x-breadcrumbs>
    <div class="grid grid-cols-4 gap-4 mb-4"> 
        @foreach ($sights as $sight)
            <x-sight-card :$sight><p> {!!nl2br(e(Str::limit($sight->description, 200)))!!}</p></x-sight-card>
        @endforeach
    </div>
</div>
