@include('client.section.header')

<div>

    @include('client.section.topnav')

    <!-- START PAGE CONTENT-->

    @include('client.section.notify')
    @yield('main-content')

    <!-- END PAGE CONTENT-->

    @include('client.section.footer')
</div>

@include('client.section.scripts')
