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
              <li class="sidebar-list-item"><a href="" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
              <li class="sidebar-list-item"><a href="" class="sidebar-link text-muted"><i class="o-table-content-1 mr-3 text-gray"></i><span>Kwitansi</span></a></li>
              <li class="sidebar-list-item"><a href="" class="sidebar-link text-muted"><i class="o-survey-1 mr-3 text-gray"></i><span>Profile</span></a></li>
          <li class="sidebar-list-item"><a href="" class="sidebar-link text-muted"><i class="o-exit-1 mr-3 text-gray"></i><span>Logout</span></a></li>
        </ul>
      </div>
      <div class="page-holder w-100 d-flex flex-wrap">
