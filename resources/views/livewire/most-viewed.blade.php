<div wire:init="loadComponent">
    <div id="table-default" class="table-responsive dimmer @if(!$this->readyToLoad) active @endif">
        <table class="table">
            <thead>
            <tr>
                <th>Página</th>
                <th>Visualizações</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-tbody">
            @foreach($rows as $row)
                <tr>
                    <td>{{ ucfirst($row['page']) }}<a href="{{ ucfirst($row['page']) }}" class="ms-1" aria-label="Open website"><!-- Download SVG icon from http://tabler-icons.io/i/link -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 15l6 -6"></path><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path></svg>
                        </a></td>
                    <td>{{ number_format($row['sessions'],0) }}</td>
                    <td data-progress="{{ $row['percent'] }}">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-auto">{{ $row['percent'] }}%</div>
                            <div class="col">
                                <div class="progress" style="width: 5rem">
                                    <div class="progress-bar" style="width: {{ $row['percent'] }}%" role="progressbar" aria-valuenow="{{ $row['percent'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $row['percent'] }}0% Complete">
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
