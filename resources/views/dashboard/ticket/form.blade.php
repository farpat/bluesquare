@extends('dashboard.layout')

@section('title')
    @if ($ticket->exists)
        {{ __('Ticket') }} << {{ $ticket->title }} >>
    @else
        {{ __('Create ticket') }}
    @endif
@endsection

@section('script_to_load', 'ticket-form')

@section('body')
    <div class="container">
        <h1>
            @if ($ticket->exists)
                {{ __('Edit ticket') }} << {{ $ticket->title }} >>
            @else
                {{ __('Create ticket') }}
            @endif
        </h1>

        <form method="POST"
              action="@if ($ticket->exists) {{ route('dashboard.tickets.update', ['ticket' => $ticket]) }}@else {{ route('dashboard.tickets.store') }} @endif">
            @csrf

            @if ($ticket->exists)
                @method('PUT')
            @endif

            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{ old('title', $ticket->title) }}"
                           required autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                <div class="col-md-6">
                    @php
                        $selectedType = old('type', $ticket->type);
                    @endphp

                    <select id="type" class="form-select @error('type') is-invalid @enderror" name="type">
                        <option @if (!$selectedType) selected @endif>Select type</option>
                        @foreach(\App\Models\Ticket::getTypes() as $key => $type)
                            <option value="{{ $key }}" @if ($selectedType === $key) selected @endif>{{ $type }}</option>
                        @endforeach
                    </select>

                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>


                <div class="col-md-6">
                    @php
                        $selectedStatus = old('status', $ticket->status);
                    @endphp

                    <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                        <option @if (!$selectedStatus) selected @endif>Select status</option>
                        @foreach(\App\Models\Ticket::getStatuses() as $key => $status)
                            <option value="{{ $key }}" @if ($selectedStatus === $key) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>

                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="priority" class="col-md-4 col-form-label text-md-right">{{ __('Priority') }}</label>

                <div class="col-md-6">
                    @php
                        $selectedPriority = old('priority', $ticket->priority);
                    @endphp

                    <select id="priority" class="form-select @error('priority') is-invalid @enderror" name="priority">
                        <option @if (!$selectedPriority) selected @endif>Select priority</option>
                        @foreach(\App\Models\Ticket::getPriorities() as $key => $priority)
                            <option value="{{ $key }}" @if ($selectedPriority === $key) selected @endif>{{ $priority }}</option>
                        @endforeach
                    </select>

                    @error('priority')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                <div class="col-md-6">
                    <textarea id="description" type="text" class="js-wysiwyg form-control @error('description') is-invalid @enderror"
                              name="description" required>{{ old('description', $ticket->description) }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="context" class="col-md-4 col-form-label text-md-right">{{ __('Context') }}</label>

                <div class="col-md-6">
                    <textarea id="context" type="text" class="js-wysiwyg form-control @error('context') is-invalid @enderror"
                              name="context">{{ old('context', $ticket->context) }}</textarea>

                    @error('context')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row mt-2 mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        @if ($ticket->exists)
                            {{ __('Edit Ticket') }}
                        @else
                            {{ __('Create ticket') }}
                        @endif
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
