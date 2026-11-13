@extends('layouts.app')

@section('content')
    @include('sections.hero')
    @include('sections.about')
    @include('sections.ai-lab')
    @include('sections.portfolio')
    @include('sections.highlights')
    @include('sections.resume')
    @include('sections.services')
    @include('sections.contact')
@endsection

@push('scripts')
    @if ($recaptchaSiteKey !== '')
        <script src="https://www.google.com/recaptcha/api.js?render={{ rawurlencode($recaptchaSiteKey) }}"></script>
        <script>
            window.portfolioRecaptchaSiteKey = @json($recaptchaSiteKey);
        </script>
    @endif
@endpush
