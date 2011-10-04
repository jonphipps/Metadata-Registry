<?php slot('feeds') ?>
<link rel="alternate" type="application/rdf+xml" title="Registry News RSS 1.0 (RDF)" href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed/rdf" />
<link rel="alternate" type="application/rss+xml" title="Registry News RSS 2.0" href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed" />
<link rel="alternate" type="application/atom+xml" title="Registry News Atom 1.0" href= "http://metadataregistry.org/blog/category/registry-development/the-registry/feed/atom" />
<link rel="alternate" type="application/atom+xml" title="Registry Changes Atom 1.0" href= "http://173.203.104.72/allhistoryfeeds.atom" />
<?php end_slot() ?>

<div id="home" style="margin-left:auto;margin-right:auto;">
<?php echo $html ?>
  <table id="home_news_feed_container" width="100%" style="background-color: white; border-top: 3px solid red;">
    <tr>
      <td width="50%" valign="top">
        <table width="100%" style="border-bottom: 1px solid black;" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="baseline" style="white-space:nowrap"><h1 style="background-color: white; margin-left:0">Registry News</h1></td>
            <td valign="baseline" align="left" style="white-space:nowrap">  ...from the <a href="http://metadataregistry.org/blog/">Registry Blog</a></td>
            <td valign="baseline" align="right" style="white-space:nowrap; padding-right:10px; padding-left:6px; width:100%;" ><a href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed">rss 2.0</a>&nbsp;&nbsp;<a href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed/rdf">rss 1.0</a>&nbsp;&nbsp;<a href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed/atom">atom 1.0</a>&nbsp;&nbsp;<?php echo image_tag('feed-icon.gif',array('align' => "top")); ?></td>
          </tr>
        </table>
<?php if (isset($rssItems)): ?>
        <div id="home_news_feed" style="height:300px; background-color: white; padding:4px; overflow:scroll; padding-left:6px" > <!-- http://metadataregistry.org/blog/category/registry-development/feed -->
    <?php foreach ($rssItems as $key => $item): ?>
            <div style="padding-top:10px; border-bottom:#F2A430 1px solid; margin-bottom:2px; padding-bottom:6px;">
              <h2><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></h2>
              <div style="padding-top:2px; padding-bottom:2px; margin-bottom:4px;">
              Posted by: <span><?php echo $item['dc:creator'] ?></span> at
              <span><?php echo gmdate("H:i \o\\n l, F d, Y \G\\M\\T", strtotime($item['pubDate'])) ?></span></div>
              <?php // echo $item['content:encoded'] ?>
              <?php $item['description'] = preg_replace('/\[\.\.\.\]$/', '[ <a href="' . $item['link'] . '">...</a> ]', $item['description']) ?>
              <?php echo $item['description'] ?>
            </div>
    <?php endforeach; ?>
        </div>
<?php endif; ?>
      </td>
      <td width="50%" valign="top">
        <table width="100%" style="border-bottom: 1px solid black;" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="baseline" style="white-space:nowrap"><h1 style="background-color: white; margin-left:0">Latest Activity</h1></td>

            <td valign="baseline" align="right" style="white-space:nowrap; padding-right:10px; width:100%;" ><a href="http://173.203.104.72/allhistoryfeeds.atom">atom 1.0</a>&nbsp;&nbsp;<?php echo image_tag('feed-icon.gif',array('align' => "top")); ?></td>
          </tr>
        </table>
<?php if (isset($changeFeedItems)): ?>
        <div id="changes_feed" style="height:300px; background-color: white; padding:4px; overflow:scroll; padding-left:6px" > <!-- http://metadataregistry.org/blog/category/registry-development/feed -->
    <?php foreach ($changeFeedItems as $item): ?>
            <div style="padding-top:10px; border-bottom:#F2A430 1px solid; margin-bottom:2px; padding-bottom:6px;">
              <h2><a href="<?php /** @var sfFeeditem **/ echo $item->getLink() ?>"><?php echo $item->getTitle() ?></a></h2>
              <div style="padding-top:2px; padding-bottom:2px; margin-bottom:4px;">
              <?php echo $item->getContent() ?>
              </div>
            </div>
    <?php endforeach; ?>
        </div>
<?php endif; ?>
      </td>
    </tr>
  </table>
  </div>
