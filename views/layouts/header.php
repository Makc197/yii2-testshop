<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<!-- Navigation & Logo-->
<div class="mainmenu-wrapper">
    <div class="container">
        <div class="menuextras">
            <div class="extras">
                <ul>
                    <li class="shopping-cart-items"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a href="/shop/page-shopping-cart"><b>3 items</b></a></li>

                    <li>
                        <?= Html::beginForm(['/site/logout'], 'post') ?>
                        <?=
                        Yii::$app->user->isGuest ?
                        Html::a('Login', '/site/login') :
                        Html::submitButton(
                        sprintf('Logout (%s)', Yii::$app->user->identity->login), ['class' => 'btn-link logout maks-logout']
                        );
                        ?>
                        <?= Html::endForm() ?>
                    </li>

                </ul>
            </div>
        </div>
        <nav id="mainmenu" class="mainmenu">
            <ul>
                <li class="logo-wrapper"><a href="<?= Url::to('/site/index') ?>"><img src="/img/mPurpose-logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li>
                <li class="active">
                    <a href="<?= Url::to('/site/index') ?>">Home</a>
                </li>
                <li>
                    <a href="<?= Url::to('/site/features') ?>">Features</a>
                </li>
                <li class="has-submenu">
                    <a href="#">Pages +</a>
                    <div class="mainmenu-submenu">
                        <div class="mainmenu-submenu-inner"> 
                            <div>
                                <h4>Homepage</h4>
                                <ul>
                                    <li><a href="<?= Url::to('/site/index') ?>">Homepage (Sample 1)</a></li>
                                    <li><a href="<?= Url::to('/site/page-homepage-sample') ?>">Homepage (Sample 2)</a></li>
                                </ul>
                                <h4>Services & Pricing</h4>
                                <ul>
                                    <li><a href="<?= Url::to('/site/page-services-1-column') ?>">Services/Features (Rows)</a></li>
                                    <li><a href="<?= Url::to('/site/page-services-3-columns') ?>">Services/Features (3 Columns)</a></li>
                                    <li><a href="<?= Url::to('/site/page-services-4-columns') ?>">Services/Features (4 Columns)</a></li>
                                    <li><a href="<?= Url::to('/site/page-pricing') ?>">Pricing Table</a></li>
                                </ul>
                                <h4>Team & Open Vacancies</h4>
                                <ul>
                                    <li><a href="<?= Url::to('/site/page-team') ?>">Our Team</a></li>
                                    <li><a href="<?= Url::to('/site/page-vacancies') ?>">Open Vacancies (List)</a></li>
                                    <li><a href="<?= Url::to('/site/page-job-details') ?>">Open Vacancies (Job Details)</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4>Our Work (Portfolio)</h4>
                                <ul>
                                    <li><a href="<?= Url::to('/site/page-portfolio-2-columns-1') ?>">Portfolio (2 Columns, Option 1)</a></li>
                                    <li><a href="<?= Url::to('/site/page-portfolio-2-columns-2') ?>">Portfolio (2 Columns, Option 2)</a></li>
                                    <li><a href="<?= Url::to('/site/page-portfolio-3-columns-1') ?>">Portfolio (3 Columns, Option 1)</a></li>
                                    <li><a href="<?= Url::to('/site/page-portfolio-3-columns-2') ?>">Portfolio (3 Columns, Option 2)</a></li>
                                    <li><a href="<?= Url::to('/site/page-portfolio-item') ?>">Portfolio Item (Project) Description</a></li>
                                </ul>
                                <h4>General Pages</h4>
                                <ul>
                                    <li><a href="/theme/page-about-us.html">About Us</a></li>
                                    <li><a href="/theme/page-contact-us.html">Contact Us</a></li>
                                    <li><a href="/theme/page-faq.html">Frequently Asked Questions</a></li>
                                    <li><a href="/theme/page-testimonials-clients.html">Testimonials & Clients</a></li>
                                    <li><a href="/theme/page-events.html">Events</a></li>
                                    <li><a href="/theme/page-404.html">404 Page</a></li>
                                    <li><a href="/theme/page-sitemap.html">Sitemap</a></li>
                                    <li><a href="/theme/page-login.html">Login</a></li>
                                    <li><a href="/theme/page-register.html">Register</a></li>
                                    <li><a href="/theme/page-password-reset.html">Password Reset</a></li>
                                    <li><a href="/theme/page-terms-privacy.html">Terms & Privacy</a></li>
                                    <li><a href="/theme/page-coming-soon.html">Coming Soon</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4>eShop</h4>
                                <ul>
                                    <li><a href="/theme/page-products-3-columns.html">Products listing (3 Columns)</a></li>
                                    <li><a href="/theme/page-products-4-columns.html">Products listing (4 Columns)</a></li>
                                    <li><a href="/theme/page-products-slider.html">Products Slider</a></li>
                                    <li><a href="/theme/page-product-details.html">Product Details</a></li>
                                    <li><a href="/theme/page-shopping-cart.html">Shopping Cart</a></li>
                                </ul>
                                <h4>Blog</h4>
                                <ul>
                                    <li><a href="/theme/page-blog-posts.html">Blog Posts (List)</a></li>
                                    <li><a href="/theme/page-blog-post-right-sidebar.html">Blog Single Post (Right Sidebar)</a></li>
                                    <li><a href="/theme/page-blog-post-left-sidebar.html">Blog Single Post (Left Sidebar)</a></li>
                                    <li><a href="/theme/page-news.html">Latest & Featured News</a></li>
                                </ul>
                            </div>
                        </div><!-- /mainmenu-submenu-inner -->
                    </div><!-- /mainmenu-submenu -->
                </li>
                <li>
                    <a href="<?= Url::to('/site/credits') ?>">Credits</a>
                </li>
                <li>
                    <a href="/site/contact">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</div>