<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="{{ asset('admin/images/user-100.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-right info">
                <p>Mason hows11</p>
                <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="جستجو">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-o"></i>
                    <span>کاربران</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/users"><i class="fa fa-circle-o"></i>لیست کاربران</a></li>
                </ul>
            </li>

            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>تقویم</span>
                    <span class="pull-left-container">
              <small class="label pull-left bg-red">۳</small>
              <small class="label pull-left bg-blue">۱۷</small>
            </span>
                </a>
            </li>
            <li>
                <a href="pages/mailbox/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>ایمیل ها</span>
                    <span class="pull-left-container">
              <small class="label pull-left bg-yellow">۱۲</small>
              <small class="label pull-left bg-green">۱۶</small>
              <small class="label pull-left bg-red">۵</small>
            </span>
                </a>
            </li>

            <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>مستندات</span></a></li>
            <li class="header">برچسب ها</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>مهم</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>هشدار</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>اطلاعات</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>