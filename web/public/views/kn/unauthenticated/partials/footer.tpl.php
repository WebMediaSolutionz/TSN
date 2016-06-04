				<footer>
					<div>
						 All models appearing on this website are 18 year or older. Click here for 18 U.S.C. 2257 Record Keeping Requirements Compliance Statement.
					</div>

					<div>
						By entering this site, you swear that you are of legal age in your area to view adult material and that you wish to view such material.
					</div>

					<div>
						<a href="privacy_policy.php">Privacy Policy</a> <div class="pipe"></div> <a href="terms_and_conditions.php">Terms and Conditions</a> <div class="pipe"></div> <a href="technical_support.php">Technical Support</a>
					</div>

					<span class="italics">copyright &copy; <?php echo date( "Y", time() ) . " " . strtoupper( SITE_NAME ) . " " . str_replace( '*company*', PARENT_COMPANY, str_replace( '*company_website*', PARENT_COMPANY_WEBSITE, $lang[ 'powered_by' ] ) ); ?></span>
				</footer>
			</div>
    	</div>

    	<script type="text/javascript" src="scripts/<?php echo $theme; ?>/javascript.js"></script>
    </body>
</html>
<?php
	if ( isset( $DB ) ) {
		$DB->close_connection();
	}
?>