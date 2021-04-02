<script type="text/javascript">
    jQuery(function ($) {
        var path = window.location.href;
        $('ul li a').each(function () {
            if (this.href === path) {
                $(this).addClass('active');
            }
        });
    });
</script>
<div id="sidebar" class="sidebar py-3">
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
    <ul class="sidebar-menu list-unstyled">
        @role('admin')
            <li class="sidebar-liste-item"><a href="{{ route('admin.dashboard') }}" class="sidebar-link text-muted"><i
                        class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
            <li class="sidebar-list-item"><a href="{{ route('user.index') }}" class="sidebar-link text-muted"><i class="fas fa-user-friends mr-3 text-gray"></i><span>Users</span></a></li>
            <li class="sidebar-list-item"><a href="{{ route('barang.index') }}" class="sidebar-link text-muted"><i class="fas fa-cubes mr-3 text-gray"></i><span> Barang</span></a></li>
            <li class="sidebar-list-item"><a href="{{ route('invoices.index') }}" class="sidebar-link text-muted"><i
                        class="o-survey-1 mr-3 text-gray"></i><span>Invoice</span></a></li>
        @elserole('user')
            <li class="sidebar-list-item"><a href="{{ route('user.dashboard') }}" class="sidebar-link text-muted"><i
                        class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
            <li class="sidebar-list-item"><a href="{{ route('invoice.index') }}" class="sidebar-link text-muted"><i
                        class="o-table-content-1 mr-3 text-gray"></i><span>Invoice</span></a></li>
            {{-- <li class="sidebar-list-item"><a href="{{ route('user.profile') }}" class="sidebar-link text-muted"><i
                        class="o-survey-1 mr-3 text-gray"></i><span>Profile</span></a></li> --}}
        @endrole
        <li class="sidebar-list-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-link text-muted"><i
                    class="o-exit-1 mr-3 text-gray"></i><span>Logout</span></a></li>
        @include('layouts.logoutForm')
    </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
