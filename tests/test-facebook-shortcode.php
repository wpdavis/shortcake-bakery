<?php

class Test_Facebook_Shortcode extends WP_UnitTestCase {

	public function test_post_display() {
		$post_id = $this->factory->post->create( array( 'post_content' => '[facebook url="https://www.facebook.com/willpd/posts/1001217146572688"]' ) );
		$post = get_post( $post_id );
		$this->assertContains( '<div class="fb-post shortcake-bakery-responsive" data-href="https://www.facebook.com/willpd/posts/1001217146572688"', apply_filters( 'the_content', $post->post_content ) );
	}

	public function test_video_display() {
		$post_id = $this->factory->post->create( array( 'post_content' => '[facebook url="https://www.facebook.com/video.php?v=1095405247152119"]' ) );
		$post = get_post( $post_id );
		$this->assertContains( '<div class="fb-post shortcake-bakery-responsive" data-href="https://www.facebook.com/video.php?v=1095405247152119"', apply_filters( 'the_content', $post->post_content ) );
	}

	public function test_embed_reversal() {
		$old_content = <<<EOT

		apples before

		<div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script><div class="fb-post" data-href="https://www.facebook.com/video.php?v=1095405247152119" data-width="466"><div class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/video.php?v=1095405247152119">Post</a> by <a href="https://www.facebook.com/fusionmedianetwork">Fusion</a>.</div></div>

		bananas after
EOT;
		$transformed_content = wp_filter_post_kses( $old_content );
		$transformed_content = str_replace( '\"', '"', $transformed_content ); // Kses slashes the data
		$this->assertContains( '[facebook url="https://www.facebook.com/video.php?v=1095405247152119"]', $transformed_content );
		$this->assertContains( 'apples before', $transformed_content );
		$this->assertContains( 'bananas after', $transformed_content );

	}

}
