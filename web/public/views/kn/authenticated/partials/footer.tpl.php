				<footer class="smaller">
					<div>
						 All models appearing on this website are 18 year or older. Click here for 18 U.S.C. 2257 Record Keeping Requirements Compliance Statement.
					</div>

					<div>
						By entering this site, you swear that you are of legal age in your area to view adult material and that you wish to view such material.
					</div>

					<div>
						<a class="<?php echo ( $current_page_short === 'privacy_policy' ) ? 'current' : ''; ?>" href="privacy_policy.php">Privacy Policy</a> <div class="pipe"></div> <a class="<?php echo ( $current_page_short === 'terms_and_conditions' ) ? 'current' : ''; ?>" href="terms_and_conditions.php">Terms and Conditions</a> <div class="pipe"></div> <a class="<?php echo ( $current_page_short === 'technical_support' ) ? 'current' : ''; ?>" href="technical_support.php">Technical Support</a>
					</div>

					<span class="italics">copyright &copy; <?php echo date( "Y", time() ) . " " . strtoupper( SITE_NAME ) . " " . str_replace( '*company*', PARENT_COMPANY, str_replace( '*company_website*', PARENT_COMPANY_WEBSITE, $lang[ 'powered_by' ] ) ); ?></span>
				</footer>
			</div>
    	</div>

    	<?php include( 'templates.tpl.php' ); ?>

    	<script type="text/javascript" src="views/<?php echo $theme; ?>/authenticated/scripts/compressed/lib/jquery-3.0.0.min.js"></script>
    	<script type="text/javascript" src="views/<?php echo $theme; ?>/authenticated/scripts/compressed/lib/mustache.min.js"></script>
		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		<script type="text/javascript" src="views/<?php echo $theme; ?>/authenticated/scripts/compressed/lib/tinymce.min.js"></script>

		<script type="text/javascript" src="views/<?php echo $theme; ?>/authenticated/scripts/compressed/javascript.js"></script>
    </body>
</html>
<?php
	if ( isset( $DB ) ) {
		$DB->close_connection();
	}
?>