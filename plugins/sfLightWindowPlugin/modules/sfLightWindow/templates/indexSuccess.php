<?php use_helper('LightWindow') ?>
<div class="background">
<div class="page-body">

	<h1 style="color: #FFFFFF;">LightWindow v2.0 <span style="font-size:14px">Now with sfLightWindowPlugin for Symfony!</span></h1>
	<p>This is a port of the original demo used with <?php echo link_to('LightWindow v2.0', 'http://stickmanlabs.com/lightwindow') ?>. If you look at the source you will see it uses the symfony helpers to do all the work. It's amazingly simple to add these great effects to your site.</p>
	<p><small>Changes from original LightWindow v2.0</small> The sfLightWindowPlugin uses a slightly altered lightwindow.js source. The only changes made were to the path of the image files, and the option of using an improved inline form handler, found in the last two methods <span>_lwUpdateWithResponse</span> and <span>_lwSingleFormCall</span>.</p>
	<p><small>Requirements</small> LightWindow v2.0 requires at least prototype 1.5.1.1 and scriptaculous > v1.7.1. These are included with the plugin, but you can customize the location of this files in sfLightWindowPlugin/config/config.php.</p>
	<p><small>Notes</small> Due to the size of some of the sample content, it is best that your browser window is larger than 800px for these demos. </p>
	<h2>sfLightWindowPlugin <span>lw_link(), lw_image(), lw_media() and more...</h2>
	<p>It's easy to use, and supports all the page and media types of LightWindow. After installing the plugin, just include the helper in your template file and you are off to the races.</p>
	<pre><code>&lt;?php use_helper(&apos;LightWindow&apos;) ?&gt;
&lt;?php echo lw_link(&apos;My LightWindow&apos;, &apos;module/action&apos;) ?&gt;
&lt;?php echo lw_media(&apos;My Media File&apos;, &apos;/gallery/my_movie.mov&apos;, &apos;width=19 height=240&apos;) ?&gt;
&lt;?php echo lw_image(image_tag(&apos;pic_thumb.jpg&apos;), &apos;/gallery/pic.jpg&apos;) ?&gt;
&lt;?php echo lw_button(&apos;click to open!&apos;, &apos;/images/yourimage.png&apos;, array(
  &apos;title&apos;   =&gt; &quot;Great Pic&quot;,
  &apos;author&apos;  =&gt; &quot;Stereo&quot;,
  &apos;caption&apos; =&gt; &quot;Your caption&quot;,
  &apos;left&apos;    =&gt; 300,
)) ?&gt;
</code></pre>
	<p>You can also add any of the the following options in the third parameter:</p>
	<pre><code>title         // title of window
author        // author of window
caption       // the caption for the window
width         // Width of window
height        // Height of window
show_images   // Number of images to show at once in a gallery
top           // Set as an Integer to be spaced from the Top
left          // Set as an Integer to be spaced from the Left
type          // Specify the type of content served: page, external, image, media, inline
loading_animation // Set to false to opt to not fade out the Loading Cover
iframe_embed  // To embed media into a media into an iframe rather than just into a div
form          // The name of the form</code></pre>
  <p>To create a gallery, you use the <small>lw_gallery()</small> function with an array of image attributes.</p>
