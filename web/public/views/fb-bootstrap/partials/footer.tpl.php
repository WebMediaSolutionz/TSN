    </div> <!-- /container -->

    <footer>
    	<div class="container container-fluid">
    		<div class="footer-nav pull-left">
    			<!-- footer nav -->
    		</div>
			<div class="copyright pull-right">
				<span>&copy; <?php echo date( "Y", time() ) . " " . strtoupper( SITE_NAME ) . " " . str_replace( '*company*', PARENT_COMPANY, str_replace( '*company_website*', PARENT_COMPANY_WEBSITE, $lang[ 'powered_by' ] ) ); ?></span>
			</div>
		</div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>