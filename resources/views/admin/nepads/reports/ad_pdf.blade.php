<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad Report PDF</title>
    <style>
        body { font-family: DejaVu Sans, Helvetica, Arial, sans-serif; font-size: 12px; color: #111827; }
        .container { width: 100%; }
        .header { display:flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .brand { font-weight: 700; font-size: 18px; }
        .muted { color: #6b7280; }
        .card { border: 1px solid #e5e7eb; border-radius: 6px; padding: 10px; margin-bottom: 12px; }
        .grid { display: flex; gap: 12px; }
        .grid .card { flex: 1; text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; }
        th { background: #f9fafb; font-size: 11px; text-transform: uppercase; color: #6b7280; }
        h1 { font-size: 18px; margin: 0 0 6px; }
        h2 { font-size: 14px; margin: 12px 0 6px; }
        .footer { margin-top: 16px; font-size: 10px; color: #6b7280; text-align: right; }
        .note { padding: 8px; border: 1px dashed #f59e0b; background: #fffbeb; color: #92400e; border-radius: 4px; margin-bottom: 12px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="brand">Ad Report</div>
        <div class="muted">Range: {{ $start->toDateString() }} → {{ $end->toDateString() }}</div>
    </div>

    <h1>{{ $ad->title }}</h1>
    <div class="muted">Type: {{ ucfirst($ad->type) }} • Status: {{ ucfirst($ad->status) }}</div>

    @if(!empty($missingPdf))
        <div class="note">
            PDF generator not installed. To enable PDF downloads, run:<br>
            composer require barryvdh/laravel-dompdf<br>
            php artisan vendor:publish --provider="Barryvdh\\DomPDF\\ServiceProvider"
        </div>
    @endif

    <div class="grid">
        <div class="card">
            <div class="muted">Impressions</div>
            <div style="font-size:22px; font-weight:700;">{{ number_format($impressions) }}</div>
        </div>
        <div class="card">
            <div class="muted">Clicks</div>
            <div style="font-size:22px; font-weight:700;">{{ number_format($clicks) }}</div>
        </div>
        <div class="card">
            <div class="muted">CTR</div>
            <div style="font-size:22px; font-weight:700;">{{ number_format($ctr, 2) }}%</div>
        </div>
    </div>

    <h2>Breakdown by Placement</h2>
    <table>
        <thead>
            <tr>
                <th>Placement</th>
                <th>Impressions</th>
                <th>Clicks</th>
                <th>CTR</th>
            </tr>
        </thead>
        <tbody>
            @forelse($placements as $p)
                <tr>
                    <td>{{ $p['name'] }}</td>
                    <td>{{ number_format($p['impressions']) }}</td>
                    <td>{{ number_format($p['clicks']) }}</td>
                    <td>{{ number_format($p['ctr'], 2) }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="muted">No data for this range.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->toDateTimeString() }}
    </div>
</div>
</body>
</html>
