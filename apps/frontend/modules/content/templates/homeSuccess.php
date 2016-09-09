<?php slot('feeds') ?>
<link rel="alternate" type="application/rdf+xml" title="Registry News RSS 1.0 (RDF)" href="http://blog.metadataregistry.org/category/registry-development/the-registry/feed/rdf"/>
<link rel="alternate" type="application/rss+xml" title="Registry News RSS 2.0" href="http://blog.metadataregistry.org/category/registry-development/the-registry/feed"/>
<link rel="alternate" type="application/atom+xml" title="Registry News Atom 1.0" href="http://blog.metadataregistry.org/category/registry-development/the-registry/feed/atom"/>
<link rel="alternate" type="application/atom+xml" title="Registry Changes Atom 1.0" href="http://metadataregistry.org/allhistoryfeeds.atom"/>
<?php end_slot() ?>
<?php /** @var myUser $sf_user */
$subscriber = $sf_user->getSubscriber();
if ($subscriber && $sf_user->isAuthenticated()):
    $subscriber = $sf_user->getSubscriber();
    ?>
    <div id="sf_admin_container">
        <h1>My Stuff</h1>
        <div id="sf_admin_content">
            <fieldset id="sf_fieldset_schemas">
                <h2><?php echo __('Element Sets') ?></h2>
                <div id="show_row_user_schema_list" class="show-row">
                    <div id="show_row_content_user_schema_list" class="content">
                        <?php $showValue = get_partial('user/schema_list', [ 'type' => 'list', 'user' => $subscriber ]);
                        if ($showValue) {
                            echo get_partial('user/schema_list',
                                             [
                                                 'type' => 'list',
                                                 'user' => $subscriber
                                             ]);
                        } ?>
                    </div>
                </div>
            </fieldset>
            <?php if ($sf_user->getAttribute('agentCount', '0', 'subscriber')): ?>
                <ul class="sf_admin_actions">
                    <li>
                        <?php echo button_to(__('Add Element Set'),
                                             'schema/create',
                                             [
                                                 'title' => 'Create',
                                                 'class' => 'sf_admin_action_create',
                                             ]) ?>
                    </li>
                </ul>
            <?php endif; ?>
            <fieldset id="sf_fieldset_vocabularies">
                <h2><?php echo __('Vocabularies') ?></h2>
                <div id="show_row_user_vocabulary_list" class="show-row">
                    <div id="show_row_content_user_vocabulary_list" class="content">
                        <?php $showValue = get_partial('user/vocabulary_list',
                                                       [ 'type' => 'list', 'user' => $subscriber ]);
                        if ($showValue) {
                            echo get_partial('user/vocabulary_list',
                                             [
                                                 'type' => 'list',
                                                 'user' => $subscriber
                                             ]);
                        } ?>
                    </div>
                </div>
            </fieldset>
            <?php if ($sf_user->getAttribute('agentCount', '0', 'subscriber')): ?>
                <ul class="sf_admin_actions">
                    <li>
                        <?php echo button_to(__('Add Vocabulary'),
                                             'vocabulary/create',
                                             [
                                                 'title' => 'Create',
                                                 'class' => 'sf_admin_action_create',
                                             ]) ?>
                    </li>
                </ul>
            <?php endif; ?>
            <fieldset id="sf_fieldset_agents">
                <h2><?php echo __('Agents') ?></h2>
                <div id="show_row_user_agent_list" class="show-row">
                    <div id="show_row_content_user_agent_list" class="content">
                        <?php $showValue = get_partial('user/agent_list', [ 'type' => 'list', 'user' => $subscriber ]);
                        if ($showValue) {
                            echo get_partial('user/agent_list',
                                             [
                                                 'type' => 'list',
                                                 'user' => $subscriber
                                             ]);
                        } ?>
                    </div>
                </div>
            </fieldset>
            <ul class="sf_admin_actions">
                <li>
                    <?php echo button_to(__('Add Agent'),
                                         'agent/create',
                                         [
                                             'title' => 'Create',
                                             'class' => 'sf_admin_action_create',
                                         ]) ?>
                </li>
            </ul>
        </div>
    </div>
