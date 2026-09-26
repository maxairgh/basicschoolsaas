<div style="display: flex; align-items: center; gap: 12px;">
    <img
        src="{{ asset('storage/' . auth()->user()->school?->school_badge ?? '') }}"
        alt="School Badge"
        style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;"
    >

    <strong style="font-size: 16px; white-space: nowrap;">
        {{ auth()->user()->school->school_name ?? '' }}
    </strong>
</div>