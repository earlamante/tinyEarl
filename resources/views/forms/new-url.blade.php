<form method="POST" action="{{ route('dashboard.add_new') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="url" id="url" aria-describedby="URL" placeholder="Enter LongEarl" required>
                @if ($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Shorten</button>
        </div>
    </div>
</form>
