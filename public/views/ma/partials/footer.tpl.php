			</div>

			<div id="footer">
				
			</div>
		</div>

		<div class="container margin-bottom">
			<div class="footer">
				<span class="italics">&copy; <?php echo date( "Y", time() ) . " " . strtoupper( SITE_NAME ) . " " . str_replace( '*company*', PARENT_COMPANY, str_replace( '*company_website*', PARENT_COMPANY_WEBSITE, $lang[ 'powered_by' ] ) ); ?></span>
			</div>
		</div>
    </body>
</html>
<?php
	if ( isset( $DB ) ) {
		$DB->close_connection();
	}
?>