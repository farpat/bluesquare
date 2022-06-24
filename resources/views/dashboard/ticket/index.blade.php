@extends('dashboard.layout')

@section('title')
    {{ __('Tickets list') }}
@endsection

@section('script_to_load', 'ticket-index')

@section('body')
    <div class="container">
        <header class="mb-5">
            <div class="row align-items-center mb-3">
                <h1 class="col m-0">{{ __('Tickets list') }} ({{ $tickets->count() }})</h1>
                <p class="col m-0 text-end">
                    <a class="btn btn-success" href="{{ route('dashboard.tickets.new') }}">{{ __('Add ticket') }}</a>
                </p>
            </div>

            <form class="row js-filter-form">
                <div class="col-md-3">
                    <select id="type" class="form-select" name="filterData[type]" aria-label="{{ __('Select type') }}">
                        <option data-empty="1">{{ __('Selected type') }}</option>
                        @foreach(\App\Models\Ticket::getTypes() as $key => $type)
                            <option value="{{ $key }}" @if(($filterData['type'] ?? null) === $key) selected @endif>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="status" class="form-select" name="filterData[status]" aria-label="{{ __('Select status') }}">
                        <option data-empty="1">{{ __('Select status') }}</option>
                        @foreach(\App\Models\Ticket::getStatuses() as $key => $status)
                            <option value="{{ $key }}" @if(($filterData['status'] ?? null) === $key) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="priority" class="form-select" name="filterData[priority]" aria-label="{{ __('Select priority') }}">
                        <option data-empty="1">{{ __('Select priority') }}</option>
                        @foreach(\App\Models\Ticket::getPriorities() as $key => $priority)
                            <option value="{{ $key }}" @if(($filterData['priority'] ?? null) === $key) selected @endif>{{ $priority }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </header>

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Title') }}</th>
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
                        @auth
                            <a class="btn btn-link" href="{{ route('dashboard.tickets.read', ['ticket' => $ticket]) }}">{{ __('Consult') }}</a>
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
