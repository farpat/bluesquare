@extends('dashboard.layout')

@section('title')
    Ticket << {{ $ticket->title }} >>
@endsection

@section('script_to_load', 'ticket-read.jsx')

@section('body')
    <div class="container">
        <h1>{{ __('Ticket informations') }}</h1>

        <div id="app"></div>

        <div class="card">
            <div class="card-body pt-4">
                <section class="ticket-description">
                    <a href="{{ route('dashboard.tickets.edit', ['ticket' => $ticket]) }}" class="btn btn-light position-absolute top-0 end-0">
                        {{ __('Edit') }}
                    </a>

                    <h2 class="h5">{{ __('Description') }}</h2>
                    <div>
                        {!! $ticket->description !!}
                    </div>
                </section>

                <section class="ticket-context mt-5">
                    <h2 class="h5">{{ __('Context') }}</h2>
                    {!! $ticket->context !!}
                </section>
            </div>
        </div>
    </div>
@endsection
