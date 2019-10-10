<html>
<head>

</head>
<body>
<div style="background: white; box-sizing: border-box; color: #3C4043; font-family: Roboto,Arial,sans-serif; margin: 0 auto; min-width: 320px; max-width: 458px; text-align: center; ">
    <div style="border: 1px solid #dadce0; border-radius: 8px; margin-bottom: 8px;">
        <div style="padding: 24px 8px;">
            <img src="{{ asset('/images/fmd.svg') }}"
                 style="display: block; height: 35px; margin: 0 auto; padding-bottom: 30px;">
            <div style="font-size: 22px; font-weight: 500; line-height: 28px; padding: 0 8px 20px;">
                Seu desempenho no Google<br/>
                {{ $initialDate->format('d/m') }} até {{ $finalDate->format('d/m') }}
            </div>
            <div style="background-image: url('{{ asset('images/grail.png') }}'); background-size: cover; height: 88px; margin: 0 auto; width: 76px;">
                <img src="{{ asset('images/apple-touch-icon.png') }}"
                     style="height:24px; margin-top: 14px; width: 24px;">
            </div>
            <div style="font-size: 16px; font-weight: 500; letter-spacing: 0.1px; line-height: 24px; padding: 4px 0 38px;">
                <a style="color: inherit;">{{ config('app.name') }}</a></div>
            <div style="display: flex; padding-bottom: 16px;">
                <div style="width: 136px; margin: 0 7px 0 auto;">
                    <img src="{{ asset('images/eye.svg') }}"
                         style="border-radius: 50%; height: 24px; padding: 8px; width: 24px; background: #17a2b8;">
                    <div style="font-size: 22px; line-height: 28px;">{{ $sessions }}</div>
                    <div style="color: #80868b; font-size: 12px; letter-spacing: 0.3px; line-height: 16px;">Acessos
                    </div>
                </div>
                <div style="width: 136px; margin: 0 auto 0 7px;">
                    <img src="{{ asset('images/search.svg') }}"
                         style="border-radius: 50%; height: 24px; padding: 8px; width: 24px; background: #fa4654;">
                    <div style="font-size: 22px; line-height: 28px;">{{ $organicSearches }}</div>
                    <div style="color: #80868b; font-size: 12px; letter-spacing: 0.3px; line-height: 16px;">Acessos<br/>Orgânicos
                    </div>
                </div>
            </div>
            <div style="display: flex; padding-bottom: 16px; padding-top: 8px;">
                <div style="width: 136px; margin: 0 auto;">
                    <img src="{{ asset('images/users.svg') }}"
                         style="border-radius: 50%; height: 24px; padding: 8px; width: 24px; background: #5eba00;">
                    <div style="font-size: 22px; line-height: 28px;">{{ $newUsers }}</div>
                    <div style="color: #80868b; font-size: 12px; letter-spacing: 0.3px; line-height: 16px;">Novos<br>Usuários
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="border: 1px solid #dadce0; border-radius: 8px; margin-bottom: 8px;">
        <div style="padding: 24px 16px 32px;">
            <div style="font-size: 22px; line-height: 28px; padding: 0 8px;">Destaques do seu conteúdo</div>
            <div style="font-size: 16px; letter-spacing: 0.1px; line-height: 24px; padding-top: 36px;">
                Páginas com o melhor desempenho
            </div>
            <div style="font-size: 12px; letter-spacing: 0.3px; line-height: 16px; box-sizing: border-box; margin: 0 auto; max-width: 346px; padding: 16px 8px 0;">
                <div style="color: #9aa0a6; display: flex; font-size: 12px; letter-spacing: 0.3px; line-height: 16px;">
                    <div style="margin-right: auto;">Página</div>
                    <div>Visualizações</div>
                </div>
                @foreach($topPages as $page)
                    <div style="display: flex; padding: 8px 0;">
                        <div style="margin-right: auto; text-align: left; width: 226px; word-break: break-all;"><a
                                    style="color: inherit;">{!! asset($page->path) !!}</a></div>
                        <div style="font-weight: 500;">{{ $page->pageViews }}</div>
                    </div>
                    @if(!$loop->last)
                        <div style="background: #dadce0; height: 1px;"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div style="border: 1px solid #dadce0; border-radius: 8px; margin-bottom: 8px;">
        <div style="padding: 24px 16px 32px;">
            <div style="font-size: 22px; line-height: 28px; padding: 0 8px;">
                Como as pessoas encontram seu conteúdo?
            </div>
            <div style="font-size: 16px; letter-spacing: 0.1px; line-height: 24px; padding-top: 36px;">
                Palavras com o melhor desempenho
            </div>
            <div style="font-size: 12px; letter-spacing: 0.3px; line-height: 16px; box-sizing: border-box; margin: 0 auto; max-width: 346px; padding: 16px 8px 0;">
                <div style="color: #9aa0a6; display: flex; font-size: 12px; letter-spacing: 0.3px; line-height: 16px;">
                    <div style="margin-right: auto;">Palavras</div>
                    <div>Visualizações</div>
                </div>
                @foreach($topKeyword as $keyword)
                    <div style="display: flex; padding: 8px 0;">
                        <div style="margin-right: auto; text-align: left; width: 226px; word-break: break-all;"><a
                                    style="color: inherit;">{!! $keyword->keyword !!}</a></div>
                        <div style="font-weight: 500;">{{ $keyword->pageViews }}</div>
                    </div>
                    @if(!$loop->last)
                        <div style="background: #dadce0; height: 1px;"></div>
                    @endif
                @endforeach
            </div>
            <div style="font-size: 16px; letter-spacing: 0.1px; line-height: 24px; padding-top: 36px;">
                Entradas de acesso
            </div>
            <div style="font-size: 12px; letter-spacing: 0.3px; line-height: 16px; box-sizing: border-box; margin: 0 auto; max-width: 346px; padding: 16px 8px 0;">
                <div style="color: #9aa0a6; display: flex; font-size: 12px; letter-spacing: 0.3px; line-height: 16px;">
                    <div style="margin-right: auto;">Fonte</div>
                    <div>Visualizações</div>
                </div>
                @foreach($topMedium as $page)
                    <div style="display: flex; padding: 8px 0;">
                        <div style="margin-right: auto; text-align: left; width: 226px; word-break: break-all;"><a
                                    style="color: inherit;">{{ $page->medium }}</a></div>
                        <div style="font-weight: 500;">{{ $page->pageViews }}</div>
                    </div>
                    @if(!$loop->last)
                        <div style="background: #dadce0; height: 1px;"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div style="border: 1px solid #dadce0; border-radius: 8px; margin-bottom: 8px;">
        <div style="padding: 24px 16px;">
            <div style="font-size: 22px; line-height: 28px; padding: 0 8px;">Saiba mais sobre seu público-alvo</div>
            <div style="font-size: 16px; letter-spacing: 0.1px; line-height: 24px; padding-top: 36px;">Dispositivos
            </div>
            <div style="font-size: 12px; letter-spacing: 0.3px; line-height: 16px; color: #80868b; padding-bottom: 16px;">
                Acessos
            </div>
            <div style="display: inline-flex; padding: 24px 6px 16px;">
                <div style="border-bottom: 1px solid #dadce0; display: inline-flex; padding: 0 12px;">
                    <span style="background: #17a2b8; border-radius: 4px 4px 0 0; height: {{ (optional($topDeviceCategory->where('deviceCategory', 'desktop')->first())->percent) ?? 0 }}px; margin-top: auto; width: 32px;"></span>
                    <span style="background: #5eba00; border-radius: 4px 4px 0 0; height: {{ (optional($topDeviceCategory->where('deviceCategory', 'mobile')->first())->percent) ?? 0 }}px; margin: auto 2px 0; width: 32px;"></span>
                    <span style="background: #fa4654; border-radius: 4px 4px 0 0; height: {{ (optional($topDeviceCategory->where('deviceCategory', 'tablet')->first())->percent) ?? 0 }}px; margin-top: auto; width: 32px;"></span>
                </div>
            </div>
            <div style="margin: 0 auto; width: 256px;">
                <div style="color: #3c4043; font-size: 12px; letter-spacing: 0.3px; line-height: 16px; padding: 20px 0 6px;">
                    <div style="display: flex; margin-bottom: 8px;">
                        <img src="{{ asset('images/monitor.svg') }}"
                             style="height: 24px; width: 24px; padding: 0 24px;">
                        <img src="{{ asset('images/smartphone.svg') }}"
                             style="height: 24px; width: 24px; padding: 0 44px;">
                        <img src="{{ asset('images/tablet.svg') }}"
                             style="height: 24px; width: 24px; padding: 0 24px;">
                    </div>
                    <div style="display: flex;">
                        <span style="width: 72px; word-break: break-word;">Computador</span>
                        <span style="width: 72px; word-break: break-word; padding: 0 20px;">Dispositivo Móvel</span>
                        <span style="width: 72px; word-break: break-word;">Tablet</span>
                    </div>
                    <div style="display: flex;">
                        <span style="width: 72px;">{{ (optional($topDeviceCategory->where('deviceCategory', 'desktop')->first())->sessions) ?? 0 }}</span>
                        <span style="width: 72px; padding: 0 20px;">{{ (optional($topDeviceCategory->where('deviceCategory', 'mobile')->first())->sessions) ?? 0 }}</span>
                        <span style="width: 72px;">{{ (optional($topDeviceCategory->where('deviceCategory', 'tablet')->first())->sessions) ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div style="background: #dadce0; height: 1px; margin-bottom: 12px;"></div>
        <div style="margin: 0 auto; width: 256px;">
            <div style="padding-bottom: 24px;">
                <div style="font-size: 16px; letter-spacing: 0.1px; line-height: 24px; padding-top: 36px;">
                    Principais Cidades
                </div>
                <div style="font-size: 12px; letter-spacing: 0.3px; line-height: 16px; color: #80868b; padding-bottom: 16px;">
                    Acessos
                </div>
                <div style="font-size: 12px; letter-spacing: 0.3px; line-height: 16px; box-sizing: border-box; margin: 0 auto; max-width: 346px; padding: 16px 8px 0;">
                    @foreach($topCity as $city)
                        <div style="display: flex; padding: 8px 0;">
                            <div style="margin-right: auto; text-align: left; width: 226px; word-break: break-all;"><a
                                        style="color: inherit;">{{ $city->city }}</a></div>
                            <div style="font-weight: 500;">{{ $city->pageViews }}</div>
                        </div>
                        @if(!$loop->last)
                            <div style="background: #dadce0; height: 1px;"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div>
        <div style="padding: 34px 24px 64px;">
            <div style="margin: 0 auto; width: 304px;">
                <div style="color: #80868b; font-size: 16px; font-weight: 500; letter-spacing: 0.1px; line-height: 24px; padding: 24px 0 28px;">
                    {{ date('Y') }} - <a href="https://fmd.ag/?utm_source=report"
                                         style="color: #80868b; text-decoration: none;">Agência F&MD</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>