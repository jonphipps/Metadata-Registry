<!DOCTYPE html>
<html lang="en">
<head>
    <?php use Illuminate\Support\Facades\Auth;
    include_http_metas();
    include_metas() ?>
    <?php if (has_slot('download')): ?><?php include_slot('download') ?><?php endif; ?>

    <?php include_title() ?>

    <?php if (has_slot('data')): ?><?php include_slot('data') ?><?php endif; ?>

    <link rel="icon" href="/<?php echo env('FAVICON', 'registry_favicon_prod.ico') ?>"/>

    <?php if (has_slot('feeds')): ?><?php include_slot('feeds') ?><?php endif; ?>
    <script src="//d2wy8f7a9ursnm.cloudfront.net/bugsnag-3.min.js" data-apikey="abb0b2a18c75a33583c907a7adc925a8" data-notifyReleaseStages=["beta","production"] data-releasestage="<?php echo env('BUGSNAG_RELEASE_STAGE', '') ?>"></script>
</head>
<body>
<?php use_helper('Javascript') ?>
<div id="indicator" style="display: none"></div>
<?php if (access()->user() && session()->has("admin_user_id") && session()->has("temp_user_id")): ?>
<div class="alert alert-warning logged-in-as">
  <div style="margin-left: 46em;">
    You are currently logged in as <strong><?php echo access()->user()->nickname ?>.</strong>
  <a style="padding-left: 1em" href="<?php echo route("frontend.auth.logout-as") ?> ">Re-Login as <?php echo session()->get("admin_user_name") ?></a>.</div>
</div><!--alert alert-warning logged-in-as-->
<?php endif; ?>
<div id="header">
    <ul>
        <li class="browse"><?php echo sf_link_to(__s('Projects'), '@agent_list',  'title="Browse all Projects"' ) ?></li>
        <li class="browse"><?php echo sf_link_to(__s('Vocabularies'), '@vocabulary_list',  'title="Browse all Value Vocabularies"' ); ?></li>
        <li class="browse"><?php echo sf_link_to(__s('Element Sets'), '@schema_list', 'title="Browse all Element Sets"'); ?></li>
        <?php
        if (Auth::check()): ?>
          <li class="browse"><?php echo sf_link_to(__s('Dashboard'),
                'dashboard',
                'title="Dashboard"'); ?></li>
          <li><?php echo sf_link_to(__s('%1% profile', [ '%1%' => Auth::user()->nickname ]),
                                   '@current_user_profile') ?></li>
            <li><?php echo sf_link_to(__s('sign out'), '@logout') ?></li>
        <?php else: ?>
            <li><?php echo sf_link_to(__s('sign in / register'), '@login') ?></li>
        <?php endif ?>
        <li class="last"><?php echo sf_link_to(__s('about'), '@about') ?></li>
    </ul>
    <div style="padding-left: 10px;">
        <?php echo sf_link_to(image_tag('open_metadata_logo_with_interoperability.png',
                                     'alt="Registry Home" style="position: absolute; max-width: 543px; width: 50%; height: auto; top: 0;" '),
                           '@homepage') ?>
    </div>
</div>
    <div id="search">
        <div style="padding-bottom: 3px;"><?php /** @var sfParameterHolder $sf_params */
            include_partial('conceptprop/search', [ 'searchTerm' => $sf_params->get('term') ]) ?></div>
        <div><?php include_partial('schemaprop/search', [ 'searchTerm' => $sf_params->get('term') ]) ?></div>
    </div><div id="content">
    <div id="content_main">
        <?php
        /** @var sfOutputEscaperArrayDecorator $sf_data */
        echo $sf_data->getRaw('sf_content') ?>
    </div>
</div>
<div id="footer">
    <div style="margin-bottom: 10px;">See a problem?&nbsp;
        <a href="https://github.com/jonphipps/Metadata-Registry/issues/">Please make an issue out of it...</a>
    </div>
    <div>
        <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">
            <img alt="Creative Commons License" style="border-width:0" src="/images/cc_by-nc-sa_3.0_80x15.png">
        </a>&nbsp;&nbsp;&nbsp;
        powered by <a href="http://www.symfony-project.com/"><img src="/images/symfony.gif" alt="Symfony">
        </a>&nbsp;&nbsp;&nbsp;
        <a href="https://www.digitalocean.com/">
            <img alt="Powered by Digital Ocean" src="/images/DO_Proudly_Hosted_Badge_Blue-735d53ec.png" height="20" width="75">
        </a>
    </div>
</div>
<?php
$trackingId = '';

//Google analytics
if ($_SERVER['SERVER_NAME'] == 'sandbox.metadataregistry.org') {
    $trackingId = 'UA-840150-2';
}

if ($_SERVER['SERVER_NAME'] == 'metadataregistry.org') {
    $trackingId = 'UA-840150-1';
}
if($trackingId): ?>
    <!-- Google Analytics -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                  (i[r].q = i[r].q || []).push(arguments)
              }, i[r].l = 1 * new Date();
            a = s.createElement(o),
              m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', '<?php echo $trackingId ?>', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
<?php endif; ?>

<?php //<script type="text/javascript" src="http://cetrk.com/pages/scripts/0005/6031.js"> </script> ?>
</body>
</html>
