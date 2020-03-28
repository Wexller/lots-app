<h2>Main page</h2>

<style>
  .flexbox {
    display: flex;
  }

  .flexbox p {
    margin-right: 10px;
  }
</style>

<? foreach ($lots as $lot): ?>
  <div class="flexbox">
    <p><b><?=$lot['name']?></b></p>
    <p><?=$lot['id']?></p>
    <p><?=$lot['amount']?></p>
    <p><?=$lot['rubles']?></p>
    <p><?=$statuses[$lot['status']]?></p>
  </div>

  <hr>
<? endforeach; ?>

<form action="/lot/create" method="post">
    <label for="create-amount">Сумма</label>
    <input id="create-amount" type="number" name="amount" step="0.01">

    <label for="create-currency">Валюта</label>
    <select name="currency" id="create-currency">
        <option value="none">Выберете</option>
        <? foreach ($currencies as $currency): ?>
            <option value="<?= $currency['id'] ?>"><?= $currency['name'] ?></option>
        <?endforeach;?>
    </select>

    <input type="submit" value="Создать лот">
</form>
