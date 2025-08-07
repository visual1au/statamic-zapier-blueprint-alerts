@php use function Statamic\trans as __; @endphp

@extends('statamic::layout')
@section('title', __('Edit Blueprint'))

@section('content')

    @include('statamic::partials.breadcrumb', [
        'url' => cp_route('forms.show', $form->handle()),
        'title' => __($form->title()),
    ])

    {{-- Show Zapier webhook alert if form has webhooks configured --}}
    @if(isset($hasZapierWebhooks) && $hasZapierWebhooks)
        @include('zapier-blueprint-alerts::alert')
    @endif

    <blueprint-builder
        action="{{ cp_route('forms.blueprint.update', $form->handle()) }}"
        :initial-blueprint="{{ json_encode($blueprintVueObject) }}"
        :use-tabs="false"
        :is-form-blueprint="true"
        :can-define-localizable="false"
    ></blueprint-builder>

    @include('statamic::partials.docs-callout', [
        'topic' => __('Blueprints'),
        'url' => Statamic::docsUrl('blueprints')
    ])

@endsection