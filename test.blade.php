@props(['foo' => 'bar', 'baz'])

@aware(['parent' => 'property'])

@extends('parent.name')

@use('App\Models\Example', 'Alias')
@use('App\Models\{Foo, Bar}')
@use(function App\Helpers\format_currency)
@use(const App\Constants\MAX_ATTEMPTS)
@use(function App\Helpers\{format_currency, format_date})
@use(const App\Constants\{MAX_ATTEMPTS, DEFAULT_TIMEOUT})

<?php if($foo='bar' ) { $something() } ?>
Hello, {{ $name }}.

The current UNIX timestamp is {{ time() }}.

Hello, @{{ name }}.

{{ isset($name) ? $name : 'Default' }}

Hello, {!! $name !!}.

@if ($foo == 'bar') @endif

@if (count($records) === 1)
    I have one record!
@elseif (count($records) > 1)
    I have multiple records!
@else
    I don't have any records!
@endif

@unless (Auth::check())
    You are not signed in.
@endunless

@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
    @break
    @continue
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
    @break ($user->last)
    @continue ($user->skip)
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I'm looping forever.</p>
@endwhile

@can('update-post', $post)
    <!-- current user can update the post -->
@elsecan('delete-post', $post)
    <!-- current user can delete the post -->
@else
    <!-- current user can't update or delete the post -->
@endcan

@cannot('view-post')
    <!-- current user cannot view the post -->
@elsecannot('publish-post')
    <!-- current user cannot publish the post -->
@endcannot

@canany(['update', 'view'], $post)
    <!-- current user can either update or view post -->
@elsecanany(['create'], \App\Models\Post::class)
    <!-- current user can create a post -->
@endcanany

<div>
    @include('shared.errors')
    <form>
        <!-- Form Contents -->
    </form>
</div>

@each('view.name', $jobs, 'job')

{{-- This comment will not be present in the rendered HTML --}}

{{--
    This comment spans
    multiple lines
    @yield('dont highlight')
--}}

{{-- todo fixme xxx note TODO FIXME XXX NOTE --}}

@inject('metrics', 'App\Services\MetricsService')

@once
    @push('scripts')
        <script src="/example.js"></script>
    @endpush
@endonce

@pushOnce('scripts')
    <script src="/example.js"></script>
@endPushOnce

@pushIf($shouldPush, 'scripts')
    <script src="/maybe.js"></script>
@elsePushIf($pushOther, 'scripts')
    <script src="/other.js"></script>
@elsePush
    <script src="/fallback.js"></script>
@endPushIf

@hasstack('list')
    <ul>
        @stack('list')
    </ul>
@endif

<head>
    <!-- Head Contents -->
    <title>
        @hasSection('title')
            Test - @yield('title')
        @else
            Test
        @endif
    </title>

    @stack('scripts')

    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>

@prepend('scripts')
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
@endprepend

@prependOnce('scripts')
    <script src="{{ mix('/js/prepend.js') }}"></script>
@endPrependOnce

@fragment('list')
    <!-- list contents -->
@endfragment

<div>
    @section('sidebar')
        This is the master sidebar.
    @show

    @yield('content')
</div>

@section('title', 'Page Title')

@section('sidebar')
    @@parent
    <p>This is appended to the master sidebar.</p>
@endsection

@sectionMissing('navigation')
    default navigation
@endif

<form method="POST">
    @method('PUT')
    @csrf

    <input name="example" {{ old('example') ? 'checked' : '' }} />

    <input
        type="checkbox"
        name="terms"
        @checked(old('active', $isActive))
        class="@error('terms') is-invalid @else is-valid @enderror"
    />
    @error('terms')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <input
        type="text"
        @class($classes)
        @style($styles)
        value="initial"
        @disabled($disable)
        @readonly($user->isNotAdmin())
        @required($user->isAdmin())
        aria-disabled="@bool($disable)"
    />

    <select name="shape">
        @foreach ($shapes as $shape)
            <option value="{{ $shape }}" @selected(old('shape') == $shape)>
                {{ $shape }}
            </option>
        @endforeach
    </select>
</form>

<?php
    $collection = collect([
        'foo' => [
            'bar',
            'baz',
        ]
    ])
?>

@include('pages.home', [
    'foo' => [
        'bar',
        'baz',
    ]
])

{{
    sprintf(
        'This %s a multiline echo statement',
        $foo
    )
}}

@cache
    A custom Blade directive
    @datetime($var)
    @namespaced::directive($var)
@endcache

@php($var = 'Hello World')
@unset($var)

@php
    $environment = isset($env) ? $env : 'testing';
@endphp

do_not_highlight@php.net

@verbatim
    <p class="highlighted">@if(true) {{ $notHighlighted }} @endif</p>
    <!-- highlighted -->
    <?php /* also highlighted */ ?>
@endverbatim

@lang('messages.welcome')
@choice('messages.items', 3)

@component('app')
    @slot('title')
        Title goes here
    @endslot
@endcomponent

@json($foo)

@isset($foo)
    records
@endisset

@empty($foo)
    records
@endempty

@auth('admin')
    authenticated as admin
@elseauth('editor')
    authenticated as editor
@endauth

@guest('admin')
    not authenticated as admin
@elseguest('editor')
    not authenticated as admin or guest
@endguest

@production
    only in production
@endproduction

@env(['staging', 'production'])
    in staging or production
@endenv

@session('status')
    session status is {{ $value }}
@endsession

@context('canonical')
    <link href="{{ $value }}" rel="canonical">
@endcontext

@switch($i)
    @case(1)
        case code
        @break

    @default
        default case

@endswitch

<a
    href="#"
    @class([
        'p-4',
        'active' => $isActive,
        'big' => $size > 4, // html tag should not end yet
    ])
    @style([
        'margin: 0',
        'font-weight: bold' => $isActive,
    ])
>Link</a>

@includeIf('view.name')
@includeWhen($condition, 'view.name')
@includeUnless($condition, 'view.name')
@includeFirst(['custom.name', 'name'])

<x-profile :$userId :$name />
<x-profile :user-id="$userId ?? null" :name="$name" />

{{-- double colon prefix not treated as php --}}
<x-collapse ::class="{ collapsed: isCollapsed }" />

