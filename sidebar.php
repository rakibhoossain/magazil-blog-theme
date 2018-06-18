<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package magazil
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="sidebars-area">
<!-- 	<div class="single-sidebar-widget editors-pick-widget">
		<h6 class="title">Editor’s Pick</h6>
		<div class="editors-pick-post">
			<div class="feature-img-wrap relative">
				<div class="feature-img relative">
					<div class="overlay overlay-bg"></div>
					<img class="img-fluid" src="img/e1.jpg" alt="">
				</div>
				<ul class="tags">
					<li><a href="#">Travel</a></li>
				</ul>
			</div>
			<div class="details">
				<a href="image-post.html">
					<h4 class="mt-20">A Discount Toner Cartridge Is
					Better Than Ever.</h4>
				</a>
				<ul class="meta">
					<li><a href="#"><span class="lnr lnr-user"></span>Mark wiens</a></li>
					<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
					<li><a href="#"><span class="lnr lnr-bubble"></span>06 </a></li>
				</ul>
				<p class="excert">
					Lorem ipsum dolor sit amet, consecteturadip isicing elit, sed do eiusmod tempor incididunt ed do eius.
				</p>
			</div>
			<div class="post-lists">
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="img/e2.jpg" alt="">
					</div>
					<div class="detail">
						<a href="image-post.html"><h6>Help Finding Information
						Online is so easy</h6></a>
						<ul class="meta">
							<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
							<li><a href="#"><span class="lnr lnr-bubble"></span>06</a></li>
						</ul>
					</div>
				</div>
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="img/e3.jpg" alt="">
					</div>
					<div class="detail">
						<a href="image-post.html"><h6>Compatible Inkjet Cartr
						world famous</h6></a>
						<ul class="meta">
							<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
							<li><a href="#"><span class="lnr lnr-bubble"></span>06</a></li>
						</ul>
					</div>
				</div>
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="img/e4.jpg" alt="">
					</div>
					<div class="detail">
						<a href="image-post.html"><h6>5 Tips For Offshore Soft
						Development </h6></a>
						<ul class="meta">
							<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
							<li><a href="#"><span class="lnr lnr-bubble"></span>06</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="single-sidebar-widget ads-widget">
		<img class="img-fluid" src="img/sidebar-ads.jpg" alt="">
	</div>
	<div class="single-sidebar-widget newsletter-widget">
		<h6 class="title">Newsletter</h6>
		<p>
			Here, I focus on a range of items
			andfeatures that we use in life without
			giving them a second thought.
		</p>
		<div class="form-group d-flex flex-row">
			<div class="col-autos">
				<div class="input-group">
					<input class="form-control" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" type="text">
				</div>
			</div>
			<a href="#" class="bbtns">Subcribe</a>
		</div>
		<p>
			You can unsubscribe us at any time
		</p>
	</div>
	<div class="single-sidebar-widget most-popular-widget">
		<h6 class="title">Most Popular</h6>
		<div class="single-list flex-row d-flex">
			<div class="thumb">
				<img src="img/m1.jpg" alt="">
			</div>
			<div class="details">
				<a href="image-post.html">
					<h6>Help Finding Information
					Online is so easy</h6>
				</a>
				<ul class="meta">
					<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
					<li><a href="#"><span class="lnr lnr-bubble"></span>06</a></li>
				</ul>
			</div>
		</div>
		<div class="single-list flex-row d-flex">
			<div class="thumb">
				<img src="img/m2.jpg" alt="">
			</div>
			<div class="details">
				<a href="image-post.html">
					<h6>Compatible Inkjet Cartr
					world famous</h6>
				</a>
				<ul class="meta">
					<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
					<li><a href="#"><span class="lnr lnr-bubble"></span>06</a></li>
				</ul>
			</div>
		</div>
		<div class="single-list flex-row d-flex">
			<div class="thumb">
				<img src="img/m3.jpg" alt="">
			</div>
			<div class="details">
				<a href="image-post.html">
					<h6>5 Tips For Offshore Soft
					Development </h6>
				</a>
				<ul class="meta">
					<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
					<li><a href="#"><span class="lnr lnr-bubble"></span>06</a></li>
				</ul>
			</div>
		</div>
		<div class="single-list flex-row d-flex">
			<div class="thumb">
				<img src="img/m4.jpg" alt="">
			</div>
			<div class="details">
				<a href="image-post.html">
					<h6>5 Tips For Offshore Soft
					Development </h6>
				</a>
				<ul class="meta">
					<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
					<li><a href="#"><span class="lnr lnr-bubble"></span>06</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="single-sidebar-widget social-network-widget">
		<h6 class="title">Social Networks</h6>
		<ul class="social-list">
			<li class="d-flex justify-content-between align-items-center fb">
				<div class="icons d-flex flex-row align-items-center">
					<i class="fa fa-facebook" aria-hidden="true"></i>
					<p>983 Likes</p>
				</div>
				<a href="#">Like our page</a>
			</li>
			<li class="d-flex justify-content-between align-items-center tw">
				<div class="icons d-flex flex-row align-items-center">
					<i class="fa fa-twitter" aria-hidden="true"></i>
					<p>983 Followers</p>
				</div>
				<a href="#">Follow Us</a>
			</li>
			<li class="d-flex justify-content-between align-items-center yt">
				<div class="icons d-flex flex-row align-items-center">
					<i class="fa fa-youtube-play" aria-hidden="true"></i>
					<p>983 Subscriber</p>
				</div>
				<a href="#">Subscribe</a>
			</li>
			<li class="d-flex justify-content-between align-items-center rs">
				<div class="icons d-flex flex-row align-items-center">
					<i class="fa fa-rss" aria-hidden="true"></i>
					<p>983 Subscribe</p>
				</div>
				<a href="#">Subscribe</a>
			</li>
		</ul>
	</div> -->

<aside id="sidebar" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
	
</div>

