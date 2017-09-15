<div class="row">
  <div class="col-2">
      <div class="right-sidebar">
    <h1>News</h1>
    @php
    $csgonewsurl = 'http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid=730&count=7&maxlength=300&format=json';
    $jsoncsgonews = file_get_contents($csgonewsurl);
    $csgonews = json_decode($jsoncsgonews);
    $allNews = $csgonews->appnews->newsitems;
    foreach ($allNews as $news) {
        $title  = $news->title;
        $url = $news->url;
        $date = date('d.m.Y', $news->date);
        @endphp
            <h4>{{ $date }} </h4> <p><a href="{{ $url }}" target="_blank">{{ $title }} </a></p>
        @php
    }
    @endphp
</div>
</div>
</div>
