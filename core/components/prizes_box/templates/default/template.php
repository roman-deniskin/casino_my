<? 
$prizeID = $arResult['user_prizes']['prize_id'] ?? '';
$prizeType = $arResult['user_prizes']['type'] ?? '';
$error = $arResult['error'] ?? '';
?>
<?if(!$error):?>
	<div class="prizes_wrapper clearfix">
		<div class="prizes_title">Розыгрыш призов</div>
		<div class="prize_item">
			<div class="bx_item_slider">
				<?foreach($arResult['items'] as $key => $item):?>
					<div class="prize_item_slide">
						<div class="prize_img_wrapper">
							<img class="prize_img" src="<?=core\files\includer::getIMG('img/'.$item['thing_photo']);?>">
						</div>
						<div class="prize_name"><?=$item['thing_name'];?></div>
						<div class="prize_description"><?=$item['thing_description'];?></div>
						<div class="prize_quantity"><?=$item['thing_quantity'];?></div>	
					</div>
				<?endforeach;?>
			</div>
		</div>
		<div class="prize_item">
			<div class="prize_img_wrapper">
				<img class="prize_img" src="<?=core\files\includer::getIMG('img/money.png');?>">
			</div>
			<div class="prize_name">Денежный приз</div>
			<div class="prize_description">Денежные средства будут зачислены на ваш счёт и вы можете в любой момент обменять их на внутреннюю валюту казино, либо вывести на сторонний счёт.</div>
			<div class="casino_balance">Доступно: <?=$arResult['casino_balance'];?> р.</div>
		</div>
		<div class="prize_item">
			<div class="prize_img_wrapper">
				<img class="prize_img" src="<?=core\files\includer::getIMG('img/bonuse.png');?>">
			</div>
			<div class="prize_name">Бонусные баллы</div>
			<div class="prize_description">Бонусы можно потратить как в казино, так и конвертировать в валюту и вывести.</div>
		</div>
		<?if($prizeID == ''):?>
			<div class="prizes_btn_wrapper">
				<form class="prizes_form" name="prizes_form" action="#" method="post">
					<input type="hidden" value="get_prize" name="action">
					<input type="submit" class="get_prizes_btn" value="Получить приз">	
				</form>
			</div>
		<?endif;?>
	</div>
	<?if($prizeID != ''):?>
		<div class="total_prizes_area clearfix">
			<div class="prizes_title">Ваш выигрыш:</div>
			<?if($prizeType == 'thing'):?>
				<div class="prize_item">
					<div class="prize_item_slide">
						<div class="prize_img_wrapper">
							<img class="prize_img" src="<?=core\files\includer::getIMG('img/'.$arResult['user_prizes']['prize_detail_info']['thing_photo']);?>">
						</div>
						<div class="prize_name"><?=$arResult['user_prizes']['prize_detail_info']['thing_name'];?></div>
						<div class="prize_description"><?=$arResult['user_prizes']['prize_detail_info']['thing_description'];?></div>
					</div>
				</div>
			<?elseif($prizeType == 'bonuses'):?>
				<div class="prize_item">
					<div class="prize_img_wrapper">
						<img class="prize_img" src="<?=core\files\includer::getIMG('img/bonuse.png');?>">
					</div>
					<div class="prize_name">Бонусные баллы</div>
					<div class="prize_description"><?=$arResult['user_prizes']['prize_detail_info']['bonuse_value'];?> баллов.</div>
				</div>
			<?elseif($prizeType == 'money'):?>
				<div class="prize_item">
					<div class="prize_img_wrapper">
						<img class="prize_img" src="<?=core\files\includer::getIMG('img/money.png');?>">
					</div>
					<div class="prize_name">Денежный приз</div>
					<div class="prize_description"><?=$arResult['user_prizes']['prize_detail_info']['money_value'];?> рублей.</div>
				</div>
			<?else:?>
			<?endif;?>
			<div class="prizes_btn_wrapper">
				<?if($arResult['user_prizes']['prize_status'] == 0):?>
					<form class="prizes_form get" name="prizes_form" action="#" method="post">
						<input type="submit" class="get_prizes_btn get" value="Забрать приз">	
					</form>
					<form class="prizes_form another" name="prizes_form" action="#" method="post">
						<input type="hidden" value="delete_prize" name="action">
						<input type="submit" class="get_prizes_btn delete" value="Хочу другой">	
					</form>
					<div class="prizes_form saved">
						Ваш приз успешно сохранён. Перейдите в <a class="cabinet_a" href="/profile/">профиль</a> и оставьте заявку на выдачу приза.
					</div>
				<?else:?>
					<form class="prizes_form another" name="prizes_form" action="#" method="post">
						<input type="hidden" value="delete_prize" name="action">
						<input type="submit" class="get_prizes_btn delete" value="Хочу другой">	
					</form>
					<div class="prizes_form saved show">
						Ваш приз успешно сохранён. Перейдите в <a class="cabinet_a" href="/profile/">профиль</a> и оставьте заявку на выдачу приза.
					</div>
				<?endif;?>
			</div>
		</div>
	<?endif;?>
<?else:?>
	<div class="error_message"><?=$error;?></div>
<?endif;?>