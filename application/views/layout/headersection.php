<style>
	.page-banner-with-full-image::before, .page-banner-with-full-image {
		border-radius: 30px;
	}
</style>

<?php
// Check if the current URL starts with your exclusion path
$current_url = $_SERVER['REQUEST_URI'];  // Get the current URL
$exclusion_path = '/article/'; // Notice the leading slash

if (strpos($current_url, $exclusion_path) !== 0) : // If NOT the start of the exclusion path
?>
	<div class="container">
		<div class="page-banner-with-full-image item-bg3">
			<div class="page-banner-content-two">
				<h2><?php echo $headerData['firstHeading']; ?></h2>
				<ul>
					<li>
						<a href="<?php echo site_url(); ?>">Home</a>
					</li>
					<?php
						if(isset($headerData['thirdHeading']))
						{
					?>
							<li><a href="<?php echo site_url('blogs'); ?>"><?php echo $headerData['secoundHeading']; ?></a></li>
							<li><?php echo $headerData['thirdHeading']; ?></li>
					<?php
						}
						else
						{
					?>
							<li><?php echo $headerData['secoundHeading']; ?></li>
					<?php				
						}
					?>
 
				</ul>
			</div>
		</div>
	</div>
<?php endif; ?>
