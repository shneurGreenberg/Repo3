<div id="panel-search-progression">
	<div id="video-search-header">
			<?php
				$videourl = get_post_type_archive_link('video_skrn');
				if(!isset($_GET['search_keyword'])) { $_GET['search_keyword'] = ''; }
				if(!isset($_GET['vtype'])) { $_GET['vtype'] = ''; }
				if(!isset($_GET['vgenre'])) { $_GET['vgenre'] = ''; }
                if(!isset($_GET['vplatform'])) { $_GET['vplatform'] = ''; }
				if(!isset($_GET['vduration'])) { $_GET['vduration'] = ''; }
				if(!isset($_GET['vrating'])) { $_GET['vrating'] = ''; }
				if(!isset($_GET['vcategory'])) { $_GET['vcategory'] = ''; }
				if(!isset($_GET['vdirector'])) { $_GET['vdirector'] = '';
                }
			?>

			<form method="get" class="advanced-searchform-video-header" action="<?php echo esc_url($videourl); ?>">
				<input type="hidden" name="post_type" value="video_skrn" />
				<input type="text" class="search-field-progression" name="search_keyword" placeholder="<?php esc_html_e( 'Search for Movies or TV Series', 'vayvo-progression' ); ?>" value="<?php echo esc_attr($_GET['search_keyword']); ?>" />

				<div id="video-search-header-filtering">
					<div id="video-search-header-filtering-padding">

						<ul class="skrn-video-search-columns skrn-video-search-count-<?php echo esc_attr( get_theme_mod( 'progression_studios_header_search_columns', '3') ); ?>">


							<?php if (get_theme_mod( 'progression_studios_video_search_field_type', 'true') == 'true') : ?>
							<?php $vtype = get_terms('video-type'); if($vtype): ?>
								<li class="column-search-header">
									<h5><?php esc_html_e( 'Type:', 'vayvo-progression' ); ?></h5>
									<ul class="video-search-type-list">
										<?php if(function_exists('progression_theme_elements_vayvo')  ): ?>
										<?php foreach($vtype as $vt): ?>
										<li>
											<label class="checkbox-pro-container"><?php echo esc_attr($vt->name); ?>
												<input type="checkbox" value="<?php echo esc_attr($vt->slug); ?>" name="vtype[]"
												<?php if($_GET['vtype']): ?><?php if(in_array($vt->slug, $_GET['vtype'])){ echo 'checked="checked"';}  ?><?php endif; ?>>
												<span class="checkmark-pro"></span>
											</label>
										</li>
										<?php endforeach; ?>
										<?php endif; ?>
									</ul>
									<div class="clearfix-pro"></div>
								</li>
							<?php endif; ?>
							<?php endif; ?>


							<?php if (get_theme_mod( 'progression_studios_video_search_field_genre', 'true') == 'true') : ?>
							<?php $vgenre = get_terms('video-genres'); if($vgenre): ?>
								<li class="column-search-header">
									<h5><?php esc_html_e( 'Genre:', 'vayvo-progression' ); ?></h5>
									<select name="vgenre<?php if (get_theme_mod( 'progression_studios_video_search_multiple_genre') == 'multiple') : ?>[]<?php endif; ?>" class="skrn-genre-select2" <?php if (get_theme_mod( 'progression_studios_video_search_multiple_genre') == 'multiple') : ?>multiple="multiple"<?php endif; ?> style="width: 100%">
										<?php if (get_theme_mod( 'progression_studios_video_search_multiple_genre', 'single') == 'single') : ?><option value=""><?php echo esc_html__( 'All Genres', 'vayvo-progression' ); ?></option><?php endif; ?>
										<?php if(function_exists('progression_theme_elements_vayvo')  ): ?>
										<?php foreach($vgenre as $vg): ?><option value="<?php echo esc_attr($vg->slug); ?>"
											<?php if (get_theme_mod( 'progression_studios_video_search_multiple_genre') == 'multiple') : ?>
												<?php if($_GET['vgenre']): ?><?php if(in_array($vg->slug, $_GET['vgenre'])){ echo 'selected="selected"';}  ?><?php endif; ?>
											<?php else: ?>
												<?php if($_GET['vgenre'] == $vg->slug ): ?>selected="selected"<?php endif; ?>
											<?php endif; ?>><?php echo esc_attr($vg->name); ?></option><?php endforeach; ?>
										<?php endif; ?>
									</select>
								</li>
							<?php endif; ?>
							<?php endif; ?>

                            <?php if (1) : ?>
                                <?php $vplatform = array('zeremtv'=>'zerem.tv', 'ivi'=>'ivi.ru','cinizen'=>'cinizen.io','nonfiction'=>'nonfiction.film','kinopoisk'=>'kinopoisk.ru','okko'=>'okko.ru'); if($vplatform): ?>
                                    <li class="column-search-header">
                                        <h5><?php esc_html_e( 'See at:', 'vayvo-progression' ); ?></h5>
                                        <select name="vplatform" class="skrn-platform-select2" x-multiple="multiple" style="width: 100%">
                                            <option value=""><?php echo esc_html__( 'All Platforms', 'vayvo-progression' ); ?></option>

                                                <?php foreach($vplatform as $key=>$title): ?><option value="<?=$key?>"
                                                        <?php if($_GET['vplatform']): ?><?php if($key==$_GET['vplatform']){ echo 'selected="selected"';}  ?><?php endif; ?>
                                                    ><?php echo $title; ?></option><?php endforeach; ?>

                                        </select>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>


							<?php if (get_theme_mod( 'progression_studios_video_search_field_duration', 'true') == 'true') : ?>
							<li class="column-search-header">
								<h5><?php esc_html_e( 'Duration:', 'vayvo-progression' ); ?></h5>
								<select name="vduration" class="skrn-duration-select2" style="width: 100%">
									<option value=""><?php echo esc_html__( 'Any Duration', 'vayvo-progression' ); ?></option>
									<option value="short" <?php if($_GET['vduration'] == 'short'): ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Short (< 5 minutes)', 'vayvo-progression' ); ?></option>
									<option value="medium" <?php if($_GET['vduration'] == 'medium'): ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Medium (5-10 minutes)', 'vayvo-progression' ); ?></option>
									<option value="long" <?php if($_GET['vduration'] == 'long'): ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Long (> 10 minutes)', 'vayvo-progression' ); ?></option>
								</select>
							</li>
							<?php endif; ?>

							<?php if (get_theme_mod( 'progression_studios_video_search_field_category') == 'true') : ?>
							<?php $vcategory = get_terms('video-category'); if($vcategory): ?>
								<li class="column-search-header">
									<h5><?php esc_html_e( 'Duration:', 'vayvo-progression' ); ?></h5>
