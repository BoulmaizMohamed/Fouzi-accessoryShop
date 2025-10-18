<x-filament-widgets::widget>
    <x-filament::section>
        <div class="filament-widget">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($this->getViewData() as $label => $value)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700">{{ ucwords(str_replace('_', ' ', $label)) }}</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ is_numeric($value) ? number_format($value) : $value }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
