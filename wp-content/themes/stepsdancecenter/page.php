<?php get_header(); ?>

<?php get_template_part('loop'); ?>

<?php include_once(ABSPATH.WPINC.'/feed.php');
// grab feeds
 $rss = fetch_feed('http://feeds.feedburner.com/EBRI-RSS');
 $rss2 = fetch_feed('http://www.employeebenefitsblog.com/index.xml');

// set item count up for each
$tic = 10;
$maxitems = $rss->get_item_quantity($tic);
$maxitems2 = $rss2->get_item_quantity($tic);

// get each feed up to total item count
$rss_items = $rss->get_items(0, $maxitems);
$rss_items2 = $rss2->get_items(0, $maxitems2);
 ?>

<?php if ($maxitems == 0) echo '<li>No items available</li>';
else
foreach ( $rss_items as $item ) : ?>
  <?php //echo $item->get_title(); ?>
  <?php $time = strtotime($item->get_date()); 
  //echo $time; ?>
<?php endforeach; ?>

<?php $c = array(); foreach ($rss_items as $ts => $v) { $c[$ts] = $v; } foreach ($rssitems2 as $ts => $v) { $c[$ts] = $v; } var_dump($c); ?>

<?php get_footer(); ?>
