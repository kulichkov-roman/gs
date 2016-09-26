<form action="<?=SITE_TEMPLATE_PATH."/ajax/form.php"?>" method="post" class="form-request js__form-request ajax_form">
	<?=bitrix_sessid_post()?>
	<input name="type" type="hidden" value="79"/>
	<div class="success_block"></div>
	<ul class="form__list">
		<li class="form__item">
			<input type="text" name="name" class="form__input_text" placeholder="Имя">
		</li>
		<li class="form__item">
			<input type="tel" name="phone" class="form__input_text" placeholder="Телефон">
		</li>
		<li class="form__item">
			<input type="email" name="email" class="form__input_text" placeholder="Электронная почта">
		</li>
		<li class="form__item form__item_button">
			<input type="submit" class="form__submit btn" value="Отправить">
		</li>
	</ul>
</form>
