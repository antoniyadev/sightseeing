<div>
<x-breadcrumbs class="mb-4" :links="['Sights' => route('sights.index'), $sight->title => '#']"></x-breadcrumbs>
<livewire:map :$sight/>
<x-sight-card :$sight><p> {!!nl2br(e($sight->description))!!}</p></x-sight-card>
</div>

