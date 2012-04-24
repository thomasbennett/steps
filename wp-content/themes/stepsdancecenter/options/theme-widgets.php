<?php
/*
* Register the new widget classes here so that they show up in the widget list
*/
function load_widgets() {
	register_widget('LatestTweets');
	register_widget('ThemeWidgetLatestBlogPost');
	register_widget('ThemeWidgetSidePageNavigation');
}
add_action('widgets_init', 'load_widgets');

class LatestTweets extends ThemeWidgetBase {
	function LatestTweets() {
		$widget_opts = array(
			'classname' => 'theme-widget',
			'description' => 'Displays a block with your latest tweets'
		);
		$this->WP_Widget('theme-widget-latest-tweets', 'Latest Tweets', $widget_opts);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title',
				'default'=>''
			),
			array(
				'name'=>'count',
				'type'=>'text',
				'title'=>'Number of Tweets to show',
				'default'=>'3'
			),
		);
	}
	
	function front_end($args, $instance) {
		extract($args);
		if ($instance['title']) {
			echo $before_title . $instance['title'] . $after_title;
		}		
		?>
    <?php $twittername = get_option('twitter_username'); ?>
    <h3 class="twitter-icon">@<?php echo $twittername; ?></h3>
    <div class="twitter-box"></div>
    <?php 
//      require_once __DIR__ . '/../lib/twitter/TwitterHelper.php';
//      $twitter_helper = new TwitterHelper('steps');
//      $tweets = $twitter_helper->_get_tweets(5);
//      die(var_dump($tweets));

      require(dirname(__FILE__). '/../twitter-cache.php');
      $cache = new JG_Cache(dirname(__FILE__). '/../cache');
      $data = $cache->get('tweets');

      if ($data === FALSE)
      {
        $data = file_get_contents('http://twitter.com/statuses/user_timeline.json?screen_name='.$twittername.'&count='.$instance['count']);
        $cache->set('tweets', $data);

      }
    ?>

    <script>
    jQuery(function(){
      var data = <?php echo $data; ?>;

      jQuery.each(data, function(i,item){
        ctd = item['created_at'];
        cta = item['id'];
        ct = item.text;
        replyto = item['id_str'];
        var ctu = "http://twitter.com/intent/user?screen_name=<?php echo $twittername ?>";
        ct = ct.replace(/http:\/\/\S+/g,  '<a href="$&" target="_blank">$&</a>');
        ct = ct.replace(/\s(@)(\w+)/g,    ' @<a onclick="javascript:pageTracker._trackPageview("/outgoing/twitter.com/");" href="http://twitter.com/$2" target="_blank">$2</a>');
        ct = ct.replace(/\s(#)(\w+)/g,    ' #<a onclick="javascript:pageTracker._trackPageview("/outgoing/search.twitter.com/search?q=%23");" href="http://search.twitter.com/search?q=%23$2" target="_blank">$2</a>');
        jQuery(".twitter-box").append( 
          '<div class="tweeters">' +
            '<a href="'+ ctu + '"><?php echo $twittername ?></a> '
            + ct +
            '<br />' + 
            '<small>' + 
              '<a href="http://twitter.com/intent/tweet?in_reply_to='+cta+'">reply</a> - ' +
              '<a href="http://twitter.com/intent/retweet?tweet_id='+replyto+'">retweet</a> - ' + 
              '<a href="http://twitter.com/intent/favorite?tweet_id='+replyto+'">favorite</a>' + 
          '</div>'
        );
      });
    });
    </script>
<?php
/*
		<div class="twitter-box">
			<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script>
			new TWTR.Widget({
			  version: 2,
			  type: 'profile',
			  rpp: <?php echo $instance['count']; ?>,
			  interval: 30000,
			  width: 396,
			  height: 230,
			  theme: {
			    shell: {
			      background: '#ffffff',
			      color: '#000000'
			    },
			    tweets: {
			      background: '#ffffff',
			      color: '#000000',
			      links: '#007ac1'
			    }
			  },
			  features: {
			    scrollbar: false,
			    loop: false,
			    live: false,
			    behavior: 'all'
			  }
			}).render().setUser('<?php echo get_option('twitter_username'); ?>').start();
			</script>
		</div>
    <?php 
*/ 
	}
}

class ThemeWidgetLatestBlogPost extends ThemeWidgetBase {
	function ThemeWidgetLatestBlogPost() {
		$widget_opts = array(
			'classname' => 'theme-widget', 
			'description' => __( 'Displays a block with title/text' ) 
		);
		$control_ops = array();
		$this->WP_Widget('theme-widget-latest-blog-post', 'Latest Blog Post', $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title', 
				'type'=>'text', 
				'title'=>'Title',
				'default'=>'Nossi Blog'
			),
		);
	}
	

	function front_end($args, $instance) {
		if (isset($instance['title'])): ?>
			<h6><?php echo $instance['title']; ?></h6>
			<?php 
		endif;
		query_posts('post_type=post&posts_per_page=1'); 
		add_filter('excerpt_length', 'steps_exceprt_length_average');
		while(have_posts()): 
			the_post();
			?>
			<div class="blogpost">
				<?php if (has_post_thumbnail()): ?>
					<?php the_post_thumbnail('post_medium', array('class' => 'alignleft')) ?>
				<?php endif ?>
				<p class="posted"><?php the_time('d/m/Y'); ?></p>
				<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<div class="entry">
					<?php the_excerpt(); ?>					
				</div>
				<a href="<?php the_permalink(); ?>" class="more">MORE<span class="arr">&nbsp;</span></a>
				<div class="cl">&nbsp;</div>
			</div>
			<?php
		endwhile;
		remove_filter('excerpt_length', 'steps_exceprt_length_average');
		wp_reset_query();
		?>
		<a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="more alignright">VISIT THE BLOG<span class="arr">&nbsp;</span></a>
		<?php
	}
}

class ThemeWidgetSidePageNavigation extends ThemeWidgetBase {
	function ThemeWidgetSidePageNavigation() {
		$widget_opts = array(
			'classname' => 'theme-widget', 
			'description' => __( 'Displays a related side navigation' ) 
		);
		$control_ops = array();
		$this->WP_Widget('theme-widget-related-side-nav', 'Side Page Navigation', $widget_opts, $control_ops);
		$this->custom_fields = array();
		$this->print_wrappers = false;
	}
	

	function front_end($args, $instance) {
		if (!is_page() && get_post_type() != 'tribe_events' && get_post_type() != 'student') {
			return;
		}
		global $post, $wp_query;
		if(get_post_type() == 'tribe_events' || get_post_type() == 'student') {
			$anc = get_page_by_path('student-life');
		} else {
			$anc = get_page_ancestor($post->ID);	
		}
		$children = get_pages('sort_column=menu_order&order=ASC&parent=' . $anc->ID . '&child_of=' . $anc->ID);
		if (!$children) {
			return;
		}
		?>
		<div id="menu">
			<div class="menu-t"></div>
			<div class="menu-c">
				<ul>
					<li<?php echo (is_page($anc->ID)) ? ' class="current"' : ''; ?>><a href="<?php echo get_permalink($anc->ID); ?>"><?php echo $anc->post_title; ?></a></li>
					<?php foreach ($children as $c): ?>
						<li<?php echo (is_page($c->ID)) ? ' class="current"' : ''; ?>><a href="<?php echo get_permalink($c->ID); ?>"><?php echo $c->post_title; ?></a></li>						
					<?php endforeach ?>
				</ul>
			</div>
			<div class="menu-b"></div>
		</div>
		<?php
	}
}
?>
