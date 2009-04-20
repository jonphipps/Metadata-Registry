<?php slot('feeds') ?>
<link rel="alternate" type="application/rss+xml" title="Registry News RSS 1.0 (RDF)" href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed/rdf" />
<link rel="alternate" type="application/rss+xml" title="Registry News RSS 2.0" href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed" />
<link rel="alternate" type="application/atom+xml" title="Registry News Atom 1.0" href= "http://metadataregistry.org/blog/category/registry-development/the-registry/feed/atom" />
<?php end_slot() ?>

<div id="home" style="margin-left:auto;margin-right:auto;">
<?php echo $html ?>
        <table style="width: 100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="baseline" style="white-space:nowrap"><h1>Registry News</h1></td>
            <td valign="baseline" align="left" style="white-space:nowrap">  ...from the <a href="http://metadataregistry.org/blog/">Registry Blog</a></td>
            <td valign="baseline" align="right" style="white-space:nowrap; padding-right:10px; width:100%;" ><a href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed">rss 2.0</a>&nbsp;&nbsp;<a href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed/rdf">rss 1.0</a>&nbsp;&nbsp;<a href="http://metadataregistry.org/blog/category/registry-development/the-registry/feed/atom">atom 1.0</a>&nbsp;&nbsp;<?php echo image_tag('feed-icon.gif',array('align' => "middle")); ?></td>
          </tr>
        </table>
<?php if (isset($rssItems)): ?>
    <div id="home_news_feed" > <!-- http://metadataregistry.org/blog/category/registry-development/feed -->
<?php foreach ($rssItems as $key => $item): ?>
        <div style="padding-top:10px; border-bottom:#F2A430 1px solid; margin-bottom:2px;">
          <h2><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></h2>
          <div style="padding-top:2px; padding-bottom:2px; margin-bottom:4px;">
          Posted by: <span><?php echo $item['dc:creator'] ?></span> at
          <span><?php echo gmdate("H:i \o\\n l, F d, Y \G\\M\\T", strtotime($item['pubDate'])) ?></span></div>
          <?php echo $item['content:encoded'] ?>
        </div>
<?php endforeach; ?>
    </div>
<?php endif; ?>
  </div>