<pre><code>&lt;?php 
  $media = array();

  $media[] = array(
    &apos;link&apos;    =&gt; &apos;&lt;strong&gt;Image Gallery&lt;/strong&gt; - Everyone needs a killer gallery!&apos;,
    &apos;src&apos;     =&gt; &apos;/sfLightWindowPlugin/gallery/0.jpg&apos;,
    &apos;options&apos; =&gt; array(
      &apos;class&apos; =&gt; &apos;page-options&apos;,
      &apos;title&apos; =&gt; &apos;High 5 Dood!&apos;,
      &apos;caption&apos;=&gt; &apos;Snow people know how to have fun...&apos;,
    ),
  );

  $media[] = array(
    &apos;link&apos;  =&gt; &apos;Header #3&apos;,
    &apos;src&apos;   =&gt; &apos;/sfLightWindowPlugin/gallery/header3.swf?scale=noscale&amp;amp;tag1=Sooth Your Mind &amp;amp; Body&amp;amp;tag2=Justice Through Integrity&amp;amp;tag3=Helping Injured Victims&amp;amp;tag4=Experience You Can Trust&apos;,
    &apos;options&apos; =&gt; array(
      &apos;width&apos; =&gt; &apos;769&apos;,
      &apos;height&apos;=&gt; &apos;209&apos;,
      &apos;title&apos; =&gt; &quot;Oh My! Flash and Images Mixed!&quot;,
      &apos;author&apos;=&gt; false,
      &apos;caption&apos;=&gt; false,
    ),
  );
    
  $gallery_options = array(
    &apos;hide&apos; =&gt; true,
    &apos;title&apos; =&gt; &apos;default title&apos;,
    &apos;caption&apos; =&gt; &apos;default caption&apos;,
    &apos;author&apos; =&gt; &apos;Unknown&apos;,
  );

  echo lw_gallery($media, &apos;Random[Sample Images]&apos;, $gallery_options);
