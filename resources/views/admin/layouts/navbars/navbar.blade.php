@auth()
    @include('admin.layouts.navbars.navs.auth')
@endauth

@guest()
    {{-- @include('layouts.navbars.navs.guest') --}}
@endguest
