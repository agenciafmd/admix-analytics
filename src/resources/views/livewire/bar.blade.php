<div wire:init="loadComponent" class="col-sm-12 col-lg-3">
    <div class="dimmer @if(!$this->readyToLoad) active @endif">
        <div class="loader text-muted"></div>
        <div class="dimmer-content">
            <table class="table card-table table-vcenter">
                <tbody>
                <tr>
                    <td><strong>{{ $label }}</strong></td>
                </tr>
                @foreach($rows as $row)
                    <tr>
                        <td>
                            <div class="clearfix">
                                <div class="float-left">
                                    <strong>{{ ucfirst($row['dimensions']) }}</strong>
                                </div>
                                <div class="float-right"><strong>{{ human_number($row['sessions']) }}</strong>
                                    <small class="text-muted">({{ $row['percent'] }}%)</small>
                                </div>
                            </div>
                            <div class="progress progress-xs">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $row['percent'] }}%"
                                     aria-valuenow="{{ $row['percent'] }}" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>