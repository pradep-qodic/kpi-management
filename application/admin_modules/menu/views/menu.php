<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <input type="hidden" id="base_url" value="<?php echo base_url();?>" />
	<input type="hidden" id="admin_base_url" value="<?php echo admin_base_url();?>" />
	<!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        <header class="m-grid__item    m-header " data-minimize-offset="200" data-minimize-mobile-offset="200">
            <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- BEGIN: Brand -->
                    <div class="m-stack__item m-brand  m-brand--skin-dark ">
                        <div class="m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo" style="width: 140px;">
                                <a href="<?php echo base_url('admins/dashboard');?>" class="m-brand__logo-wrapper" style="color: white!important;">Respect Dashboard
                           </a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                <!-- BEGIN: Left Aside Minimize Toggle -->
                                <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block ">
                                    <span></span>
                                </a>
                                <!-- END -->
                                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>
                                <!-- END -->                                
                                <!-- BEGIN: Topbar Toggler -->
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                    <i class="flaticon-more"></i>
                                </a>
                                <!-- BEGIN: Topbar Toggler -->
                            </div>
                        </div>
                    </div>
                    <!-- END: Brand -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                        <!-- BEGIN: Horizontal Menu -->
                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i>
                        </button>
                        <!-- BEGIN: Topbar -->
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
                                            <span class="m-topbar__userpic">
											<?php
															if($profilepic == ''){
																$profile_pics = 'default.jpg';
																}else{
																$profile_pics = $profilepic;
															}
														?>
                                 <img id="profilepic1" src="<?php echo base_url().'uploads/adminLogo/'.$profile_pics;?>" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                                 </span>
                                            <span class="m-topbar__username m--hide">Nick</span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                 
												<div class="m-dropdown__header m--align-center" style="background: url(<?php echo 'uploads/adminLogo/'.$profile_pics; ?>); background-size: cover;">
                                                    <div class="m-card-user m-card-user--skin-dark">                                                       
														<div class="m-card-user__pic">
                                                            <img id="profilepic2"  src="<?php echo base_url().'uploads/adminLogo/'.$profile_pics;?>" class="m--img-rounded m--marginless" alt="" />
                                                        </div>
                                                        <div class="m-card-user__details">
                                                            <span class="m-card-user__name m--font-weight-500"  id="username"> <?php echo ($name ? $name : '' ); ?></span>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav m-nav--skin-light">
                                                            <li class="m-nav__section m--hide">
                                                                <span class="m-nav__section-text">Section</span>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="<?php echo base_url('admins/profile')?>" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                    <span class="m-nav__link-title">  
																		<span class="m-nav__link-wrap">      
																			<span class="m-nav__link-text">My Profile</span>                                                                    
																		</span>
                                                                    </span>
                                                                </a>
                                                            </li> 
															<li class="m-nav__separator m-nav__separator--fit"></li>	
                                                            <li class="m-nav__item">
                                                                <a href="<?php echo base_url('admins/logout');?>" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END: Topbar -->
                    </div>
                </div>
            </div>
        </header>
        <!-- END: Header -->
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i>
            </button>
            <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
                <!-- BEGIN: Aside Menu -->
                <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
                    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                        <li class="m-menu__item  <?php echo (uri_string()=='admins/dashboard')?'m-menu__item--active':'';?>" aria-haspopup="true">
                            <a href="<?php echo base_url('admins/dashboard');?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-dashboard"></i>
                                <span class="m-menu__link-title">
									<span class="m-menu__link-wrap"> 
									<span class="m-menu__link-text">Dashboard</span>
                                </span>
                                </span>
                            </a>
                        </li>
                        <?php if(isSuperAdmin()): ?>
						<li class="m-menu__item  <?php echo (uri_string()=='admins/site')?'m-menu__item--active':'';?>" aria-haspopup="true">
                            <a href="<?php echo base_url('admins/site');?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-building-o"></i>
                                <span class="m-menu__link-title">
									<span class="m-menu__link-wrap"> 
									<span class="m-menu__link-text">Site</span>
                                </span>
                                </span>
                            </a>
                        </li>
						<li class="m-menu__item  <?php echo (uri_string()=='admins/user')?'m-menu__item--active':'';?>" aria-haspopup="true">
                            <a href="<?php echo base_url('admins/user');?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-building-o"></i>
                                <span class="m-menu__link-title">
									<span class="m-menu__link-wrap"> 
									<span class="m-menu__link-text">Users</span>
                                </span>
                                </span>
                            </a>
                        </li>
						<?php endif; ?>
						<li class="m-menu__item  <?php echo (uri_string()=='admins/datamanagement')?'m-menu__item--active':'';?>" aria-haspopup="true">
                            <a href="<?php echo base_url('admins/datamanagement');?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-database"></i>
                                <span class="m-menu__link-title">
									<span class="m-menu__link-wrap"> 
									<span class="m-menu__link-text">Data Management</span>
                                </span>
                                </span>
                            </a>
                        </li>
						<?php if(isSuperAdmin()): ?>
						<li class="m-menu__item  <?php echo (uri_string()=='admins/kpi')?'m-menu__item--active':'';?>" aria-haspopup="true">
                            <a href="<?php echo base_url('admins/kpi');?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-database"></i>
                                <span class="m-menu__link-title">
									<span class="m-menu__link-wrap"> 
									<span class="m-menu__link-text">KPI</span>
                                </span>
                                </span>
                            </a>
                        </li>
						<?php endif; ?>						
                    </ul>
                </div>
                <!-- END: Aside Menu -->
            </div>