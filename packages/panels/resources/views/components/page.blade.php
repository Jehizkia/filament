@php
    use phpDocumentor\Reflection\Types\Context;

    $widgetData = $this->getWidgetData();
@endphp

<div {{ $attributes->class(['fi-page']) }}>
    {{ \Filament\Support\Facades\FilamentView::renderHook('page.start', scope: static::class) }}

    <div class="space-y-6">
        @if ($header = $this->getHeader())
            {{ $header }}
        @elseif ($heading = $this->getHeading())
            <x-filament::header :actions="$this->getCachedHeaderActions()">
                <x-slot name="heading">
                    {{ $heading }}
                </x-slot>

                @if ($subheading = $this->getSubheading())
                    <x-slot name="subheading">
                        {{ $subheading }}
                    </x-slot>
                @endif
            </x-filament::header>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook('page.header-widgets.start', scope: static::class) }}

        @if ($headerWidgets = $this->getVisibleHeaderWidgets())
            <x-filament-widgets::widgets
                :widgets="$headerWidgets"
                :columns="$this->getHeaderWidgetsColumns()"
                :data="$widgetData"
            />
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook('page.header-widgets.end', scope: static::class) }}

        {{ $slot }}

        {{ \Filament\Support\Facades\FilamentView::renderHook('page.footer-widgets.start', scope: static::class) }}

        @if ($footerWidgets = $this->getVisibleFooterWidgets())
            <x-filament-widgets::widgets
                :widgets="$footerWidgets"
                :columns="$this->getFooterWidgetsColumns()"
                :data="$widgetData"
            />
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook('page.footer-widgets.end', scope: static::class) }}

        @if ($footer = $this->getFooter())
            {{ $footer }}
        @endif
    </div>

    @if (! $this instanceof \Filament\Tables\Contracts\HasTable)
        <x-filament-actions::modals />
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook('page.end', scope: static::class) }}
</div>