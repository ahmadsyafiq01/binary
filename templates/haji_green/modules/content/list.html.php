<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<div class="content news">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><?php echo $cat['title']; ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 pb-4">
				<?php
				if($cat['total_page'] > 1)
				{
					?>
					<span class="text text-muted text-justify"><?php echo lang('page').' '.($page+1).' '.lang('of').' '.items($cat['total_page'], 'page');?></span>
					<div class="clearfix"></div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
		foreach((array)$cat['list'] as $k => $data)
		{
			$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
			$link      = content_link($data['id'], $data['title']);

			if ($k == 0)
			{
				if ((!empty($config['thumbnail']) && !empty($data['image'])))
				{
					?>
					<div class="row">
						<div class="col-md-12" align="center">
							<?php echo content_src($data['image'], true, false) ?>
						</div>
					</div>
					<?php
				}
				?>
				<div class="row d-flex-c">
					<div class="col-md-12" style="display: unset;">
						<?php
						if(!empty($config['title']))
						{
							if(!empty($config['title_link']))
							{
								?>
								<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>"><h4><?php echo $data['title'];?></h4></a>
								<?php
							}else{
								?>
								<h4><?php echo $data['title'];?></h4>
								<?php
							}
						}

						if(	!empty($config['created']) || !empty($config['author'] ))
						{
							?>
							<span><?php echo (!empty($config['created'])) ? content_date($data['created']) : '' ?> <?php echo (!empty($config['author'])) ? lang('by') : '' ?> <span style="font-weight: bold"><?php echo (!empty($config['author'])) ? $data['created_by_alias'] : '' ?></span></span>
							<?php
						}
						?>
						<p></p>
						<p style="text-align: left!important;">
							<?php echo nl2br(strip_tags($data['intro']));?>
							<?php echo (!empty($config['read_more'])) ? '<a href="'.$link.'" class="readmore">'.lang('Read more').'</a>' : '';?>
							<?php
								if( !empty($config['tag']) )
								{
									?>
									<div class="text-left">
										<?php
										$r = content_category($data['id'], $config['tag_link']);
										echo lang('Tags').implode(' ', $r);
										?>
									</div>
									<?php
								}
								if(empty($data['revised']))
								{
									$config['modified'] = 0;
								}
								if(!empty($config['rating']) || !empty($config['modified']) || !empty($edit_data))
								{
									?>
									<div class="row">
										<?php
										if($config['rating'])
										{
											echo '<div class="col-md-5">'.rating($data['rating']).'</div>';
										}
										if(!empty($edit_data))
										{
											?>
											<div class="col-md-7 text-right">
												<?php echo ($config['modified']) ? '<span class="text-muted">'.lang('modified').content_date($data['modified']).'</span>' : '';?>
												<a href="<?php echo $Bbc->mod['circuit'].'.posted_form&id='.$data['id'];?>" title="<?php echo lang('edit content');?>"><?php echo icon('edit');?></a>
											</div>
											<?php
										}	else {
											echo ($config['modified']) ? '<div class="col-md-7 text-right"><span class="text-muted">'.lang('modified').content_date($data['modified']).'</span></div>' : '';?>
											<div class="clearfix"></div>
											<?php
										}
										?>
									</div>
									<?php
								}
							?>
						</p>
					</div>
				</div>
				<?php
			}else{
				?>
				<div class="row subNews">
					<?php
					$col1 = 0;
					if ((!empty($config['thumbnail']) && !empty($data['image'])))
					{
						$col1 = 3;
						?>
						<div class="col-md-<?php echo $col1 ?> newsImage" align="center">
							<?php echo content_src($data['image'], ' class="img-responsive" style="width: 100%;"', false) ?>
						</div>
						<?php
					}

					$col2 = 12 - $col1;
					?>
					<div class="col-md-<?php echo $col2?> newsText">
						<?php
						if(!empty($config['title']))
						{
							if(!empty($config['title_link']))
							{
								?>
								<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>"><h4><?php echo $data['title'];?></h4></a>
								<?php
							}else{
								?>
								<h4><?php echo $data['title'];?></h4>
								<?php
							}
						}
						if(	!empty($config['created']) || !empty($config['author'] ))
						{
							?>
							<span><?php echo (!empty($config['created'])) ? content_date($data['created']) : '' ?> <?php echo (!empty($config['author'])) ? lang('by') : '' ?> <span style="font-weight: bold"><?php echo (!empty($config['author'])) ? $data['created_by_alias'] : '' ?></span></span>
							<?php
						}
						?>
						<p></p>
						<p style="text-align: justify;">
							<?php echo nl2br(strip_tags($data['intro']));?>
							<?php echo (!empty($config['read_more'])) ? '<a href="'.$link.'" class="readmore">'.lang('Read more').'</a>' : '';?>
							<?php
								if( !empty($config['tag']) )
								{
									?>
									<div class="text-left">
										<?php
										$r = content_category($data['id'], $config['tag_link']);
										echo lang('Tags').implode(' ', $r);
										?>
									</div>
									<?php
								}
								if(empty($data['revised']))
								{
									$config['modified'] = 0;
								}
								if(!empty($config['rating']) || !empty($config['modified']) || !empty($edit_data))
								{
									?>
									<div class="row">
										<?php
										if($config['rating'])
										{
											echo '<div class="col-md-5">'.rating($data['rating']).'</div>';
										}
										if(!empty($edit_data))
										{
											?>
											<div class="col-md-7 text-right">
												<?php echo ($config['modified']) ? '<span class="text-muted">'.lang('modified').content_date($data['modified']).'</span>' : '';?>
												<a href="<?php echo $Bbc->mod['circuit'].'.posted_form&id='.$data['id'];?>" title="<?php echo lang('edit content');?>"><?php echo icon('edit');?></a>
											</div>
											<?php
										}	else {
											echo ($config['modified']) ? '<div class="col-md-7 text-right"><span class="text-muted">'.lang('modified').content_date($data['modified']).'</span></div>' : '';?>
											<div class="clearfix"></div>
											<?php
										}
										?>
									</div>
									<?php
								}
							?>
						</p>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
</div>

<?php
echo '<div class="text-center">'.page_list($cat['total'], $config['tot_list'], $page, 'page', $cat['link']).'</div>';
if (!empty($cat['rss']))
{
	?>
	<a href="<?php echo $cat['rss'];?>" class="btn btn-warning btn-sm pull-right" title="<?php echo lang('category feed');?>"><?php echo icon('fa-rss-square');?> <?php echo lang('category feed');?></a>
	<?php
}
?>
<div class="clearfix"></div>
