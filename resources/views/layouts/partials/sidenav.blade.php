<!-- ========== Menu ========== -->
<div class="app-menu">

    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="{{ route('home') }}" class="logo-light">
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo" class="logo-lg">
            <img src="{{ asset('assets/images/favicon.ico') }}" alt="small logo" class="logo-sm">
        </a>

        <!-- Brand Logo Dark -->
        <a href="{{ route('home') }}" class="logo-dark">
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo" class="logo-lg">
            <img src="{{ asset('assets/images/favicon.ico') }}" alt="small logo" class="logo-sm">
        </a>
    </div>

    <!-- menu-left -->
    <div class="scrollbar">

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown">Geneva
                    Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted mb-0">Admin Head</p>
        </div>

        <!--- Menu -->
        <ul class="menu">

            <li class="menu-title">Navigation</li>

            <li class="menu-item">
                <a href="#menuDashboards" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="airplay"></i></span>
                    <span class="menu-text"> Dashboards </span>
                    <span class="badge bg-success rounded-pill ms-auto">4</span>
                </a>
                <div class="collapse" id="menuDashboards">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <span class="menu-text">Dashboard 1</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-title">Apps</li>

            {{--  <li class="menu-item">
                <a href="apps-calendar.php" class="menu-link">
                    <span class="menu-icon"><i data-feather="calendar"></i></span>
                    <span class="menu-text"> Calendar </span>
                </a>
            </li> --}}

            {{-- <li class="menu-item">
                <a href="apps-chat.php" class="menu-link">
                    <span class="menu-icon"><i data-feather="message-square"></i></span>
                    <span class="menu-text"> Chat </span>
                </a>
            </li> --}}

            {{-- <li class="menu-item">
                <a href="#menuEcommerce" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="shopping-cart"></i></span>
                    <span class="menu-text"> Ecommerce </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuEcommerce">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="ecommerce-dashboard.php" class="menu-link">
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-products.php" class="menu-link">
                                <span class="menu-text">Products</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-product-detail.php" class="menu-link">
                                <span class="menu-text">Product Detail</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-product-edit.php" class="menu-link">
                                <span class="menu-text">Add Product</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-customers.php" class="menu-link">
                                <span class="menu-text">Customers</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-orders.php" class="menu-link">
                                <span class="menu-text">Orders</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-order-detail.php" class="menu-link">
                                <span class="menu-text">Order Detail</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-sellers.php" class="menu-link">
                                <span class="menu-text">Sellers</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-cart.php" class="menu-link">
                                <span class="menu-text">Shopping Cart</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ecommerce-checkout.php" class="menu-link">
                                <span class="menu-text">Checkout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- <li class="menu-item">
                <a href="#menuCrm" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="users"></i></span>
                    <span class="menu-text"> CRM </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuCrm">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="crm-dashboard.php" class="menu-link">
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="crm-contacts.php" class="menu-link">
                                <span class="menu-text">Contacts</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="crm-opportunities.php" class="menu-link">
                                <span class="menu-text">Opportunities</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="crm-leads.php" class="menu-link">
                                <span class="menu-text">Leads</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="crm-customers.php" class="menu-link">
                                <span class="menu-text">Customers</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            {{--
            <li class="menu-item">
                <a href="#menuEmail" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="mail"></i></span>
                    <span class="menu-text"> Email </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuEmail">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="email-inbox.php" class="menu-link">
                                <span class="menu-text">Inbox</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="email-read.php" class="menu-link">
                                <span class="menu-text">Read Email</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="email-compose.php" class="menu-link">
                                <span class="menu-text">Compose Email</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="email-templates.php" class="menu-link">
                                <span class="menu-text">Email Templates</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item">
                <a href="apps-social-feed.php" class="menu-link">
                    <span class="menu-icon"><i data-feather="rss"></i></span>
                    <span class="menu-text"> Social Feed </span>
                    <span class="badge bg-pink ms-auto">Hot</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="apps-companies.php" class="menu-link">
                    <span class="menu-icon"><i data-feather="activity"></i></span>
                    <span class="menu-text"> Companies </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#menuProjects" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="briefcase"></i></span>
                    <span class="menu-text"> Projects </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuProjects">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="project-list.php" class="menu-link">
                                <span class="menu-text">List</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="project-detail.php" class="menu-link">
                                <span class="menu-text">Detail</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="project-create.php" class="menu-link">
                                <span class="menu-text">Create Project</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item">
                <a href="#menuTasks" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="clipboard"></i></span>
                    <span class="menu-text"> Tasks </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuTasks">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="task-list.php" class="menu-link">
                                <span class="menu-text">List</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="task-details.php" class="menu-link">
                                <span class="menu-text">Details</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="task-kanban-board.php" class="menu-link">
                                <span class="menu-text">Kanban Board</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            --}}
            <li class="menu-item">
                <a href="#menuContacts" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="book"></i></span>
                    <span class="menu-text"> Master Data </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuContacts">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('admin.sejarah.index') }}" class="menu-link">
                                <span class="menu-text">Data Profil</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ route('admin.tentang.index') }}" class="menu-link">
                                <span class="menu-text">Tantang Kami</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ route('admin.divisi.index') }}" class="menu-link">
                                <span class="menu-text">Data Divisi</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ route('admin.blog.index') }}" class="menu-link">
                                <span class="menu-text">Berita</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.event.index') }}" class="menu-link">
                                <span class="menu-text">Publikasi</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.gallery.index') }}" class="menu-link">
                                <span class="menu-text">Galeri</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.banner.index') }}" class="menu-link">
                                <span class="menu-text">Banner</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{--  <li class="menu-item">
                <a href="#menuTickets" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="aperture"></i></span>
                    <span class="menu-text"> Tickets </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuTickets">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="tickets-list.php" class="menu-link">
                                <span class="menu-text">List</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="tickets-detail.php" class="menu-link">
                                <span class="menu-text">Detail</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item">
                <a href="apps-file-manager.php" class="menu-link">
                    <span class="menu-icon"><i data-feather="folder-plus"></i></span>
                    <span class="menu-text"> File Manager </span>
                </a>
            </li> --}}
            <li class="menu-title">Custom</li>


            <li class="menu-item">
                <a href="#menuAuth" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="file-text"></i></span>
                    <span class="menu-text"> Setting </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse collapse-md" id="menuAuth">
                    <ul class="sub-menu">
                        @hasrole(config('roles.access_super_admin_routes'))
                            <li class="menu-item">
                                <a href="{{ route('perusahaan.index') }}" class="menu-link">
                                    <span class="menu-text">Perusahaan</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('permission.index') }}" class="menu-link">
                                    <span class="menu-text">Permisision</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('roles.index') }}" class="menu-link">
                                    <span class="menu-text">Role</span>
                                </a>
                            </li>
                        @endhasrole

                        <li class="menu-item">
                            <a href="{{ route('user.index') }}" class="menu-link">
                                <span class="menu-text">User</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
        <!--- End Menu -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left menu End ========== -->
