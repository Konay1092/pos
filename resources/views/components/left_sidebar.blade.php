<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{route('home')}}">
            <img src="{{asset('vendors/images/logo/deskapp-logo.svg')}}" alt="" class="dark-logo">
            <img src="{{asset('vendors/images/logo/deskapp-logo-white.svg')}}" alt="" class="light-logo">


        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ request()->routeIs('admin.user') ? 'active' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-user-1"></span><span class="mtext">User</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.user') }}" class="{{ request()->routeIs('admin.user') ? 'active' : '' }}">All User</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Product</span>

                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('admin.user')}}">Add Product</a></li>


                        <li><a href="{{route('admin.user')}}">All Product</a></li>
                        <li><a href="{{route('admin.user')}}">Edit Product</a></li>
                        <li><a href="{{route('admin.user')}}">Multi Image</a></li>
                        {{-- <li><a href="index2.html">Dashboard style 2</a></li> --}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Brand</span>



                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('admin.user')}}">All Brand</a></li>
                        <li><a href="{{route('admin.user')}}">Edit Brand</a></li>
                        <li><a href="{{route('admin.user')}}">Multi Image</a></li>
                        {{-- <li><a href="index2.html">Dashboard style 2</a></li> --}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Category</span>



                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('admin.user')}}">All Category</a></li>
                        <li><a href="{{route('admin.user')}}">Edit Category</a></li>
                        {{-- <li><a href="index2.html">Dashboard style 2</a></li> --}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">All Order</span>



                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('admin.user')}}">Completed Order</a></li>
                        <li><a href="{{route('admin.user')}}">Confirm Order</a></li>
                        <li><a href="{{route('admin.user')}}">Pending Order</a></li>


                        <li><a href="{{route('admin.user')}}">Edit Order</a></li>





                        {{-- <li><a href="index2.html">Dashboard style 2</a></li> --}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Payment</span>



                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('admin.user')}}">All Payment</a></li>
                        <li><a href="{{route('admin.user')}}">Edit Payment</a></li>
                        {{-- <li><a href="index2.html">Dashboard style 2</a></li> --}}
                    </ul>
                </li>








                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Extra</div>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-edit-2"></span><span class="mtext">Documentation</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="introduction.html">Introduction</a></li>
                        <li><a href="getting-started.html">Getting Started</a></li>
                        <li><a href="color-settings.html">Color Settings</a></li>
                        <li><a href="third-party-plugins.html">Third Party Plugins</a></li>
                    </ul>
                </li>
                <li>
                    <a href="https://dropways.github.io/deskapp-free-single-page-website-template/" target="_blank" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-paper-plane1"></span>
                        <span class="mtext">Landing Page <img src="vendors/images/coming-soon.png" alt="" width="25"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
