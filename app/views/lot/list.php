<section class="section-lots-list">
    <div class="lots-header">
        <div class="lot-box lot-id">#</div>
        <div class="lot-box lot-currency">Валюта</div>
        <div class="lot-box lot-amount">Сумма</div>
        <div class="lot-box lot-rubles">В рублях</div>
        <div class="lot-box lot-status">Операция</div>
    </div>
    <div class="lots-body">
      <? foreach ($lots as $lot): ?>
          <div class="lot-item">
              <div class="lot-box lot-id"><?=$lot['id']?></div>
              <div class="lot-box lot-currency"><?=$lot['name']?></div>
              <div class="lot-box lot-amount"><?=$lot['amount']?></div>
              <div class="lot-box lot-rubles"><?=$lot['rubles']?></div>
              <div class="lot-box lot-status">
                  <input type="button" value="Купить" class="lot-action base-button button-yellow button-confirm" data-option="purchase" data-lot-id="<?=$lot['id']?>">
                  <input type="button" value="Отклонить" class="lot-action base-button button-blue button-confirm" data-option="decline" data-lot-id="<?=$lot['id']?>">
              </div>
          </div>
      <? endforeach; ?>
    </div>
</section>

