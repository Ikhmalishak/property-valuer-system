<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="[
                \Filament\Forms\Components\Actions\Action::make('save')->action('save')->label('Update Profile'),
            ]"
        />
    </x-filament-panels::form>

    @if (session()->has('status'))
        <p class="mt-4 text-sm text-green-600">{{ session('status') }}</p>
    @endif
</x-filament-panels::page>