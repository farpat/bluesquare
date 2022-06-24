@extends('front.layout')

@section('title')
    {{ __('Tickets list') }}
@endsection

{{--@section('script_to_load', 'home-index')--}}

@section('body')
    <div class="container">
        <h1>{{ __('Tickets list') }} ({{ $tickets->count() }})</h1>

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Priority') }}</th>
                <th>{{ __('Created by') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>
                        {{ $ticket->id }}
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $ticket->type }}</span>
                    </td>
                    <td>
                        {{ $ticket->title }}
                    </td>
                    <td>
                    <span class="badge bg-{{ $ticket->status_color  }}">
                        {{ $ticket->status }}
                    </span>
                    </td>

                    <td>
                    <span class="badge bg-{{ $ticket->priority_color  }}">
                        {{ $ticket->priority }}
                    </span>
                    </td>
                    <td>
                        {{ $ticket->author->name }} (<time class="text-secondary">{{ $ticket->created_at }}</time>)
                    </td>
                    <td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
