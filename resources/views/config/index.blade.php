<x-layout title="Config">

    <x-slot name="head">
        <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
        <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    </x-slot>

    <div class="h3 text-primary border-bottom border-primary">Configs</div>
    <div style="max-width: 600px; margin:auto">

        <x-errors></x-errors>

        @php
            $is_admin = auth()
                ->user()
                ->isAdmin();
        @endphp

        @php textconfig('Send "FROM" email', 'send-from-email', 'email'); @endphp
        @php textconfig('Set DEMO "TO" email', 'force-to-email', 'email'); @endphp


        @php textconfig('Company name in invoice', 'company-name'); @endphp
        @php textconfig('Company address', 'company-address'); @endphp
        @php textconfig('Company email', 'company-email'); @endphp
        @php textconfig('Company phone', 'company-phone'); @endphp

        @php textconfig('Email subject', 'email-subject'); @endphp

        <div class="form-group">
            <form method="POST">
                @csrf
                <label class="font-weight-bold text-primary mt-3" for="">Email body</label>
                <div id="editor"></div>
                <input type="hidden" id="email_body" name="email-body" value="@config('email-body')">
                <script>
                    (() => {
                        const editor = new toastui.Editor({
                            el: document.querySelector('#editor'),
                            height: '300px',
                            initialValue: email_body.value,
                            initialEditType: 'wysiwyg'
                        });

                        editor.on('change', () => {
                            email_body.value = editor.getHTML();
                        })

                    })();
                </script>

                <div class="text-center">
                    <button class="btn btn-outline-primary mt-3" type="submit">✔</button>
                </div>
            </form>
        </div>

        <hr>

        <div class="form-group">
            @if ($is_admin)
                <form method="POST" action="{{ route('config.super') }}">
                    @csrf
            @endif

            <label class="font-weight-bold text-primary mt-3" for="">Set application DEMO mode ON/OFF</label>
            <input type="hidden" name="demo-mode" value="0">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <input type="checkbox" @if ($is_admin) name="demo-mode" @else disabled @endif
                            @checked(\App\Models\Config::value('demo-mode') == 1) />
                    </span>
                </div>
                <input type="text" class="form-control bg-white font-weight-bold text-primary" value="Demo mode"
                    readonly>

                @if ($is_admin)
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">✔</button>
                    </div>
                @endif
            </div>
            </form>
        </div>

        <div class="form-group">
            @if ($is_admin)
                <form method="POST" action="{{ route('config.super') }}">
                    @csrf
            @endif

            <label class="font-weight-bold text-primary mt-3" for="">Max mails per day</label>
            <div class="input-group">
                <input class="form-control" type="number" step="1" required
                    @if ($is_admin) name="max-mails-per-day" @else disabled @endif
                    value="@config('max-mails-per-day')" />

                @if ($is_admin)
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">✔</button>
                    </div>
                @endif
            </div>
            </form>
        </div>

        <div class="form-group">
            @if ($is_admin)
                <form method="POST" action="{{ route('config.super') }}">
                    @csrf
            @endif

            <label class="font-weight-bold text-primary mt-3" for="">Max file upload size (MBs)</label>
            <div class="input-group">
                <input class="form-control" type="number" step="1" required
                    @if ($is_admin) name="max-file-size" @else disabled @endif
                    value="@config('max-file-size')" />

                @if ($is_admin)
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">✔</button>
                    </div>
                @endif
            </div>
            </form>
        </div>

        <div class="form-group">
            @if ($is_admin)
                <form method="POST" action="{{ route('config.super') }}">
                    @csrf
            @endif

            <label class="font-weight-bold text-primary mt-3" for="">Application name</label>

            <div class="input-group">
                <input class="form-control" type="text" required
                    @if ($is_admin) name="application-title" @else disabled @endif
                    value="@config('application-title')" />

                @if ($is_admin)
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">✔</button>
                    </div>
                @endif
            </div>
            </form>
        </div>

    </div>
</x-layout>

<?php function textconfig($label,$key,$type='text') {?>
<div class="form-group">
    <form method="POST">
        @csrf
        <label class="font-weight-bold text-primary mt-3" for="">{{ $label }}</label>
        <div class="input-group">
            <input class="form-control" type="{{ $type }}" name="{{ $key }}" required
                value="@config($key)" />

            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit">✔</button>
            </div>
        </div>
    </form>
</div>
<?php } ?>
