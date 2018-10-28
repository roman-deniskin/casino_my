<? 
$prizeID = $arResult['user_prizes']['prize_id'] ?? '';
$prizeType = $arResult['user_prizes']['type'] ?? '';
$error = $arResult['error'] ?? '';
?>
<?if(!$error):?>
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
				<div class="prizes_form saved show">
					Чтобы получить приз, позвоните по номеру 8 800 555 35 35 и наш менеджер проконсультирует вас.
				</div>
			</div>
		</div>
	<?endif;?>
<?else:?>
	<div class="error_message"><?=$error;?></div>
<?endif;?>