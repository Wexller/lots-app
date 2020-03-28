<h1>Лоты</h1>

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

    <input type="button" value="Купить" class="lot-action" data-option="purchase" data-lot-id="<?=$lot['id']?>">
    <input type="button" value="Отклонить" class="lot-action" data-option="decline" data-lot-id="<?=$lot['id']?>">
  </div>

  <hr>
<? endforeach; ?>
