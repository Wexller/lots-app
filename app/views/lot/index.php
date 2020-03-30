<section class="section-lots-list">
    <div class="lots-header">
        <div class="lot-box lot-id">#</div>
        <div class="lot-box lot-currency">Валюта</div>
        <div class="lot-box lot-amount">Сумма</div>
        <div class="lot-box lot-rubles">В рублях</div>
        <div class="lot-box lot-status">Статус</div>
    </div>
    <div class="lots-body">
      <? foreach ($lots as $lot): ?>
          <div class="lot-item">
              <div class="lot-box lot-id"><?=$lot['id']?></div>
              <div class="lot-box lot-currency"><?=$lot['name']?></div>
              <div class="lot-box lot-amount"><?=$lot['amount']?></div>
              <div class="lot-box lot-rubles"><?=$lot['rubles']?></div>
              <div class="lot-box lot-status <?=$lot['status']?>"><?=$statuses[$lot['status']]?></div>
          </div>
      <? endforeach; ?>
    </div>
</section>

<section class="section-add-lot">
    <div class="form-container">
        <div class="form-header">
            Добавить лот
        </div>
        <div class="form-body">
            <form action="/lot/create" method="post">
                <div class="form-group">
                    <div class="form-field">
                        <label for="create-amount" class="input-label">Сумма</label>
                        <input id="create-amount" type="text" name="amount">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-field select-block">
                        <label class="input-label">Валюта</label>
                        <span class="dropdown-el">
                            <input type="radio" name="currency" value="none" checked="checked" id="select-default">
                            <label for="select-default"></label>
                          <? foreach ($currencies as $currency): ?>
                              <input type="radio" name="currency" value="<?= $currency['id'] ?>" id="option-<?= $currency['id'] ?>">
                              <label for="option-<?= $currency['id'] ?>"><?= $currency['name'] ?></label>
                          <? endforeach; ?>
                        </span>
                    </div>
                </div>

                <div class="form-submit">
                    <input type="submit" value="Создать лот" class="base-button button-submit button-yellow">
                </div>
            </form>
        </div>
    </div>
</section>