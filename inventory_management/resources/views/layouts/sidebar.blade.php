
            <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <img src="/public/assets/images/logo/inverse.png" />
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Product</li>
                                <li>
                                    <a href="#">
                                        <i class="fad fa-cart-arrow-down"></i>
                                        Product List
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{ Route('product') }}" class="mm-active">
                                                See All Product
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ Route('product.add') }}">
                                                Add New Product
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-list"></i>
                                        Category
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{ Route('category') }}"> <i class="metismenu-icon"> </i>All Category </a>
                                        </li>
                                        <li>
                                            <a href="{{ Route('category.add') }}"> <i class="metismenu-icon"> </i>Add New Category </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Sales</li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-money-bill-alt"></i>
                                        Sales List
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{ Route('sales') }}">
                                                See All Sales
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ Route('sales.add') }}">
                                                Add New Sales
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="app-main__outer">
                    <div class="app-main__inner">