<?php
    require_once CSTS_DIR . 'includes/class-csts-settings.php';
    $settings = Csts_Settings::get_settings();
    
?>

<!DOCTYPE html>
<html class="no-js no-svg">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Coming soon template">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body data-spy="click" data-target=".navbar-nav">
    <div class="page-wrapper">
        <header class="header">
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container">

                    <?php if( !empty( $settings['logo']['url'] ) ): ?>

                        <a class="navbar-brand" href="#home">
                            <img src="<?php echo $settings['logo']['url']; ?>" alt="">
                        </a>

                    <?php endif; ?>

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

                            <!-- Home menu -->
                            <li class="nav-item active">
                                <a class="nav-link" href="#home"> <?php echo __('Home', 'csts'); ?></a>
                            </li>

                            <!-- Service -->
                            <?php
                                if( $settings['service_enable_disable'] == "1" ) {
                                    echo '<li class="nav-item active">
                                        <a class="nav-link" href="#'.str_replace(' ', '-', strtolower($settings["service_title"])).'"> '.$settings["service_title"].'</a>
                                    </li>';
                                }
                            ?>

                            <!-- Blog -->
                            <?php
                                if( $settings['blog_enable_disable'] == "1" ) {
                                    echo '<li class="nav-item active">
                                        <a class="nav-link" href="#'.str_replace(' ', '-', strtolower($settings["blog_title"])).'"> '.$settings["blog_title"].'</a>
                                    </li>';
                                }
                            ?>

                            <!-- Contact -->
                            <?php
                                if( $settings['contact_enable_disable'] == "1" && !empty($settings["contact_title"]) ) {
                                    echo '<li class="nav-item active">
                                        <a class="nav-link" href="#'.str_replace(' ', '-', strtolower($settings["contact_title"])).'"> '.$settings["contact_title"].'</a>
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
            <div class="countdown-area toggle-section show" id="home">
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
                                <p><?php echo $settings['home_description']; ?></p>
                                <form class="newsletter">
                                    <div class="input-group">
                                        <?php echo do_shortcode($settings['subscribe_form_shortcode']); ?>
                                        <!-- <input type="text" class="form-control" placeholder="Your email Here" aria-label="Your email Here" autocomplete="off">
                                        <span class="input-group-btn">
                                            <button class="btn newsletter-btn" type="button">Subscribe Now!</button>
                                        </span> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service section -->
            <div class="services toggle-section" id="<?php echo str_replace(' ', '-', strtolower($settings["service_title"])); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="s-title">
                                <h2><?php echo $settings['service_title']; ?></h2>
                                <p><?php echo $settings['service_description']; ?></p>
                            </div>
                        </div>
                        <?php foreach( $settings['service_box'] as $item ): ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="service-item">
                                    <div class="item-icon">
                                    <?php
                                        if( $item["icon_image"] == 0 ): ?>
                                            <img src="<?php echo $item['image']['url'] ?>">
                                        <?php endif; ?>
                                    </div>
                                    <h4 class="item-title"><?php echo $item['title']; ?></h4>
                                    <p><?php echo $item['description']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <!-- Blog section -->
            <div class="blog toggle-section" id="<?php echo str_replace(' ', '-', strtolower($settings["blog_title"])); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="s-title">
                                <h2><?php echo $settings["blog_title"]; ?></h2>
                                <p><?php echo $settings["blog_description"]; ?></p>
                            </div>
                        </div>

                        <?php
                            $query = new WP_Query( 
                                array( 
                                    'post_type'         => 'post',
                                    'post_status'       => 'publish',
                                    'post_per_page'     => 4
                                ) 
                            ); ?>

                        <?php
                        
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full'); 
                            echo '
                                <div class="col-lg-3 col-sm-6">
                                    <div class="blog-post">
                                        <div class="post-thumb">
                                            <img src="'.$featured_img_url.'">
                                            <div class="overlay-btn">
                                                <a href="' . get_the_permalink() . '">'.__('Read More', 'csts').'</a>
                                            </div>
                                        </div>
                                        <div class="post-des">
                                            <div class="post-meta">
                                                <span class="meta-category">'.get_the_category_list(',').'</span>
                                            </div>
                                            <h2 class="post-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        
                        ?>
                    </div>
                </div>
            </div>

            <!-- Contact section -->
            <div class="contact toggle-section" id="<?php echo str_replace(' ', '-', strtolower($settings["contact_title"])); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="s-title">
                                <h2><?php echo $settings["contact_title"]; ?></h2>
                                <p><?php echo $settings["contact_description"]; ?></p>
                            </div>
                        </div>
                        <?php if( !empty( $settings['contact_form_shortcode'] ) ): ?>
                            <div class="col-lg-6">
                                <?php echo do_shortcode($settings['contact_form_shortcode']); ?>
                            </div>
                        <?php endif; ?>
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

                    <?php if( !empty( $settings['copyright_center_text'] ) ): ?>

                        <div class="f-col">
                            <p class="copyright"><?php echo $settings['copyright_center_text']; ?></p>
                        </div>

                    <?php endif; ?>

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
        <div data-relative-input="true" id="scene" class="px-wrapper">
            <div class="layer d-none" data-depth="0.2"></div>
            <div class="px-layer" data-depth="0.2">
                <div class="circle-1"></div>
            </div>
            <div class="px-layer" data-depth="0.2" data-limit-x="0">
                <div class="circle-2"></div>
            </div>
        </div>
        <div data-relative-input="true" id="circle"  class="px-wrapper">
            <div class="layer d-none" data-depth="1"></div>
            <div class="px-layer" data-depth="1">
                <div class="circle-o-1"></div>
            </div>
            <div class="px-layer" data-depth="1" data-limit-x="0">
                <div class="circle-o-2"></div>
            </div>
            <div class="px-layer" data-depth="1" data-limit-x="0">
                <div class="circle-o-3"></div>
            </div>
        </div>
        <div data-relative-input="true" id="line"  class="px-wrapper">
            <div class="layer d-none" data-depth="0.4"></div>
            <div class="px-layer" data-depth="0.4">
                <div class="line-1"></div>
            </div>
            <div class="px-layer" data-depth="0.4" data-limit-x="0">
                <div class="line-2"></div>
            </div>
            <div class="px-layer" data-depth="0.4" data-limit-x="0">
                <div class="line-3"></div>
            </div>
            <div class="px-layer" data-depth="0.4" data-limit-x="0">
                <div class="line-4"></div>
            </div>
        </div>
        <div data-relative-input="true" id="star"  class="px-wrapper">
            <div class="layer d-none" data-depth="0.7"></div>
            <div class="px-layer" data-depth="0.7">
                <div class="star-1"></div>
            </div>
            <div class="px-layer" data-depth="0.7" data-limit-x="0">
                <div class="star-2"></div>
            </div>
            <div class="px-layer" data-depth="0.7" data-limit-x="0">
                <div class="star-3"></div>
            </div>
        </div>
        <div data-relative-input="true" id="triangle"  class="px-wrapper">
            <div class="layer d-none" data-depth="0.3"></div>
            <div class="px-layer" data-depth="0.3">
                <div class="triangle-1"></div>
            </div>
            <div class="px-layer" data-depth="0.3" data-limit-x="0">
                <div class="triangle-2"></div>
            </div>
            <div class="px-layer" data-depth="0.3" data-limit-x="0">
                <div class="triangle-3"></div>
            </div>
            <div class="px-layer" data-depth="0.3" data-limit-x="0">
                <div class="triangle-4"></div>
            </div>
        </div>
        <div data-relative-input="true" id="polygon"  class="px-wrapper">
            <div class="layer d-none" data-depth="0.5"></div>
            <div class="px-layer" data-depth="0.5">
                <div class="polygon-1"></div>
            </div>
            <div class="px-layer" data-depth="0.5" data-limit-x="0">
                <div class="polygon-2"></div>
            </div>
            <div class="px-layer" data-depth="0.5" data-limit-x="0">
                <div class="polygon-3"></div>
            </div>
        </div>
    </div>

    <!-- Include footer -->
    <?php wp_footer(); ?>
</body>