?&gt;
</pre></code>
  <p>View the PHP source of this page found in <small>/sfLightWindowPlugin/modules/sfLightWindowPlugin/templates/indexSuccess.php</small> to find out more about galleries of images and other types of web media.
	<h2>Media <span>Movies, Flash, PDF's... just link directly to the file!</span></h2>
	<p>
	  <?php echo lw_media('<strong>Quicktime Movie Example</strong> - Local File', '/sfLightWindowPlugin/gallery/sample_sorenson.mov', 'width=190 height=240 class=page-options') ?>
	  <?php echo lw_media('<strong>Apple.com Trailer</strong> - Transformers, more than meets the eye!', 'http://images.apple.com/movies/dreamworks/transformers/transformers-tlr4_h.640.mov', 'width=640 height=288 class=page-options')?>
	  <?php echo lw_media('<strong>Single SWF Example</strong> - Because I <strong>Love</strong> Flash...', '/sfLightWindowPlugin/gallery/header3.swf?scale=noscale&amp;tag1=Sooth Your Mind &amp; Body&amp;tag2=Justice Through Integrity&amp;tag3=Helping Injured Victims&amp;tag4=Experience You Can Trust', 'class=page-options width=769 height=209 title="Preview: Doesn\'t your masthead look perdy?"') ?>
  	
  	<?php
  	  $swfs = array();
  	  $swfs[] = array(
  	    'link' => '<strong>SWF Gallery</strong> - Any media can now be used in a GALLERY!',
  	    'src'  => '/sfLightWindowPlugin/gallery/header.swf?scale=noscale&amp;tag1=Sooth Your Mind &amp; Body&amp;tag2=Justice Through Integrity&amp;tag3=Helping Injured Victims&amp;tag4=Experience You Can Trust',
  	    'options' => 'class=page-options width=800 height=345 title="Gallery: Doesn\'t your masthead look perdy?" author="Einstein Industries"',
  	  );
  	  // or you can pass the options parameter as an array
  	  $swfs[] = array(
  	    'link' => 'SWF #2',
  	    'src'  => '/sfLightWindowPlugin/gallery/header3.swf?scale=noscale&amp;tag1=Sooth Your Mind &amp; Body&amp;tag2=Justice Through Integrity&amp;tag3=Helping Injured Victims&amp;tag4=Experience You Can Trust',
  	    'options' => array(
  	      'width' => '769',
  	      'height'=> '209',
  	      'title' => 'Gallery: I like this one more!',
  	      'author'=> 'Einstein Industries',
  	    ),
  	  );
  	  echo lw_gallery($swfs, "Flash Gallery[Headers]");
  	?>
		
		<?php echo lw_media('<strong>User Example</strong> - CheathamLane.net', 'http://www.cheathamlane.net/clients/SFCM/flash/index.html', 'class=page-options width=600 height=450 loading_animation=false title="CheathamLane :: Interactive 360&deg; Photography &amp; Flash') ?>
		<?php echo lw_media('<strong>Flash Paper</strong> - The RIGHT way to embed a PDF!', '/sfLightWindowPlugin/gallery/frontdoor_doc.swf', 'class=page-options iframe_embed=true title="Flash Paper"') ?>
		<?php echo lw_media('<strong>You Tube</strong> - 300 Preview', 'http://www.youtube.com/v/uhi5x7V3WXE', 'class=page-options width=425 height=340 loading_animation=false title="YouTube: 300 Preview"') ?>
  </p>
  
	<h2>External Sources <span>Look Ma! It's like a popup window! (Other Domains)</span></h2>
	<p>
	  <?php echo lw_link('<strong>Website Example</strong> - Preview any website from yours!', 'http://www.symfony-project.com', 'class=page-options caption="Our beloved Symfony Project"')?>
    <?php echo lw_link('<strong><span style="color: red;">NEW</span> Page Treated as External</strong> - This page is local to this domain but is placed in an iframe.', 'sfLightWindow/blank', 'class=page-options type=external') ?>
	</p>

	<h2>Frame Calls <span style="color: red;">NEW</span> <span>Call a LightWindow from a frame!</span></h2>
	<p>
    <iframe id="iframe_test" src="<?php echo url_for('sfLightWindow/iframe')?>" frameborder="1" allowtransparency="true" scrolling="no" width="100%" height="25" ></iframe>
	</p>

	<h2>Images <span>Singles or Gallery Sets!</span></h2>
	<p>
	  <?php echo lw_image('<strong>Textual Link</strong> Links can be text or images...', '/sfLightWindowPlugin/gallery/image-5.jpg', array(
	      'class' => 'page-options',
	      'title' => 'What is this plant?',
	      'author'=> 'Unknown',
	      'caption'=>'Whatever it is, it is still a pretty cool picture.
	                  Whatever it is, it is still a pretty cool picture.
	                  Whatever it is, it is still a pretty cool picture.
	                  Whatever it is, it is still a pretty cool picture.',
	    )) ?>
	  
	  <?php echo lw_image(image_tag('/sfLightWindowPlugin/gallery/stereo_banner_thumb.png'), '/sfLightWindowPlugin/gallery/stereo_logo.png', 'class=page-options title=Stereo Interactive & Design') ?>
		<?php echo lw_image('<strong><span style="color: red;">NEW</span> External Image</strong> - An Image pulled from an External Source', 'http://farm1.static.flickr.com/180/439443686_bc797081ea.jpg', array(
		  'class' => 'page-options',
		   'title'=> "Bob, Donna and my son Kote",
		   'author'=>"My Wife",
		   'caption'=>"Three of some of the most important people in my life."
		)) ?>
		
		<?php
    $images = array();

    $images[] = array(
      'link'    => '<strong>Image Gallery</strong> - Everyone needs a killer gallery!',
      'src'     => '/sfLightWindowPlugin/gallery/0.jpg',
      'options' => array(
        'class' => 'page-options',
        'title' => 'High 5 Dood!',
        'caption'=> 'Snow people know how to have fun...',
      ),
    );

    $images[] = array(
      'link'    => 'image #1',
      'src'     => '/sfLightWindowPlugin/gallery/1.jpg',
      'options' => array(
        'title'   => 'Snow People Playing Football',
        'caption' => "Please don't kick me!",
      ),
    );
    
    $images[] = array(
      'link'  => 'Header #3',
      'src'   => '/sfLightWindowPlugin/gallery/header3.swf?scale=noscale&amp;tag1=Sooth Your Mind &amp; Body&amp;tag2=Justice Through Integrity&amp;tag3=Helping Injured Victims&amp;tag4=Experience You Can Trust',
      'options' => array(
        'width' => '769',
        'height'=> '209',
        'title' => "Oh My! Flash and Images Mixed!",
        'author'=> false,
        'caption'=> false,
      ),
    );
        
    $gallery_options = array(
      'hide' => true,
      'title' => 'default title',
      'caption' => 'default caption',
      'author' => 'Unknown',
    );

    echo lw_gallery($images, 'Random[Sample Images]', $gallery_options);
    ?>
    
    <?php 
    $images = array();
    $images[] = array(
      'link'  => "<strong>Image Gallery w/Multiple Images</strong> - Side by Sides can be good for Before and After Gallery's or to show actions, etc.!",
      'src'   => '/sfLightWindowPlugin/gallery/0-evolution.jpg',
      'options'=> array(
        'class' => 'page-options',
        'title' => "The Evolution of Man is looking grim...",
        'caption' => "Man starts out kinda hairy...",
        'author' => "Unknown",
        'show_images' => 2,
      ),
    );
    // add other images to the array automatically...
    for ($i=1; $i<6; $i++) {
      $images[] = array(
        'link'  => 'Image '.$i,
        'src'   => '/sfLightWindowPlugin/gallery/'.$i.'-evolution.jpg',
        'options' => array(
          'show_images' => 2
        )
      );
    }
    
    echo lw_gallery($images, 'Evolution?[Man]');
    ?>
	</p>

	<h2>Instantiate 1 by 1 <span>when you need to add one window or re-add it or whatever</span></h2>
	<p>
    <input type="button" onclick="javascript: if (!$('sample-link').onclick) {myLightWindow.createWindow('sample-link'); exampleCreated = true;}" value="Instantiate the Link Below" />
              or 
		<?php echo lw_button('Launch it from this button!', 'http://stickmanlabs.com/images/kevin_vegas.jpg', 'title="waiting for the show to start in Las Vegas" author="Jazzmatt" caption="Mmmmm Margaritas! And yes, this is me..." left=300') ?>
	</p>
          
	<p>
		<a href="http://stickmanlabs.com/images/kevin_vegas.jpg" class="page-options" title="Waiting for the show to start in Las Vegas" author="Jazzmatt" caption="Mmmmmm Margaritas! And yes, this is me..." id="sample-link"><strong><span style="color: red;">NEW</span> A link with no Class</strong> - As in no Class Name! We built this one with a function call.</a>
	</p>				

	<h2>Forms <span>yes, yes it does work...</span></h2>
	<p>
	  <?php echo lw_link('<strong>Form Example</strong> - Submit a form in a lightWindow!', 'sfLightWindow/form', 'width=175 height=60 class=page-options') ?>
	  <?php echo lw_link('<strong><span style="color: red;">NEW</span> Form Example with a custom position</strong> - Submit a form in a lightWindow!', 'sfLightWindow/form', 'width=175 height=60 class=page-options top=200 left=300') ?>
	</p>
	<h2>Pages <span>Fixed width and Fluid.</span></h2>
	<p>
	  <?php echo lw_link('<strong>Fluid Page</strong> - This page does not have a width, the content is flexible.</a>', 'sfLightWindow/blank', 'class=page-options') ?>
		<?php echo lw_link('<strong>Fixed Page</strong> - This page has a defined amount of space it needs or it will cause a horizontal scroll.', 'sfLightWindow/wide', 'class=page-options') ?>
		<?php echo lw_link('<strong>Monster Fixed Page</strong> - This page is just plain too big for the browser window unless you maximize a 30 inch monitor.', 'sfLightWindow/huge', 'class=page-options title=Sample Title') ?>
		<?php echo lw_link('<strong>Set Dimensions</strong> - Set the dimensions of the window.', 'sfLightWindow/wide', 'class=page-options width=800 height=350') ?>
	</p>
	<h2>Inline Content <span>They call this a gimme :)</span></h2>
	<p>
	  <?php echo lw_link('<strong>Inline Content</strong> - Not a fan of AJAX? No worries, here you go.', '#inline-sample', 'class=page-options')?>
	</p>
	
