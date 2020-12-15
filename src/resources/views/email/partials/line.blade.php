<div style="display: flex; padding: 8px 0;">
    <div style="margin-right: auto; text-align: left; width: 226px; word-break: break-all;">
        <a style="color: inherit;">{{ $item['dimensions'] }}</a>
    </div>
    <div style="font-weight: 500;">
        {{ human_number($item['metrics']) }}
    </div>
    <span style="background: {{ $item['color'] ?? '#5eba00' }}; border-radius: 4px 0 0 4px; height: 12px; margin: auto 0 auto 5px; width: {{ $item['percent'] }}px;"></span>
</div>
