<x-smalllayout title="Upload">

    <label>Import CSV</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="file" required accept=".csv">
        <label class="custom-file-label" for="customFile">Choose file</label>
        <div class="small text-danger">
            @if (\App\Models\Config::value('demo-mode'))
                DEMO:
            @endif
            Max file size @config('max-file-size')mb.
        </div>
    </div>

    <x-errors></x-errors>

    <div class="mt-3 text-center">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>

</x-smalllayout>
