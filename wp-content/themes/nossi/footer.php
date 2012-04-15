<!-- Footer -->
<div id="footer">
	<div class="shell">
		<?php 
		add_filter('widget_title', 'nossi_autolink_footer_menu_titles');
		dynamic_sidebar('footer-widgets'); 
		remove_filter('widget_title', 'nossi_autolink_footer_menu_titles');
		?>
		<div class="f-contact">
			<a href="<?php echo home_url('/'); ?>" class="flogo"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/flogo.png" alt="" /></a>
			<div class="social">
				<a target="_blank" href="http://twitter.com/<?php echo get_option('twitter_username'); ?>" class="tw"></a>
				<a target="_blank" href="<?php echo get_option('facebook_link'); ?>" class="fb"></a>
				<a target="_blank" href="mailto:<?php bloginfo('admin_email'); ?>" class="ml"></a>
			</div>
			<div class="cl">&nbsp;</div>
			<?php echo wpautop(get_option('phone_numbers')); ?>

			<?php $address = get_option('general_address'); ?>
			<div class="map">
				<span class="arrow">&nbsp;</span>
				<a href="<?php echo add_query_arg('q', urlencode($address), 'http://maps.google.com/'); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/map.png" alt="" /></a>
			</div>
			<p class="address"><?php echo $address; ?></p>
		</div>
		<div class="cl">&nbsp;</div>
	</div>	
</div>

<!-- End of Footer -->
<!-- page-v -->
<div id="page-b" class="page-b">
	<div class="shell">
		<div id="btm-tabs">
			<div class="tabs-nav">
				<ul>
					<li><a class="livechat" id="chat-live-now" href="#"><span class="q-balloon"></span>CHAT LIVE NOW<span></span></a></li>
					<li><a href="#">SEND ME INFO<span></span></a></li>
					<li><a href="#">TAKE A TOUR<span></span></a></li>
				</ul>
			</div>
			<div class="tabs-holder">
				<div class="tab">
					<div class="chat">
                                                <textarea id="lpcChatTArea" style="width:474px; height:100px"></textarea>
						<!--<div class="entries-wrap" id="lpChatArea"></div>-->
						<div class="form">
							<form action="#">
								<em class="alignleft" id="lpcTyping">&nbsp;</em>
								<em class="alignright" id="lpcDuration">&nbsp;</em>
								<div class="cl">&nbsp;</div>
								<div class="row">
									<input type="text" class="chat-field" value="" id="lpChatLine" />
									<input type="submit" value="send" id="lpSendText" class="submit notext" />
									<div class="cl">&nbsp;</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="tab">
					<div class="info-form">
						<div class="contact form">
              <?php echo do_shortcode('[gravityform id="2" name="For More Info" title="false" description="false" ajax="true"]');?>
              <?php /*
							<form action="#">
								<p>Fill out the form to receive more information or use the chat function to speak with someone now!</p>
								<div class="row">
									<span class="field alignleft"><input type="text" title="FIRST NAME" value="FIRST NAME" /></span>
									<span class="field alignright"><input type="text" title="LAST NAME" value="LAST NAME" /></span>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="row">
									<span class="field alignleft"><input type="text" title="STREET ADDRESS" value="STREET ADDRESS" /></span>
									<span class="field alignright"><input type="text" title="CITY" value="CITY" /></span>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="row">
									<span class="field alignleft small"><input type="text" title="STATE" value="STATE" /></span>
									<span class="field alignleft small"><input type="text" title="ZIP" value="ZIP" /></span>
									<span class="field alignright"><input type="text" title="EMAIL" value="EMAIL" /></span>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="row">
									<div class="left">
										<label class="l-label">PHONE:</label>
										<span class="field alignright medium"><input type="text" title="    -     -     " value="    -     -     " /></span>
									</div>
									<div class="right">
										<label class="l-label">INTEREST:</label>
										<span class="select-field">
											<select>
                        <option value=""></option>
												<option value="Photography">PHOTOGRAPHY</option>
												<option value="Videography">VIDEOGRAPHY</option>
												<option value="Illustration">ILLUSTRATION</option>
												<option value="Graphic Design">GRAPHIC DESIGN<option>
											</select>
										</span>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="buttons">
									<input type="submit" value="Submit" class="submit" />
								</div>
							</form>
              */ ?>
						</div>
					</div>
				</div>
				<div class="tab">
					<div class="info-form">
						<div class="contact form">
             <?php  echo do_shortcode('[gravityform id="3" name="Send Me Info FOOTER" title="false" description="false" ajax="true"]');?> 
              <?php /*
							<form action="#">
								<p>Fill out the form to schedule a tour.</p>
								<div class="row">
									<span class="field alignleft"><input type="text" title="FIRST NAME" value="FIRST NAME" /></span>
									<span class="field alignright"><input type="text" title="LAST NAME" value="LAST NAME" /></span>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="row">
									<span class="field alignleft"><input type="text" title="STREET ADDRESS" value="STREET ADDRESS" /></span>
									<span class="field alignright"><input type="text" title="CITY" value="CITY" /></span>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="row">
									<span class="field alignleft small"><input type="text" title="STATE" value="STATE" /></span>
									<span class="field alignleft small"><input type="text" title="ZIP" value="ZIP" /></span>
									<span class="field alignright"><input type="text" title="EMAIL" value="EMAIL" /></span>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="row">
									<div class="left">
										<label class="l-label">PHONE:</label>
										<span class="field alignright medium"><input type="text" title="    -     -     " value="    -     -     " /></span>
									</div>
									<div class="right">
										<label class="l-label">INTEREST:</label>
										<span class="select-field">
											<span class="value">GRAPHIC DESIGN</span>
											<select>
                        <option value=""></option>
												<option value="Photography">PHOTOGRAPHY</option>
												<option value="Videography">VIDEOGRAPHY</option>
												<option value="Illustration">ILLUSTRATION</option>
												<option value="Graphic Design">GRAPHIC DESIGN<option>
											</select>
										</span>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="buttons">
									<input type="submit" value="Submit" class="submit" />
								</div>
							</form>
              */ ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end of page-b -->
		<?php wp_footer(); ?>
	</body>
</html>
