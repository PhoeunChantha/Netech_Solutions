@php
    $statusMapping = [
        'Pending' => ['label' => 'Pending', 'class' => 'btn-warning'], 
        'Recieved' => ['label' => 'Recieved', 'class' => 'btn-primary disabled'], 
        'Ordered' => ['label' => 'Ordered', 'class' => 'btn-danger'], 
    ];

    $currentStatus = $purchase->purchase_status ?? 'Pending';
    $statusText = $statusMapping[$currentStatus]['label'];
    $statusClass = $statusMapping[$currentStatus]['class'];
@endphp
<div class="btn-group">
    <button type="button" class="btn btn-sm {{ $statusClass }} dropdown-toggle status-dropdown" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        {{ $statusText }}
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li>
            <a href="javascript:void(0)"
                class="change_status pending-status dropdown-item {{ $currentStatus == 'Pending' ? 'active' : '' }}"
                data-id="{{ $purchase->id }}" data-status="Pending">
                Pending
            </a>
        </li>
        <li>
            <a href="javascript:void(0)"
                class="change_status Recieved-status dropdown-item {{ $currentStatus == 'Recieved' ? 'active' : '' }}"
                data-id="{{ $purchase->id }}" data-status="Recieved">
                Recieved
            </a>
        </li>
        <li>
            <a href="javascript:void(0)"
                class="change_status Ordered-status dropdown-item {{ $currentStatus == 'Ordered' ? 'active' : '' }}"
                data-id="{{ $purchase->id }}" data-status="Ordered">
                Ordered
            </a>
        </li>
    </ul>
</div>
