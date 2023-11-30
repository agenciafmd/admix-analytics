<div wire:init="loadComponent" class="col-sm-6 col-md-3">
    <div class="card">
        <div class="dimmer @if(!$this->readyToLoad) active @endif">
            <div class="loader text-muted"></div>
            <div class="dimmer-content">
                <div class="card-body p-3 text-center">
                    @if(isset($indicator))
                        <div class="text-right @if(Str::startsWith($indicator, '-')) text-red @else text-green @endif @if($indicator == '0%' || $indicator == '0') invisible @else visible @endif">
                            {{ trim($indicator, '-') }}
                            <i class="icon @if(Str::startsWith($indicator, '-')) fe-chevron-down @else fe-chevron-up @endif"></i>
                        </div>
                    @endif
                    <div class="h1 m-0">{{ $total }}</div>
                    <div class="text-muted mb-4">{{ $label }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
