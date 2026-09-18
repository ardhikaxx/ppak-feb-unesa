@props(['day' => '', 'month' => '', 'category' => '', 'time' => '', 'venue' => '', 'title' => '', 'desc' => '', 'status' => '', 'isUpcoming' => false])
<div class="event-item-card" {{ $attributes }}>
    <div class="event-date-box">
        <span class="event-date-day">{{ $day }}</span>
        <span class="event-date-month">{{ $month }}</span>
    </div>
    <div class="flex-grow-1">
        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
            @if($category)
                <x-badge variant="navy" style="font-size:0.725rem;">{{ $category }}</x-badge>
            @endif
            @if($time)
                <span class="small text-muted"><i class="fa-regular fa-clock me-1"></i> {{ $time }}</span>
            @endif
            @if($venue)
                <span class="small text-muted"><i class="fa-solid fa-location-dot me-1"></i> {{ $venue }}</span>
            @endif
        </div>
        <h4 class="fs-6 fw-bold text-navy mb-1">{{ $title }}</h4>
        @if($desc)
            <p class="small text-secondary mb-0">{{ $desc }}</p>
        @endif
    </div>
    <div class="ms-lg-auto flex-shrink-0">
        <x-badge :variant="$isUpcoming ? 'green' : 'navy'">{{ $status }}</x-badge>
    </div>
</div>
