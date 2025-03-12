@php
    $statusMapping = [
        'Pending' => ['label' => 'Pending', 'class' => 'btn-warning'], 
        'Completed' => ['label' => 'Completed', 'class' => 'btn-primary disabled'], 
        'Canceled' => ['label' => 'Canceled', 'class' => 'btn-danger'], 
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
                class="change_status completed-status dropdown-item {{ $currentStatus == 'Completed' ? 'active' : '' }}"
                data-id="{{ $purchase->id }}" data-status="Completed">
                Completed
            </a>
        </li>
        <li>
            <a href="javascript:void(0)"
                class="change_status canceled-status dropdown-item {{ $currentStatus == 'Canceled' ? 'active' : '' }}"
                data-id="{{ $purchase->id }}" data-status="Canceled">
                Canceled
            </a>
        </li>
    </ul>
</div>
