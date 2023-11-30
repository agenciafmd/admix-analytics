<div wire:init="loadComponent">
    <div id="table-default" class="table-responsive dimmer @if(!$this->readyToLoad) active @endif">
        <table class="table">
            <thead>
            <tr>
                <th>Referência</th>
                <th>Visualizações</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-tbody">
        @foreach($rows as $row)
            <tr>
                <td>
                    {{ ucfirst($row['dimensions']) }}
                </td>
                <td>{{ number_format($row['sessions'],0) }}</td>
                <td data-progress="{{ $row['percent'] }}">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-auto">{{ $row['percent'] }}%</div>
                        <div class="col">
                            <div class="progress" style="width: 5rem">
                                <div class="progress-bar" style="width: {{ $row['percent'] }}%" role="progressbar" aria-valuenow="{{ $row['percent'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $row['percent'] }}% Complete">
                                    <span class="visually-hidden">{{ $row['percent'] }}% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
</div>
