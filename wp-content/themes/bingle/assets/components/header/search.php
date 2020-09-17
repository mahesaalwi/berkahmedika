<div class="search-wrapper">
	<span class="search-icon">
		<label id="searchopen" for="search-toggle">
			<div id="wrapper">
				<button class="btn-transparent-tottle">
				<div id="circle"></div>
				<div id="bar"></div>
				</button>
			</div>
		</label>
	</span>
	<div class="header-search">
		<div class="bingle-search-form">
			<?php echo wp_kses_post(get_search_form()); ?>
		</div>
	</div>
</div>