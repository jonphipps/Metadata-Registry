<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>

    <?php include_title() ?>

    <?php if (has_slot('data')): ?><?php include_slot('data') ?><?php endif; ?>
    <?php if ($_SERVER['SERVER_NAME'] == 'registry.dev' || $_SERVER['SERVER_NAME'] == 'beta.metadataregistry.net'): ?>
        <link rel="icon" href="/registry_favicon_dev.ico"/>
    <?php elseif ($_SERVER['SERVER_NAME'] == 'beta.metadataregistry.org' || $_SERVER['SERVER_NAME'] == 'beta-sand.metadataregistry.org' || $_SERVER['SERVER_NAME'] == 'beta-prod.metadataregistry.org'): ?>
        <link rel="icon" href="/registry_favicon_beta.ico"/>
    <?php elseif ($_SERVER['SERVER_NAME'] == 'sandbox.metadataregistry.org'): ?>
        <link rel="icon" href="/registry_favicon_sand.ico"/>
    <?php else: ?>
        <link rel="icon" href="/registry_favicon_prod.ico"/>
    <?php endif; ?>

    <?php if (has_slot('feeds')): ?><?php include_slot('feeds') ?><?php endif; ?>
</head>
<body>
<?php use_helper('Javascript') ?>
<div id="indicator" style="display: none"></div>
<div id="header">
    <ul>
        <li class="browse"><?php echo link_to(__('Agents'), 'agents',  'title="Browse all Agents"' ) ?></li>
        <li class="browse"><?php echo link_to(__('Vocabularies'), 'vocabularies',  'title="Browse all Value Vocabularies"' ); ?></li>
        <li class="browse"><?php echo link_to(__('Element Sets'), 'elementsets', 'title="Browse all Element Sets"'); ?></li>
        <?php if ($sf_user->isAuthenticated()): ?>
            <li><?php echo link_to(__('%1% profile', [ '%1%' => $sf_user->getAttribute('nickname', '', 'subscriber') ]),
                                   '@current_user_profile') ?></li>
            <li><?php echo link_to(__('sign out'), '@logout') ?></li>
        <?php else: ?>
            <li><?php echo link_to(__('sign in / register'), '@login') ?></li>
        <?php endif ?>
        <li class="last"><?php echo link_to(__('about'), '@about') ?></li>
    </ul>
    <div style="padding-left: 10px;">
        <?php echo link_to(image_tag('open_metadata_logo_with_interoperability.png',
                                     'alt="Registry Home" style="position: absolute; max-width: 543px; width: 50%; height: auto; top: 0;" '),
                           '@homepage') ?>
    </div>
</div>
    <div id="search">
        <div style="padding-bottom: 3px;"><?php include_partial('conceptprop/search',
                                                                [ 'searchTerm' => $sf_params->get('term') ]) ?></div>
        <div><?php include_partial('schemaprop/search', [ 'searchTerm' => $sf_params->get('term') ]) ?></div>
    </div><div id="content">
    <div id="content_main" class="Left">
        <?php echo $sf_data->getRaw('sf_content') ?>
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