<?php else: ?>
    <div id="home" class="shadow" style="margin-left:auto;margin-right:auto;">
        <?php echo $html ?>
        <div id="home_news_feed_container" style="background-color: white; border-top: 3px solid red; display: flex;">
            <div style="width: 50%; flex: 1 1 0%; border-width: 1px medium 1px 1px; border-style: solid none solid solid; border-color: black; -moz-use-text-color black black; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none;">
                <div style="border-bottom: 1px solid black; width: 100%">
                    <h1 style="background-color: white; margin-left:0; display: inline-block">Registry News</h1>
                    <span style="white-space:nowrap; text-align: left"> ...from the
                                <a href="http://blog.metadataregistry.org/">Registry Blog</a></span>
                    <div style="white-space: nowrap; padding-right: 20px; padding-left: 6px; float: right; top: 8px; position: relative; text-align: right;">
                        <a href="http://blog.metadataregistry.org/category/registry-development/the-registry/feed">rss
                            2.0</a>&nbsp;&nbsp;<a href="http://blog.metadataregistry.org/category/registry-development/the-registry/feed/rdf">rss
                            1.0</a>&nbsp;&nbsp;<a href="http://blog.metadataregistry.org/category/registry-development/the-registry/feed/atom">atom
                            1.0</a>&nbsp;&nbsp;<?php echo image_tag('feed-icon.gif',
                                                                    'style="position: relative; top: 3px;"'); ?>
                    </div>
                </div>
                <?php if (isset( $rssItems )): ?>
                    <div id="home_news_feed" style="height:300px; background-color: white; padding:4px; overflow:scroll; padding-left:6px">
                        <!-- http://blog.metadataregistry.org/category/registry-development/feed -->
                        <?php foreach ($rssItems as $key => $item): ?>
                            <div style="padding-top:10px; border-bottom:#F2A430 1px solid; margin-bottom:2px; padding-bottom:6px;">
                                <h2><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></h2>
                                <div style="padding-top:2px; padding-bottom:2px; margin-bottom:4px;">
                                    Posted by: <span><?php echo $item['dc:creator'] ?></span> at
                                    <span><?php echo gmdate("H:i \o\\n l, F d, Y \G\\M\\T",
                                                            strtotime($item['pubDate'])) ?></span></div>
                                <?php // echo $item['content:encoded'] ?>
                                <?php $item['description'] = preg_replace('/\[\.\.\.\]$/',
                                                                          '[ <a href="' . $item['link'] . '">...</a> ]',
                                                                          $item['description']) ?>
                                <?php echo $item['description'] ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div style="float: right; flex: 1 1 0%; border: 1px solid black; border-collapse: collapse;">
                <div style="border-bottom: 1px solid black;">
                    <h1 style="background-color: white; margin-left:0; display: inline-block">Latest Activity</h1>
                    <div style="white-space: nowrap; padding-right: 10px; padding-left: 6px; float: right; position: relative; text-align: right; top: 8px;">
                        <a href="http://metadataregistry.org/allhistoryfeeds.atom">atom
                            1.0</a>&nbsp;&nbsp;<?php echo image_tag('feed-icon.gif',
                                                                    'style="position: relative; top: 2px;"'); ?>
                    </div>
                </div>
                <?php if (isset( $changeFeedItems )): ?>
                    <div id="changes_feed" style="height:300px; background-color: white; padding:4px; overflow:scroll; padding-left:6px">
                        <!-- http://blog.metadataregistry.org/category/registry-development/feed -->
                        <?php foreach ($changeFeedItems as $item): ?>
                            <div style="padding-top:10px; border-bottom:#F2A430 1px solid; margin-bottom:2px; padding-bottom:6px;">
                                <h2><a href="<?php /** @var sfFeeditem * */
                                    echo $item->getLink() ?>"><?php echo $item->getTitle() ?></a></h2>
                                <div style="padding-top:2px; padding-bottom:2px; margin-bottom:4px;">
                                    <?php echo $item->getContent() ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