</div>

<div class="page-footer">
	<p>LightWindow &copy; Copyright 2007 <a href="http://www.stickmanlabs.com/"><small>stickmanlabs</small></a></p>
	<p>sfLightWindowPlugin &copy; Copyright 2007 <a href="http://blog.stereodevelopment.com">Stereo Interactive &amp; Design</a></p>
	<p>LightWindow and sfLightWindowPlugin are freely distributable under the terms of an MIT-style license.</p>
</div>

<!-- Hidden stuff for demos -->
<div id="inline-sample" >
	
					
	<div >
	<p>Oh yeah, this content was pulled from within the page!</p>
	<p>In order to get the LightWindow to fit the content, you have to define the height and width of a div in the inline div or send values for lightwindow_width and lightwindow_height in the url string.   Personally I prefer the inner div method, this way you can gracefully degrade the link as I did into an anchor if javascript isn't available.</p>
	<p>
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vestibulum hendrerit nibh at libero. Donec lectus enim, condimentum ac, scelerisque non, malesuada id, diam. Sed porta magna. Ut luctus bibendum nulla. Ut sit amet tellus. Aliquam ut justo. Duis sapien magna, sagittis et, molestie at, interdum a, mi. Nunc nisi arcu, tincidunt quis, adipiscing ac, faucibus convallis, ligula. Aenean lacinia laoreet nisi. Integer dictum. Maecenas porttitor dictum felis.
	</p>
	<p>
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vestibulum hendrerit nibh at libero. Donec lectus enim, condimentum ac, scelerisque non, malesuada id, diam. Sed porta magna. Ut luctus bibendum nulla. Ut sit amet tellus. Aliquam ut justo. Duis sapien magna, sagittis et, molestie at, interdum a, mi. Nunc nisi arcu, tincidunt quis, adipiscing ac, faucibus convallis, ligula. Aenean lacinia laoreet nisi. Integer dictum. Maecenas porttitor dictum felis.
	</p>
	<p>
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vestibulum hendrerit nibh at libero. Donec lectus enim, condimentum ac, scelerisque non, malesuada id, diam. Sed porta magna. Ut luctus bibendum nulla. Ut sit amet tellus. Aliquam ut justo. Duis sapien magna, sagittis et, molestie at, interdum a, mi. Nunc nisi arcu, tincidunt quis, adipiscing ac, faucibus convallis, ligula. Aenean lacinia laoreet nisi. Integer dictum. Maecenas porttitor dictum felis.
	</p>
	<p>
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vestibulum hendrerit nibh at libero. Donec lectus enim, condimentum ac, scelerisque non, malesuada id, diam. Sed porta magna. Ut luctus bibendum nulla. Ut sit amet tellus. Aliquam ut justo. Duis sapien magna, sagittis et, molestie at, interdum a, mi. Nunc nisi arcu, tincidunt quis, adipiscing ac, faucibus convallis, ligula. Aenean lacinia laoreet nisi. Integer dictum. Maecenas porttitor dictum felis.
	</p>
	<p>
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vestibulum hendrerit nibh at libero. Donec lectus enim, condimentum ac, scelerisque non, malesuada id, diam. Sed porta magna. Ut luctus bibendum nulla. Ut sit amet tellus. Aliquam ut justo. Duis sapien magna, sagittis et, molestie at, interdum a, mi. Nunc nisi arcu, tincidunt quis, adipiscing ac, faucibus convallis, ligula. Aenean lacinia laoreet nisi. Integer dictum. Maecenas porttitor dictum felis.
	</p>
	<p>
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vestibulum hendrerit nibh at libero. Donec lectus enim, condimentum ac, scelerisque non, malesuada id, diam. Sed porta magna. Ut luctus bibendum nulla. Ut sit amet tellus. Aliquam ut justo. Duis sapien magna, sagittis et, molestie at, interdum a, mi. Nunc nisi arcu, tincidunt quis, adipiscing ac, faucibus convallis, ligula. Aenean lacinia laoreet nisi. Integer dictum. Maecenas porttitor dictum felis.
	</p>
	</div>
	
</div>
</div>