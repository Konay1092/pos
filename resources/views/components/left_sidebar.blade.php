<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{route('home')}}" >
            {{-- <img src="{{asset('vendors/images/logo/logo-dark.svg')}}" alt="" class="dark-logo"> --}}
            {{-- <img src="{{asset('vendors/images/logo/deskapp-logo-white.svg')}}" alt="" class="light-logo"> --}}
            <img src="{{asset('vendors/images/logo/logo-dark.svg')}}" alt="" class="dark-logo" width="50px" height="50px">

            <img src="{{asset('vendors/images/logo/logo-dark.svg')}}" alt="" class="light-logo" width="50px" height="50px">

            <span class="" style="color:rgb(61, 61, 231)">Nadi Yoon Htike
</span>
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

               <li class="dropdown {{ request()->routeIs('products.*') ? 'active' : '' }}">
    <a href="javascript:;" class="dropdown-toggle">
        <span class="micon dw dw-house-1"></span><span class="mtext">Product</span>
    </a>
    <ul class="submenu">
        <li>
            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
                All Product
            </a>
        </li>
        <li>
            <a href="{{ route('products.create') }}" class="{{ request()->routeIs('products.create') ? 'active' : '' }}">
                Add Product
            </a>
        </li>
        @if(request()->routeIs('products.edit'))
            <li>
                <a href="{{ route('products.edit', ['product' => request()->route('product')]) }}" class="{{ request()->routeIs('products.edit') ? 'active' : '' }}">
                    Edit Product
                </a>
            </li>
        @endif
        @if(request()->routeIs('products.show'))
            <li>
                <a href="{{ route('products.show', ['product' => request()->route('product')]) }}" class="{{ request()->routeIs('products.show') ? 'active' : '' }}">
                    Show Product
                </a>
            </li>
        @endif
    </ul>
</li>

                {{-- <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Brand</span>



                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('brands.index')}}">All Brand</a></li>
                <li><a href="{{route('brands.create')}}">Create Brand</a></li>
            </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon dw dw-house-1"></span><span class="mtext">Category</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{route('categories.index')}}">All Category</a></li>
                    <li><a href="{{route('categories.create')}}">Create Category</a></li>
                </ul>

            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon dw dw-house-1"></span><span class="mtext">SubCategory</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{route('subcategories.index')}}">All SubCategory</a></li>
                    <li><a href="{{route('subcategories.create')}}">Create SubCategory</a></li>
                </ul>

            </li> --}}
            <li class="dropdown {{ request()->routeIs('brands.*') ? 'active' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    {{-- ion-close-round --}}
                    <span class="micon dw dw-shopping-basket"></span><span class="mtext">Brand</span>

                </a>
                <ul class="submenu">
                    <li><a href="{{ route('brands.index') }}" class="{{ request()->routeIs('brands.index') ? 'active' : '' }}">All Brand</a></li>
                    <li><a href="{{ route('brands.create') }}" class="{{ request()->routeIs('brands.create') ? 'active' : '' }}">Create Brand</a></li>

                    @if(request()->routeIs('brands.edit'))
                    <li><a href="{{ route('brands.edit', ['brand' => request()->route('brand')]) }}" class="{{ request()->routeIs('brands.edit') ? 'active' : '' }}">Edit Brand</a></li>
                    @endif

                    @if(request()->routeIs('brands.show'))
                    <li><a href="{{ route('brands.show', ['brand' => request()->route('brand')]) }}" class="{{ request()->routeIs('brands.show') ? 'active' : '' }}">Show Brand</a></li>
                    @endif


                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon dw dw-chair"></span><span class="mtext">Category</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">All Category</a></li>
                    <li><a href="{{ route('categories.create') }}" class="{{ request()->routeIs('categories.create') ? 'active' : '' }}">Create Category</a></li>
                    @if(request()->routeIs('categories.edit'))
                    <li><a href="{{ route('categories.edit', ['category' => request()->route('category')]) }}" class="{{ request()->routeIs('categories.edit') ? 'active' : '' }}">Edit Category</a></li>
                    @endif

                    @if(request()->routeIs('categories.show'))
                    <li><a href="{{ route('categories.show', ['category' => request()->route('category')]) }}" class="{{ request()->routeIs('categories.show') ? 'active' : '' }}">Show Category</a></li>
                    @endif

                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('subcategories.*') ? 'active' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon dw dw-house-1"></span><span class="mtext">SubCategory</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('subcategories.index') }}" class="{{ request()->routeIs('subcategories.index') ? 'active' : '' }}">All SubCategory</a></li>
                    <li><a href="{{ route('subcategories.create') }}" class="{{ request()->routeIs('subcategories.create') ? 'active' : '' }}">Create SubCategory</a></li>
                    @if(request()->routeIs('subcategories.edit'))
                    <li><a href="{{ route('subcategories.edit', ['subcategory' => request()->route('subcategory')]) }}" class="{{ request()->routeIs('subcategories.edit') ? 'active' : '' }}">Edit SubCategory</a></li>
                    @endif

                    @if(request()->routeIs('subcategories.show'))
                    <li><a href="{{ route('subcategories.show', ['subcategory' => request()->route('subcategory')]) }}" class="{{ request()->routeIs('subcategories.show') ? 'active' : '' }}">Show SubCategory</a></li>
                    @endif

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