<!--									<select name="vcategory--><?php //if (get_theme_mod( 'progression_studios_video_search_multiple_cat') == 'multiple') : ?><!--[]--><?php //endif; ?><!--" class="skrn-category-select2" --><?php //if (get_theme_mod( 'progression_studios_video_search_multiple_cat') == 'multiple') : ?><!--multiple="multiple"--><?php //endif; ?><!-- style="width: 100%">-->
<!--										--><?php //if (get_theme_mod( 'progression_studios_video_search_multiple_cat', 'single') == 'single') : ?><!--<option value="">--><?php //echo esc_html__( 'All Categories', 'vayvo-progression' ); ?><!--</option>--><?php //endif; ?>
<!--										--><?php //foreach($vcategory as $vc): ?><!--<option value="--><?php //echo esc_attr($vc->slug); ?><!--"-->
<!---->
<!--										--><?php //if (get_theme_mod( 'progression_studios_video_search_multiple_cat') == 'multiple') : ?>
<!--											--><?php //if($_GET['vcategory']): ?><!----><?php //if(in_array($vc->slug, $_GET['vcategory'])){ echo 'selected="selected"';}  ?><!----><?php //endif; ?>
<!--										--><?php //else: ?>
<!--											--><?php //if($_GET['vcategory'] == $vc->slug ): ?><!--selected="selected"--><?php //endif; ?>
<!--										--><?php //endif; ?>
<!--										>--><?php //echo esc_attr($vc->name); ?><!--</option>--><?php //endforeach; ?>
<!--									</select>-->


                                    <ul class="video-search-type-list">
                                        <?php if(function_exists('progression_theme_elements_vayvo')  ): ?>
                                            <?php foreach($vcategory as $vt): ?>
                                                <li>
                                                    <label class="checkbox-pro-container"><?php echo esc_attr($vt->name); ?>
                                                        <input type="checkbox" value="<?php echo esc_attr($vt->slug); ?>" name="vcategory[]"
                                                            <?php if($_GET['vcategory']): ?><?php if(in_array($vt->slug, $_GET['vcategory'])){ echo 'checked="checked"';}  ?><?php endif; ?>>
                                                        <span class="checkmark-pro"></span>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
								</li>
							<?php endif; ?>
							<?php endif; ?>


							<?php if (get_theme_mod( 'progression_studios_video_search_field_director') == 'true') : ?>
							<?php $vdirector = get_terms('video-director'); if($vdirector): ?>
								<li class="column-search-header">
									<h5><?php esc_html_e( 'Director:', 'vayvo-progression' ); ?></h5>
									<select name="vdirector<?php if (get_theme_mod( 'progression_studios_video_search_multiple_director') == 'multiple') : ?>[]<?php endif; ?>" class="skrn-director-select2" <?php if (get_theme_mod( 'progression_studios_video_search_multiple_director') == 'multiple') : ?>multiple="multiple"<?php endif; ?> style="width: 100%">
										<?php if (get_theme_mod( 'progression_studios_video_search_multiple_director', 'single') == 'single') : ?><option value=""><?php echo esc_html__( 'All Directors', 'vayvo-progression' ); ?></option><?php endif; ?>
										<?php foreach($vdirector as $vd): ?><option value="<?php echo esc_attr($vd->slug); ?>"
											<?php if (get_theme_mod( 'progression_studios_video_search_multiple_director') == 'multiple') : ?>
												<?php if($_GET['vdirector']): ?><?php if(in_array($vd->slug, $_GET['vdirector'])){ echo 'selected="selected"';}  ?><?php endif; ?>
											<?php else: ?>
												<?php if($_GET['vdirector'] == $vd->slug ): ?>selected="selected"<?php endif; ?>
											<?php endif; ?>
											><?php echo esc_attr($vd->name); ?></option><?php endforeach; ?>
									</select>
								</li>
							<?php endif; ?>
							<?php endif; ?>

							<?php if (get_theme_mod( 'progression_studios_video_search_field_rating', 'true') == 'true') : ?>
							<li class="column-search-header">
								<h5><?php esc_html_e( 'Average Rating:', 'vayvo-progression' ); ?></h5>
								<input class="rating-range-search-skrn" type="text" name="vrating" min="0" max="5" value="<?php echo isset($_GET['vrating']) && !empty($_GET['vrating']) ? $_GET['vrating'] : '0,5'; ?>" step="1"  />
							</li>
							<?php endif; ?>
						</ul>

						<div class="clearfix-pro"></div>

						<div class="video-search-header-buttons">
                            <input type="button" id="configreset" value="<?php echo esc_html__( 'Reset', 'vayvo-progression' ); ?>" />
							<input type="submit" class="submit-search-pro" name="submit" value="<?php echo esc_html__( 'Search Videos', 'vayvo-progression' ); ?>" />

						</div>

						<div class="clearfix-pro"></div>
					</div><!-- #video-search-header-filtering-padding -->
				</div><!-- close #video-search-header-filtering -->

			</form>

			<div class="clearfix-pro"></div>
	</div><!-- close #video-search-header -->
</div><!-- close #panel-search-progression -->
