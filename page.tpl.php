<?php // $Id: page.tpl.php $ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title ?></title>
  <meta http-equiv="content-language" content="<?php print $language->language ?>" />
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  <link rel="apple-touch-icon" href="<?php if (function_exists('path_to_active_theme')) { print path_to_active_theme(); } ?>/apple-touch-icon.png" />
</head>

<body class="<?php print $body_classes ?>">
  <?php if (!empty($roadblock)) print $roadblock; ?>

  <div id="pm-pg" class="pm-pg">
    <?php if (!empty($utility_area)): ?>
      <div class="pm-util">
        <div class="pm-util-padding">
          <?php print $utility_area; ?>
        </div>
      </div>
    <?php endif ?>
    <div class="pm-hd">
      <div class="pm-hd-pdg">
        <div id="top">
          <?php print l('Skip to Navigation', '', array('fragment' => 'navigation', 'external' => TRUE)); ?>
          <?php print l('Skip to Content', '', array('fragment' => 'content', 'external' => TRUE)); ?>
        </div>
        <?php if ($site_name): ?>
          <div class="pm-site-name">
            <?php if($is_front): ?>
              <h1><?php print l($site_name, '<front>'); ?></h1>
            <?php else: ?>
              <?php print l($site_name, '<front>'); ?>
            <?php endif ?>
            <?php if ($site_slogan): ?>
              <span class="pm-slogan"><?php print $site_slogan ?></span>
            <?php endif ?>
          </div>
        <?php endif ?>
        <?php if ($search_box): ?>
          <div class="pm-search">
            <?php print $search_box ?>
          </div>
        <?php endif ?>
        <?php if ($header): ?>
          <div class="pm-hd-region">
            <?php print $header; ?>
          </div>
        <?php endif ?>
        <?php if ($navigation_menu): ?>
          <div class="pm-nav-menu">
            <?php print $navigation_menu; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="pm-wrp clearfix">
      <div class="pm-wrp-pdg">
        <?php if (!empty($banner_ad_top)): ?>
          <div class="pm-banner-ad pm-banner-ad-top">
            <?php print $banner_ad_top; ?>
          </div>
        <?php endif ?>
  
        <?php if (!empty($top)):?>
          <div class="pm-top">
            <div class="pm-cont-pdg">
              <?php print $top; ?>
            </div>
          </div><!--// pm-top -->
        <?php endif ?>
  
        <?php if ($tabs): ?>
          <div class="tabs"><?php print $tabs ?></div>
        <?php endif ?>
  
        <?php print $breadcrumb ?>
  
        <div class="pm-content-wrp clearfix"><?php //wraps the content and sidebar only ?>
          <div class="pm-content">
            <?php print $messages // click to close function is in js/tools.js ?>
            <?php if ($title_header): ?>
              <?php print $title_header; ?>
            <?php endif; ?>
            <?php if ($node->type == 'blog'): ?>
              <div class="blog-about">
                <?php if (!empty($blog_header)): ?>
                  <div class="blog-header-img">
                    <?php
                      $blog_img = '<img src="/' . $blog_header . '" alt="' . $blog_home_title . '" />';
                      print l($blog_img, $blog_home_url, array('html' => 'true'));
                    ?> <!-- comment for testing deployment change -->
                  </div>
                <?php else: ?>
                  <div class="blog-home-title"><?php print l($blog_home_title, $blog_home_url); ?></div>
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <?php if (!drupal_is_front_page() && $title && $node->type != 'dowloadable' && $node->type != 'site_subscription'): ?>
              <h1 class="page-title"><?php print $title ?></h1>
            <?php endif; ?>
            <?php if (!empty($content_top)):?>
              <div class="pm-content-top">
                <div class="pm-cont-pdg">
  
                  <?php print $content_top; ?>
                </div>
              </div><!--// pm-content-top -->
            <?php endif ?>
            <div class="pm-cont-main<?php print ($onecolumn_layout) ? ' pm-cont-main-full' : ''; ?>" id="content">
              <div id="pm-main-pdg" class="pm-cont-pdg">
                <?php print $help ?>
                <?php print $content; ?>
                <?php if ($node->comment == 1): ?>
                  <h4 class="no-posting-permission"><?php print t('Comments have been closed'); ?></h4>
                <?php elseif ($node->comment == 2 && !$user->uid && !user_access('post comments')): ?>
                <?php $path = drupal_get_destination(); ?>
                  <h4 class="no-posting-permission"><?php print "Please $content_login_link or $content_register_link to post comments."; ?> </h4>
                <?php endif; ?>
                <?php if ($related_articles || $related_articles_region): ?>
                  <div class="related-articles-block block">
                    <?php if (!empty($related_articles_region)): ?>
                      <?php print $related_articles_region; ?>
                    <?php endif; ?>
                    <?php if (!empty($related_articles)): ?>
                      <div class="related-articles">
                        <?php print $related_articles ?>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div><!--// pm-cont-main -->
            <?php if ($left): ?>
              <div class="pm-cont-sidebar">
                <div class="pm-cont-pdg">
                  <?php print $left; ?>
                </div>
              </div><!--// pm-cont-sidebar -->
            <?php endif ?>
            <?php if (!empty($content_bottom)):?>
              <div class="pm-cont-btm">
                <div class="pm-cont-pdg">
                  <?php print $content_bottom; ?>
                </div>
              </div><!--// pm-cont-btm -->
            <?php endif ?>
          </div><!--// pm-content -->
          <?php if ($right): ?>
            <div class="pm-sidebar">
              <div class="pm-cont-pdg">
                <?php print $right ?>
              </div>
            </div><!--// pm-sidebar -->
          <?php endif ?>
          <?php if (!empty($bottom)):?>
            <div class="pm-btm">
              <div class="pm-cont-pdg">
                <?php print $bottom; ?>
              </div>
            </div><!--// pm-btm -->
          <?php endif ?>
        </div><!--// pm-content-wrp -->
  
        <?php if (!empty($banner_ad_btm)): ?>
          <div class="pm-banner-ad pm-banner-ad-btm">
            <?php print $banner_ad_btm; ?>
          </div>
        <?php endif ?>
      </div><!--// pm-wrp-pdg -->
    </div><!--// pm-wrp -->
    <?php if ($footer): ?>
      <div class="pm-ft">
        <div class="pm-cont-pdg">
          <div class="pm-ft-pdg">
            <?php print $footer ?>
          </div>
        </div>
      </div>
    <?php endif ?>

    <?php if ($footer_message): ?>
      <div class="pm-ft-message">
        <div class="pm-cont-pdg">
          <div class="pm-ft-pdg">
            <?php print $footer_message ?>
          </div>
        </div>
      </div>
    <?php endif ?>

  </div><!--// pm-pg-->
  <div id="fb-root"></div>
  <?php print $closure ?>
</body>
</html>
