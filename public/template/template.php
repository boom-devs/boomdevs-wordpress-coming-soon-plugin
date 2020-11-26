<?php
    require_once CSTS_DIR . 'includes/class-csts-settings.php';
    $settings = Csts_Settings::get_settings();
?>

<!DOCTYPE html>
<html class="no-js no-svg">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $settings['seo_description']; ?>">
    <meta name="keywords" content="<?php echo $settings['seo_keywords']; ?>">
    <title><?php echo $settings['seo_title']; ?></title>
    <?php wp_head(); ?>
    <?php
        if( !empty($settings["bg_image"]["url"]) ) {
            $background_image = 'background-image:url('.$settings["bg_image"]["url"].')';
        } else {
            $background_image = '';
        }
        if( !empty( $settings["menu_typography"]['color'] ) ) {
            $menu_bar_border_color = $settings["menu_typography"]['color'];
        } else {
            $menu_bar_border_color = '';
        }
        echo '<style>
            .csts-page-wrapper .navbar-nav li a::after{
                background-color: '.$menu_bar_border_color.';
            }
            .csts-page-wrapper.page-wrapper {
                '.$background_image.'
            }
        </style>';
    ?>
</head>

<body data-spy="click" data-target=".navbar-nav">
    <!-- Single Blog popup wrapper -->
    <div class="single-blog-popup-wrapper">
        <div class="close-button">
            <img src="<?php echo CSTS_DIR_URI; ?>public/images/cancel.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-blog-content">
                        <div class="title">
                            <span></span>
                            <h1></h1>
                        </div>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Loading -->
    <div class="loading">
        <img src="<?php echo CSTS_DIR_URI; ?>public/images/preview.gif" alt="loading-img"> 
    </div>
    <!-- End Single Blog Popup wrapper -->
    <div class="csts-page-wrapper  page-wrapper">
        <header class="header">
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container">

                    <?php if( !empty( $settings['logo']['url'] ) ) { ?>

                        <a class="navbar-brand" href="#<?php echo str_replace(' ', '-', strtolower($settings["home_menu_title"])); ?>">
                            <img src="<?php echo $settings['logo']['url']; ?>" alt="">
                        </a>

                    <?php }else { ?>
                        <a class="navbar-brand" href="#<?php echo str_replace(' ', '-', strtolower($settings["home_menu_title"])); ?>">
                            <img src="<?php echo CSTS_DIR_URI; ?>public/images/logo.png" alt="">
                        </a>
                    <?php } ?>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <div class="menu-toggle">
                            <div class="hamburger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="hamburger-cross">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </button>
                    <div class="collapse navbar-collapse" id="main-nav">
                        <ul class="navbar-nav ml-auto">
                            <!-- Home -->
                            <?php
                                if( $settings['home_enable_disable'] == "1" && !empty($settings["home_menu_title"]) ) {
                                    echo '<li class="nav-item active">
                                        <a class="nav-link" href="#'.str_replace(' ', '-', strtolower($settings["home_menu_title"])).'"> '.$settings["home_menu_title"].'</a>
                                    </li>';
                                }
                            ?>
                            <!-- Service -->
                            <?php
                                if( $settings['service_enable_disable'] == "1" && !empty( $settings["service_menu_title"] ) ) {
                                    echo '<li class="nav-item">
                                        <a class="nav-link" href="#'.str_replace(' ', '-', strtolower($settings["service_menu_title"])).'"> '.$settings["service_menu_title"].'</a>
                                    </li>';
                                }
                            ?>

                            <!-- Blog -->
                            <?php
                                if( $settings['blog_enable_disable'] == "1" && !empty( $settings["blog_menu_title"] ) ) {
                                    echo '<li class="nav-item ">
                                        <a class="nav-link" href="#'.str_replace(' ', '-', strtolower($settings["blog_menu_title"])).'"> '.$settings["blog_menu_title"].'</a>
                                    </li>';
                                }
                            ?>

                            <!-- Contact -->
                            <?php
                                if( $settings['contact_enable_disable'] == "1" && !empty( $settings["contact_menu_title"] ) ) {
                                    echo '<li class="nav-item">
                                        <a class="nav-link" href="#'.str_replace(' ', '-', strtolower($settings["contact_menu_title"])).'"> '.$settings["contact_menu_title"].'</a>
                                    </li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- header -->

        <div class="main-content">
            <!-- Home section -->
            <div class="countdown-area toggle-section show" id="<?php echo str_replace(' ', '-', strtolower($settings["home_menu_title"])); ?>">
                <div class="container">
                    <div class="row align-items-center">
                        <?php

                            $string = str_replace(' ', '-', $settings['count_down_date']); // Replaces all spaces with hyphens.
                            $date = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars
                            $date_arr = str_split ( $date, 2 );
                            //$monthName = date('F', mktime(0, 0, 0, $date_arr[2], 10)); // March

                            if( !empty( $settings['count_down_date'] ) ) {
                                echo '<div class="col">
                                        <div class="countdown-timer">
                                            <div class="countdown" data-countdown="'.$date_arr[2].''.$date_arr[3].'-'.$date_arr[0].'-'.$date_arr[1].' '.$settings['count_down_time'].'"></div>
                                        </div>
                                    </div>';
                            }
                        ?>
                        <div class="col">
                            <div class="coming-soon-content">
                                <h2><?php echo $settings['home_title']; ?></h2>
                                <p><?php echo do_shortcode($settings['home_description']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service section -->
            <div class="services toggle-section" id="<?php echo str_replace(' ', '-', strtolower($settings["service_menu_title"])); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="s-title">
                                <h2><?php echo $settings['service_title']; ?></h2>
                                <p><?php echo $settings['service_description']; ?></p>
                            </div>
                        </div>
                        <?php 
                        if( !empty( $settings['service_box'] ) ):
                            foreach( $settings['service_box'] as $item ): ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="service-item">
                                    <div class="item-icon">
                                    <?php
                                        if( $item['icon'] == 0 ): ?>
                                            <i class="<?php echo $item['icon']; ?>" ></i>
                                        <?php endif; ?>
                                    </div>
                                    <h4 class="item-title"><?php echo $item['title']; ?></h4>
                                    <p><?php echo $item['description']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Blog section -->
            <div class="blog toggle-section" id="<?php echo str_replace(' ', '-', strtolower($settings["blog_menu_title"])); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="s-title">
                                <h2><?php echo $settings["blog_title"]; ?></h2>
                                <p><?php echo $settings["blog_description"]; ?></p>
                            </div>
                        </div>
                        <?php $query = new WP_Query( 
                                array( 
                                    'post_type'         => 'post',
                                    'post_status'       => 'publish',
                                    'cat'               => $settings['blog_category']
                                ) 
                            ); ?>
                        <?php
                        
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full'); 
                            echo '
                                <div class="col-lg-'.$settings['blog_grid_list'].'">
                                    <div class="blog-post">
                                        <div class="post-thumb">
                                            <img src="'.$featured_img_url.'">
                                            <div class="overlay-btn">
                                                <a data-id="'.get_the_id().'" href="#">'.__('Read More', 'csts').'</a>
                                            </div>
                                        </div>
                                        <div class="post-des">
                                            <div class="post-meta">
                                                <span class="meta-category">';
                                                $i = 1;
                                                $total_category = count(get_categories());

                                                foreach ( get_categories() as $key => $category ) {
                                                    $separator = ', ';
                                                    if( $total_category == $i ) {
                                                       $separator = ''; 
                                                    }
                                                    echo $category->name.$separator;
                                                    $i++;
                                                }
                                            echo ' </span>
                                            </div>
                                            <h2 class="post-title">' . get_the_title() . '</h2>
                                        </div>
                                    </div>
                                </div>
                            ';
                        } ?>
                    </div>
                </div>
            </div>

            <!-- Contact section -->
            <div class="contact toggle-section" id="<?php echo str_replace(' ', '-', strtolower($settings["contact_menu_title"])); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="s-title">
                                <h2><?php echo $settings["contact_title"]; ?></h2>
                                <p><?php echo do_shortcode($settings["contact_description"]); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer fixed-bottom">
            <div class="container">
                <div class="row no-gutters">
                    <?php if( !empty( $settings['copyright_left_text'] ) ): ?>
                        <div class="f-col">
                            <p class="copyright"><?php echo $settings['copyright_left_text']; ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="f-col">
                        <p class="copyright" id="csts_credit">Made with love 💓 by TaspriStudio</p>
                    </div>
                    <?php if( !empty( $settings['footer_social_icons'] ) ): ?>
                        <div class="f-col ml-auto">
                            <ul class="social-profile">
                                <?php foreach( $settings['footer_social_icons'] as $item ): ?>
                                    <li>
                                        <a href="<?php echo $item['social_icon_link']; ?>">
                                            <i class="<?php echo $item['social_icon']; ?>"></i>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </footer>
    </div>
    <!-- Include footer -->
    <?php wp_footer(); ?>
</body>
