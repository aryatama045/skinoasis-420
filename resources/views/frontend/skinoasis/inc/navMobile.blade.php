<div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>


            <nav class="mobile-nav">
                <ul class="mobile-menu">
                        @if (!is_null(getSetting('header_menu_labels')))
                            @php
                                $labels = json_decode(getSetting('header_menu_labels')) ?? [];
                                $menus = json_decode(getSetting('header_menu_links')) ?? [];
                            @endphp

                            @foreach ($menus as $menuKey => $menuItem)
                                <li class="<?php if($menuItem==localize($labels[$menuKey])){ "active"; } ?>" >
                                    <a href="{{ $menuItem }}">{{ localize($labels[$menuKey]) }}</a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="{{ route('home') }}">{{ localize('Home') }}</a></li>
                            <li><a href="{{ route('products.index') }}">{{ localize('Products') }}</a></li>
                            <li><a href="{{ route('home.campaigns') }}">{{ localize('Campaigns') }}</a>
                            </li>
                            <li><a href="{{ route('home.coupons') }}">{{ localize('Coupons') }}</a>
                            </li>
                        @endif
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="{{ getSetting('facebook_link') }}" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="{{ getSetting('twitter_link') }}" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="{{ getSetting('linkedin_link') }}" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="{{ getSetting('youtube_link') }}" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->