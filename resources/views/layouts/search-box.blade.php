<div class="search-box">
  <h2>Easily find statistic for player</h2>
  <form method="post" action="">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" placeholder="Paste link to Steam user profile, user ID or custom URL(full)" class="form-control" id="steamid" name="steamid">
        <span class="input-group-btn">
            <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </span>
    </div>
  </form>
</div>
