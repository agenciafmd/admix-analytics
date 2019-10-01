<table class="table card-table table-vcenter">
    <tbody>
    <tr>
        <td><strong>{{ $label }}</strong></td>
    </tr>
    @foreach($data as $item)
        <tr>
            <td>
                <div class="clearfix">
                    <div class="float-left">
                        <strong>{{ ucfirst($item[$key]) }}</strong>
                    </div>
                    <div class="float-right"><strong>{{ $item[$value] }}</strong>
                        <small class="text-muted">({{ round(($item[$value] / $total) * 100, 2) }}%)</small>
                    </div>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar --bg-green" role="progressbar" style="width: {{ round(($item[$value] / $total) * 100, 2) }}%" aria-valuenow="{{ round(($item[$value] / $total) * 100, 2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>