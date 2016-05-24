				<footer>
					<span class="italics">&copy; <?php echo date( "Y", time() ) . " " . strtoupper( SITE_NAME ) . " " . str_replace( '*company*', PARENT_COMPANY, str_replace( '*company_website*', PARENT_COMPANY_WEBSITE, $lang[ 'powered_by' ] ) ); ?></span>
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