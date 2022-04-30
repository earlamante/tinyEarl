@extends('dashboard')
@section('content')
    <h3>Welcome back {{ Auth::user()->name }}</h3>

    <div class="py-3">
        @include('forms.new-url')
    </div>

    <div class="py-3">
        @if($urls->count())
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 20%;">TinyEarl</th>
                        <th scope="col">LongEarl</th>
                        <th style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($urls as $url)
                        <tr>
                            <td scope="row">
                                <span id="tiny_{{ $url->id }}" class="d-none">{{ $url->tinyearl }}</span>
                                <a href="#" onclick="copyText('#tiny_{{ $url->id }}');" style="margin-right: 5px;"><i class="fa-solid fa-copy"></i></a>
                                <a href="{{ $url->tinyearl }}" target="_blank">{{ $url->custom }}</a>
                            </td>
                            <td class="position-relative">
                                <a href="#" onclick="copyText('#url_{{ $url->id }}');" style="margin-right: 5px;"><i class="fa-solid fa-copy"></i></a>
                                <a id="url_{{ $url->id }}" href="{{ $url->url }}" target="_blank" class="mx-2">{{ $url->url }}</a>
                            </td>
                            <td>
                                <form class="d-inline" method="POST" action="{{ url('/delete/' . $url->id) }}" onsubmit="return confirmDelete();">
                                    @csrf
                                    <button style="border: 0; background: none; color: red;"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center border-top pt-3">
                <h4>No URL shortened yet</h4>
            </div>
        @endif
    </div>
@endsection
