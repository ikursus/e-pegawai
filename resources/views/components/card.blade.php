<div class="card">
    <div class="card-header">
      {{ $title ?? "Tajuk" }}
    </div>
    <div class="card-body">
        {{ $slot ?? "Mesej"}}
    </div>
</div>
